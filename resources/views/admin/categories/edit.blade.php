@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Category: {{ $category->name }}</h6>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Important for update route --}}

            <!-- Category Name -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $category->name) }}" required>
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
                           value="{{ old('slug', $category->slug) }}" required>
                    <small class="form-text text-muted">URL-friendly version of the name.</small>
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
                              rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Current Image -->
            <div class="form-group row">
                 <div class="col-sm-12">
                    <label>Current Image</label>
                    <div>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                 alt="Current Image"
                                 class="img-thumbnail mb-2"
                                 style="max-width: 150px; max-height: 150px;">
                        @else
                            <span class="text-muted">No current image uploaded.</span>
                        @endif
                    </div>
                 </div>
            </div>

            <!-- Image Upload (for replacement) -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Upload New Image (Optional)</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="categoryImage">
                        <label class="custom-file-label" for="categoryImage">Choose file to replace...</label>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">Upload a new image only if you want to replace the current one. Max 2MB.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Update Category
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

    // Note: Slug generation might be less useful on edit unless you want it to auto-update
    // when the name changes, which could break existing links if not handled carefully.
    // Keeping the slug field editable might be safer here.
});
</script>
@endsection