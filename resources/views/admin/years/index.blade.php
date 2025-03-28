@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Years Listing</h6>
        <a href="{{ route('admin.years.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Year
        </a>
    </div>
    <div class="card-body">
        {{-- Display Success/Error Messages --}}
        @include('partials.admin.flash-messages') {{-- Or copy the specific if blocks --}}

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($years as $year)
                    <tr>
                        <td>{{ $year->id }}</td>
                        <td>{{ $year->year }}</td>
                        <td>{{ $year->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{-- Show Button (Optional) --}}
                            {{-- <a href="{{ route('admin.years.show', $year) }}"
                               class="btn btn-sm btn-secondary mb-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.years.edit', $year) }}"
                               class="btn btn-sm btn-info mb-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.years.destroy', $year) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure? Deleting this year might fail if it is linked to Parts.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No years found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         {{-- Pagination Links --}}
         <div class="d-flex justify-content-center">
            {{ $years->links() }}
        </div>
    </div>
</div>
@endsection