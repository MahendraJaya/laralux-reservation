@extends('layouts.dashboard')
@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form method="POST" action="{{ route('admin.product.updateAdmin', ['hotel' => $hotel, 'product' => $product]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Price</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Capacity</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $product->capacity) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Available Room</label>
                <input type="number" value="{{ old('available_room', $product->available_room) }}" id="available_room" name="available_room"
                    class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label for="file_photo" class="form-label">input image</label>
                <input class="form-control" type="file" id="file_photo" name="file_photo" value="{{ old('file_photo', $product->file_photo) }}">
            </div>
            <div class="input-group input-group-outline mb-3">

                <select class="form-select p-2" aria-label="Default select example" name="type_product_id"
                    id="type_product_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @selected(old('type_product_id', $product->type_product_id) == $type->id)>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="hotel_id" id="hotel_id" value="{{ $hotel->id }}">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

