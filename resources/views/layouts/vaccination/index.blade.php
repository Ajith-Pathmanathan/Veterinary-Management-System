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

                        <!-- Vaccine Modal -->
                        <div class="modal fade" id="vaccineIndexModal" tabindex="-1" aria-labelledby="cowsModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cowsModalLabel">Vaccine</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" class="btn btn-primary mb-3" id="createVaccineButton"
                                                data-bs-toggle="modal" data-bs-target="#vaccineFormModal">
                                            Create New Vaccine
                                        </button>

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vaccines as $vaccine)
                                                <tr>
                                                    <td>{{ $vaccine->id }}</td>
                                                    <td>{{ $vaccine->name }}</td>
                                                    <td>
                                                        <button type="button"
                                                                class="btn btn-warning btn-sm editVaccineButton"
                                                                data-id="{{ $vaccine->id }}"
                                                                data-name="{{ $vaccine->name }}" data-bs-toggle="modal"
                                                                data-bs-target="#vaccineFormModal">
                                                            Edit
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm deleteVaccineButton"
                                                                data-id="{{ $vaccine->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#deleteVaccineModal">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Create/Edit Vaccine Modal -->
                        <div class="modal fade" id="vaccineFormModal" tabindex="-1" aria-labelledby="vaccineFormLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="vaccineFormLabel">Create Vaccine</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="vaccineForm" method="POST" action="">
                                            @csrf
                                            <input type="hidden" name="_method" id="vaccineFormMethod" value="POST">

                                            <div class="mb-3">
                                                <label for="vaccineName" class="form-label">Vaccine Name</label>
                                                <input type="text" class="form-control" id="vaccineName" name="name"
                                                       required>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Vaccine Modal -->
                        <div class="modal fade" id="deleteVaccineModal" tabindex="-1"
                             aria-labelledby="deleteVaccineLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteVaccineLabel">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this vaccine?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form id="deleteVaccineForm" method="POST" action="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="card-title mb-3 d-flex flex-row justify-content-between ">Vaccinations List
                            <div class="d-flex mx-2 mb-4">
                                <a href="{{ route('vaccinations.create') }}" class="btn btn-primary mb-3">Create New
                                    Vaccination</a>
                                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                                        data-bs-target="#vaccineIndexModal">
                                    View Vaccines
                                </button>
                            </div>
                        </h5>

                        <!-- Filter Form -->

                        <!-- Actions Section -->

                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <form method="GET" action="{{ route('vaccinations.index') }}">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="vaccine_name"
                                                   name="vaccine_name" value="{{ request()->get('vaccine_name') }}"
                                                   placeholder="Enter vaccine name">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="owner_nic" name="owner_nic"
                                                   value="{{ request()->get('owner_nic') }}"
                                                   placeholder="Enter owner NIC">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end justify-content-end">
                                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Vaccinations Table -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <table class="table  table-hover ">
                                    <thead>
                                    <tr>
                                        <th>Pet ID</th>
                                        <th>Vaccination Date</th>
                                        <th>Vaccination Name</th>
                                        <th>Dose</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vaccinations as $vaccination)
                                        <tr>
                                            <td>{{ $vaccination->pet->pet_id }}</td>
                                            <td>{{ $vaccination->vaccination_date }}</td>
                                            <td>{{ $vaccination->vaccine->name }}</td>
                                            <td>{{ $vaccination->dose }}</td>
{{--                                            <td>{{ $vaccination->pet->user->national_id }}</td>--}}

                                            <td>
                                                <a href="{{ route('vaccinations.show', $vaccination->id) }}"
                                                   class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('vaccinations.edit', $vaccination->id) }}"
                                                   class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('vaccinations.destroy', $vaccination->id) }}"
                                                      id="delete-form-{{ $vaccination->id }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"  class="btn btn-danger btn-sm" onclick="confirmDelete({{ $vaccination->id }})">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $vaccinations->links('pagination::bootstrap-5') }}
                        </div>
                        @include("layouts.Dashboard._footer")
                        @include("layouts.Dashboard._script")
                        <!-- Modal for Vaccines -->
                        <!-- Assuming modal structure already exists elsewhere in your project -->

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const vaccineFormModal = document.getElementById('vaccineFormModal');
                                const vaccineForm = document.getElementById('vaccineForm');
                                const vaccineFormMethod = document.getElementById('vaccineFormMethod');
                                const vaccineNameInput = document.getElementById('vaccineName');
                                const vaccineFormLabel = document.getElementById('vaccineFormLabel');

                                document.getElementById('createVaccineButton').addEventListener('click', function () {
                                    vaccineForm.action = "{{ route('vaccines.store') }}";
                                    vaccineFormMethod.value = "POST";
                                    vaccineNameInput.value = "";
                                    vaccineFormLabel.textContent = "Create Vaccine";
                                });

                                document.querySelectorAll('.editVaccineButton').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        const vaccineId = button.getAttribute('data-id');
                                        const vaccineName = button.getAttribute('data-name');

                                        vaccineForm.action = `/vaccines/${vaccineId}`;
                                        vaccineFormMethod.value = "PUT";
                                        vaccineNameInput.value = vaccineName;
                                        vaccineFormLabel.textContent = "Edit Vaccine";
                                    });
                                });

                                const deleteVaccineForm = document.getElementById('deleteVaccineForm');
                                document.querySelectorAll('.deleteVaccineButton').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        const vaccineId = button.getAttribute('data-id');
                                        deleteVaccineForm.action = `/vaccines/${vaccineId}`;
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


</body>
</html>
