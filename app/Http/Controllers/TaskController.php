<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TaskController extends BaseController
{
    /**
     * Display all active tasks.
     */
   
    public function index(Request $request)
    {
        $tasks = Task::latest()->get();

        $viewMode = $request->query('view', 'list');

    return view('tasks.index', compact('tasks', 'viewMode'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'project' => 'required',
            'description' => 'nullable',
            'assigned_to' => 'required',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task added successfully.');
    }

    /**
     * Display a specific task.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing a task.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update an existing task.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required',
            'project' => 'required',
            'description' => 'nullable',
            'assigned_to' => 'required',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

 /**
     * Update a task's status from the Kanban board.
     */
    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                'in:Pending,In Progress,Completed',
            ],
        ]);

        $task->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Task status updated successfully.',
            'task' => [
                'id' => $task->id,
                'status' => $task->status,
            ],
        ]);
    }
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task archived successfully.');
    }

    /**
     * Display archived tasks.
     */
    public function archive()
    {
        $tasks = Task::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('tasks.archive', compact('tasks'));
    }

    /**
     * Restore an archived task.
     */
    public function restore($id)
    {
        $task = Task::withTrashed()
            ->findOrFail($id);

        $task->restore();

        return redirect()
            ->route('tasks.archive')
            ->with('success', 'Task restored successfully.');
    }

    /**
     * Permanently delete an archived task.
     */
    public function forceDelete($id)
    {
        $task = Task::withTrashed()
            ->findOrFail($id);

        $task->forceDelete();

        return redirect()
            ->route('tasks.archive')
            ->with('success', 'Task permanently deleted.');
    }
}