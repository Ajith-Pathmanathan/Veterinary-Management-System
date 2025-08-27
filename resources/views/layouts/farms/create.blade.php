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
                    <h5 class="card-title">Create New Farm</h5>

                    <!-- Floating Labels Form -->
                    <form action="{{ route('farms.store') }}" method="POST" class="row g-3" data-parsley-validate>
                        @csrf

                        <!-- Farm Name -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingName" name="name"
                                    placeholder="Farm Name" value="{{ old('name') }}" required>
                                <label for="floatingName">Farm Name</label>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- User ID Field (Visible/Editable) -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingNIC" name="national_id" placeholder="NIC"
                                       value="{{ old('national_id') }}"  data-parsley-nic-exists required data-parsley-pattern="^\d{9}[Vv]|\d{12}$" data-parsley-pattern-message="NIC must be 9 digits + V (e.g., 123456789V) or 12 digits (e.g., 200012345678)." data-parsley-length="[10,12]" data-parsley-trigger="keyup">
                                <label for="floatingNIC">NIC</label>
                                <div id="nic-error" class="text-danger" style="display: none;">NIC already exists!</div>
                                @error('national_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <!-- Farm Size -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" id="floatingSize"
                                    name="size" placeholder="Farm Size (in acres)" value="{{ old('size') }}" required>
                                <label for="floatingSize">Size (in acres)</label>
                                @error('size')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Farm Type -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="floatingType" name="type" required>
                                    <option value="" selected>Select Farm Type</option>
                                    <option value="Poultry" {{ old('type') == 'Poultry' ? 'selected' : '' }}>Poultry</option>
                                    <option value="Dairy" {{ old('type') == 'Dairy' ? 'selected' : '' }}>Dairy</option>
                                </select>
                                <label for="floatingType">Type</label>
                                @error('type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Address Fields -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingStreet" name="street"
                                    placeholder="Street" value="{{ old('street') }}" required>
                                <label for="floatingStreet">Street</label>
                                @error('street')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingCity" name="city"
                                    placeholder="City" value="{{ old('city') }}" required>
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

                        <!-- User ID (Hidden Field if related to authenticated user) -->
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Create Farm</button>
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
