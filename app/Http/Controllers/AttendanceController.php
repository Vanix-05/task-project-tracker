<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AttendanceController extends BaseController
{
    public function index()
    {
        $attendances = Attendance::with('employee')
            ->orderBy('date', 'desc')
            ->get();

        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();

        return view('attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Late,Absent',
        ]);

        Attendance::create($request->all());

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();

        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Late,Absent',
        ]);

        $attendance->update($request->all());

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}