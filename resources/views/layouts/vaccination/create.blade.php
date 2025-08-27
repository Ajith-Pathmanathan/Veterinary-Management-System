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
                <h5 class="card-title">Create New Vaccination</h5>

                <!-- Floating Labels Form -->
                <form action="{{ route('vaccinations.store') }}" method="POST" class="row g-3">
                    @csrf

                    <!-- Animal ID -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAnimalId" name="pet_id"
                                   placeholder="Pet ID" value="{{ old('pet_id') }}">
                            <label for="floatingAnimalId">Pet ID</label>
                            @error('pet_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <!-- Vaccination Date -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingVaccinationDate" name="vaccination_date"
                                   placeholder="Vaccination Date" value="{{ old('vaccination_date') }}">
                            <label for="floatingVaccinationDate">Vaccination Date</label>
                            @error('vaccination_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Vaccine Dropdown -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" id="floatingVaccinationName" name="vaccine_id" required>
                                <option value="">Select a Vaccine</option>
                                @foreach($vaccines as $vaccine)
                                    <option value="{{ $vaccine->id }}" {{ old('vaccine_id') == $vaccine->id ? 'selected' : '' }}>
                                        {{ $vaccine->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="floatingVaccinationName">Vaccination Name</label>
                            @error('vaccination_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Dose -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingDose" name="dose"
                                   placeholder="Dose (ml)" value="{{ old('dose') }}">
                            <label for="floatingDose">Dose</label>
                            @error('dose')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Vaccination</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End floating Labels Form -->
            </div>
        </div>
    </section>
</main>

@include('layouts.Dashboard._footer')
@include('layouts.Dashboard._script')
</body>

</html>
