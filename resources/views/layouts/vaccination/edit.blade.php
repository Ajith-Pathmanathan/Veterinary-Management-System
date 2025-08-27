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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Vaccination</h5>

                    <!-- Floating Labels Form -->
                    <form action="{{ route('vaccinations.update', $vaccination->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                        <!-- Animal ID -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingAnimalId" name="pet_id"
                                       placeholder="Animal ID" value="{{ old('pet_id', $vaccination->pet->pet_id) }}">
                                <label for="floatingAnimalId">Animal ID</label>
                                @error('pet_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <!-- Vaccination Date -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingVaccinationDate" name="vaccination_date"
                                       placeholder="Vaccination Date" value="{{ old('vaccination_date', $vaccination->vaccination_date) }}">
                                <label for="floatingVaccinationDate">Vaccination Date</label>
                                @error('vaccination_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Vaccination Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="floatingVaccinationName" name="vaccine_id">
                                    <option value="">Select a Vaccine</option>
                                    @foreach($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}"
                                            {{ (old('vaccine_id', $vaccination->vaccine_id ?? '') == $vaccine->id) ? 'selected' : '' }}>
                                            {{ $vaccine->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingVaccinationName">Vaccination Name</label>
                                @error('vaccine_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Dose -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingDose" name="dose"
                                       placeholder="Dose" value="{{ old('dose', $vaccination->dose) }}">
                                <label for="floatingDose">Dose</label>
                                @error('dose')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit & Cancel Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Vaccination</button>
                            <a href="{{ route('vaccinations.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <!-- End floating Labels Form -->
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
