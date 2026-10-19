
@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="container" style="max-width: 1200px; margin: 30px auto; padding: 20px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 8px;">Projects</h1>
            <p style="margin:0; color:#888;">Manage your projects and deadlines.</p>
        </div>

        <a href="{{ route('projects.create') }}"
           style="background:#7c3aed; color:white; padding:12px 18px; border-radius:8px; text-decoration:none;">
            + New Project
        </a>
    </div>

    @if(session('success'))
        <div style="padding:12px; margin-bottom:18px; background:#dcfce7; color:#166534; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="padding:12px; margin-bottom:18px; background:#fee2e2; color:#991b1b; border-radius:8px;">
            Please check the form errors.
        </div>
    @endif

    <div style="background:#fff; border:1px solid #e5e7eb; border-radius:12px; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; text-align:left;">
            <thead style="background:#f8fafc;">
                <tr>
                    <th style="padding:14px;">Project</th>
                    <th style="padding:14px;">Start Date</th>
                    <th style="padding:14px;">Due Date</th>
                    <th style="padding:14px;">Status</th>
                    <th style="padding:14px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr style="border-top:1px solid #e5e7eb;">
                        <td style="padding:14px;">
                            <strong>{{ $project->name }}</strong>
                            <div style="color:#888; font-size:13px;">
                                {{ \Illuminate\Support\Str::limit($project->description, 70) }}
                            </div>
                        </td>
                        <td style="padding:14px;">{{ $project->start_date ?? '—' }}</td>
                        <td style="padding:14px;">{{ $project->due_date ?? '—' }}</td>
                        <td style="padding:14px;">{{ $project->status }}</td>
                        <td style="padding:14px; white-space:nowrap;">
                            <a href="{{ route('projects.edit', $project) }}">Edit</a>
                            <form action="{{ route('projects.destroy', $project) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="margin-left:8px; color:#dc2626; cursor:pointer;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:35px; text-align:center; color:#888;">
                            No projects yet. Select “New Project” to create your first one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
