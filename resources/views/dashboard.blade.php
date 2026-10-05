@extends('layouts.app')

@section('title', 'Dashboard - Task & Project Tracker')

@section('eyebrow', 'OVERVIEW')

@section('page-title', 'Dashboard')

@section('page-description')
    Here's what's happening with your tasks today.
@endsection

@section('content')


<!-- =========================================
     SUCCESS MESSAGE
     ========================================= -->

@if(session('success'))

    <div class="dashboard-success">

        <i data-lucide="circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


<!-- =========================================
     STATISTICS
     ========================================= -->

<section class="dashboard-stats">


    <!-- TOTAL TASKS -->

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
            {{ $totalTasks }}
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
                <i data-lucide="circle-dashed"></i>
            </div>

        </div>

        <strong class="dashboard-stat-number">
            {{ $pendingTasks }}
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
                <i data-lucide="arrow-right"></i>
            </div>

        </div>

        <strong class="dashboard-stat-number">
            {{ $inProgressTasks }}
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
            {{ $completedTasks }}
        </strong>

        <span class="stat-description">
            Successfully finished
        </span>

    </div>

</section>


<!-- =========================================
     MAIN GRID
     ========================================= -->

<section class="dashboard-grid">


    <!-- =====================================
         MY TASKS
         ===================================== -->

    <div class="dashboard-card tasks-card">

        <div class="dashboard-card-header">

            <div>

                <span class="card-eyebrow">
                    WORKSPACE
                </span>

                <h2>
                    My Tasks
                </h2>

                <p>
                    Your most recent tasks.
                </p>

            </div>

            <a
                href="{{ route('tasks.index') }}"
                class="card-link"
            >
                View all →
            </a>

        </div>


        @if($recentTasks->count() > 0)

            <div class="dashboard-task-list">

                @foreach($recentTasks as $task)

                    <div class="dashboard-task">


                        <!-- TASK STATUS ICON -->

                        <div
                            class="dashboard-task-check
                            {{ strtolower(str_replace(' ', '-', $task->status)) }}"
                        >

                            @if($task->status === 'Completed')

                                <i data-lucide="check"></i>

                            @elseif($task->status === 'In Progress')

                                <i data-lucide="arrow-right"></i>

                            @else

                                <i data-lucide="circle"></i>

                            @endif

                        </div>


                        <!-- TASK INFORMATION -->

                        <div class="dashboard-task-info">

                            <strong>
                                {{ $task->task_name }}
                            </strong>

                            <span>
                                {{ $task->project }}
                            </span>

                        </div>


                        <!-- TASK STATUS -->

                        @if($task->status === 'Completed')

                            <span class="dashboard-status completed">
                                Completed
                            </span>

                        @elseif($task->status === 'In Progress')

                            <span class="dashboard-status progress">
                                In Progress
                            </span>

                        @else

                            <span class="dashboard-status pending">
                                Pending
                            </span>

                        @endif

                    </div>

                @endforeach

            </div>

        @else


            <!-- EMPTY TASK STATE -->

            <div class="dashboard-empty">

                <div class="dashboard-empty-icon">
                    <i data-lucide="clipboard-check"></i>
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


    <!-- =====================================
         PROJECT OVERVIEW
         ===================================== -->

    <div class="dashboard-card overview-card">

        <div class="dashboard-card-header">

            <div>

                <span class="card-eyebrow">
                    PERFORMANCE
                </span>

                <h2>
                    Project Overview
                </h2>

                <p>
                    Your current progress.
                </p>

            </div>

        </div>


        <!-- COMPLETION RATE -->

        <div class="completion-box">

            <div class="completion-top">

                <span>
                    Completion rate
                </span>

                <strong>
                    {{ $completionRate }}%
                </strong>

            </div>

            <div class="dashboard-progress">

                <div
                    class="dashboard-progress-fill"
                    style="width: {{ $completionRate }}%;"
                ></div>

            </div>

        </div>


        <!-- ACTIVE PROJECTS -->

        <div class="project-summary">

            <div class="project-summary-icon">
                <i data-lucide="folder-kanban"></i>
            </div>

            <div>

                <strong>
                    {{ $totalProjects }}
                </strong>

                <span>
                    Active projects
                </span>

            </div>

        </div>


        <!-- PRIORITY SUMMARY -->

        <div class="priority-summary">


            <!-- HIGH -->

            <div class="priority-row">

                <span>

                    <i class="priority-dot high"></i>

                    High priority

                </span>

                <strong>
                    {{ $highPriorityTasks }}
                </strong>

            </div>


            <!-- MEDIUM -->

            <div class="priority-row">

                <span>

                    <i class="priority-dot medium"></i>

                    Medium priority

                </span>

                <strong>
                    {{ $mediumPriorityTasks }}
                </strong>

            </div>


            <!-- LOW -->

            <div class="priority-row">

                <span>

                    <i class="priority-dot low"></i>

                    Low priority

                </span>

                <strong>
                    {{ $lowPriorityTasks }}
                </strong>

            </div>

        </div>

    </div>

</section>

<!-- =========================================
     OVERDUE TASKS
     ========================================= -->

<section class="dashboard-card overdue-card">

    <div class="dashboard-card-header">

        <div>

            <span class="card-eyebrow">
                ATTENTION
            </span>

            <h2>
                Overdue Tasks
            </h2>

            <p>
                Tasks that still need to be completed.
            </p>

        </div>

        <div class="overdue-count">

            <i data-lucide="alert-circle"></i>

            <span>
                {{ $overdueTasks }}
                {{ $overdueTasks == 1 ? 'task' : 'tasks' }}
            </span>

        </div>

    </div>


    @if($overdueTaskList->count() > 0)

        <div class="overdue-list">

            @foreach($overdueTaskList as $task)

                <div class="overdue-task">

                    <!-- ICON -->

                    <div class="overdue-task-icon">

                        <i data-lucide="triangle-alert"></i>

                    </div>


                    <!-- TASK INFORMATION -->

                    <div class="overdue-task-info">

                        <strong>
                            {{ $task->task_name }}
                        </strong>

                        <span>

                            {{ $task->project }}

                            ·

                            {{ $task->assigned_to }}

                        </span>

                    </div>


                    <!-- DUE DATE -->

                    <div class="overdue-task-date">

                        <span>
                            Due
                        </span>

                        <strong>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                        </strong>

                    </div>


                    <!-- STATUS -->

                    @if($task->status === 'In Progress')

                        <span class="dashboard-status progress">
                            In Progress
                        </span>

                    @else

                        <span class="dashboard-status pending">
                            Pending
                        </span>

                    @endif


                    <!-- VIEW -->

                    <a
                        href="{{ route('tasks.show', $task->id) }}"
                        class="overdue-view-btn"
                        title="View task"
                    >

                        <i data-lucide="arrow-up-right"></i>

                    </a>

                </div>

            @endforeach

        </div>

    @else

        <!-- NO OVERDUE TASKS -->

        <div class="overdue-empty">

            <div class="overdue-empty-icon">

                <i data-lucide="circle-check"></i>

            </div>

            <strong>
                You're all caught up!
            </strong>

            <span>
                There are no overdue tasks right now.
            </span>

        </div>

    @endif

</section>
<!-- =========================================
     UPCOMING TASKS
     ========================================= -->

<section class="dashboard-card upcoming-card">

    <div class="dashboard-card-header">

        <div>

            <span class="card-eyebrow">
                DEADLINES
            </span>

            <h2>
                Upcoming Tasks
            </h2>

            <p>
                Keep an eye on what's coming next.
            </p>

        </div>


        <a
            href="{{ route('tasks.create') }}"
            class="small-add-btn"
        >

            <i data-lucide="plus"></i>

            <span>
                Add Task
            </span>

        </a>

    </div>


    @if($upcomingTasks->count() > 0)

        <div class="upcoming-list">

            @foreach($upcomingTasks as $task)

                <div class="upcoming-task">


                    <!-- DATE -->

                    <div class="upcoming-date">

                        <strong>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('d') }}
                        </strong>

                        <span>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M') }}
                        </span>

                    </div>


                    <!-- TASK -->

                    <div class="upcoming-info">

                        <strong>
                            {{ $task->task_name }}
                        </strong>

                        <span>

                            {{ $task->project }}

                            ·

                            {{ $task->assigned_to }}

                        </span>

                    </div>


                    <!-- PRIORITY -->

                    <div class="upcoming-priority">

                        @if($task->priority === 'High')

                            <span class="priority-badge high">
                                High
                            </span>

                        @elseif($task->priority === 'Medium')

                            <span class="priority-badge medium">
                                Medium
                            </span>

                        @else

                            <span class="priority-badge low">
                                Low
                            </span>

                        @endif

                    </div>


                    <!-- EDIT -->

                    <a
                        href="{{ route('tasks.edit', $task->id) }}"
                        class="upcoming-edit"
                    >

                        <i data-lucide="pencil"></i>

                        <span>
                            Edit
                        </span>

                    </a>

                </div>

            @endforeach

        </div>

    @else

        <div class="upcoming-empty">

            <i data-lucide="calendar-x"></i>

            <span>
                No upcoming deadlines.
            </span>

        </div>

    @endif

</section>


<!-- =========================================
     PROJECT BREAKDOWN
     ========================================= -->

@if($projectBreakdown->count() > 0)

    <section class="dashboard-card project-breakdown-card">

        <div class="dashboard-card-header">

            <div>

                <span class="card-eyebrow">
                    PROJECTS
                </span>

                <h2>
                    Project Breakdown
                </h2>

                <p>
                    Tasks grouped by project.
                </p>

            </div>

        </div>


        <div class="project-breakdown-list">

            @foreach($projectBreakdown as $project)

                @php

                    $projectPercentage = $totalTasks > 0
                        ? round(($project->task_count / $totalTasks) * 100)
                        : 0;

                @endphp


                <div class="project-breakdown-row">


                    <!-- PROJECT NAME -->

                    <div class="project-breakdown-info">

                        <strong>
                            {{ $project->project }}
                        </strong>

                        <span>

                            {{ $project->task_count }}

                            {{ $project->task_count == 1 ? 'task' : 'tasks' }}

                        </span>

                    </div>


                    <!-- PROGRESS -->

                    <div class="project-breakdown-bar">

                        <div
                            style="width: {{ $projectPercentage }}%;"
                        ></div>

                    </div>


                    <!-- PERCENTAGE -->

                    <strong class="project-percentage">
                        {{ $projectPercentage }}%
                    </strong>

                </div>

            @endforeach

        </div>

    </section>

@endif


@endsection