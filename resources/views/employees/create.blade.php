<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Employee - Employee Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 235px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 28px 15px;
        }

        .logo {
            font-size: 23px;
            font-weight: 700;
            padding: 0 22px;
            margin-bottom: 42px;
        }

        .logo span {
            color: #2563eb;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 15px;
            margin-bottom: 35px;
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
            font-weight: bold;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 600;
        }

        .profile-role {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 3px;
        }

        .menu-title {
            font-size: 10px;
            color: #9ca3af;
            padding: 0 22px;
            margin-bottom: 12px;
            letter-spacing: .5px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #6b7280;
            padding: 12px 15px;
            border-radius: 9px;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .menu a:hover {
            background: #f1f5ff;
            color: #2563eb;
        }

        .menu a.active {
            background: #eaf1ff;
            color: #2563eb;
            font-weight: 600;
        }

        /* MAIN */
        .main {
            margin-left: 235px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .page-title {
            font-size: 21px;
            font-weight: 700;
        }

        .page-subtitle {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
        }

        .notification {
            width: 40px;
            height: 40px;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            background: white;
            cursor: pointer;
        }

        /* CONTENT */
        .content {
            padding: 32px 38px;
        }

        .back {
            text-decoration: none;
            color: #6b7280;
            font-size: 13px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .back:hover {
            color: #2563eb;
        }

        .form-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            max-width: 900px;
            box-shadow: 0 2px 8px rgba(0,0,0,.03);
        }

        .form-header {
            padding: 24px 28px;
            border-bottom: 1px solid #eef0f4;
        }

        .form-header h2 {
            margin: 0;
            font-size: 19px;
        }

        .form-header p {
            margin: 7px 0 0;
            font-size: 13px;
            color: #9ca3af;
        }

        .form-body {
            padding: 28px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / 3;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }

        .required {
            color: #ef4444;
        }

        input {
            width: 100%;
            height: 44px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
            transition: .2s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.10);
        }

        .error {
            color: #dc2626;
            font-size: 11px;
            margin-top: 6px;
        }

        .form-footer {
            border-top: 1px solid #eef0f4;
            padding: 18px 28px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 11px 20px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-cancel {
            background: #ffffff;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }

        .btn-cancel:hover {
            background: #f9fafb;
        }

        .btn-save {
            background: #2563eb;
            color: white;
        }

        .btn-save:hover {
            background: #1d4ed8;
        }

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .alert ul {
            margin: 5px 0 0 18px;
            padding: 0;
        }

        @media (max-width: 800px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
            }

            .content {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
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
            <div class="avatar">CJ</div>

            <div>
                <div class="profile-name">CJ CERBITO</div>
                <div class="profile-role">Administrator</div>
            </div>
        </div>

        <div class="menu-title">MAIN MENU</div>

        <div class="menu">
            <a href="#">▣ Dashboard</a>

            <a href="{{ route('employees.index') }}" class="active">
                ♟ Employees
            </a>

            <a href="#">⊡ Departments</a>
            <a href="#">◷ Attendance</a>
            <a href="#">◈ Performance</a>
            <a href="#">◇ Reports</a>
            <a href="#">⚙ Settings</a>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main">

        <header class="topbar">

            <div>
                <div class="page-title">Add Employee</div>
                <div class="page-subtitle">
                    Create a new employee record
                </div>
            </div>

            <button class="notification">♧</button>

        </header>


        <section class="content">

            <a href="{{ route('employees.index') }}" class="back">
                ← Back to Employees
            </a>


            <!-- VALIDATION ERRORS -->
            @if ($errors->any())

                <div class="alert">

                    <strong>Please fix the following errors:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            <!-- FORM CARD -->
            <div class="form-card">

                <div class="form-header">

                    <h2>Employee Information</h2>

                    <p>
                        Enter the employee's information below.
                    </p>

                </div>


                <form action="{{ route('employees.store') }}" method="POST">

                    @csrf

                    <div class="form-body">

                        <div class="form-grid">


                            <!-- EMPLOYEE NUMBER -->
                            <div class="form-group">

                                <label>
                                    Employee No.
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="employee_no"
                                    value="{{ old('employee_no') }}"
                                    placeholder="e.g. EMP-001"
                                    required
                                >

                                @error('employee_no')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>


                            <!-- FULL NAME -->
                            <div class="form-group">

                                <label>
                                    Full Name
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="full_name"
                                    value="{{ old('full_name') }}"
                                    placeholder="e.g. Juan Dela Cruz"
                                    required
                                >

                                @error('full_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>


                            <!-- DEPARTMENT -->
                            <div class="form-group">

                                <label>
                                    Department
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="department"
                                    value="{{ old('department') }}"
                                    placeholder="e.g. Information Technology"
                                    required
                                >

                                @error('department')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>


                            <!-- POSITION -->
                            <div class="form-group">

                                <label>
                                    Position
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="position"
                                    value="{{ old('position') }}"
                                    placeholder="e.g. IT Staff"
                                    required
                                >

                                @error('position')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>


                            <!-- SALARY -->
                            <div class="form-group">

                                <label>
                                    Salary
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="salary"
                                    value="{{ old('salary') }}"
                                    placeholder="e.g. 25000"
                                    min="0"
                                    step="0.01"
                                    required
                                >

                                @error('salary')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>


                            <!-- EMAIL -->
                            <div class="form-group">

                                <label>
                                    Email Address
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="e.g. juan@example.com"
                                    required
                                >

                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <!-- BUTTONS -->
                    <div class="form-footer">

                        <a
                            href="{{ route('employees.index') }}"
                            class="btn btn-cancel"
                        >
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-save">
                            + Save Employee
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </main>

</body>
</html>