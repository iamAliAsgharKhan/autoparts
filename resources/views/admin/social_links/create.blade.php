@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Create New Social Link</h6>
        <a href="{{ route('admin.social_links.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.social_links.store') }}" method="POST">
            @csrf

            <!-- Platform Name -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="platform_name">Platform Name <span class="text-danger">*</span></label>
                    <input type="text" id="platform_name" name="platform_name"
                           class="form-control @error('platform_name') is-invalid @enderror"
                           value="{{ old('platform_name') }}" required placeholder="e.g., Facebook, Instagram">
                    @error('platform_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- URL -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="url">URL <span class="text-danger">*</span></label>
                    <input type="url" id="url" name="url"
                           class="form-control @error('url') is-invalid @enderror"
                           value="{{ old('url') }}" required placeholder="https://...">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

             <!-- Icon Class -->
                            <!-- Icon Selection -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="icon">Icon <span class="text-danger">*</span></label>
                                    <select name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" required>
                                        <option value="">-- Select Icon --</option>
                                        @foreach($icons as $class => $name)
                                            <option value="{{ $class }}" {{ old('icon') == $class ? 'selected' : '' }}>
                                                {{ $name }} ({{ $class }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Select an icon from the list. Ensure Font Awesome is loaded on your site.</small>
                                </div>
                            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Create Link
            </button>
        </form>
    </div>
</div>
@endsection