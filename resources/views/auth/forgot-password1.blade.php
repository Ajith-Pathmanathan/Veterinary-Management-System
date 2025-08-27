<!DOCTYPE html>
<html lang="en">

<head>
   @include("auth.metaData")

    <title>Email Password Reset Link - NiceAdmin Bootstrap Template</title>

    @include("auth.links")



</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Forgot your password?</h5>
                                    <p class="text-center small">Enter your email, and we will send a password reset link</p>
                                </div>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form class="row g-3 needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="col-12">
                                        <label for="email" class="form-label">Your Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus>
                                        <div class="invalid-feedback">Please enter your email!</div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Email Password Reset Link</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include("auth.script")

</body>

</html>
