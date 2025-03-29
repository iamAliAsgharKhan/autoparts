
 @extends('layouts.admin')

 @section('styles')
<style>
    .image-gallery { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 10px; padding: 10px; background-color: #f8f9fa; border: 1px solid #eee; border-radius: 5px;}
    .image-gallery img { max-width: 150px; max-height: 150px; border: 1px solid #ddd; padding: 3px; }
</style>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Project Details: {{ $project->headline }}</h6>
        <div>
             <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-info btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
       <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $project->id }}</dd>

            <dt class="col-sm-3">Headline</dt>
            <dd class="col-sm-9">{{ $project->headline }}</dd>

            <dt class="col-sm-3">Description</dt>
            {{-- Use {!! !!} if description contains HTML from a rich text editor --}}
            {{-- Be careful with XSS if the content isn't properly sanitized! --}}
            <dd class="col-sm-9">{!! nl2br(e($project->description)) !!}</dd> {{-- Basic display with line breaks --}}

            <dt class="col-sm-3">Created At</dt>
            <dd class="col-sm-9">{{ $project->created_at->format('Y-m-d H:i:s') }}</dd>

            <dt class="col-sm-3">Last Updated</dt>
            <dd class="col-sm-9">{{ $project->updated_at->format('Y-m-d H:i:s') }}</dd>
       </dl>

        <hr>

        <h5>Before Images ({{ $project->beforeImages->count() }})</h5>
        @if($project->beforeImages->isNotEmpty())
            <div class="image-gallery">
                @foreach($project->beforeImages as $image)
                    <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                         <img src="{{ asset('storage/' . $image->image_path) }}" alt="Before Image {{ $loop->iteration }}">
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-muted">No 'before' images available.</p>
        @endif

         <h5 class="mt-4">After Images ({{ $project->afterImages->count() }})</h5>
         @if($project->afterImages->isNotEmpty())
            <div class="image-gallery">
                @foreach($project->afterImages as $image)
                     <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                         <img src="{{ asset('storage/' . $image->image_path) }}" alt="After Image {{ $loop->iteration }}">
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-muted">No 'after' images available.</p>
        @endif

    </div>
</div>
@endsection
