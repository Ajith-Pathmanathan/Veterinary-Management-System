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
                <h5 class="card-title">Edit User</h5>

                <form action="{{ route('users.update', $user->id) }}" method="POST" class="row g-3" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingFirstName" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                            <label for="floatingFirstName">First Name</label>
                            @error('first_name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingLastName" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                            <label for="floatingLastName">Last Name</label>
                            @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingEmail" name="email" value="{{ old('email', $user->email) }}" required>
                            <label for="floatingEmail">Email</label>
                            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="floatingRole" name="role_id" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingRole">Role</label>
                            @error('role_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingNIC" name="national_id" value="{{ old('national_id', $user->national_id) }}" required>
                            <label for="floatingNIC">NIC</label>
                            @error('national_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingDOB" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                            <label for="floatingDOB">Date of Birth</label>
                            @error('date_of_birth')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPhone" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
                            <label for="floatingPhone">Phone Number</label>
                            @error('phone_number')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingStreet" name="street" value="{{ old('street', $user->street) }}" required>
                            <label for="floatingStreet">Street</label>
                            @error('street')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingCity" name="city" value="{{ old('city', $user->city) }}" required>
                            <label for="floatingCity">City</label>
                            @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="floatingDistrict" name="district" required>
                                <option value="">Select District</option>
                                <option value="Jaffna" {{ old('district', $user->district) == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                                <option value="Kilinochchi" {{ old('district', $user->district) == 'Kilinochchi' ? 'selected' : '' }}>Kilinochchi</option>
                                <option value="Mannar" {{ old('district', $user->district) == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                                <option value="Vavuniya" {{ old('district', $user->district) == 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
                                <option value="Mullaitivu" {{ old('district', $user->district) == 'Mullaitivu' ? 'selected' : '' }}>Mullaitivu</option>
                            </select>
                            <label for="floatingDistrict">District</label>
                            @error('district')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
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
