<h2>Hello Dr. {{ $doctor->name }},</h2>

<p>Here are your appointments for {{ \Carbon\Carbon::now()->format('Y-m-d') }}:</p>

@if($appointments->isEmpty())
    <p>You have no appointments today.</p>
@else
    <ul>
        @foreach ($appointments as $appointment)
            <li>
                <strong>Time:</strong> {{ $appointment->appointment_time }}<br>
                <strong>Pet:</strong> {{ $appointment->pet->name ?? 'N/A' }}<br>
                <strong>Reason:</strong> {{ $appointment->reason }}
            </li>
        @endforeach
    </ul>
@endif

<p>Regards,<br>Your System</p>
