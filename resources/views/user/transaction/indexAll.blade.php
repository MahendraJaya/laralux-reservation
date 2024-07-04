@extends('layouts.frontend')
@section('content')
    <div class="container">
        <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Pembeli</th>

            <th>Tanggal Transaction</th>
            <th>Detail</th>
        </thead>
        <tbody>
            {{-- @dd($transactions) --}}
            @if (isset($transactions))
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        {{-- <td>{{ $transaction->customer->name }}</td> --}}
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $transaction->check_in }}</td>

                        <td><a href="{{ route('transaction.showUser', ['transaction' => $transaction]) }}"
                                class="btn btn-secondary">Detail</a></td>

                    </tr>
                @endforeach
            @endif
        </tbody>
        </table>
    </div>
    <br>
    <br>
@endsection
