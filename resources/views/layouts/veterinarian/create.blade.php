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
                <h5 class="card-title">Add Staff Details</h5>

                <form action="{{ route('veterinarians.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @php
                        $userId = request('user');
                    @endphp
                    <!-- User ID -->
                    <div class="col-md-12">
                        <input type="hidden" name="user_id" value="{{ $userId }}">
                    </div>

                    <!-- Education -->
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="education" placeholder="Education">
                        @error('education') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Experience -->
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="experience" placeholder="Experience (years)">
                        @error('experience') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <!-- Occupation -->
                    <div class="col-md-12">
                        <select class="form-control" name="occupation">
                            <option value="" disabled selected>Select Occupation</option>
                            <option value="doctor" {{ old('occupation') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                            <option value="veterinarian" {{ old('occupation') == 'veterinarian' ? 'selected' : '' }}>Veterinarian</option>
                            <option value="other_staff" {{ old('occupation') == 'other_staff' ? 'selected' : '' }}>Other Staff</option>
                        </select>
                        @error('occupation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Certificate -->
                    <div class="col-md-12">
                        <label>Education Certificate
                            <input type="file" class="form-control" placeholder="Education Certificate" name="education_certificate">
                            @error('education_certificate') <div class="text-danger">{{ $message }}</div> @enderror

                        </label>
                    </div>
                    <!-- Certificate -->
                    <div class="col-md-12">
                        <label>NIC Copy
                            <input type="file" class="form-control" placeholder="NIC Copy" name="NIC_copy">
                            @error('education_certificate') <div class="text-danger">{{ $message }}</div> @enderror
                        </label>
                    </div>
                    <!-- Certificate -->
                    <div class="col-md-12">
                        <label>profile picture
                            <input type="file" class="form-control" placeholder="profile picture" name="profile_picture">
                            @error('education_certificate') <div class="text-danger">{{ $message }}</div> @enderror
                        </label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Veterinarian</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
