
@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Car Models Listing</h6>
        <a href="{{ route('admin.car_models.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Model
        </a>
    </div>
    <div class="card-body">
        {{-- Display Success/Error Messages --}}
        @include('partials.admin.flash-messages') {{-- Assuming you have a partial for flash messages --}}
        {{-- Or copy the specific if blocks from Make index --}}


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Model Name</th>
                        <th>Make</th> {{-- Added Make column --}}
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carModels as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->make->name ?? 'N/A' }}</td> {{-- Display make name safely --}}
                        <td>{{ $model->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{-- Show Button (Optional) --}}
                            {{-- <a href="{{ route('admin.car_models.show', $model) }}"
                               class="btn btn-sm btn-secondary mb-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.car_models.edit', $model) }}"
                               class="btn btn-sm btn-info mb-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.car_models.destroy', $model) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure? Deleting this model might fail if it is linked to Years or Parts.')">
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
                        <td colspan="5" class="text-center">No car models found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         {{-- Pagination Links --}}
         <div class="d-flex justify-content-center">
            {{ $carModels->links() }}
        </div>
    </div>
</div>
@endsection

