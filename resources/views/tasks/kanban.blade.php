
<div class="kanban-board" id="kanbanBoard">
    @php
        $columns = [
            'Pending' => [
                'label' => 'To Do',
                'class' => 'pending',
                'description' => 'Ready to be started',
            ],
            'In Progress' => [
                'label' => 'In Progress',
                'class' => 'progress',
                'description' => 'Currently being worked on',
            ],
            'Completed' => [
                'label' => 'Completed',
                'class' => 'completed',
                'description' => 'Finished tasks',
            ],
        ];
    @endphp

    @foreach ($columns as $status => $column)
        <section class="kanban-column kanban-{{ $column['class'] }}"
            data-status="{{ $status }}">
            <header class="kanban-column-header">
                <div>
                    <h3>{{ $column['label'] }}</h3>
                    <p>{{ $column['description'] }}</p>
                </div>

                <span class="kanban-count">
                    {{ $tasks->where('status', $status)->count() }}
                </span>
            </header>

            <div class="kanban-dropzone"
                data-status="{{ $status }}"
                aria-label="Drop tasks in {{ $column['label'] }}">
                @foreach ($tasks->where('status', $status) as $task)
                    <article class="kanban-task"
                        draggable="true"
                        data-task-id="{{ $task->id }}"
                        data-status="{{ $task->status }}">
                        <div class="kanban-task-top">
                            <span class="kanban-project">
                                {{ $task->project }}
                            </span>
                            <span class="kanban-priority priority-{{ strtolower($task->priority) }}">
                                {{ $task->priority }}
                            </span>
                        </div>

                        <h4>{{ $task->task_name }}</h4>

                        @if ($task->description)
                            <p class="kanban-description">
                                {{ \Illuminate\Support\Str::limit($task->description, 100) }}
                            </p>
                        @endif

                        <footer class="kanban-task-footer">
                            <span class="kanban-assignee">
                                <span class="kanban-avatar">
                                    {{ strtoupper(substr($task->assigned_to, 0, 1)) }}
                                </span>
                                {{ $task->assigned_to }}
                            </span>

                            @if ($task->due_date)
                                <span class="kanban-due-date">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                                </span>
                            @endif
                        </footer>

                        <a href="{{ route('tasks.edit', $task->id) }}"
                            class="kanban-edit-link">
                            Edit task
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

<div id="kanbanStatusMessage" class="kanban-status-message"
    role="status" aria-live="polite"></div>
