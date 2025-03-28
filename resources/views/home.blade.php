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
        <p class="projects-description">Check out custom car modifications done by team of experts at AutoStore workshop!<p>
        
        <div class="projects-grid">
            <div class="project-card">
                <div class="before-after">
                    <div class="image-container">
                        <img src="images/btoyota.png" alt="Before">
                        <span class="image-label">Before</span>
                    </div>
                    <div class="image-container">
                        <img src="images/tafter.png" alt="After">
                        <span class="image-label">After</span>
                    </div>
                </div>
                <h3>Toyota Hilux Revo 2021 To Rocco GR Sport Conversion 2023</h3>
            </div>
            
            <div class="project-card">
                <div class="before-after">
                    <div class="image-container">
                        <img src="images/2b.png" alt="After">
                        <span class="image-label">Before</span>
                    </div>
                    <div class="image-container">
                        <img src="images/2a.png" alt="Before">
                        <span class="image-label">After</span>
                    </div>
                </div>
                <h3>Toyota Fortuner Upgrade With TRD Body Kit 2016 To 2021-2022</h3>
            </div>

            <div class="project-card">
                <div class="before-after">
                    <div class="image-container">
                        <img src="images/btoyota.png" alt="Before">
                        <span class="image-label">Before</span>
                    </div>
                    <div class="image-container">
                        <img src="images/tafter.png" alt="After">
                        <span class="image-label">After</span>
                    </div>
                </div>
                <h3>Toyota Hilux Revo 2021 To Rocco GR Sport Conversion 2023</h3>
            </div>

           
        </div>

        <div class="pagination">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
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