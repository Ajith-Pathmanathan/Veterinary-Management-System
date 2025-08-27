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
                <h5 class="card-title">Veterinarian Details</h5>

                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $veterinarian->id }}</li>
                    <li class="list-group-item"><strong>Name:</strong> {{ $veterinarian->user->first_name }} {{ $veterinarian->user->last_name }}</li> <!-- Displaying Veterinarian's name from User table -->
                    <li class="list-group-item"><strong>Education:</strong> {{ $veterinarian->education }}</li>
                    <li class="list-group-item"><strong>Experience:</strong> {{ $veterinarian->experience }} years</li>
                    <li class="list-group-item"><strong>Occupation:</strong> {{ $veterinarian->occupation }} </li>

                    <li class="list-group-item">
                        <strong>Education Certificate:</strong>
                        @if($veterinarian->education_certificate)
                            <a href="{{ asset('storage/' . $veterinarian->education_certificate) }}" target="_blank">View Certificate</a>
                        @else
                            No certificate available
                        @endif
                    </li>
                </ul>

                <div class="text-center mt-3">
                    <a href="{{ route('veterinarians.edit', $veterinarian->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('veterinarians.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
