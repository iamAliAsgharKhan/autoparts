@extends('layouts.main')


@section('title', 'Results')
    
@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/styles3.css') }}">
@endsection

    @section('content')
        <!-- Product Listing Section -->
        <section class="product-listing">
            <h2>Filtered Results</h2>
            @if($results->isEmpty())
                <p>No parts found for the selected filters.</p>
            @else
                <div class="product-grid">
                    @foreach($results as $product)
                        <div class="product-card">
                            <!-- Use asset() for product images -->
                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}">
                            <h3>{{ $product->name }}</h3>
                            <p class="product-price">Rs {{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="view-details">View Details</a>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination Links -->
                <!-- <div class="pagination">
                    {{ $results->links() }}
                </div> -->
            @endif
        </section>
    @endsection