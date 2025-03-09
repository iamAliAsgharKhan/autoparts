@extends('layouts.main')


@section('title', 'Products')
    
@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/styles3.css') }}">
@endsection

@section('content')
    <!-- Product Listing Section -->
    <section class="product-listing">
        <h2>{{ $category->name }} Products</h2>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p class="product-price">Rs {{ number_format($product->price, 2) }}</p>
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
 
            
        </div>
    </section>

    @endsection