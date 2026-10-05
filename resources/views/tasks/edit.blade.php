<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Task - Task & Project Tracker</title>

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

                <h1>Edit Task</h1>

                <p>
                    Update the information for this task.
                </p>

            </div>

            <a
                href="{{ route('tasks.index') }}"
                class="back-btn"
            >
                ← Back to Tasks
            </a>

        </div>


        <!-- FORM CARD -->

        <div class="form-card">

            <form
                action="{{ route('tasks.update', $task->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <!-- TASK INFORMATION -->

                <div class="form-section">

                    <div class="form-section-title">
                        Task Information
                    </div>

                    <div class="form-section-description">
                        Update the basic information about the task.
                    </div>


                    <!-- TASK NAME -->

                    <div class="form-group">

                        <label for="task_name">
                            Task Name
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="task_name"
                            name="task_name"
                            value="{{ old('task_name', $task->task_name) }}"
                            placeholder="e.g. Create Login Page"
                        >

                        @error('task_name')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PROJECT -->

                    <div class="form-group">

                        <label for="project">
                            Project
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="project"
                            name="project"
                            value="{{ old('project', $task->project) }}"
                            placeholder="e.g. KIDDEX"
                        >

                        @error('project')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Describe the task..."
                        >{{ old('description', $task->description) }}</textarea>

                        @error('description')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <!-- ASSIGNMENT -->

                <div class="form-section">

                    <div class="form-section-title">
                        Assignment
                    </div>

                    <div class="form-section-description">
                        Update the person, priority, status, and deadline.
                    </div>


                    <div class="form-grid">


                        <!-- ASSIGNED TO -->

                        <div class="form-group">

                            <label for="assigned_to">
                                Assigned To
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="assigned_to"
                                name="assigned_to"
                                value="{{ old('assigned_to', $task->assigned_to) }}"
                                placeholder="e.g. CJ Cerbito"
                            >

                            @error('assigned_to')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- PRIORITY -->

                        <div class="form-group">

                            <label for="priority">
                                Priority
                                <span>*</span>
                            </label>

                            <select
                                id="priority"
                                name="priority"
                            >

                                <option value="">
                                    Select priority
                                </option>

                                <option
                                    value="Low"
                                    {{ old('priority', $task->priority) == 'Low' ? 'selected' : '' }}
                                >
                                    Low
                                </option>

                                <option
                                    value="Medium"
                                    {{ old('priority', $task->priority) == 'Medium' ? 'selected' : '' }}
                                >
                                    Medium
                                </option>

                                <option
                                    value="High"
                                    {{ old('priority', $task->priority) == 'High' ? 'selected' : '' }}
                                >
                                    High
                                </option>

                            </select>

                            @error('priority')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- STATUS -->

                        <div class="form-group">

                            <label for="status">
                                Status
                                <span>*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                            >

                                <option value="">
                                    Select status
                                </option>

                                <option
                                    value="Pending"
                                    {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="In Progress"
                                    {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}
                                >
                                    In Progress
                                </option>

                                <option
                                    value="Completed"
                                    {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}
                                >
                                    Completed
                                </option>

                            </select>

                            @error('status')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- DUE DATE -->

                        <div class="form-group">

                            <label for="due_date">
                                Due Date
                            </label>

                            <input
                                type="date"
                                id="due_date"
                                name="due_date"
                                value="{{ old('due_date', $task->due_date) }}"
                            >

                            @error('due_date')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>


                <!-- BUTTONS -->

                <div class="form-actions">

                    <a
                        href="{{ route('tasks.index') }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="save-task-btn"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>