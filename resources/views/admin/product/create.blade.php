@extends('layouts.dashboard')
@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form action="{{ route('admin.product.storeAdmin', $hotel) }}" method="post">
            @csrf
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Capacity</label>
                <input type="number" id="capacity" name="capacity" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Available Room</label>
                <input type="number" id="available_room" name="available_room" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                
                <select class="form-select p-2" aria-label="Default select example" name="type_product_id" id="type_product_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="hotel_id" id="hotel_id" value="{{ $hotel->id }}">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('javascript')
@endsection
