@extends('layouts.dashboard')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form action="{{ route('admin.hotel.storeAdmin') }}" method="post">
            @csrf
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Telephone</label>
                <input type="number" id="telephone" name="telephone" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Email</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">City</label>
                <input type="text" id="city" name="city" class="form-control">
            </div>
            
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Rating</label>
                <input type="number" id="rating" name="rating" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">

                <select class="form-select p-2" aria-label="Default select example" name="type_hotel_id" id="type_hotel_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('javascript')
@endsection
