<!DOCTYPE html>
<html>

<head>
    @include('layouts.Dashboard._meta')
    @include('layouts.Dashboard._style')
</head>

<body>
@include('layouts.Dashboard._header')
@include('layouts.Dashboard._sidebar')

<main id="main" class="main">

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create New Appointment</h5>

                <!-- Floating Labels Form -->
                <form action="{{ route('appointments.store') }}" method="POST" class="row g-3">
                    @csrf

                    <!-- Appointment Time -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="time" class="form-control" id="floatingAppointmentTime" name="appointment_time"
                                   placeholder="Appointment Time" value="{{ old('appointment_time') }}" required>
                            <label for="floatingAppointmentTime">Appointment Time</label>
                            @error('appointment_time')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input
                                type="date"
                                class="form-control"
                                id="floatingDate"
                                name="date"
                                placeholder="Date"
                                value="{{ old('date') }}"
                                min="{{ date('Y-m-d') }}"
                                required>
                            <label for="floatingDate">Date</label>
                            @error('date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Reason -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingReason" name="reason" placeholder="Reason" style="height: 100px;" required>{{ old('reason') }}</textarea>
                            <label for="floatingReason">Reason</label>
                            @error('reason')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- User -->
                    <div hidden class="col-md-6">
                        <div class="form-floating">
                            <input hidden type="text" class="form-control" id="floatingDate" name="user_id"
                                   placeholder="User Id" value="{{ auth()->user()->id ?? '' }}"
                                   readonly>
                            <label for="floatingDate">User Id</label>
                        </div>
                    </div>
                    <!-- pet Selection -->
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-floating">--}}
{{--                            <select class="form-control" id="floatingDoctor" name="doctor_id">--}}
{{--                                <option value="">Select Doctor</option>--}}
{{--                                @foreach ($doctors as $doctor)--}}
{{--                                    <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="floatingDoctor">Select Doctor</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Appointment</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End Floating Labels Form -->
            </div>
        </div>
    </section>

</main>

@include('layouts.Dashboard._footer')
@include('layouts.Dashboard._script')
</body>

</html>
