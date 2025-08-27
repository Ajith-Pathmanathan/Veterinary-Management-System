<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pet Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
<h2>Pet Report</h2>
<p>Total pets: {{ $pets->count() }}</p>

<table>
    <thead>
    <tr>
        <th>Pet ID</th>
        <th>Type</th>
        <th>Breed</th>
        <th>Date of Birth</th>
        <th>Gender</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pets as $pet)
        <tr>
            <td>{{ $pet->pet_id }}</td>
            <td>{{ $pet->type }}</td>
            <td>{{ $pet->breed }}</td>
            <td>{{ $pet->date_of_birth }}</td>
            <td>{{ ucfirst($pet->gender) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
