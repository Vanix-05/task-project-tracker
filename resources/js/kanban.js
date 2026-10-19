
document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('kanbanBoard');

    if (!board) return;

    const message = document.getElementById('kanbanStatusMessage');
    const dropzones = board.querySelectorAll('.kanban-dropzone');

    let draggedTask = null;
    let originalParent = null;
    let originalNextSibling = null;
    let originalStatus = null;

    function showMessage(text, type = 'success') {
        if (!message) return;

        message.textContent = text;
        message.dataset.type = type;
        message.classList.add('is-visible');
    }

    function updateColumnCounts() {
        board.querySelectorAll('.kanban-column').forEach(column => {
            const zone = column.querySelector('.kanban-dropzone');
            const count = column.querySelector('.kanban-count');

            if (zone && count) {
                count.textContent =
                    zone.querySelectorAll('.kanban-task').length;
            }
        });
    }

    // Update the statistics on the Tasks page.
    function updateTaskStatistics(data) {
        const elements = {
            totalTasks: document.getElementById('taskLiveTotalTasks'),
            pendingTasks: document.getElementById('taskLivePendingTasks'),
            inProgressTasks: document.getElementById('taskLiveInProgressTasks'),
            completedTasks: document.getElementById('taskLiveCompletedTasks')
        };

        if (elements.totalTasks) {
            elements.totalTasks.textContent = data.totalTasks;
        }

        if (elements.pendingTasks) {
            elements.pendingTasks.textContent = data.pendingTasks;
        }

        if (elements.inProgressTasks) {
            elements.inProgressTasks.textContent = data.inProgressTasks;
        }

        if (elements.completedTasks) {
            elements.completedTasks.textContent = data.completedTasks;
        }
    }

    // Retrieve the latest counts from Laravel.
    async function refreshTaskStatistics() {
        try {
            const response = await fetch('/dashboard/live-data', {
                headers: {
                    'Accept': 'application/json'
                },
                cache: 'no-store'
            });

            if (!response.ok) {
                throw new Error('Could not refresh task statistics.');
            }

            const data = await response.json();
            updateTaskStatistics(data);
        } catch (error) {
            console.error('Task statistics refresh failed:', error);
        }
    }

    board.addEventListener('dragstart', event => {
        const task = event.target.closest('.kanban-task');

        if (!task) return;

        draggedTask = task;
        originalParent = task.parentElement;
        originalNextSibling = task.nextElementSibling;
        originalStatus = task.dataset.status;

        task.classList.add('is-dragging');

        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', task.dataset.taskId);
    });

    board.addEventListener('dragend', () => {
        if (draggedTask) {
            draggedTask.classList.remove('is-dragging');
        }

        dropzones.forEach(zone => {
            zone.classList.remove('is-drag-over');
        });

        draggedTask = null;
        originalParent = null;
        originalNextSibling = null;
        originalStatus = null;
    });

    dropzones.forEach(zone => {
        zone.addEventListener('dragover', event => {
            if (!draggedTask) return;

            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
            zone.classList.add('is-drag-over');
        });

        zone.addEventListener('dragleave', event => {
            if (!zone.contains(event.relatedTarget)) {
                zone.classList.remove('is-drag-over');
            }
        });

        zone.addEventListener('drop', async event => {
            event.preventDefault();
            zone.classList.remove('is-drag-over');

            if (!draggedTask || !originalParent) return;

            const task = draggedTask;
            const taskId = task.dataset.taskId;
            const newStatus = zone.dataset.status;

            // Save the original position locally before the request.
            const sourceParent = originalParent;
            const sourceNextSibling = originalNextSibling;
            const sourceStatus = originalStatus;

            if (!taskId || !newStatus || newStatus === sourceStatus) {
                return;
            }

            // Move the card immediately in the UI.
            zone.appendChild(task);
            task.dataset.status = newStatus;
            task.classList.add('is-saving');

            updateColumnCounts();

            try {
                const response = await fetch(
                    `/tasks/${encodeURIComponent(taskId)}/status`,
                    {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                )?.getAttribute('content') ?? ''
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    }
                );

                const result = await response.json().catch(() => ({}));

                if (!response.ok) {
                    throw new Error(
                        result.message || 'Could not save the task status.'
                    );
                }

                task.dataset.status = result.task?.status ?? newStatus;

                // Refresh the statistics after Laravel saves the change.
                await refreshTaskStatistics();

                showMessage(
                    result.message || 'Task status updated successfully.'
                );
            } catch (error) {
                // Restore the card if saving failed.
                if (sourceNextSibling &&
                    sourceNextSibling.parentElement === sourceParent) {
                    sourceParent.insertBefore(task, sourceNextSibling);
                } else {
                    sourceParent.appendChild(task);
                }

                task.dataset.status = sourceStatus;

                updateColumnCounts();

                showMessage(
                    error.message || 'Could not update task status.',
                    'error'
                );
            } finally {
                task.classList.remove('is-saving');
            }
        });
    });

    updateColumnCounts();

    // Load the latest counts when the board opens.
    refreshTaskStatistics();
});
