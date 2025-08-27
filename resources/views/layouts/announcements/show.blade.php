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
                        <h5 class="card-title">Announcement Details</h5>

                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $announcement->id }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $announcement->description }}</td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>
                                    @if($announcement->image)
                                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement Image" width="100">
                                    @else
                                        No image available
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Expiry Date</th>
                                <td>{{ $announcement->expiry_date }}</td>
                            </tr>
                        </table>

                        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Back to List</a>
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
