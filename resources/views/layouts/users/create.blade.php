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
                <h5 class="card-title">Create New User</h5>

                <form action="{{ route('users.store') }}" method="POST" class="row g-3" data-parsley-validate>
                    @csrf

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingFirstName" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                            <label for="floatingFirstName">First Name</label>
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingLastName" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                            <label for="floatingLastName">Last Name</label>
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            <label for="floatingEmail">Email</label>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="floatingRole" name="role_id" required>
                                <option value="" selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="floatingRole">Role</label>
                            @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingNIC" name="national_id" placeholder="NIC" value="{{ old('national_id') }}" required>
                            <label for="floatingNIC">NIC</label>
                            @error('national_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingDOB" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            <label for="floatingDOB">Date of Birth</label>
                            @error('date_of_birth')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPhone" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                            <label for="floatingPhone">Phone Number</label>
                            @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingStreet" name="street" placeholder="Street" value="{{ old('street') }}" required>
                            <label for="floatingStreet">Street</label>
                            @error('street')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingCity" name="city" placeholder="City" value="{{ old('city') }}" required>
                            <label for="floatingCity">City</label>
                            @error('city')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="floatingDistrict" name="district" required>
                                <option value="" selected>Select District</option>
                                <option value="Jaffna" {{ old('district') == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                                <option value="Kilinochchi" {{ old('district') == 'Kilinochchi' ? 'selected' : '' }}>Kilinochchi</option>
                                <option value="Mannar" {{ old('district') == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                                <option value="Vavuniya" {{ old('district') == 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
                                <option value="Mullaitivu" {{ old('district') == 'Mullaitivu' ? 'selected' : '' }}>Mullaitivu</option>
                            </select>
                            <label for="floatingDistrict">District</label>
                            @error('district')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@include('layouts.Dashboard._footer')
@include('layouts.Dashboard._script')
</body>

</html>
