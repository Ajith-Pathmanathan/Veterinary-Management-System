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
                        <h5 class="card-title">Announcements List</h5>
                        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-3">Create New Announcement</a>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Expiry Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{ $announcement->id }}</td>
                                    <td>{{ $announcement->description }}</td>
                                    <td>
                                        @if($announcement->image)
                                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement Image" width="50">
                                        @endif
                                    </td>
                                    <td>{{ $announcement->expiry_date }}</td>
                                    <td>
                                        <a href="{{ route('announcements.show', $announcement->id) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('announcements.edit', $announcement->id) }}" class="btn btn-warning">Edit</a>
                                        <form
                                            id="delete-form-{{ $announcement->id }}"
                                            action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $announcement->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
