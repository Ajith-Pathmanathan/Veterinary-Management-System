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
                        <h5 class="card-title d-flex flex-row justify-content-between">
                            User List
                            <div>
                                <a href="{{ route('users.pdf') }}" class="btn btn-danger mb-3">Download PDF</a>
                                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
                            </div>
                        </h5>


                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="national_id" class="form-control" placeholder="National Id" value="{{ request('national_id') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="first_name" class="form-control" placeholder="Name" value="{{ request('first_name') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>District</th>
                                <th>National ID</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->district }}</td>
                                    <td>{{ $user->national_id }}</td>
                                    <td>{{ $user->role->name  }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form
                                            id="delete-form-{{ $user->id }}"
                                            action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"  class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted">No users found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
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
