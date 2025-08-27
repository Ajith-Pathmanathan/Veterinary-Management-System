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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">FAQ Details</h5>

                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $faq->id }}</li>
                    <li class="list-group-item"><strong>Question:</strong> {{ $faq->question }}</li>
                    <li class="list-group-item"><strong>Answer:</strong> {{ $faq->answer }}</li>
                </ul>

                <div class="text-center mt-3">
                    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
