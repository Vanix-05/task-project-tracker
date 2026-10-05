@extends('layouts.app')

@section('title', 'Tasks - Task & Project Tracker')

@section('eyebrow', 'WORKSPACE')

@section('page-title', 'Tasks')

@section('page-description')
    Manage your tasks, projects, priorities, and deadlines.
@endsection

@section('content')

<div class="task-page">

    <!-- =========================================
         TASK HEADER
         ========================================= -->

    <div class="task-page-header">

        <div>
            <h2>
                All Tasks
            </h2>

            <p>
                View and manage everything in your workspace.
            </p>
        </div>

        <a
            href="{{ route('tasks.create') }}"
            class="add-task-btn"
        >
            <span>
                +
            </span>

            Add Task
        </a>

    </div>


    <!-- =========================================
         SUCCESS MESSAGE
         ========================================= -->

    @if(session('success'))

        <div class="dashboard-success">

            <span>
                ✓
            </span>

            {{ session('success') }}

        </div>

    @endif


    <!-- =========================================
         STATISTICS
         ========================================= -->

    <div class="dashboard-stats">


        <!-- TOTAL -->

        <div class="dashboard-stat-card">

            <div class="stat-top">

                <span class="dashboard-stat-label">
                    Total Tasks
                </span>

                <div class="stat-icon purple">
                    <i data-lucide="list-check"></i>
                </div>

            </div>

            <strong class="dashboard-stat-number">
                {{ $tasks->count() }}
            </strong>

            <span class="stat-description">
                All tasks in workspace
            </span>

        </div>


        <!-- PENDING -->

        <div class="dashboard-stat-card">

            <div class="stat-top">

                <span class="dashboard-stat-label">
                    Pending
                </span>

                <div class="stat-icon gray">
                    <i data-lucide="clock-3"></i>
                </div>

            </div>

            <strong class="dashboard-stat-number">
                {{ $tasks->where('status', 'Pending')->count() }}
            </strong>

            <span class="stat-description">
                Waiting to be started
            </span>

        </div>


        <!-- IN PROGRESS -->

        <div class="dashboard-stat-card">

            <div class="stat-top">

                <span class="dashboard-stat-label">
                    In Progress
                </span>

                <div class="stat-icon blue">
                    <i data-lucide="loader-circle"></i>
                </div>

            </div>

            <strong class="dashboard-stat-number">
                {{ $tasks->where('status', 'In Progress')->count() }}
            </strong>

            <span class="stat-description">
                Currently being worked on
            </span>

        </div>


        <!-- COMPLETED -->

        <div class="dashboard-stat-card">

            <div class="stat-top">

                <span class="dashboard-stat-label">
                    Completed
                </span>

                <div class="stat-icon green">
                    <i data-lucide="circle-check"></i>
                </div>

            </div>

            <strong class="dashboard-stat-number">
                {{ $tasks->where('status', 'Completed')->count() }}
            </strong>

            <span class="stat-description">
                Successfully finished
            </span>

        </div>


    </div>


    <!-- =========================================
         TASK TABLE
         ========================================= -->

    <div class="dashboard-card tasks-table-card">


        <div class="dashboard-card-header">

            <div>

                <span class="card-eyebrow">
                    TASK MANAGEMENT
                </span>

                <h2>
                    Task List
                </h2>

                <p>
                    Select a task to view, edit, or delete it.
                </p>

            </div>

        </div>
        <!-- =========================================
     SEARCH & FILTERS
     ========================================= -->

<div class="task-filters">

    <!-- SEARCH -->

    <div class="task-search">

        <i data-lucide="search"></i>

        <input
            type="text"
            id="taskSearch"
            placeholder="Search tasks..."
            autocomplete="off"
        >

    </div>


    <!-- PROJECT FILTER -->

    <select id="projectFilter">

        <option value="all">
            All Projects
        </option>

        @foreach($tasks->pluck('project')->unique()->sort() as $project)

            <option value="{{ strtolower($project) }}">
                {{ $project }}
            </option>

        @endforeach

    </select>


    <!-- STATUS FILTER -->

    <select id="statusFilter">

        <option value="all">
            All Status
        </option>

        <option value="pending">
            Pending
        </option>

        <option value="in progress">
            In Progress
        </option>

        <option value="completed">
            Completed
        </option>

    </select>


    <!-- PRIORITY FILTER -->

    <select id="priorityFilter">

        <option value="all">
            All Priority
        </option>

        <option value="high">
            High
        </option>

        <option value="medium">
            Medium
        </option>

        <option value="low">
            Low
        </option>

    </select>


    <!-- CLEAR -->

    <button
        type="button"
        id="clearTaskFilters"
        class="clear-task-filters"
    >

        <i data-lucide="rotate-ccw"></i>

        Clear

    </button>

</div>


        @if($tasks->count() > 0)


            <div class="table-wrapper">

                <table class="tasks-table">

                    <thead>

                        <tr>

                            <th>
                                Task
                            </th>

                            <th>
                                Project
                            </th>

                            <th>
                                Assigned To
                            </th>

                            <th>
                                Priority
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Due Date
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

    @foreach($tasks as $task)

        <tr
            class="task-row"
            data-task="{{ strtolower($task->task_name) }}"
            data-project="{{ strtolower($task->project) }}"
            data-assigned="{{ strtolower($task->assigned_to) }}"
            data-status="{{ strtolower($task->status) }}"
            data-priority="{{ strtolower($task->priority) }}"
        >

            <!-- TASK -->

            <td>

                <div class="task-table-name">

                    <strong>
                        {{ $task->task_name }}
                    </strong>

                    @if($task->description)

                        <span>
                            {{ Str::limit($task->description, 45) }}
                        </span>

                    @endif

                </div>

            </td>


            <!-- PROJECT -->

            <td>

                <span class="table-project">

                    <i data-lucide="folder"></i>

                    {{ $task->project }}

                </span>

            </td>


            <!-- ASSIGNED TO -->

            <td>

                <span class="assigned-user">

                    <span class="mini-avatar">
                        {{ strtoupper(substr($task->assigned_to, 0, 1)) }}
                    </span>

                    {{ $task->assigned_to }}

                </span>

            </td>


            <!-- PRIORITY -->

            <td>

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

            </td>


            <!-- STATUS -->

            <td>

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

            </td>


            <!-- DUE DATE -->

            <td>

                @if($task->due_date)

                    <span class="task-due-date">

                        <i data-lucide="calendar"></i>

                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}

                    </span>

                @else

                    <span class="no-date">
                        No date
                    </span>

                @endif

            </td>


            <!-- ACTIONS -->

            <td>

                <div class="task-actions">


                    <!-- VIEW -->

                    <a
                        href="{{ route('tasks.show', $task->id) }}"
                        class="task-action-btn view"
                        title="View task"
                    >

                        <i data-lucide="eye"></i>

                    </a>


                    <!-- EDIT -->

                    <a
                        href="{{ route('tasks.edit', $task->id) }}"
                        class="task-action-btn edit"
                        title="Edit task"
                    >

                        <i data-lucide="pencil"></i>

                    </a>


                    <!-- DELETE -->

                    <form
                        action="{{ route('tasks.destroy', $task->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="task-action-btn delete"
                            title="Delete task"
                        >

                            <i data-lucide="trash-2"></i>

                        </button>

                    </form>

                </div>

            </td>

        </tr>

    @endforeach

</tbody>

                </table>
                    <div
                id="noTaskResults"
                    class="no-task-results"
                    style="display: none;"
                >

                    <div class="no-task-results-icon">
                <i data-lucide="search-x"></i>
            </div>

        <strong>
        No tasks found
        </strong>

        <span>
        Try changing your search or filters.
        </span>

</div>
            </div>


        @else


            <!-- EMPTY STATE -->

            <div class="dashboard-empty">

                <div class="dashboard-empty-icon">

                    <i data-lucide="clipboard-list"></i>

                </div>

                <strong>
                    No tasks yet
                </strong>

                <span>
                    Create your first task to get started.
                </span>

                <a href="{{ route('tasks.create') }}">
                    + Create Task
                </a>

            </div>


        @endif


    </div>


</div>

@endsection