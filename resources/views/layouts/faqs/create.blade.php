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
                <h5 class="card-title">Create New FAQ</h5>

                <!-- Floating Labels Form -->
                <form action="{{ route('faqs.store') }}" method="POST" class="row g-3">
                    @csrf

                    <!-- Question -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingQuestion" name="question" value="{{ old('question') }}">
                            <label for="floatingQuestion">Question</label>
                            @error('question')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Answer -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingAnswer" name="answer" style="height: 100px;">{{ old('answer') }}</textarea>
                            <label for="floatingAnswer">Answer</label>
                            @error('answer')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create FAQ</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End floating Labels Form -->
            </div>
        </div>
    </section>

</main>

@include('layouts.Dashboard._footer')
@include('layouts.Dashboard._script')
</body>

</html>
