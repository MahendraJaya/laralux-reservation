@extends('layouts.dashboard')
@section('content')
<div>
@can('create-product', Auth::user())
<a href="{{ route('admin.product.createAdmin', $hotel) }}" class="btn btn-primary">Create Product</a>
@endcan
</div>
<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Availible Room</th>
                <th>Detail</th>
                @can('delete-hotel', Auth::user())
                <th scope="col">Action</th>
                <th scope="col">Delete</th>
                @endcan
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
            <tr class="">
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->available_room }}</td>
                <td>
                    <a href="{{ route('admin.product.showAdmin', ['product' => $product, 'hotel'=>$hotel]) }}" class="btn btn-primary">Detail</a>
                </td>
                @can('delete-hotel', Auth::user())
                <td><a href="{{ route('admin.product.editAdmin', ['product' => $product, 'hotel'=>$hotel]) }}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form method="POST" action="{{route('admin.product.destroy', ['product' => $product, 'hotel'=>$hotel])}}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" value="{{$product->id}}" name="id">
                        <input type="submit" value="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete Product')">
                    </form>
                </td>
                </td>
                @endcan
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection

@section('javascript')
@endsection