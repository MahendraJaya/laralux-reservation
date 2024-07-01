@extends('layouts.frontend')

@section('content')
<div class="container my-5">
        <div class="col-md-16">
            <div class="card h-100 shadow-sm">
                <img src="{{ $hotel->image }}" class="card-img-top" alt="Hotel Image" style="height: 400px; object-fit: cover;">
                <div class="card-body">
                    <h3 class="card-title">{{ $hotel->name }}</h3>
                    <p class="card-text"><strong>Address:</strong> {{ $hotel->address }}</p>
                    <p class="card-text"><strong>Telephone:</strong> {{ $hotel->telephone }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $hotel->email }}</p>
                    <p class="card-text"><strong>City:</strong> {{ $hotel->city }}</p>
                    <p class="card-text"><strong>Rating:</strong> {{ $hotel->rating }}</p>
                    <p class="card-text"><strong>Type:</strong> {{ $hotel->typeHotel->name }}</p>
                    <p class="card-text"><strong>Owner:</strong> {{ $hotel->user->name }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('hotel.products', $hotel->id) }}" class="btn btn-primary">
                        See Product
                    </a>
                </div>
            </div>
        </div>
    
</div>
@endsection
