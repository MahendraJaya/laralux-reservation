
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
        <th>Pembeli</th>
        <th>Kasir</th>
        <th>Tanggal Transaction</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ( $transactions as $transaction )
        <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->customer->name}}</td>
            <td>{{$transaction->user->name}}</td>
            <td>{{$transaction->transaction_date}}</td>
            <td>
            <td><a href="{{ route('admin.hotel.showAdmin', $hotel) }}" class="btn btn-primary">Detail</a> || <a href="{{ route('admin.transaction.show', $transaction) }}" class="btn btn-secondary">Detail</a></td>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

=======
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-hover">
            <thead>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->id}}</td>
                    <td>{{$transaction->user_id}}</td>
                    <td>{{$transaction->user->name}}</td>
                    <td>{{$transaction->check_in}}</td>
                    <td>{{$transaction->check_out}}</td>
                    <td><a class="btn btn-warning" href="{{route('transaction.edit', $transaction->id)}}">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection