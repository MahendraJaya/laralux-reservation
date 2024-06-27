@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">          
            <div class="card">
                <div class="card-header"><h2>Hotels</h2></div>
                <div class="card-body">
                    <div class="mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Rating</th>
                                    <th>Image</th>
                                    <th>Type Hotel</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Owner</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotels as $hotel)
                                    <tr>
                                        <td>{{ $hotel->name }}</td>
                                        <td>{{ $hotel->address }}</td>
                                        <td>{{ $hotel->telephone }}</td>
                                        <td>{{ $hotel->email }}</td>
                                        <td>{{ $hotel->city }}</td>
                                        <td>{{ $hotel->rating }}</td>
                                        <td><img src="{{ $hotel->image }}" alt="Hotel Image" width="100"></td>
                                        <td>{{ $hotel->typeHotel->name }}</td>
                                        <td>{{ $hotel->created_at }}</td>
                                        <td>{{ $hotel->updated_at }}</td>
                                        <td>{{ $hotel->user->name }}</td>
                                        <td>
                                            <a href="{{ route('hotel.products', $hotel->id) }}" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
