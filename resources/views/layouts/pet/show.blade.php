<!DOCTYPE html>
<html>
<head>
    @include("layouts.Dashboard._meta")
    @include("layouts.Dashboard._style")
    <style>
        /* Vaccination Badge Styling */
        .vaccine-button {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            border-radius: 20px;
            font-weight: bold;
            color: #fff;
            font-size: 14px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .vaccine-blue { background-color: #007bff; }
        .vaccine-green { background-color: #28a745; }
        .vaccine-orange { background-color: #fd7e14; }

        /* Medical History Cards */
        .medical-card {
            border-left: 5px solid #007bff;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .medical-card h6 {
            margin-bottom: 5px;
            font-weight: bold;
            color: #007bff;
        }
        .medical-card p {
            font-size: 14px;
            margin: 0;
            color: #555;
        }
    </style>
</head>
<body>
@include("layouts.Dashboard._header")
@include("layouts.Dashboard._sidebar")

<main id="main" class="main">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pet Details</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Pet ID:</strong> {{ $pet->pet_id }}</li>
                    <li class="list-group-item"><strong>Type:</strong> {{ $pet->type }}</li>
                    <li class="list-group-item"><strong>Breed:</strong> {{ $pet->breed }}</li>
                    <li class="list-group-item"><strong>Date of Birth:</strong> {{ $pet->date_of_birth }}</li>
                    <li class="list-group-item"><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</li>
                </ul>

                <!-- Vaccination Details -->
                <h5 class="card-title mt-4">Vaccination Details</h5>
                @if($vaccinations->isEmpty())
                    <p class="text-muted">No vaccination records found.</p>
                @else
                    <div class="mb-3">
                        @foreach($vaccinations as $vaccination)
                            @php
                                $colors = ['vaccine-blue', 'vaccine-green', 'vaccine-orange'];
                                $color = $colors[array_rand($colors)];
                            @endphp
                            <span class="vaccine-button {{ $color }}">
                                {{ $vaccination->vaccine->name ?? 'Unknown' }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Medical History -->
                <h5 class="card-title mt-4">Medical History</h5>
                @if($medicalHistory->isEmpty())
                    <p class="text-muted">No medical history available.</p>
                @else
                    <div class="row">
                        @foreach($medicalHistory as $history)
                            <div class="col-md-4">
                                <div class="medical-card">
                                    <h6>Dr. {{ $history->veterinarian->user->first_name ?? 'Unknown' }}</h6>
                                    <p><strong>Details:</strong> {{ $history->details }}</p>
                                    <p><strong>Medicines:</strong> {{ $history->medicines }}</p>
                                    <p class="text-muted"><small>{{ $history->created_at->format('d-m-Y') }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- Lab Test Details -->
                <h5 class="card-title mt-4">Lab Test Details</h5>
                @if($labtests->isEmpty())
                    <p class="text-muted">No lab test records found.</p>
                @else
                    <div class="row">
                        @foreach($labtests as $labTest)
                            <div class="col-md-4">
                                <div class="medical-card">
                                    <h6>Test Type: {{ ucfirst($labTest->test_type) }}</h6>
                                    <p><strong>Details:</strong> {{ $labTest->test_detail }}</p>
                                    <p class="text-muted"><small>{{ $labTest->created_at->format('d-m-Y') }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- Owner History -->
                <h5 class="card-title mt-4">Owner History</h5>
                @if($ownerHistories->isEmpty())
                    <p class="text-muted">No owner history records found.</p>
                @else
                    <div class="row">
                        @foreach($ownerHistories as $history)
                            <div class="col-md-4">
                                <div class="medical-card">
                                    <h6>Farm: {{ $history->farm->name }}</h6>
                                    <h6>Owner: {{ $history->farm->user->first_name }}</h6>
                                    <p><strong>NIC:</strong> {{ $history->farm->user->national_id }}</p>
                                    <p><strong>From:</strong> {{ \Carbon\Carbon::parse($history->from_date)->format('d-m-Y') }}</p>
                                    <p><strong>To:</strong> {{ \Carbon\Carbon::parse($history->to_date)->format('d-m-Y') }}</p>
                                    <p class="text-muted"><small>Recorded on: {{ $history->created_at->format('d-m-Y') }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="text-center mt-3">
                    @if (Auth::user()->role_id == 2)
                    <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning">Edit</a>
                    @endif
                    <a href="{{ route('pets.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")
</body>
</html>
