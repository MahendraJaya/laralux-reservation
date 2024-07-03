@extends('layouts.frontend')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ $product->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $product->image }}" class="card-img-top" alt="product Image" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <p><strong>Price:</strong> {{ $product->price }}</p>
                            <p><strong>Capacity:</strong> {{ $product->capacity }}</p>
                            <p><strong>Available Room:</strong> {{ $product->available_room }}</p>
                            <p><strong>Type Product:</strong> {{ $product->typeProduct->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <form action="{{ route('transaction.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
