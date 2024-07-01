@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Products for {{ $hotel->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="mt-4">
                        @if($products->isEmpty())
                            <p>No products available for this hotel.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Capacity</th>
                                        <th>Image</th>
                                        <th>Available Room</th>
                                        <th>Type Product</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->capacity }}</td>
                                            <td><img src="{{ $product->image }}" alt="Product Image" width="100"></td>
                                            <td>{{ $product->available_room }}</td>
                                            <td>{{ $product->typeProduct->name }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>{{ $product->updated_at }}</td>
                                            <td>
                                                
                                                <form action="{{ route('transaction.add', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Buy</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       @endif
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
