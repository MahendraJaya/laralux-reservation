@extends('layouts.frontend')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="mt-4">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($hotels as $hotel)
                        <div class="col mb-4">
                            <a href="{{ route('hotel.showUserHotel', $hotel->id) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $hotel->image }}" class="card-img-top" alt="Hotel Image" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $hotel->name }}</h5>
                                        <p class="card-text"><strong>Address:</strong> {{ $hotel->address }}</p>
                                        <p class="card-text"><strong>Rating:</strong> {{ $hotel->rating }}</p>
                                        <p class="card-text"><strong>Type:</strong> {{ $hotel->typeHotel->name }}</p>
                                    </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('hotel.products', $hotel->id) }}" class="btn btn-primary">
                                        See Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      {{ $hotels->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
