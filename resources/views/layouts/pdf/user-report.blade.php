<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #222;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<h2>User Report</h2>
<table>
    <thead>
    <tr>
        <th>Full Name</th>
        <th>District</th>
        <th>NIC</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->district }}</td>
            <td>{{ $user->national_id }}</td>
            <td>{{ $user->role->name ?? 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
