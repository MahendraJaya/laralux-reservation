@extends('layouts.dashboard')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form action="{{ route('admin.facility.store', $hotel) }}" method="post">
            @csrf
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">

                <select class="form-select p-2" aria-label="Default select example" name="product"
                    id="product">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
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
