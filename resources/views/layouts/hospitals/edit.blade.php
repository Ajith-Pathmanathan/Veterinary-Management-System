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
                <h5 class="card-title">Edit Hospital</h5>

                <!-- Floating Labels Form -->
                <form action="{{ route('hospitals.update', $hospital->id) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <!-- Hospital Name -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" name="name" value="{{ old('name', $hospital->name) }}">
                            <label for="floatingName">Hospital Name</label>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingDistrict" name="district" value="{{ old('district', $hospital->district) }}">
                            <label for="floatingDistrict">District</label>
                            @error('district')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingAddress" name="address">{{ old('address', $hospital->address) }}</textarea>
                            <label for="floatingAddress">Address</label>
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingContact" name="contact_number" value="{{ old('contact_number', $hospital->contact_number) }}">
                            <label for="floatingContact">Contact Number</label>
                            @error('contact_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingEmail" name="email_address" value="{{ old('email_address', $hospital->email_address) }}">
                            <label for="floatingEmail">Email Address</label>
                            @error('email_address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Hospital</button>
                        <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">Cancel</a>
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
