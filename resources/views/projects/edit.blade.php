
@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="container" style="max-width:800px; margin:30px auto; padding:20px;">
    <h1>Edit Project</h1>

    @if($errors->any())
        <div style="color:#b91c1c; margin-bottom:16px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('projects.update', $project) }}" method="POST"
          style="background:white; padding:24px; border:1px solid #e5e7eb; border-radius:12px;">
        @csrf
        @method('PUT')

        <label for="name">Project Name *</label>
        <input id="name" name="name" value="{{ old('name', $project->name) }}" required
               style="display:block; width:100%; box-sizing:border-box; padding:12px; margin:8px 0 18px;">

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4"
                  style="display:block; width:100%; box-sizing:border-box; padding:12px; margin:8px 0 18px;">{{ old('description', $project->description) }}</textarea>

        <label for="start_date">Start Date</label>
        <input id="start_date" type="date" name="start_date"
               value="{{ old('start_date', $project->start_date) }}"
               style="display:block; padding:12px; margin:8px 0 18px;">

        <label for="due_date">Due Date</label>
        <input id="due_date" type="date" name="due_date"
               value="{{ old('due_date', $project->due_date) }}"
               style="display:block; padding:12px; margin:8px 0 18px;">

        <label for="status">Status</label>
        <select id="status" name="status" required
                style="display:block; padding:12px; margin:8px 0 22px;">
            <option value="Planning" @selected(old('status', $project->status) === 'Planning')>Planning</option>
            <option value="In Progress" @selected(old('status', $project->status) === 'In Progress')>In Progress</option>
            <option value="Completed" @selected(old('status', $project->status) === 'Completed')>Completed</option>
        </select>

        <button type="submit"
                style="background:#7c3aed; color:white; border:0; padding:12px 18px; border-radius:8px; cursor:pointer;">
            Save Changes
        </button>

        <a href="{{ route('projects.index') }}" style="margin-left:12px;">Cancel</a>
    </form>
</div>
@endsection
