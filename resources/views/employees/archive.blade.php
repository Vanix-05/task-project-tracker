<!DOCTYPE html>
<html>
<head>
    <title>Archived Employees</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #0f172a;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background: white;
            border-right: 1px solid #e2e8f0;
            padding: 28px 14px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            margin-left: 14px;
            margin-bottom: 45px;
        }

        .logo span {
            color: #2563eb;
        }

        .menu-title {
            font-size: 11px;
            color: #94a3b8;
            margin: 0 14px 14px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #475569;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .menu a:hover {
            background: #f1f5f9;
        }

        .menu a.active {
            background: #e8f0ff;
            color: #2563eb;
            font-weight: 700;
        }

        .main {
            flex: 1;
            padding: 30px 36px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 22px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 14px 20px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
        }

        td {
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .employee-name {
            font-weight: 700;
        }

        .restore-btn {
            color: #16a34a;
            text-decoration: none;
            font-weight: 600;
            margin-right: 12px;
        }

        .delete-btn {
            border: none;
            background: none;
            color: #dc2626;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .success {
            margin: 20px 24px;
            padding: 12px 15px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
        }

        .empty {
            padding: 40px;
            text-align: center;
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">
            Employ<span>o</span>
        </div>

        <div class="menu-title">
            Main Menu
        </div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}">
                ▫ Dashboard
            </a>

            <a href="{{ route('employees.index') }}">
                ♟ Employees
            </a>

            <a href="{{ route('departments.index') }}">
                ▣ Departments
            </a>

            <a href="{{ route('employees.archive') }}" class="active">
                ▣ Archive
            </a>

            <a href="{{ route('attendance.index') }}">
                ◷ Attendance
            </a>

            <a href="#">
                ◈ Performance
            </a>

            <a href="#">
                ◇ Reports
            </a>

            <a href="#">
                ⚙ Settings
            </a>

        </nav>

    </aside>


    <main class="main">

        <div class="page-title">
            Archived Employees
        </div>

        <div class="page-subtitle">
            View employees that have been moved to the archive.
        </div>


        <div class="card">

            <div class="card-header">
                <div class="card-title">
                    Archived Employee Records
                </div>
            </div>


            @if(session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif


            @if($employees->count())

                <table>

                    <thead>

                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Archived Date</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($employees as $employee)

                            <tr>

                                <td>
                                    <div class="employee-name">
                                        {{ $employee->full_name }}
                                    </div>

                                    <div style="font-size: 12px; color: #64748b;">
                                        {{ $employee->employee_no }}
                                    </div>
                                </td>

                                <td>
                                    {{ $employee->department }}
                                </td>

                                <td>
                                    {{ $employee->position }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($employee->deleted_at)->format('M d, Y h:i A') }}
                                </td>

                                <td>

                                    <form
                                        action="{{ route('employees.restore', $employee->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="restore-btn"
                                            style="border: none; background: none; cursor: pointer;"
                                        >
                                            Restore
                                        </button>

                                    </form>


                                    <form
                                        action="{{ route('employees.forceDelete', $employee->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn"
                                            onclick="return confirm('This will permanently delete the employee. Continue?')"
                                        >
                                            Delete Permanently
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">
                    No archived employees found.
                </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>