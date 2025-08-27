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
                <h5 class="card-title">User Details</h5>

                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $user->id ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Name:</strong> {{ ($user->first_name ?? 'N/A') . ' ' . ($user->last_name ?? 'N/A') }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>National ID:</strong> {{ $user->national_id ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Date of Birth:</strong> {{ $user->date_of_birth ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Phone Number:</strong> {{ $user->phone_number ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Street:</strong> {{ $user->street ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>City:</strong> {{ $user->city ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>District:</strong> {{ $user->district ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Role:</strong> {{ optional($user->role)->name ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Education:</strong> {{ optional($user->veterinarian)->education ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Experience:</strong> {{ optional($user->veterinarian)->experience ?? 'N/A' }} years</li>
                    <li class="list-group-item"><strong>Occupation:</strong> {{ optional($user->veterinarian)->occupation ?? 'N/A' }}</li>

                    <li class="list-group-item">
                        <strong>Education Certificate:</strong>
                        @if(optional($user->veterinarian)->education_certificate)
                            <a href="{{ asset('storage/' . $user->veterinarian->education_certificate) }}" target="_blank">View Certificate</a>
                        @else
                            N/A
                        @endif
                    </li>
                    <li class="list-group-item">
                        <strong>NIC_copy:</strong>
                        @if(optional($user->veterinarian)->NIC_copy)
                            <a href="{{ asset('storage/' . $user->veterinarian->NIC_copy) }}" target="_blank">View Certificate</a>
                        @else
                            N/A
                        @endif
                    </li>
                    <li class="list-group-item">
                        <strong>profile_picture:</strong>
                        @if(optional($user->veterinarian)->profile_picture)
                            <a href="{{ asset('storage/' . $user->veterinarian->profile_picture) }}" target="_blank">View Certificate</a>
                        @else
                            N/A
                        @endif
                    </li>
                </ul>


                <div class="text-center mt-3">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
