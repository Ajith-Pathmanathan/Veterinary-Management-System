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
                <h5 class="card-title">Vaccination Details</h5>

                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $vaccination->id }}</li>
                    <li class="list-group-item"><strong>Animal ID:</strong> {{ $vaccination->pet->pet_id }}</li>
                    <li class="list-group-item"><strong>Animal Type:</strong> {{ ucfirst($vaccination->pet->type) }}</li>
                    <li class="list-group-item"><strong>Vaccination Date:</strong> {{ $vaccination->vaccination_date }}</li>
                    <li class="list-group-item"><strong>Vaccination Name:</strong> {{ $vaccination->vaccine->name }}</li>
                    <li class="list-group-item"><strong>Dose:</strong> {{ $vaccination->dose }}</li>
                </ul>

                <div class="text-center mt-3">
                    <a href="{{ route('vaccinations.edit', $vaccination->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('vaccinations.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
