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
                <h5 class="card-title">FAQs List</h5>
                <a href="{{ route('faqs.create') }}" class="btn btn-primary mb-3">Add New FAQ</a>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
