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
                    <h5 class="card-title">Edit Pet</h5>

                    <!-- Floating Labels Form -->
                    <form action="{{ route('pets.update', $pet->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                        <!-- Type (Dropdown) -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="floatingType" name="type" required>
                                    <option value="cow" {{ old('type', $pet->type) == 'cow' ? 'selected' : '' }}>Cow</option>
                                    <option value="goat" {{ old('type', $pet->type) == 'goat' ? 'selected' : '' }}>Goat</option>
                                    <option value="other" {{ old('type', $pet->type) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <label for="floatingType">Type</label>
                                @error('type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Breed -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingBreed" name="breed" value="{{ old('breed', $pet->breed) }}" required>
                                <label for="floatingBreed">Breed</label>
                                @error('breed')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Color -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingColor" name="color" value="{{ old('color', $pet->color) }}" required>
                                <label for="floatingColor">Color</label>
                                @error('color')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingDateOfBirth" name="date_of_birth" value="{{ old('date_of_birth', $pet->date_of_birth) }}" required>
                                <label for="floatingDateOfBirth">Date of Birth</label>
                                @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="floatingGender" name="gender" required>
                                    <option value="male" {{ old('gender', $pet->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $pet->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <label for="floatingGender">Gender</label>
                                @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

{{--                        <!-- National ID -->--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="text" class="form-control" id="floatingNationalId" name="national_id" value="{{ old('national_id', $pet->national_id) }}">--}}
{{--                                <label for="floatingNationalId">National ID</label>--}}
{{--                                @error('national_id')--}}
{{--                                <div class="text-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Vaccination -->--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="text" class="form-control" id="floatingVaccination" name="vaccination" value="{{ old('vaccination', $pet->vaccination) }}">--}}
{{--                                <label for="floatingVaccination">Vaccination</label>--}}
{{--                                @error('vaccination')--}}
{{--                                <div class="text-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Farm ID (Dropdown) -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="floatingFarmId" name="farm_id" required>
                                    @foreach ($farms as $farm)
                                        <option value="{{ $farm->id }}" {{ old('farm_id', $pet->farm_id) == $farm->id ? 'selected' : '' }}>
                                            {{ $farm->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingFarmId">Farm</label>
                                @error('farm_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit & Cancel Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Pet</button>
                            <a href="{{ route('pets.index') }}" class="btn btn-secondary">Cancel</a>
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
