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