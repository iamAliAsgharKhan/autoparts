
@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Car Makes Listing</h6>
        <a href="{{ route('admin.makes.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Make
        </a>
    </div>
    <div class="card-body">
        {{-- Display Success/Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($makes as $make)
                    <tr>
                        <td>{{ $make->id }}</td>
                        <td>{{ $make->name }}</td>
                        <td>{{ $make->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{-- Show Button (Optional) --}}
                            {{-- <a href="{{ route('admin.makes.show', $make) }}"
                               class="btn btn-sm btn-secondary mb-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.makes.edit', $make) }}"
                               class="btn btn-sm btn-info mb-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.makes.destroy', $make) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this Make? This cannot be undone.')">
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
                        <td colspan="4" class="text-center">No makes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         {{-- Pagination Links --}}
         <div class="d-flex justify-content-center">
            {{ $makes->links() }}
        </div>
    </div>
</div>
@endsection
