<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .buttons {
            margin-top: 25px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .cancel {
            margin-left: 10px;
            text-decoration: none;
            color: #555;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Employee</h1>

    @if ($errors->any())
        <div class="error">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Employee No.</label>
            <input
                type="text"
                name="employee_no"
                value="{{ old('employee_no', $employee->employee_no) }}"
                required
            >

            @error('employee_no')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input
                type="text"
                name="full_name"
                value="{{ old('full_name', $employee->full_name) }}"
                required
            >

            @error('full_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Department</label>
            <input
                type="text"
                name="department"
                value="{{ old('department', $employee->department) }}"
                required
            >

            @error('department')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Position</label>
            <input
                type="text"
                name="position"
                value="{{ old('position', $employee->position) }}"
                required
            >

            @error('position')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Salary</label>
            <input
                type="number"
                name="salary"
                step="0.01"
                value="{{ old('salary', $employee->salary) }}"
                required
            >

            @error('salary')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $employee->email) }}"
                required
            >

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="buttons">
            <button type="submit">Update Employee</button>

            <a href="{{ route('employees.index') }}" class="cancel">
                Cancel
            </a>
        </div>

    </form>

</div>

</body>
</html>