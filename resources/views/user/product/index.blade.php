@extends('layouts.frontend')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 bg-transparent">
                <div class="card-header bg-transparent border-0">
                    <h2 class="text-center">Products for Hotel {{ $hotel->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @if($products->isEmpty())
                            <div class="col">
                                <div class="card shadow-sm h-100 bg-white border-0">
                                    <div class="card-body text-center">
                                        <p class="card-text">No products available for this hotel.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($products as $product)
                                <div class="col mb-4">
                                    <a href="{{ route('product.detail', ['hotelId' => $hotel->id, 'productId' => $product->id]) }}" class="text-decoration-none text-dark">
                                        <div class="card h-100 shadow-sm bg-white border-0">
                                            <img src="{{ $product->image }}" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>
                                                <p class="card-text"><strong>Capacity:</strong> {{ $product->capacity }}</p>
                                                <p class="card-text"><strong>Available Room:</strong> {{ $product->available_room }}</p>
                                                <p class="card-text"><strong>Type Product:</strong> {{ $product->typeProduct->name }}</p>
                                            </div>
                                            <div class="card-footer text-center">
                                                <form action="{{ route('transaction.add', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Buy</button>
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
