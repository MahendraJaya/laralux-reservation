@extends('layouts.dashboard')
@section("content")
<a href="{{ route('admin.product.indexAdmin', $hotel) }}" class="btn btn-primary">Product</a>
@endsection

@section("javascript")
@endsection