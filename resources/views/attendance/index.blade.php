<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
</head>
<head>
    <title>Attendance - Employee Management System</title>

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

        /* SIDEBAR */

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

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 10px 42px;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .profile-name {
            font-weight: 700;
            font-size: 14px;
        }

        .profile-role {
            font-size: 11px;
            color: #64748b;
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

        /* MAIN */

        .main {
            flex: 1;
            padding: 30px 36px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .add-button {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
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

        .card-subtitle {
            margin-top: 5px;
            font-size: 13px;
            color: #64748b;
        }

        /* TABLE */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px 24px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 17px 24px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .employee-name {
            font-weight: 600;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .present {
            background: #dcfce7;
            color: #15803d;
        }

        .late {
            background: #fef3c7;
            color: #b45309;
        }

        .absent {
            background: #fee2e2;
            color: #dc2626;
        }

        .action {
            text-decoration: none;
            color: #2563eb;
            font-size: 13px;
            font-weight: 600;
            margin-right: 10px;
        }

        .delete-button {
            border: none;
            background: none;
            color: #dc2626;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
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

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            Employ<span>o</span>
        </div>

        <div class="profile">

            <div class="profile-avatar">
                RF
            </div>

            <div>
                <div class="profile-name">
                    Robert Fox
                </div>

                <div class="profile-role">
                    Administrator
                </div>
            </div>

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

            <a href="{{ route('attendance.index') }}" class="active">
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


    <!-- MAIN CONTENT -->

    <main class="main">

        <div class="topbar">

            <div>
                <div class="page-title">
                    Attendance
                </div>

                <div class="page-subtitle">
                    Manage employee attendance records.
                </div>
            </div>

            <a href="{{ route('attendance.create') }}" class="add-button">
                + Record Attendance
            </a>

        </div>


        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    Attendance Records
                </div>

                <div class="card-subtitle">
                    View and manage employee attendance.
                </div>

            </div>


            @if(session('success'))

                <div style="
                    margin: 18px 24px;
                    padding: 12px 15px;
                    background: #dcfce7;
                    color: #166534;
                    border-radius: 8px;
                    font-size: 14px;
                ">
                    {{ session('success') }}
                </div>

            @endif


            @if($attendances->count())

                <table>

                    <thead>

                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($attendances as $attendance)

                            <tr>

                                <td>
                                    <div class="employee-name">
                                        {{ $attendance->employee->full_name }}
                                    </div>

                                    <div style="
                                        font-size: 12px;
                                        color: #64748b;
                                        margin-top: 4px;
                                    ">
                                        {{ $attendance->employee->employee_no }}
                                    </div>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                                </td>

                                <td>

                                    @if($attendance->status === 'Present')

                                        <span class="status present">
                                            Present
                                        </span>

                                    @elseif($attendance->status === 'Late')

                                        <span class="status late">
                                            Late
                                        </span>

                                    @else

                                        <span class="status absent">
                                            Absent
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route('attendance.edit', $attendance->id) }}"
                                        class="action"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('attendance.destroy', $attendance->id) }}"
                                        method="POST"
                                        style="display: inline;"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-button"
                                            onclick="return confirm('Delete this attendance record?')"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">

                    No attendance records found.

                </div>

            @endif

        </div>

    </main>

</div>
</body>
</html>