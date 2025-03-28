@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Create New Category</h6>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Category Name -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Slug -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" id="slug" name="slug"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug') }}" required>
                     <small class="form-text text-muted">URL-friendly version of the name (e.g., "brake-pads"). Usually lowercase letters, numbers, and hyphens.</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

             <!-- Description -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Image -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Category Image</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="categoryImage">
                        <label class="custom-file-label" for="categoryImage">Choose file...</label>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">Optional. Max 2MB. Recommended format: JPG, PNG, WEBP.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Create Category
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Script to update the file input label with the selected file name
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function (event) {
            let fileName = event.target.files[0] ? event.target.files[0].name : 'Choose file...';
            let nextSibling = event.target.nextElementSibling;
            if (nextSibling && nextSibling.classList.contains('custom-file-label')) {
                nextSibling.innerText = fileName;
            }
        });
    });

    // Basic Slug Generation (optional - enhance as needed)
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('keyup', function() {
            const nameValue = this.value;
            // Basic slugify: lowercase, replace spaces with hyphens, remove non-alphanumeric/hyphens
            slugInput.value = nameValue.toString().toLowerCase()
                .replace(/\s+/g, '-')         // Replace spaces with -
                .replace(/[^\w\-]+/g, '')     // Remove all non-word chars but keep hyphens
                .replace(/\-\-+/g, '-')       // Replace multiple - with single -
                .replace(/^-+/, '')           // Trim - from start of text
                .replace(/-+$/, '');          // Trim - from end of text
        });
    }
});
</script>
@endsection