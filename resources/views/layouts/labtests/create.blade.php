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
            <div class=" mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Lab Test</h5>

                        <form action="{{ route('labtests.store') }}" method="POST">
                            @csrf

                            <!-- Pet Selection -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-control @error('pet_id') is-invalid @enderror"
                                            id="floatingHospital" name="pet_id">
                                        <option value="">Select Pet</option>
                                        @foreach ($pets as $pet)
                                            <option
                                                value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                                {{ $pet->pet_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingHospital">Select Pet</label>
                                    @error('pet_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Test Type -->
                            <div class="mb-3">
                                <label for="test_type" class="form-label">Test Type</label>
                                <input type="text" class="form-control @error('test_type') is-invalid @enderror"
                                       id="test_type" name="test_type"
                                       value="{{ old('test_type') }}" required>
                                @error('test_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Test Detail -->
                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="test_detail" class="form-label">Test Detail</label>--}}
                            {{--                                <textarea class="form-control @error('test_detail') is-invalid @enderror" id="test_detail" name="test_detail" rows="3" required>{{ old('test_detail') }}</textarea>--}}
                            {{--                                @error('test_detail')--}}
                            {{--                                <div class="text-danger">{{ $message }}</div>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            <!-- Test Details as Key-Value Pairs -->
                            <div class="mb-3">
                                <label class="form-label">Test Details</label>
                                <table class="table table-bordered" id="test-details-table">
                                    <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Value</th>
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm" onclick="addRow()">
                                                Add
                                            </button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" name="test_details[0][key]" class="form-control"
                                                   required></td>
                                        <td><input type="text" name="test_details[0][value]" class="form-control"
                                                   required></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Remove
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
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
</body>
</html>
