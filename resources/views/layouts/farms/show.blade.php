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
                <h5 class="card-title">Farm Details</h5>
                <div class="row text-center mt-3">
                    <!-- Cows -->
                    <!-- Cows -->
                    <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#cowsModal">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-cow p-3 text-primary rounded-circle" style="font-size: 24px; background-color: #f8f9fa;"></i>
                                </div>
                                <h5 class="card-title">Total Cows</h5>
                                <p class="card-text display-6 fw-bold">{{ $totalCows }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Goats -->
                    <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#goatsModal">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-paw p-3 text-success rounded-circle" style="font-size: 24px; background-color: #f8f9fa;"></i>
                                </div>
                                <h5 class="card-title">Total Goats</h5>
                                <p class="card-text display-6 fw-bold">{{ $totalGoats }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Other Animals -->
                    <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#othersModal">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-dog p-3 text-warning rounded-circle" style="font-size: 24px; background-color: #f8f9fa;"></i>
                                </div>
                                <h5 class="card-title">Other Animals</h5>
                                <p class="card-text display-6 fw-bold">{{ $totalOthers }}</p>
                            </div>
                        </div>
                    </div>

                </div>


                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $farm->id }}</li>
                    <li class="list-group-item"><strong>Name:</strong> {{ $farm->name }}</li>
                    <li class="list-group-item"><strong>Size:</strong> {{ $farm->size }} acres</li>
                    <li class="list-group-item"><strong>User ID:</strong> {{ $farm->user_id }}</li>
                    <li class="list-group-item"><strong>Type:</strong> {{ $farm->type }}</li>
                    <li class="list-group-item"><strong>Street:</strong> {{ $farm->street }}</li>
                    <li class="list-group-item"><strong>City:</strong> {{ $farm->city }}</li>
                    <li class="list-group-item"><strong>District:</strong> {{ $farm->district }}</li>
                </ul>
                <!-- Owner History Section -->
                <h5 class="card-title mt-4">Owner History</h5>

                @if($ownerHistories->isEmpty())
                    <p class="text-muted text-center">No owner history records found.</p>
                @else
                    <div class="row">
                        @foreach($ownerHistories as $history)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm border-0 rounded">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">
                                            <strong>Owner:</strong> {{ optional($history->farm->user)->first_name ?? 'N/A' }}
                                        </h6>
                                        <p class="mb-1">
                                            <strong>NIC:</strong> {{ optional($history->farm->user)->national_id ?? 'N/A' }}
                                        </p>
                                        <p class="mb-1">
                                            <strong>From:</strong> {{ $history->from_date ? \Carbon\Carbon::parse($history->from_date)->format('d-m-Y') : 'N/A' }}
                                        </p>
                                        <p class="mb-1">
                                            <strong>To:</strong> {{ $history->to_date ? \Carbon\Carbon::parse($history->to_date)->format('d-m-Y') : 'N/A' }}
                                        </p>
                                        <p class="text-muted small">
                                            <i class="bi bi-clock"></i> Recorded on: {{ optional($history->created_at)->format('d-m-Y') ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif


                <div class="text-center mt-3">
                    <a href="{{ route('farms.edit', $farm->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('farms.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Cows Modal -->
    <div class="modal fade" id="cowsModal" tabindex="-1" aria-labelledby="cowsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cowsModalLabel">Cow List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cows as $cow)
                            <tr>
                                <td>{{ $cow->id }}</td>
                                <td>{{ $cow->type }}</td>
                                <td>{{ $cow->breed }}</td>
                                <td>{{ $cow->date_of_birth }}</td>
                                <td>{{ ucfirst($cow->gender) }}</td>
                                <td>
                                    <a href="{{ route('pets.show', $cow->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('pets.edit', $cow->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pets.destroy', $cow->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Goats Modal -->
    <div class="modal fade" id="goatsModal" tabindex="-1" aria-labelledby="goatsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goatsModalLabel">Goat List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goats as $goat)
                            <tr>
                                <td>{{ $goat->id }}</td>
                                <td>{{ $goat->type }}</td>
                                <td>{{ $goat->breed }}</td>
                                <td>{{ $goat->date_of_birth }}</td>
                                <td>{{ ucfirst($goat->gender) }}</td>
                                <td>
                                    <a href="{{ route('pets.show', $goat->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('pets.edit', $goat->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pets.destroy', $goat->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Animals Modal -->
    <div class="modal fade" id="othersModal" tabindex="-1" aria-labelledby="othersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="othersModalLabel">Other Animals List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($others as $other)
                            <tr>
                                <td>{{ $other->id }}</td>
                                <td>{{ $other->type }}</td>
                                <td>{{ $other->breed }}</td>
                                <td>{{ $other->date_of_birth }}</td>
                                <td>{{ ucfirst($other->gender) }}</td>
                                <td>
                                    <a href="{{ route('pets.show', $other->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('pets.edit', $other->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pets.destroy', $other->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>

                                    </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
                </div>
            </div>
    </div>
    </div>
 </main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")


<script>
    function showAnimalList(type) {
        // Hide all lists
        document.querySelectorAll('.animal-list').forEach(list => list.style.display = 'none');
        // Show the selected list
        document.getElementById(type).style.display = 'block';
    }
</script>
</body>
</html>
