@extends('layouts.dashboard')
@section('content')
<div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content" id="msg">

        </div>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <th>ID</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </thead>
    <tbody>
        @foreach ( $transactions->product_transaction as $pt )
        <tr>
            <td>{{$pt->id}}</td>
            <td>{{$pt->product->name}}</td>
            <td>{{$pt->quantity}}</td>
            <td>{{$pt->subtotal}}</td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection