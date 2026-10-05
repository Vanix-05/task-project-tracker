<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// ATTENDANCE
Route::resource('attendance', AttendanceController::class)
    ->except(['show']);

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// EMPLOYEES

Route::get('/employees/archive', [EmployeeController::class, 'archive'])
    ->name('employees.archive');

Route::post('/employees/{id}/restore', [EmployeeController::class, 'restore'])
    ->name('employees.restore');

Route::delete('/employees/{id}/force-delete', [EmployeeController::class, 'forceDelete'])
    ->name('employees.forceDelete');

Route::resource('employees', EmployeeController::class);


// DEPARTMENTS
Route::get('/departments', [DepartmentController::class, 'index'])
    ->name('departments.index');
    

    // TASKS
Route::resource('tasks', TaskController::class);

    //LOGIN
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');