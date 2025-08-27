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
                        <h5 class="card-title">Medical History Details</h5>
                        <p><strong>Pet:</strong> {{ $medicalHistory->pet->pet_id }}</p>
                        <p><strong>Doctor:</strong> {{ $medicalHistory->user->first_name }}</p>
                        <p><strong>Details:</strong> {{ $medicalHistory->details }}</p>
                        <p><strong>Medicines:</strong> {{ $medicalHistory->medicines }}</p>
                        <a href="{{ route('medical_histories.index') }}" class="btn btn-primary">Back</a>
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
