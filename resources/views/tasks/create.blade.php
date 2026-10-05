@extends('layouts.app')

@section('title', 'Add Task - Task & Project Tracker')

@section('eyebrow', 'TASKS')

@section('page-title', 'Add Task')

@section('page-description')
    Create a new task for your workspace.
@endsection

@section('content')

<div class="task-page">

    <div class="form-container">

        <div class="form-header">

            <div>
                <h1>Create New Task</h1>

                <p>
                    Add a task and assign it to a project.
                </p>
            </div>

            <a
                href="{{ route('tasks.index') }}"
                class="back-btn"
            >
                ← Back to Tasks
            </a>

        </div>


        <div class="form-card">

            <form
                action="{{ route('tasks.store') }}"
                method="POST"
            >

                @csrf


                <!-- TASK INFORMATION -->

                <div class="form-section">

                    <div class="form-section-title">
                        Task Information
                    </div>

                    <div class="form-section-description">
                        Enter the basic information about the task.
                    </div>


                    <!-- TASK NAME -->

                    <div class="form-group">

                        <label for="task_name">
                            Task Name <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="task_name"
                            name="task_name"
                            value="{{ old('task_name') }}"
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
                            Project <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="project"
                            name="project"
                            value="{{ old('project') }}"
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
                        >{{ old('description') }}</textarea>

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
                        Set the person, priority, status, and deadline.
                    </div>


                    <div class="form-grid">


                        <!-- ASSIGNED TO -->

                        <div class="form-group">

                            <label for="assigned_to">
                                Assigned To <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="assigned_to"
                                name="assigned_to"
                                value="{{ old('assigned_to') }}"
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
                                Priority <span>*</span>
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
                                    {{ old('priority') == 'Low' ? 'selected' : '' }}
                                >
                                    Low
                                </option>

                                <option
                                    value="Medium"
                                    {{ old('priority') == 'Medium' ? 'selected' : '' }}
                                >
                                    Medium
                                </option>

                                <option
                                    value="High"
                                    {{ old('priority') == 'High' ? 'selected' : '' }}
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
                                Status <span>*</span>
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
                                    {{ old('status') == 'Pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="In Progress"
                                    {{ old('status') == 'In Progress' ? 'selected' : '' }}
                                >
                                    In Progress
                                </option>

                                <option
                                    value="Completed"
                                    {{ old('status') == 'Completed' ? 'selected' : '' }}
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
                                value="{{ old('due_date') }}"
                            >

                            @error('due_date')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                    </div>

                </div>


                <!-- FORM ACTIONS -->

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
                        Create Task
                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection