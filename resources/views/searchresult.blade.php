@extends('layouts.main')


@section('title', 'Product listing')
    
@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/styles3.css') }}">
@endsection
@section('content')
    <section class="product-listing">
        <h2>Search Results for "{{ $query }}"</h2>

        @if($results->isEmpty())
            <p>No results found for "{{ $query }}".</p>
        @else
            <div class="product-grid">
                @foreach($results as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
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

            
        </div>
    </section>
    @endsection