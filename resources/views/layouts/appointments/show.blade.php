<!DOCTYPE html>
<html>
<head>
    @include("layouts.Dashboard._meta")
    @include("layouts.Dashboard._style")
</head>
<body>
@include("layouts.Dashboard._header")
@include("layouts.Dashboard._sidebar")

<main id="main" class="main">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appointment Details</h5>

                <!-- Appointment Info -->
                <ul class="list-group">
                    <li class="list-group-item"><strong>Appointment ID:</strong> {{ $appointment->id }}</li>
                    <li class="list-group-item"><strong>Owner Name:</strong> {{ $appointment->user->first_name }}</li>
{{--                    <li class="list-group-item"><strong>Vet Name:</strong> {{ $appointment->veterinarian->user->first_name }}</li>--}}
                    <li class="list-group-item"><strong>Date:</strong> {{ $appointment->date }}</li>
                    <li class="list-group-item"><strong>Time:</strong> {{ $appointment->appointment_time }}</li>
                    <li class="list-group-item"><strong>Purpose:</strong> {{ $appointment->reason }}</li>
                    <li class="list-group-item"><strong>Pet Id:</strong> {{ $appointment->pet->pet_id }}</li>

                    <li class="list-group-item"><strong>Status:</strong>
                        <span class="badge {{ $appointment->viewed == true ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </li>
                </ul>

             @if(Auth::user()->role_id !== 2)
                    <!-- Action Buttons -->
                    <div class="text-center mt-3">
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                    <!-- Add Medical History Button -->
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMedicalHistoryModal">
                            Add Medical History
                        </button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('pets.show', $appointment->pet->id) }}" class="btn btn-warning">View Pet Details</a>
                    </div>
                @endif
            </div>
        </div>
        <!-- Add Medical History Modal -->
        <div class="modal fade" id="addMedicalHistoryModal" tabindex="-1" aria-labelledby="addMedicalHistoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMedicalHistoryModalLabel">Add Medical History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('medical_histories.store') }}" method="POST">
                            @csrf
                            <div hidden class="mb-3">
                                <label for="pet_id" class="form-label">Pet</label>
                                <input id="pet_id" name="pet_id" value={{$appointment->pet_id}} class="form-control" />

                            </div>
                            <div hidden class="mb-3">
                                <label for="doctor_id" class="form-label">Doctor</label>
                                <input id="doctor_id" name="doctor_id" class="form-control" value="{{ auth()->user()->id }}" />
                            </div>

                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea id="details" name="details" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="medicines" class="form-label">Medicines</label>
                                <textarea id="medicines" name="medicines" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")

<script>
    // Add custom scripts if necessary
</script>
</body>
</html>
