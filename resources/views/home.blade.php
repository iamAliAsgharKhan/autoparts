@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="hero-container">
            <img src="images/coursel.png" alt="Toyota Revo" class="hero-image">
        </div>

        <div class="nav-arrows">
            <button class="nav-arrow">←</button>
            <button class="nav-arrow">→</button>
        </div>
    </section>

    <section class="search-parts">
    <div class="container">
        <h2>Search Parts For Your Car</h2>
        <form action="{{ route('parts.filter') }}" method="GET" class="search-form">
            <!-- Make Dropdown -->
            <select name="make_id" id="make" class="search-select">
                <option value="">--Select Make--</option>
                @foreach ($makes as $make)
                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                @endforeach
            </select>

            <!-- Model Dropdown -->
            <select name="car_model_id" id="model" class="search-select">
                <option value="">--Select Model--</option>
            </select>

            <!-- Year Dropdown -->
            <select name="year_id" id="year" class="search-select">
                <option value="">--Select Year--</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                @endforeach
            </select>

            <!-- Submit Button -->
            <button type="submit" class="filter-button">Filter</button>
        </form>
    </div>
</section>




<section class="projects">
    <div class="container">
        <h2>AutoStore Projects</h2>
        <p class="projects-description">Check out custom car modifications done by team of experts at AutoStore workshop!</p>

        {{-- Check if there are enough projects to make a slider meaningful --}}
        @if($projects->count() > 0)
            <div class="projects-slider-container"> {{-- Outer container for overflow --}}
                <div class="projects-slider-track"> {{-- Inner container that slides --}}
                    {{-- Loop through all fetched projects --}}
                    @foreach($projects as $project)
                        <div class="project-card"> {{-- Each project is a slide --}}
                            <a href="{{ route('projects.show', $project) }}" class="project-card-link"> {{-- Link the whole card --}}
                                <div class="before-after">
                                    <div class="image-container">
                                        @php $beforeImage = $project->beforeImages->first(); @endphp
                                        <img src="{{ $beforeImage ? asset('storage/' . $beforeImage->image_path) : asset('images/placeholder_before.png') }}"
                                             alt="Before - {{ $project->headline }}">
                                        <span class="image-label">Before</span>
                                    </div>
                                    <div class="image-container">
                                        @php $afterImage = $project->afterImages->first(); @endphp
                                        <img src="{{ $afterImage ? asset('storage/' . $afterImage->image_path) : asset('images/placeholder_after.png') }}"
                                             alt="After - {{ $project->headline }}">
                                        <span class="image-label">After</span>
                                    </div>
                                </div>
                                <h3>{{ $project->headline }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div> {{-- End slider track --}}

                 {{-- Optional: Add Prev/Next Buttons if needed later
                 <button class="slider-nav prev" aria-label="Previous Slide"><</button>
                 <button class="slider-nav next" aria-label="Next Slide">></button>
                 --}}

            </div> {{-- End slider container --}}
        @else
            {{-- Displayed if $projects collection is empty --}}
            <div class="col-12">
                <p class="text-center text-muted mt-4">No projects available at the moment. Check back soon!</p>
            </div>
        @endif

    </div>
</section>



<section class="related-products">
        <h2>Recent Products</h2>
        <div class="related-products-grid">
            @foreach($recentProducts as $product)
                <div class="related-product-card">
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p class="related-product-price">Rs {{ number_format($product->price, 2) }}</p>
                    <button 
                    class="view-details" 
                    onclick="window.location.href='{{ route('product.show', $product->id) }}'" 
                    role="link"
                >
                    View Details
                </button>
                </div>
            @endforeach
        </div>
</section>



<section class="categories">
    <h2 class="categories-title">Categories</h2>
    <div class="categories-container">
        @foreach ($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="category-link">
            <div class="category-card">
                
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image">
                    <p class="category-text">{{ $category->name }}</p>
                
            </div>
            </a>
        @endforeach
    </div>
</section>

@endsection

@section('additional-styles')
<link rel="stylesheet" href="{{ asset('css/scroll.css') }}">

@endsection
@section('scripts')
<script>
    // --- Existing Make/Model/Year Dropdown JS ---
    document.getElementById('make')?.addEventListener('change', function() {
       // ... your existing code ...
    });
    document.getElementById('model')?.addEventListener('change', function() {
       // ... your existing code ...
    });
    // --- End Existing JS ---


    // --- Project Slider Logic ---
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.projects-slider-container');
        const track = document.querySelector('.projects-slider-track');
        const slides = track ? track.querySelectorAll('.project-card') : []; // Get individual slides

        if (!track || !container || slides.length === 0) {
            console.log("Project slider elements not found or no slides.");
            return; // Exit if slider elements aren't present
        }

        let currentIndex = 0;
        let intervalId = null;
        const slideInterval = 5000; // Time between slides in milliseconds (5 seconds)

        // --- Calculate slides to show based on container width ---
        function getSlidesToShow() {
            if (window.innerWidth <= 768) return 1;
            if (window.innerWidth <= 992) return 2;
            return 3; // Default
        }
        // ---------------------------------------------------------

        function updateSliderPosition() {
            const slidesToShow = getSlidesToShow();
            // Calculate the width of a single slide based on the container and number shown
            // Note: Using percentage width on cards makes this simpler
            const totalSlides = slides.length;

            // Prevent sliding if not enough slides for the current view
            if (totalSlides <= slidesToShow) {
                 track.style.transform = 'translateX(0%)';
                 return; // Don't slide if all visible
            }

            // Calculate max index to prevent empty space at the end
            const maxIndex = totalSlides - slidesToShow;
            if (currentIndex > maxIndex) {
                currentIndex = 0; // Loop back to start
            } else if (currentIndex < 0) {
                currentIndex = maxIndex; // Loop back from start (if prev button added later)
            }

             // Calculate translation percentage
             // Each slide takes up 100 / slidesToShow percentage of the container view
            const percentagePerSlideGroup = 100 / slidesToShow;
            const translatePercentage = -currentIndex * percentagePerSlideGroup;

            track.style.transform = `translateX(${translatePercentage}%)`;
        }

        function nextSlide() {
            const slidesToShow = getSlidesToShow();
            const totalSlides = slides.length;
             if (totalSlides <= slidesToShow) return; // Don't advance if not needed

             // Check if moving to the next index would exceed the max index
             if (currentIndex + 1 > totalSlides - slidesToShow) {
                 currentIndex = 0; // Loop back to the start
             } else {
                 currentIndex++;
             }
            updateSliderPosition();
        }

        function startInterval() {
            stopInterval(); // Clear any existing interval first
            intervalId = setInterval(nextSlide, slideInterval);
        }

        function stopInterval() {
            clearInterval(intervalId);
        }

        // --- Event Listeners ---
        container.addEventListener('mouseenter', stopInterval);
        container.addEventListener('mouseleave', startInterval);
        window.addEventListener('resize', () => {
            // Recalculate position on resize, might need adjustment
            // Resetting index might be simplest for resize
            currentIndex = 0;
            updateSliderPosition();
        });
        // ---------------------

        // --- Initial Setup ---
        updateSliderPosition(); // Set initial position
        startInterval(); // Start the automatic sliding
        // -------------------

    });
    // --- End Project Slider Logic ---

</script>
@endsection 