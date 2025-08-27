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
            <div class="mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Lab Test</h5>

                        <form action="{{ route('labtests.update', $labtest->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> Please fix the following errors:
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Pet Selection -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-control" id="floatingHospital" name="pet_id">
                                        <option value="">Select Pet</option>
                                        @foreach ($pets as $pet)
                                            <option value="{{ $pet->id }}" {{ $labtest->pet_id == $pet->id ? 'selected' : '' }}>
                                                {{ $pet->pet_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingHospital">Select Pet</label>
                                    @error('pet_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Test Type -->
                            <div class="mb-3">
                                <label for="test_type" class="form-label">Test Type</label>
                                <input type="text" class="form-control" id="test_type" name="test_type"
                                       value="{{ old('test_type', $labtest->test_type) }}" required>
                                @error('test_type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Test Details Table -->
                            <div class="mb-3">
                                <label class="form-label">Test Details</label>
                                <table class="table table-bordered" id="test-details-table">
                                    <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Value</th>
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm" onclick="addRow()">Add</button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $details = old('test_details') ?? json_decode(Storage::get("public/labtests/{$labtest->pdf_file}"), true)['test_details'] ?? [];
                                    @endphp
                                    @foreach ($details as $index => $detail)
                                        <tr>
                                            <td><input type="text" name="test_details[{{ $index }}][key]" class="form-control" value="{{ $detail['key'] }}" required></td>
                                            <td><input type="text" name="test_details[{{ $index }}][value]" class="form-control" value="{{ $detail['value'] }}" required></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('labtests.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")

@push('scripts')
    <script>
        let rowCount = {{ count($details) ?: 1 }};

        function addRow() {
            const tableBody = document.querySelector("#test-details-table tbody");
            const newRow = document.createElement("tr");

            newRow.innerHTML = `
            <td><input type="text" name="test_details[${rowCount}][key]" class="form-control" required></td>
            <td><input type="text" name="test_details[${rowCount}][value]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
        `;

            tableBody.appendChild(newRow);
            rowCount++;
        }

        function removeRow(button) {
            button.closest("tr").remove();
        }
    </script>
@endpush

</body>
</html>
