
@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Car Model: {{ $carModel->name }}</h6>
        <a href="{{ route('admin.car_models.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.car_models.update', $carModel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Make Selection -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="make_id">Make <span class="text-danger">*</span></label>
                    <select name="make_id" id="make_id" class="form-control @error('make_id') is-invalid @enderror" required>
                        <option value="">-- Select Make --</option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}" {{ old('make_id', $carModel->make_id) == $make->id ? 'selected' : '' }}>
                                {{ $make->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('make_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Model Name -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="name">Model Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $carModel->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Update Model
            </button>
        </form>
    </div>
</div>
@endsection
