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
                        <h5 class="card-title d-flex justify-content-between flex-row">
                            Pets List
                            @if (Auth::user()->role_id !==  2)
                                <div>
                                    <a href="{{ route('pets.pdf') }}" class="btn btn-danger mb-3">Download PDF</a>
                                    <a href="{{ route('pets.create') }}" class="btn btn-primary mb-3">Create New Pet</a>
                                </div>
                            @endif

                        </h5>


                        <!-- Filter Form -->
                        @if (Auth::user()->role_id !==  2)
                            <form method="GET" action="{{ route('pets.index') }}" class="mb-3">
                                <div class="d-flex  flex-row justify-content-between">
                                    <input type="text" name="id" class="form-control w-50" placeholder="Enter Pet ID"
                                           value="{{ request('id') }}">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('pets.index') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        @endif


                        <!-- Create Button -->

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Pet ID</th>
                                <th>Type</th>
                                <th>Breed</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                @if (Auth::user()->role_id !==  2)

                                    <th>Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pets as $pet)
                                <tr>
                                    <td>{{ $pet->pet_id }}</td>
                                    <td>{{ $pet->type }}</td>
                                    <td>{{ $pet->breed }}</td>
                                    <td>{{ $pet->date_of_birth }}</td>
                                    <td>{{ ucfirst($pet->gender) }}</td>


                                    @if (Auth::user()->role_id !==  2)
                                        <td>
                                            <a href="{{ route('pets.show', $pet->id) }}"
                                               class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('pets.edit', $pet->id) }}"
                                               class="btn btn-warning btn-sm">Edit</a>
                                            <form
                                                id="delete-form-{{ $pet->id }}"
                                                action="{{ route('pets.destroy', $pet->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $pet->id }})">Delete
                                                </button>
                                            </form>
                                        </td>

                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No pets found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $pets->appends(request()->query())->links('pagination::bootstrap-4') }}
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
