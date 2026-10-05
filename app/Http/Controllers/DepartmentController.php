<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Routing\Controller as BaseController;

class DepartmentController extends BaseController
{
    public function index()
    {
        $departments = Employee::select('department')
            ->distinct()
            ->get();

        $departmentData = $departments->map(function ($department) {

            $employeeCount = Employee::where(
                'department',
                $department->department
            )->count();

            return [
                'name' => $department->department,
                'employee_count' => $employeeCount,
            ];

        });

        return view('departments.index', compact('departmentData'));
    }
}