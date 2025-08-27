<!DOCTYPE html>
<html lang="en">

<head>
    @include("auth.metaData")

    <title>Login - NiceAdmin Bootstrap Template</title>


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
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                                        @csrf

                                        <!-- Email Address -->
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text">@</span>
                                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" required autocomplete="current-password">
                                            <div class="invalid-feedback">Please enter your password!</div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>

                                        <!-- Forgot Password and Register Link -->
                                        @if (Route::has('password.request'))
                                            <div class="col-12">
                                                <p class="small mb-0">
                                                    Forgot your password?
                                                    <a href="{{ route('password.request') }}">Click here</a>
                                                </p>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
                                        </div>
                                    </form>
                                </div>
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
