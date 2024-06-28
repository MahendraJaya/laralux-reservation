@extends('layouts.dashboard')
@section('content')
    <div>
        <a href="{{ route('admin.product.createAdmin', $hotel) }}" class="btn btn-primary">Create Product</a>
    </div>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Availible Room</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($products as $product)
                <tr class="">
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->available_room }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('javascript')
@endsection
