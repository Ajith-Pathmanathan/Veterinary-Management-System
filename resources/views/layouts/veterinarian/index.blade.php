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
                        <h5 class="card-title d-flex flex-row justify-content-between">Staff List
                            <a href="{{ route('veterinarians.create') }}" class="btn btn-primary mb-3">Create New Veterinarian</a>
                        </h5>

                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('veterinarians.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="id" class="form-control" placeholder="Veterinarian ID" value="{{ request('id') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="name" class="form-control" placeholder="Veterinarian Name" value="{{ request('name') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="occupation" class="form-control" placeholder="Occupation" value="{{ request('occupation') }}">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('veterinarians.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>


                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>NIC</th>
                                <th>Name</th>
                                <th>Education</th>
                                <th>Experience</th>
                                <th>Occupation</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($veterinarians as $veterinarian)
                                <tr>
                                    <td>{{ $veterinarian->user->national_id }}</td>
                                    <td>{{ $veterinarian->user->first_name }}</td>
                                    <td>{{ $veterinarian->education }}</td>
                                    <td>{{ $veterinarian->experience }} years</td>
                                    <td>{{ $veterinarian->occupation }}</td>
                                    <td>
                                        <a href="{{ route('veterinarians.show', $veterinarian->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('veterinarians.edit', $veterinarian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('veterinarians.destroy', $veterinarian->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No veterinarians found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $veterinarians->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>

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
