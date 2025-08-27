<!DOCTYPE html>
<html lang="en">
<head>
    @include("layouts.Dashboard._meta")
    @include("layouts.Dashboard._style")
</head>
<body>


@include("layouts.Dashboard._header")
@include("layouts.Dashboard._sidebar")

<main id="main" class="main">
    <section class="section">
        <div class="container my-5">


            <!-- Farms List -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Farms List
                        <div>
                            <a href="{{ url('/farms/pdf/export') }}" class="btn btn-danger btn-sm me-2">
                                <i class="bi bi-download"></i> Download PDF
                            </a>
                            <a href="{{ route('farms.create') }}" class="btn btn-primary btn-sm ms-1">
                                <i class="bi bi-plus-circle"></i> Add Farm
                            </a>
                        </div>
                    </h5>



                    <!-- Search Form -->
                    <div class="mb-3">
                        <form method="GET" action="{{ route('farms.index') }}">
                            <div class="d-flex flex-row justify-content-between">
                                <input
                                    type="text"
                                    name="search"
                                    id="farmSearch"
                                    class="form-control w-50"
                                    placeholder="Search farms by  NIC..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light sticky-top">
                            <tr>
                                <th>Name</th>
                                <th>Size (acres)</th>
                                <th>NIC</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="farmTable">
                            @forelse($farms as $farm)
                                <tr>
                                    <td>{{ $farm->name }}</td>
                                    <td>{{ $farm->size }}</td>
                                    <td>{{ $farm->user->national_id }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('farms.show', $farm->id) }}" class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('farms.edit', $farm->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form id="delete-form-{{ $farm->id }}" action="{{ route('farms.destroy', $farm->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $farm->id }})" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No farms found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $farms->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
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
