
@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Year: {{ $year->year }}</h6>
        <a href="{{ route('admin.years.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.years.update', $year->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Year Input -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="year">Year (YYYY) <span class="text-danger">*</span></label>
                    <input type="number" id="year" name="year"
                           class="form-control @error('year') is-invalid @enderror"
                           value="{{ old('year', $year->year) }}"
                           required
                           min="1900"
                           max="{{ date('Y') + 5 }}"
                           step="1"
                           placeholder="Enter 4-digit year">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                     <small class="form-text text-muted">Enter the 4-digit year (e.g., 2023).</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Update Year
            </button>
        </form>
    </div>
</div>
@endsection
