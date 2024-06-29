@extends('layouts.dashboard')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form action="{{ route('admin.hotel.updateAdmin') }}" method="POST">
            @method('PUT')
            @csrf
            {{-- @dd($hotel) --}}
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $hotel->name) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $hotel->address) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Telephone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $hotel->telephone) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email', $hotel->email) }}" class="form-control" disabled>
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">City</label>
                <input type="text" id="city" name="city" value="{{ old('city', $hotel->city) }}" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Rating</label>
                <input type="number" id="rating" name="rating" value="{{ old('rating', $hotel->rating) }}" class="form-control">
                <input type="hidden" name="hotel_id" id="hotel_id" value="{{ $hotel->id }}">
            </div>
            <div class="input-group input-group-outline mb-3">

                <select class="form-select p-2" aria-label="Default select example" name="type_hotel_id" id="type_hotel_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @checked(old('type_hotel_id', $hotel->type_hotel_id) == $type->id)>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('javascript')
@endsection
