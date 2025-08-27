<!DOCTYPE html>
<html lang="en">

<head>
    @include("auth.metaData")
    <title>Pages / Register - NiceAdmin Bootstrap Template</title>
    @include("auth.links")
</head>

<body>

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
                                    @csrf

                                    <!-- User Information -->
                                    <div class="col-12">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('first_name', 'Please enter your first name!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('last_name', 'Please enter your last name!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="national_id" class="form-label">Your NIC Number</label>
                                        <input type="text" name="national_id" class="form-control" id="national_id" value="{{ old('national_id') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('email', 'Please enter a valid Nic number!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Your Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('email', 'Please enter a valid email address!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('date_of_birth', 'Please enter your date of birth!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number') }}">
                                        <div class="invalid-feedback">{{ $errors->first('phone_number', 'Please enter a valid phone number!') }}</div>
                                    </div>

                                    <!-- Address Information -->
                                    <div class="col-12">
                                        <label for="street" class="form-label">Street</label>
                                        <input type="text" name="street" class="form-control" id="street" value="{{ old('street') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('street', 'Please enter your street!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" required>
                                        <div class="invalid-feedback">{{ $errors->first('city', 'Please enter your city!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="district" class="form-label">District</label>
                                        <select name="district" class="form-control" id="district" required>
                                            <option value="" disabled selected>Select a district</option>
                                            <option value="Jaffna" {{ old('district') == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                                            <option value="Kilinochchi" {{ old('district') == 'Kilinochchi' ? 'selected' : '' }}>Kilinochchi</option>
                                            <option value="Mullaitivu" {{ old('district') == 'Mullaitivu' ? 'selected' : '' }}>Mullaitivu</option>
                                            <option value="Vavuniya" {{ old('district') == 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
                                            <option value="Mannar" {{ old('district') == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('district', 'Please select your district!') }}</div>
                                    </div>
                                    <!-- Password Fields -->
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <div class="invalid-feedback">{{ $errors->first('password', 'Please enter your password!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                        <div class="invalid-feedback">{{ $errors->first('password_confirmation', 'Please confirm your password!') }}</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>

                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

@include("auth.script")
</body>

</html>
