@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Parts Listing</h6>
        <a href="{{ route('admin.parts.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Part
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Quality</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parts as $part)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $part->main_image) }}" 
                            alt="{{ $part->name }}" 
                            class="img-thumbnail" 
                            style="max-width: 50px;">
                        </td>
                        <td>{{ $part->name }}</td>
                        <td>Rs {{ number_format($part->price, 2) }}</td>
                        <td>{{ $part->stock_level }}</td>
                        <td>
                            <span class="badge {{ $part->quality == 'new' ? 'badge-success' : 'badge-secondary' }}">
                                {{ ucfirst($part->quality) }}
                            </span>
                        </td>
                        <td>{{ optional($part->make)->name }}</td>
                        <td>{{ optional($part->carModel)->name }}</td>
                        <td>{{ optional($part->year)->year }}</td>
                        <td>{{ optional($part->category)->name }}</td>
                        <td>
                            <a href="{{ route('admin.parts.edit', $part) }}" 
                               class="btn btn-sm btn-info mb-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.parts.destroy', $part) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $parts->links() }}
    </div>
</div>
@endsection