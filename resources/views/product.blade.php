@extends('layouts.main')


@section('title', 'Product')
    
@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
@endsection

    @section('content')

    <!-- Product Section -->
    <section class="product-section">
        <div class="product-container">
            <div class="product-image">
                <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
            </div>
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-price">Rs {{ number_format($product->price, 2) }}</p>
                <p class="product-description">{{ $product->description }}</p>
                <button class="contact-whatsapp">Contact Us on WhatsApp</button>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="related-products">
        <h2>Related Products</h2>
        <div class="related-products-grid">
            @foreach($relatedProducts as $relatedProduct)
                <div class="related-product-card">
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $relatedProduct->name }}">
                    <h3>{{ $relatedProduct->name }}</h3>
                    <p class="related-product-price">Rs {{ number_format($relatedProduct->price, 2) }}</p>
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

    @endsection