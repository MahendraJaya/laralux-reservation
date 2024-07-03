@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header bg-transparent border-0">
                <div class="card-body">
                    <div class="mt-4">
                        @if($products->isEmpty())
                            <p>No products available for this hotel.</p>
                        @else
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <img class="card-img-top" src="{{ $product->image }}" alt="Product Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>
                                                <p class="card-text"><strong>Capacity:</strong> {{ $product->capacity }}</p>
                                                <p class="card-text"><strong>Available Room:</strong> {{ $product->available_room }}</p>
                                                <p class="card-text"><strong>Type:</strong> {{ $product->typeProduct->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                       @endif
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
