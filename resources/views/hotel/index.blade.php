@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">          
            <div class="card">
                <div class="card-header"><h2>Hotels</h2></div>
                <div class="card-body">
                    <div class="mt-4">
                        <div class="row">
                            @foreach($hotels as $hotel)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <img src="{{ $hotel->image }}" class="card-img-top" alt="Hotel Image" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $hotel->name }}</h5>
                                            <p class="card-text"><strong>Address:</strong> {{ $hotel->address }}</p>
                                            <p class="card-text"><strong>Telephone:</strong> {{ $hotel->telephone }}</p>
                                            <p class="card-text"><strong>Email:</strong> {{ $hotel->email }}</p>
                                            <p class="card-text"><strong>City:</strong> {{ $hotel->city }}</p>
                                            <p class="card-text"><strong>Rating:</strong> {{ $hotel->rating }}</p>
                                            <p class="card-text"><strong>Type:</strong> {{ $hotel->typeHotel->name }}</p>
                                            <p class="card-text"><strong>Owner:</strong> {{ $hotel->user->name }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('hotel.products', $hotel->id) }}" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
