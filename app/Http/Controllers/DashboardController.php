<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // =========================================
        // TASK STATISTICS
        // =========================================

        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'Pending')
            ->count();

        $inProgressTasks = Task::where('status', 'In Progress')
            ->count();

        $completedTasks = Task::where('status', 'Completed')
            ->count();

        $overdueTasks = Task::whereNotNull('due_date')
        ->whereDate('due_date', '<', now())
        ->where('status', '!=', 'Completed')
        ->count();

        // =========================================
        // COMPLETION RATE
        // =========================================

        $completionRate = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;


        // =========================================
        // PROJECT STATISTICS
        // =========================================

        $totalProjects = Task::pluck('project')
            ->unique()
            ->count();


        // =========================================
        // PRIORITY STATISTICS
        // =========================================

        $highPriorityTasks = Task::where('priority', 'High')
            ->count();

        $mediumPriorityTasks = Task::where('priority', 'Medium')
            ->count();

        $lowPriorityTasks = Task::where('priority', 'Low')
            ->count();


        // =========================================
        // RECENT TASKS
        // =========================================

        $recentTasks = Task::latest()
            ->take(5)
            ->get();


        // =========================================
        // UPCOMING TASKS
        // =========================================

        $upcomingTasks = Task::whereNotNull('due_date')
            ->where('status', '!=', 'Completed')
            ->orderBy('due_date')
            ->take(5)
            ->get();
        $overdueTaskList = Task::whereNotNull('due_date')
            ->whereDate('due_date', '<', now())
            ->where('status', '!=', 'Completed')
            ->orderBy('due_date')
            ->take(5)
            ->get();

        // =========================================
        // PROJECT BREAKDOWN
        // =========================================

        $projectBreakdown = Task::select('project')
            ->selectRaw('COUNT(*) as task_count')
            ->groupBy('project')
            ->orderByDesc('task_count')
            ->take(5)
            ->get();


        // =========================================
        // SEND DATA TO DASHBOARD VIEW
        // =========================================

        return view('dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'overdueTaskList',
            'completionRate',
            'totalProjects',
            'highPriorityTasks',
            'mediumPriorityTasks',
            'lowPriorityTasks',
            'recentTasks',
            'upcomingTasks',
            'projectBreakdown'
        ));
    }
    
public function liveData()
{
    $totalTasks = Task::count();

    $pendingTasks = Task::where('status', 'Pending')->count();

    $inProgressTasks = Task::where('status', 'In Progress')->count();

    $completedTasks = Task::where('status', 'Completed')->count();

    $overdueTasks = Task::whereNotNull('due_date')
        ->whereDate('due_date', '<', now())
        ->where('status', '!=', 'Completed')
        ->count();

    $completionRate = $totalTasks > 0
        ? round(($completedTasks / $totalTasks) * 100)
        : 0;

    $totalProjects = Task::query()
        ->whereNotNull('project')
        ->where('project', '!=', '')
        ->distinct()
        ->count('project');

    $highPriorityTasks = Task::where('priority', 'High')->count();
    $mediumPriorityTasks = Task::where('priority', 'Medium')->count();
    $lowPriorityTasks = Task::where('priority', 'Low')->count();

    $recentTasks = Task::latest()
        ->take(5)
        ->get();

    $upcomingTasks = Task::whereNotNull('due_date')
        ->where('status', '!=', 'Completed')
        ->orderBy('due_date')
        ->take(5)
        ->get();

    $overdueTaskList = Task::whereNotNull('due_date')
        ->whereDate('due_date', '<', now())
        ->where('status', '!=', 'Completed')
        ->orderBy('due_date')
        ->take(5)
        ->get();

    $projectBreakdown = Task::select('project')
        ->selectRaw('COUNT(*) as task_count')
        ->groupBy('project')
        ->orderByDesc('task_count')
        ->take(5)
        ->get();

    return response()->json([
        'totalTasks' => $totalTasks,
        'pendingTasks' => $pendingTasks,
        'inProgressTasks' => $inProgressTasks,
        'completedTasks' => $completedTasks,
        'overdueTasks' => $overdueTasks,
        'completionRate' => $completionRate,
        'totalProjects' => $totalProjects,
        'highPriorityTasks' => $highPriorityTasks,
        'mediumPriorityTasks' => $mediumPriorityTasks,
        'lowPriorityTasks' => $lowPriorityTasks,
        'recentTasks' => $recentTasks,
        'upcomingTasks' => $upcomingTasks,
        'overdueTaskList' => $overdueTaskList,
        'projectBreakdown' => $projectBreakdown,
    ]);
}

}