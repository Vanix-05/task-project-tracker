<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Departments - Employo</title>

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

        .avatar {
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

        /* DEPARTMENT CARDS */

        .department-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            padding: 24px;
        }

        .department-card {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 22px;
            transition: 0.2s;
        }

        .department-card:hover {
            border-color: #bfdbfe;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.06);
            transform: translateY(-2px);
        }

        .department-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-weight: 700;
            font-size: 18px;
        }

        .department-name {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .employee-count {
            color: #64748b;
            font-size: 13px;
        }

        .count-number {
            color: #0f172a;
            font-weight: 700;
        }

        @media (max-width: 800px) {

            .sidebar {
                width: 190px;
            }

            .main {
                padding: 24px;
            }

            .department-grid {
                grid-template-columns: 1fr;
            }

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

            <div class="avatar">
                CJ
            </div>

            <div>

                <div class="profile-name">
                    CJ CERBITO
                </div>

                <div class="profile-role">
                    Administrator
                </div>

            </div>

        </div>


        <div class="menu-title">
            MAIN MENU
        </div>


        <div class="menu">

            <a href="{{ route('dashboard') }}">
                ▫ Dashboard
            </a>

            <a href="{{ route('employees.index') }}">
                ♟ Employees
            </a>

            <a href="{{ route('departments.index') }}" class="active">
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

        </div>

    </aside>


    <!-- MAIN CONTENT -->

    <main class="main">

        <div class="topbar">

            <div>

                <div class="page-title">
                    Departments
                </div>

                <div class="page-subtitle">
                    Manage departments and view employee distribution.
                </div>

            </div>

        </div>


        <!-- DEPARTMENT SECTION -->

        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    All Departments
                </div>

                <div class="card-subtitle">
                    Departments currently registered in your organization.
                </div>

            </div>


            <div class="department-grid">

                @forelse ($departmentData as $department)

                    <div class="department-card">

                        <div class="department-icon">
                            ▣
                        </div>

                        <div class="department-name">
                            {{ $department['name'] }}
                        </div>

                        <div class="employee-count">

                            <span class="count-number">
                                {{ $department['employee_count'] }}
                            </span>

                            employee{{ $department['employee_count'] != 1 ? 's' : '' }}

                        </div>

                    </div>

                @empty

                    <div>
                        No departments found.
                    </div>

                @endforelse

            </div>

        </div>

    </main>

</div>

</body>

</html>