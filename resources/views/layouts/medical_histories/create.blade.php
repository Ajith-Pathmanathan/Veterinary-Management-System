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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Medical History</h5>

                        <form action="{{ route('medical_histories.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="pet_id" class="form-label">Pet</label>
                                <select id="pet_id" name="pet_id" class="form-control" required>
                                    <option value="">Select Pet</option>
                                    @foreach($pets as $pet)
                                        <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>{{ $pet->pet_id }}</option>
                                    @endforeach
                                </select>
                                @error('pet_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="doctor_id" value="{{ Auth::user()->id }}">

                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea id="details" name="details" class="form-control" required>{{ old('details') }}</textarea>
                                @error('details')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="medicines" class="form-label">Medicines</label>
                                <textarea id="medicines" name="medicines" class="form-control" required>{{ old('medicines') }}</textarea>
                                @error('medicines')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
