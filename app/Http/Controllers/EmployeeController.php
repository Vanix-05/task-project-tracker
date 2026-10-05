<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class EmployeeController extends BaseController
{
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_no' => 'required|unique:employees',
            'full_name' => 'required',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'email' => 'required|email|unique:employees',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'employee_no' => 'required|unique:employees,employee_no,' . $employee->id,
            'full_name' => 'required',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
{
    $employee->delete();

    return redirect()->route('employees.index')
        ->with('success', 'Employee moved to archive successfully.');
}

public function archive()
{
    $employees = Employee::onlyTrashed()
        ->orderBy('deleted_at', 'desc')
        ->get();

    return view('employees.archive', compact('employees'));
}

public function restore($id)
{
    $employee = Employee::withTrashed()->findOrFail($id);

    $employee->restore();

    return redirect()
        ->route('employees.archive')
        ->with('success', 'Employee restored successfully.');
}

public function forceDelete($id)
{
    $employee = Employee::withTrashed()->findOrFail($id);

    $employee->forceDelete();

    return redirect()
        ->route('employees.archive')
        ->with('success', 'Employee permanently deleted.');
}
}