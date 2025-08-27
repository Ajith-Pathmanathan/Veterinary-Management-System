<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
<h2>Appointment Scheduled</h2>
<p>Dear {{ $appointment->user->name }},</p>
<p>Your appointment has been scheduled successfully.</p>
<ul>
    <li><strong>Date:</strong> {{ $appointment->date }}</li>
    <li><strong>Time:</strong> {{ $appointment->appointment_time }}</li>
    <li><strong>Reason:</strong> {{ $appointment->reason }}</li>
</ul>
<p>Thank you!</p>
</body>
</html>
