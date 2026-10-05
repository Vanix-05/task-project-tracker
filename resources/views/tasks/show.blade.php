<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>View Task - Task & Project Tracker</title>

    @vite([
        'resources/css/app.css',
        'resources/css/tasks.css',
        'resources/js/app.js'
    ])

</head>

<body>

<div class="task-page">

    <div class="form-container">

        <!-- HEADER -->

        <div class="form-header">

            <div>

                <h1>Task Details</h1>

                <p>
                    View the complete information about this task.
                </p>

            </div>

            <a
                href="{{ route('tasks.index') }}"
                class="back-btn"
            >
                ← Back to Tasks
            </a>

        </div>


        <!-- MAIN CARD -->

        <div class="form-card">

            <!-- TASK INFORMATION -->

            <div class="form-section">

                <div class="form-section-title">
                    Task Information
                </div>

                <div class="form-section-description">
                    Basic information about the selected task.
                </div>


                <!-- TASK NAME -->

                <div class="view-field">

                    <div class="view-label">
                        Task Name
                    </div>

                    <div class="view-value">
                        {{ $task->task_name }}
                    </div>

                </div>


                <!-- PROJECT -->

                <div class="view-field">

                    <div class="view-label">
                        Project
                    </div>

                    <div class="view-value">
                        {{ $task->project }}
                    </div>

                </div>


                <!-- DESCRIPTION -->

                <div class="view-field">

                    <div class="view-label">
                        Description
                    </div>

                    <div class="view-value view-description">

                        {{ $task->description ?: 'No description provided.' }}

                    </div>

                </div>

            </div>


            <!-- ASSIGNMENT -->

            <div class="form-section">

                <div class="form-section-title">
                    Assignment
                </div>

                <div class="form-section-description">
                    Assignment, priority, status, and deadline information.
                </div>


                <div class="view-grid">


                    <!-- ASSIGNED TO -->

                    <div class="view-field">

                        <div class="view-label">
                            Assigned To
                        </div>

                        <div class="view-value">
                            {{ $task->assigned_to }}
                        </div>

                    </div>


                    <!-- PRIORITY -->

                    <div class="view-field">

                        <div class="view-label">
                            Priority
                        </div>

                        <div class="view-value">

                            @if($task->priority === 'High')

                                <span class="badge priority-high">
                                    High
                                </span>

                            @elseif($task->priority === 'Medium')

                                <span class="badge priority-medium">
                                    Medium
                                </span>

                            @else

                                <span class="badge priority-low">
                                    Low
                                </span>

                            @endif

                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="view-field">

                        <div class="view-label">
                            Status
                        </div>

                        <div class="view-value">

                            @if($task->status === 'Completed')

                                <span class="badge status-completed">
                                    Completed
                                </span>

                            @elseif($task->status === 'In Progress')

                                <span class="badge status-progress">
                                    In Progress
                                </span>

                            @else

                                <span class="badge status-pending">
                                    Pending
                                </span>

                            @endif

                        </div>

                    </div>


                    <!-- DUE DATE -->

                    <div class="view-field">

                        <div class="view-label">
                            Due Date
                        </div>

                        <div class="view-value">

                            {{ $task->due_date
                                ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y')
                                : 'No due date'
                            }}

                        </div>

                    </div>

                </div>

            </div>


            <!-- ACTION BUTTONS -->

            <div class="form-actions">

                <a
                    href="{{ route('tasks.index') }}"
                    class="cancel-btn"
                >
                    Back to Tasks
                </a>

                <a
                    href="{{ route('tasks.edit', $task->id) }}"
                    class="save-task-btn"
                >
                    Edit Task
                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>