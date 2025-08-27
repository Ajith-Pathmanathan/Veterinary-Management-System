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
        <div class="row">
            <div >
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Appointment</h5>

                        <!-- Appointment Update Form -->
                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="appointment_time" class="form-label">Appointment Time</label>
                                <input type="time" name="appointment_time" id="appointment_time" class="form-control" value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $appointment->date) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea name="reason" id="reason" class="form-control" rows="3" required>{{ old('reason', $appointment->reason) }}</textarea>
                            </div>
                            <!-- User -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingDate" name="user_id"
                                           placeholder="User Id" value="{{ auth()->user()->id }}" readonly>
                                    <label for="floatingDate">User Id</label>
                                </div>
                            </div>
                            <!-- pet Selection -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-control" id="floatingHospital" name="pet_id">
                                        <option value="">Select Pet</option>
                                        @foreach ($pets as $pet)
                                            <option value="{{ $pet->id }}">{{ $pet->pet_id }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingHospital">Select Pet</label>
                                </div>
                            </div>
                            <!-- Hospital Selection -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-control" id="floatingHospital" name="hospital_id">
                                        <option value="">Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingHospital">Select Hospital</label>
                                </div>
                            </div>
                            <!-- Doctor Selection -->
{{--                            <div class="col-md-6 mb-3">--}}
{{--                                <div class="form-floating">--}}
{{--                                    <select class="form-control" id="floatingDoctor" name="doctor_id">--}}
{{--                                        <option value="">Select Doctor</option>--}}
{{--                                        @foreach ($doctors as $doctor)--}}
{{--                                            <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <label for="floatingDoctor">Select Doctor</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
