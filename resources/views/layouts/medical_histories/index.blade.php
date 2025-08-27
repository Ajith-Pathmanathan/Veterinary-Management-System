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
                        <h5 class="card-title">Medical Histories List</h5>
                        <a href="{{ route('medical_histories.create') }}" class="btn btn-primary mb-3">Add Medical History</a>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Pet</th>
                                <th>Doctor</th>
                                <th>Details</th>
                                <th>Medicines</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($medicalHistories as $history)
                                <tr>
                                    <td>{{ $history->pet->pet_id }}</td>
                                    <td>{{ $history->user->first_name }}</td>
                                    <td>{{ $history->details }}</td>
                                    <td>{{ $history->medicines }}</td>
                                    <td>
                                        <a href="{{ route('medical_histories.show', $history->id) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('medical_histories.edit', $history->id) }}" class="btn btn-warning">Edit</a>
                                        <form
                                            id="delete-form-{{ $history->id }}"
                                            action="{{ route('medical_histories.destroy', $history->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $history->id }})">Delete</button>
                                        </form>
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
