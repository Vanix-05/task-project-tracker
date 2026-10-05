<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employees - Employee Management System</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #252a34;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 25px 15px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #20242c;
            padding: 0 15px;
            margin-bottom: 35px;
        }

        .logo span {
            color: #2563eb;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin-bottom: 25px;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #2563eb;
        }

        .profile-name {
            font-size: 13px;
            font-weight: bold;
        }

        .profile-role {
            font-size: 11px;
            color: #8a8f98;
            margin-top: 3px;
        }

        .menu-title {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            margin: 15px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #6b7280;
            padding: 12px 15px;
            margin: 4px 0;
            border-radius: 8px;
            font-size: 13px;
        }

        .menu a:hover {
            background: #f1f5ff;
            color: #2563eb;
        }

        .menu a.active {
            background: #eaf1ff;
            color: #2563eb;
            font-weight: bold;
        }

        .logout {
            position: absolute;
            bottom: 25px;
            left: 15px;
            right: 15px;
        }

        /* MAIN */
        .main {
            margin-left: 230px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .page-title h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .page-title p {
            font-size: 12px;
            color: #8a8f98;
        }

        .notification {
            width: 38px;
            height: 38px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
        }

        /* CONTENT */
        .content {
            padding: 30px 35px;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-row h2 {
            font-size: 20px;
        }

        .header-row p {
            color: #8a8f98;
            font-size: 13px;
            margin-top: 5px;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        /* SUMMARY CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e7e9ee;
            border-radius: 10px;
            padding: 20px;
        }

        .card-label {
            font-size: 12px;
            color: #8a8f98;
            margin-bottom: 8px;
        }

        .card-number {
            font-size: 25px;
            font-weight: bold;
        }

        /* TABLE CONTAINER */
        .table-container {
            background: #ffffff;
            border: 1px solid #e7e9ee;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-header {
            padding: 18px 20px;
            border-bottom: 1px solid #e7e9ee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 15px;
        }

        .tools {
            display: flex;
            gap: 10px;
        }

        .search {
            border: 1px solid #dfe3e8;
            border-radius: 6px;
            padding: 9px 12px;
            width: 230px;
            outline: none;
            font-size: 12px;
        }

        .filter-btn {
            border: 1px solid #dfe3e8;
            background: white;
            padding: 9px 15px;
            border-radius: 6px;
            color: #555;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: #8a8f98;
            font-weight: 600;
            background: #fafbfc;
            padding: 14px 18px;
            border-bottom: 1px solid #e7e9ee;
        }

        td {
            padding: 16px 18px;
            font-size: 12px;
            border-bottom: 1px solid #f0f1f3;
        }

        tr:hover {
            background: #fafcff;
        }

        .employee-name {
            font-weight: bold;
            color: #252a34;
        }

        .employee-number {
            color: #8a8f98;
            font-size: 11px;
            margin-top: 3px;
        }

        .badge {
            display: inline-block;
            background: #e9f8ef;
            color: #159447;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .action-btn {
            text-decoration: none;
            font-size: 11px;
            margin-right: 8px;
            color: #2563eb;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #dc2626;
            font-size: 11px;
            cursor: pointer;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
        }

        .success {
            background: #e9f8ef;
            color: #15803d;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .table-container {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            Employ<span>o</span>
        </div>

        <div class="profile">
            <div class="profile-avatar">CJ</div>

            <div>
                <div class="profile-name">CJ CERBITO</div>
                <div class="profile-role">Administrator</div>
            </div>
        </div>

        <div class="menu-title">Main Menu</div>

        <nav class="menu">

            <a href="{{ url('/dashboard') }}">
                ▫ Dashboard
            </a>

            <a href="{{ route('employees.index') }}" class="active">
                ♟ Employees
            </a>
            <a href="{{ url('/departments') }}">
                 ▣ Departments
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

        <div class="logout">
            <div class="menu">
                <a href="#">
                    ⇥ Logout
                </a>
            </div>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="page-title">
                <h1>Employees</h1>
                <p>Manage people, roles, and employee records</p>
            </div>

            <div class="notification">
                ♧
            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="header-row">

                <div>
                    <h2>Employee Records</h2>
                    <p>View and manage all employees in your organization.</p>
                </div>

                <a href="{{ route('employees.create') }}" class="add-btn">
                    + Add Employee
                </a>

            </div>


            <!-- SUMMARY -->
            <div class="cards">

                <div class="card">
                    <div class="card-label">Total Employees</div>

                    <div class="card-number">
                        {{ $employees->count() }}
                    </div>
                </div>

                <div class="card">
                    <div class="card-label">Departments</div>

                    <div class="card-number">
                        {{ $employees->pluck('department')->unique()->count() }}
                    </div>
                </div>

                <div class="card">
                    <div class="card-label">Employee Records</div>

                    <div class="card-number">
                        {{ $employees->count() }}
                    </div>
                </div>

            </div>


            <!-- TABLE -->
            <div class="table-container">

                <div class="table-header">

                    <h3>All Employees</h3>

                    <div class="tools">

                        <input
                            type="text"
                            class="search"
                            placeholder="Search employees..."
                        >

                        <button class="filter-btn">
                            Filter
                        </button>

                    </div>

                </div>


                <table>

                    <thead>
                        <tr>
                            <th>EMPLOYEE</th>
                            <th>DEPARTMENT</th>
                            <th>POSITION</th>
                            <th>SALARY</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($employees as $employee)

                            <tr>

                                <td>
                                    <div class="employee-name">
                                        {{ $employee->full_name }}
                                    </div>

                                    <div class="employee-number">
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
                                    ₱{{ number_format($employee->salary, 2) }}
                                </td>

                                <td>
                                    {{ $employee->email }}
                                </td>

                                <td>
                                    <span class="badge">
                                        Active
                                    </span>
                                </td>

                                <td>

                                    <a
                                        href="{{ route('employees.edit', $employee) }}"
                                        class="action-btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('employees.destroy', $employee) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this employee?')"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="empty">
                                    No employees found.
                                    <br><br>

                                    <a
                                        href="{{ route('employees.create') }}"
                                        class="add-btn"
                                    >
                                        + Add First Employee
                                    </a>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>
</html>