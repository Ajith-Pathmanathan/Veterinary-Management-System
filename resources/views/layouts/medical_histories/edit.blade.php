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
                        <h5 class="card-title">Edit Medical History</h5>

                        <form action="{{ route('medical_histories.update', $medicalHistory->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="pet_id" class="form-label">Pet</label>
                                <select id="pet_id" name="pet_id" class="form-control" required>
                                    <option value="">Select Pet</option>
                                    @foreach($pets as $pet)
                                        <option value="{{ $pet->id }}" {{ $medicalHistory->pet_id == $pet->id ? 'selected' : '' }}>{{ $pet->id }}</option>
                                    @endforeach
                                </select>
                                @error('pet_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea id="details" name="details" class="form-control" required>{{ old('details', $medicalHistory->details) }}</textarea>
                                @error('details')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="medicines" class="form-label">Medicines</label>
                                <textarea id="medicines" name="medicines" class="form-control" required>{{ old('medicines', $medicalHistory->medicines) }}</textarea>
                                @error('medicines')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
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
