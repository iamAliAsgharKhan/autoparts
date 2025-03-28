
@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Make: {{ $make->name }}</h6>
        <a href="{{ route('admin.makes.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.makes.update', $make->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Important for update route --}}

            <!-- Make Name -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="name">Make Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $make->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Update Make
            </button>
        </form>
    </div>
</div>
@endsection
