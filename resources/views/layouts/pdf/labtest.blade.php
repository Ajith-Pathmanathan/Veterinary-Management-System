<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab Test Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>
<h2>Lab Test Report</h2>
<p><strong>Pet ID:</strong> {{ $pet_id }}</p>
<p><strong>Test Type:</strong> {{ $test_type }}</p>

<table>
    <thead>
    <tr>
        <th>Test Key</th>
        <th>Test Value</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($test_details as $detail)
        <tr>
            <td>{{ $detail['key'] }}</td>
            <td>{{ $detail['value'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
