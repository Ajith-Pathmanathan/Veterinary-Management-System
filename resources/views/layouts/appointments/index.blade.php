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
                        <h5 class="card-title">Appointments List</h5>
                        @if ( Auth::user()->role_id == 1)

                            <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Create New
                                Appointment</a>
                        @endif
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Appointment Time</th>
                                <th>Date</th>
                                <th>Reason</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->reason }}</td>
                                    <td>{{ $appointment->user->first_name }}</td>
                                    <!-- Assuming 'name' field exists in User -->
                                    <td>
                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                           class="btn btn-info">View</a>
                                        @if ( Auth::user()->role_id !== 2 )

                                            <a href="{{ route('appointments.edit', $appointment->id) }}"
                                               class="btn btn-warning">Edit</a>
                                            <form
                                                id="delete-form-{{ $appointment->id }}"
                                                action="{{ route('appointments.destroy', $appointment->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete({{ $appointment->id }})">Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
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
