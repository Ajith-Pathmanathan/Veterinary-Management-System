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
                        <h5 class="card-title">Edit Announcement</h5>

                        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" required>{{ old('description', $announcement->description) }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                @if($announcement->image)
                                    <img src="{{ asset('storage/' . $announcement->image) }}"
                                         alt="Announcement Image"
                                         class="mt-2 rounded"
                                         width="100">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="date"
                                       class="form-control @error('expiry_date') is-invalid @enderror"
                                       id="expiry_date"
                                       name="expiry_date"
                                       value="{{ old('expiry_date', $announcement->expiry_date) }}"
                                       required>
                                @error('expiry_date')
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
