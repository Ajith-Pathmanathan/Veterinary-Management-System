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
                    <h5 class="card-title">Edit Veterinarian</h5>

                    <!-- Floating Labels Form -->
                    <form action="{{ route('veterinarians.update', $veterinarian->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

{{--                        <!-- User ID -->--}}
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input hidden type="text" class="form-control" id="floatingUserId" name="user_id" placeholder="User ID" value="{{ old('user_id', $veterinarian->user_id) }}">
                                <label for="floatingUserId">User ID</label>
                                @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingEducation" name="education" placeholder="Education" value="{{ old('education', $veterinarian->education) }}">
                                <label for="floatingEducation">Education</label>
                                @error('education')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingExperience" name="experience" placeholder="Experience (years)" value="{{ old('experience', $veterinarian->experience) }}">
                                <label for="floatingExperience">Experience (years)</label>
                                @error('experience')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Occupation -->
                        <div class="col-md-12">
                            <select class="form-control" name="occupation">
                                <option value="" disabled selected>Select Occupation</option>
                                <option value="doctor" {{ old('occupation',$veterinarian->occupation) == 'doctor' ? 'selected' : '' }}>Doctor</option>
                                <option value="veterinarian" {{ old('occupation',$veterinarian->occupation) == 'veterinarian' ? 'selected' : '' }}>Veterinarian</option>
                                <option value="other_staff" {{ old('occupation',$veterinarian->occupation) == 'other_staff' ? 'selected' : '' }}>Other Staff</option>
                            </select>
                            @error('occupation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Education Certificate -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="file" class="form-control" id="floatingCertificate" name="education_certificate">
                                <label for="floatingCertificate">Education Certificate</label>
                                @error('education_certificate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- NIC Copy -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="file" class="form-control" id="floatingNIC" name="NIC_copy">
                                <label for="floatingNIC">NIC Copy</label>
                                @error('NIC_copy')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="file" class="form-control" id="floatingProfile" name="profile_picture">
                                <label for="floatingProfile">Profile Picture</label>
                                @error('profile_picture')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit & Cancel Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Veterinarian</button>
                            <a href="{{ route('veterinarians.index') }}" class="btn btn-secondary">Cancel</a>
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
