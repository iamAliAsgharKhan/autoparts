
@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Create New Project</h6>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        {{-- Display Errors if redirected back --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Headline -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="headline">Headline <span class="text-danger">*</span></label>
                    <input type="text" id="headline" name="headline"
                           class="form-control @error('headline') is-invalid @enderror"
                           value="{{ old('headline') }}" required>
                    @error('headline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Description (Rich Text Editor Placeholder) -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="8"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Enter project details here...">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                     <small class="form-text text-muted">You can integrate a rich text editor (like TinyMCE, CKEditor) with this field later.</small>
                </div>
            </div>

            <!-- Before Images -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="before_images">Before Images</label>
                    <div class="custom-file">
                        <input type="file" name="before_images[]" class="custom-file-input @error('before_images.*') is-invalid @enderror" id="before_images" multiple>
                        <label class="custom-file-label" for="before_images">Choose files...</label>
                    </div>
                    @error('before_images.*') <span class="text-danger d-block">{{ $message }}</span> @enderror
                    <small class="form-text text-muted">You can select multiple images (Max 2MB each). Recommended: JPG, PNG, WEBP, GIF.</small>
                </div>
            </div>

             <!-- After Images -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="after_images">After Images</label>
                    <div class="custom-file">
                         <input type="file" name="after_images[]" class="custom-file-input @error('after_images.*') is-invalid @enderror" id="after_images" multiple>
                         <label class="custom-file-label" for="after_images">Choose files...</label>
                    </div>
                    @error('after_images.*') <span class="text-danger d-block">{{ $message }}</span> @enderror
                    <small class="form-text text-muted">You can select multiple images (Max 2MB each).</small>
                </div>
            </div>


            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Create Project
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
{{-- Add script to update custom file input labels --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.custom-file-input').forEach(input => {
            input.addEventListener('change', function (event) {
                let fileNames = Array.from(event.target.files).map(f => f.name).join(', ');
                let nextSibling = event.target.nextElementSibling;
                if (nextSibling && nextSibling.classList.contains('custom-file-label')) {
                    nextSibling.innerText = fileNames || 'Choose files...';
                }
            });
        });
    });
</script>
{{-- Add scripts for Rich Text Editor here if you integrate one --}}
@endsection
