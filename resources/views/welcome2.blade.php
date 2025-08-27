<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>About - VetCare</title>
    <meta content="Veterinary Management System About Page" name="description">
    <meta content="VetCare, About, FAQ, Hospitals" name="keywords">

    @include("auth.links")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .hero {
            background: url('/assets/img/background.jpg') center center / cover no-repeat;
            height: 300px;
            position: relative;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .hero-text {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            padding-top: 100px;
        }

        .section-icon {
            font-size: 2rem;
            color: #0d6efd;
        }

        .card-title {
            color: #0d6efd !important;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="/" style="color: #0d6efd !important;">VetCare</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-text">
        <h1 class="display-5 fw-bold">About VetCare</h1>
        <p class="lead">Caring for Animals with Passion and Precision</p>
    </div>
</section>

<main>
    <div class="container py-5">

        <!-- FAQ Section -->
        <section class="mb-5">
            <div class="text-center mb-4">
                <i class="bi bi-question-circle section-icon"></i>
                <h2 class="fw-bold" style="color: #0d6efd;">Frequently Asked Questions</h2>
            </div>
            <div class="accordion accordion-flush" id="faqAccordion">
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item border-0 shadow-sm mb-2 rounded">
                        <h3 class="accordion-header" id="faqHeading{{ $index }}">
                            <button class="accordion-button bg-light text-dark fw-semibold {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $index }}">
                                {{ $faq->question }}
                            </button>
                        </h3>
                        <div id="faqCollapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}">
                            <div class="accordion-body">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($faqs->isEmpty())
                    <p class="text-center text-muted">No FAQs available at the moment.</p>
                @endif
            </div>
        </section>

        <!-- Hospitals Section -->
        <section>
            <div class="text-center mb-4">
                <i class="bi bi-hospital section-icon"></i>
                <h2 class="fw-bold" style="color: #0d6efd;">Our Hospitals</h2>
            </div>

            <!-- Table for larger screens -->
            <div class="d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered bg-white shadow-sm">
                        <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>District</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($hospitals as $hospital)
                            <tr>
                                <td>{{ $hospital->name }}</td>
                                <td>{{ $hospital->district }}</td>
                                <td>{{ $hospital->address }}</td>
                                <td>{{ $hospital->contact_number }}</td>
                                <td>{{ $hospital->email_address }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($hospitals->isEmpty())
                    <p class="text-center text-muted">No hospitals available at the moment.</p>
                @endif
            </div>

            <!-- Cards for smaller screens -->
            <div class="d-md-none">
                <div class="row">
                    @foreach ($hospitals as $hospital)
                        <div class="col-12 mb-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title fw-semibold">{{ $hospital->name }}</h5>
                                    <p class="card-text"><strong>District:</strong> {{ $hospital->district }}</p>
                                    <p class="card-text"><strong>Address:</strong> {{ $hospital->address }}</p>
                                    <p class="card-text"><strong>Contact:</strong> {{ $hospital->contact_number }}</p>
                                    <p class="card-text"><strong>Email:</strong> {{ $hospital->email_address }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($hospitals->isEmpty())
                        <p class="text-center text-muted">No hospitals available at the moment.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center bg-primary text-white rounded-circle" style="background-color: #FF2D20 !important;"><i class="bi bi-arrow-up-short"></i></a>

@include("auth.script")

</body>
</html>
