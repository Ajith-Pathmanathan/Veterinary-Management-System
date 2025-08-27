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
            <div class="mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lab Test Details</h5>

                        <table class="table">
                            <tr>
                                <th>ID:</th>
                                <td>{{ $labtest->id }}</td>
                            </tr>
                            <tr>
                                <th>Pet ID:</th>
                                <td>{{ $labtest->pet_id }}</td>
                            </tr>
                            <tr>
                                <th>Test Type:</th>
                                <td>{{ $labtest->test_type }}</td>
                            </tr>
                            <tr>
                                <th>Test Report (PDF):</th>
                                <td>
                                    @if ($labtest->test_detail)
                                        <a href="{{ asset('storage/test_details/' . $labtest->test_detail) }}" target="_blank">View Certificate</a>
                                    @else
                                        <span class="text-muted">No file uploaded</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <a href="{{ route('labtests.index') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('labtests.edit', $labtest->id) }}" class="btn btn-warning">Edit</a>

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
