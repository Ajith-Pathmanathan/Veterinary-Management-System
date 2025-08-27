<!DOCTYPE html>
<html lang="en">

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
                <h5 class="card-title">Create New Pet</h5>

                <!-- Floating Labels Form -->
                <form action="{{ route('pets.store') }}" method="POST" class="row g-3">
                    @csrf

                    <!-- Type (Dropdown) -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-control" id="floatingType" name="type" required>
                                <option value="cow" {{ old('type') == 'cow' ? 'selected' : '' }}>Cow</option>
                                <option value="goat" {{ old('type') == 'goat' ? 'selected' : '' }}>Goat</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
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
                            <input type="text" class="form-control" id="floatingBreed" name="breed"
                                   value="{{ old('breed') }}" required>
                            <label for="floatingBreed">Breed</label>
                            @error('breed')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- color -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingBreed" name="color"
                                   value="{{ old('color') }}" required>
                            <label for="floatingColor">Color</label>
                            @error('color')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingDateOfBirth" name="date_of_birth"
                                   value="{{ old('date_of_birth') }}" required>
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
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <label for="floatingGender">Gender</label>
                            @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Farm ID -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" id="floatingFarmId" name="farm_id" required>
                                <!-- Assuming you are passing a $farms variable containing all farms -->
                                @foreach ($farms as $farm)
                                    <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
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


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Pet</button>
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
