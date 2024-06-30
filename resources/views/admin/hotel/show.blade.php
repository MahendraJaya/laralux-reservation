@extends('layouts.dashboard')
@section("content")
<a href="{{ route('admin.product.indexAdmin', $hotel) }}" class="btn btn-primary">Product</a>

<a href="{{ route('admin.facility.index', $hotel) }}" class="btn btn-primary">Facilities</a>
<div>
    <h1>disini detail nya nanti saja</h1>
</div>
@endsection

@section("javascript")
@endsection