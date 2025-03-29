@extends('layouts.main') {{-- Use your main front-end layout --}}

@section('title', $project->headline) {{-- Dynamic page title --}}

@section('additional-styles') {{-- Add specific styles if needed --}}
<style>
    .project-detail-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    .project-headline {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #eee;
        padding-bottom: 15px;
    }
    .project-description {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #555;
        margin-bottom: 30px;
    }
    /* Style for description HTML if using rich text */
    .project-description p { margin-bottom: 1em; }
    .project-description ul, .project-description ol { margin-left: 1.5em; margin-bottom: 1em; }

    .project-gallery {
        margin-bottom: 40px;
    }
    .project-gallery h3 {
        font-size: 1.8rem;
        color: #444;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid */
        gap: 15px;
    }
    .image-grid-item img {
        width: 100%;
        height: auto; /* Maintain aspect ratio */
        border-radius: 5px;
        border: 1px solid #ddd;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer; /* If implementing lightbox */
    }
     .image-grid-item img:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
     }
     .no-images {
        color: #888;
        font-style: italic;
     }
</style>
@endsection

@section('content')
    <div class="project-detail-container">

        <h1 class="project-headline">{{ $project->headline }}</h1>

        <div class="project-description">
            {{-- Render description - Use {!! !!} ONLY if content is trusted/sanitized HTML --}}
            {{-- Otherwise, use nl2br(e($project->description)) for basic line breaks --}}
            {!! $project->description !!}
            {{-- Or safer: --}}
            {{-- <p>{!! nl2br(e($project->description)) !!}</p> --}}
        </div>

        {{-- Before Images Gallery --}}
        <section class="project-gallery">
            <h3>Before Transformation</h3>
            @if($project->beforeImages->isNotEmpty())
                <div class="image-grid">
                    @foreach($project->beforeImages as $image)
                        <div class="image-grid-item">
                             {{-- Optional: Add link for lightbox --}}
                            <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="before-gallery" data-title="Before - {{ $project->headline }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Before Image {{ $loop->iteration }} for {{ $project->headline }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="no-images">No 'before' images available for this project.</p>
            @endif
        </section>

         {{-- After Images Gallery --}}
        <section class="project-gallery">
            <h3>After Transformation</h3>
             @if($project->afterImages->isNotEmpty())
                <div class="image-grid">
                    @foreach($project->afterImages as $image)
                         <div class="image-grid-item">
                            {{-- Optional: Add link for lightbox --}}
                             <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="after-gallery" data-title="After - {{ $project->headline }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="After Image {{ $loop->iteration }} for {{ $project->headline }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="no-images">No 'after' images available for this project.</p>
            @endif
        </section>

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="btn btn-secondary">« Back to Home</a>
             {{-- Or use route('home') if defined --}}
        </div>

    </div>

    {{-- Include Lightbox JS/CSS if you use it --}}
    {{-- Example using Lightbox2:
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
     --}}

@endsection