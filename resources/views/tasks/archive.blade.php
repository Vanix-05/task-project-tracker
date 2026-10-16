@extends('layouts.app')

@section('title', 'Archive - Task & Project Tracker')
@section('eyebrow', 'WORKSPACE')
@section('page-title', 'Archive')
@section('page-description')
    View and restore tasks that have been archived.
@endsection

@section('content')

<div class="task-page">

    <div class="task-page-header">
        <div>
            <h2>Archived Tasks</h2>
            <p>Restore tasks or permanently remove them.</p>
        </div>

        <a href="{{ route('tasks.index') }}" class="back-btn">
            ← Back to Tasks
        </a>
    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="dashboard-success">
            <span>✓</span>
            {{ session('success') }}
        </div>
    @endif


    {{-- ARCHIVED TASKS CARD --}}
    <div class="dashboard-card tasks-table-card">

        <div class="dashboard-card-header">
            <div>
                <span class="card-eyebrow">ARCHIVE</span>
                <h2>Archived Tasks</h2>
                <p>These tasks are hidden from your active task list.</p>
            </div>
        </div>


        @if($tasks->count() > 0)

            <div class="table-wrapper">

                <table class="tasks-table">

                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Project</th>
                            <th>Assigned To</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Archived</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($tasks as $task)

                            <tr>

                                {{-- TASK --}}
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


                                {{-- PROJECT --}}
                                <td>
                                    <span class="table-project">
                                        <i data-lucide="folder"></i>
                                        {{ $task->project }}
                                    </span>
                                </td>


                                {{-- ASSIGNED TO --}}
                                <td>
                                    <span class="assigned-user">

                                        <span class="mini-avatar">
                                            {{ strtoupper(substr($task->assigned_to, 0, 1)) }}
                                        </span>

                                        {{ $task->assigned_to }}

                                    </span>
                                </td>


                                {{-- PRIORITY --}}
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


                                {{-- STATUS --}}
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


                                {{-- ARCHIVED DATE --}}
                                <td>

                                    <span class="task-due-date">

                                        <i data-lucide="archive"></i>

                                        {{ \Carbon\Carbon::parse($task->deleted_at)->format('M d, Y') }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="task-actions">

                                        {{-- RESTORE --}}
                                        <form
                                            action="{{ route('tasks.restore', $task->id) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="task-action-btn view"
                                                title="Restore task"
                                            >
                                                <i data-lucide="archive-restore"></i>
                                            </button>

                                        </form>


                                        {{-- PERMANENT DELETE --}}
                                        <form
                                            action="{{ route('tasks.forceDelete', $task->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Permanently delete this task? This cannot be undone.');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="task-action-btn delete"
                                                title="Delete permanently"
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

            </div>

        @else

            {{-- EMPTY ARCHIVE --}}
            <div class="dashboard-empty">

                <div class="dashboard-empty-icon">
                    <i data-lucide="archive"></i>
                </div>

                <strong>
                    Archive is empty
                </strong>

                <span>
                    Archived tasks will appear here.
                </span>

                <a href="{{ route('tasks.index') }}">
                    ← Back to Tasks
                </a>

            </div>

        @endif

    </div>

</div>

@endsection