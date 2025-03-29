
@extends('layouts.admin')

@section('styles')
{{-- Add specific styles if needed, e.g., for image previews --}}
<style>
    .image-preview-container { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 15px; }
    .image-preview-item { position: relative; border: 1px solid #ddd; padding: 5px; background-color:#f8f9fa; }
    .image-preview-item img { max-width: 100px; max-height: 100px; display: block; }
    .image-preview-item .delete-image { margin-top: 5px; }
</style>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Project: {{ $project->headline }}</h6>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        {{-- Display Errors --}}
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

        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Headline -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="headline">Headline <span class="text-danger">*</span></label>
                    <input type="text" id="headline" name="headline"
                           class="form-control @error('headline') is-invalid @enderror"
                           value="{{ old('headline', $project->headline) }}" required>
                     @error('headline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row">
                 <div class="col-sm-12">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="8"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                     @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr>
            <h5>Manage Images</h5>

            <!-- Existing Before Images -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Current Before Images</label>
                    <div class="image-preview-container">
                        @forelse($project->beforeImages as $image)
                            <div class="image-preview-item text-center">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Before Image {{ $loop->iteration }}">
                                <div class="form-check delete-image">
                                    <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                    <label class="form-check-label text-danger" for="delete_image_{{ $image->id }}">
                                        Delete
                                    </label>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No 'before' images uploaded yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

             <!-- Add New Before Images -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="new_before_images">Add New Before Images</label>
                    <div class="custom-file">
                        <input type="file" name="new_before_images[]" class="custom-file-input @error('new_before_images.*') is-invalid @enderror" id="new_before_images" multiple>
                        <label class="custom-file-label" for="new_before_images">Choose files...</label>
                    </div>
                     @error('new_before_images.*') <span class="text-danger d-block">{{ $message }}</span> @enderror
                    <small class="form-text text-muted">Select new images to add.</small>
                </div>
            </div>

            <!-- Existing After Images -->
             <div class="form-group row mt-4">
                <div class="col-sm-12">
                    <label>Current After Images</label>
                    <div class="image-preview-container">
                         @forelse($project->afterImages as $image)
                            <div class="image-preview-item text-center">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="After Image {{ $loop->iteration }}">
                                <div class="form-check delete-image">
                                    <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                    <label class="form-check-label text-danger" for="delete_image_{{ $image->id }}">
                                        Delete
                                    </label>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No 'after' images uploaded yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Add New After Images -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="new_after_images">Add New After Images</label>
                     <div class="custom-file">
                         <input type="file" name="new_after_images[]" class="custom-file-input @error('new_after_images.*') is-invalid @enderror" id="new_after_images" multiple>
                         <label class="custom-file-label" for="new_after_images">Choose files...</label>
                    </div>
                    @error('new_after_images.*') <span class="text-danger d-block">{{ $message }}</span> @enderror
                    <small class="form-text text-muted">Select new images to add.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">
                <i class="fas fa-save fa-fw"></i> Update Project
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
{{-- Script for custom file input labels --}}
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
