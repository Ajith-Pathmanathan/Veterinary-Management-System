<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Farm Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
<h2>Farm Report</h2>
<p>Total farms: {{ $farms->count() }}</p>

<table>
    <thead>
    <tr>
        <th>Farm Name</th>
        <th>Size (acres)</th>
        <th>Owner NIC</th>
        <th>Owner Contact</th>
    </tr>
    </thead>
    <tbody>
    @foreach($farms as $farm)
        <tr>
            <td>{{ $farm->name }}</td>
            <td>{{ $farm->size }}</td>
            <td>{{ $farm->user->national_id }}</td>
            <td>{{ $farm->user->phone_number }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
