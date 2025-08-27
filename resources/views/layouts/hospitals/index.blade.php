<!DOCTYPE html>
<html lang="en">

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
                <h5 class="card-title">Hospitals List</h5>
                <a href="{{ route('hospitals.create') }}" class="btn btn-primary mb-3">Create New Hospital</a>

                <!-- Table -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($hospitals as $hospital)
                        <tr>
                            <td>{{ $hospital->id }}</td>
                            <td>{{ $hospital->name }}</td>
                            <td>{{ $hospital->district }}</td>
                            <td>{{ $hospital->contact_number }}</td>
                            <td>{{ $hospital->email_address }}</td>
                            <td>
                                <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form
                                    id="delete-form-{{ $hospital->id }}"
                                    action="{{ route('hospitals.destroy', $hospital->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $hospital->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- End Table -->
            </div>
        </div>
    </section>

</main>

@include('layouts.Dashboard._footer')
@include('layouts.Dashboard._script')
</body>

</html>
