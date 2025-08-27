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
                        <h5 class="card-title">Lab Tests List</h5>
                        <a href="{{ route('labtests.create') }}" class="btn btn-primary mb-3">Create New Lab Test</a>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pet ID</th>
                                <th>Test Type</th>
                                <th>Test Detail</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($labtests as $labtest)
                                <tr>
                                    <td>{{ $labtest->id }}</td>
                                    <td>{{ $labtest->pet->pet_id }}</td>
                                    <td>{{ $labtest->test_type }}</td>
                                    <td>{{ $labtest->test_detail }}</td>
                                    <td>
                                        <a href="{{ route('labtests.show', $labtest->id) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('labtests.edit', $labtest->id) }}" class="btn btn-warning">Edit</a>
                                        <form
                                            id="delete-form-{{ $labtest->id }}"
                                            action="{{ route('labtests.destroy', $labtest->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"  class="btn btn-danger" onclick="confirmDelete({{ $labtest->id }})">Delete</button>
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
