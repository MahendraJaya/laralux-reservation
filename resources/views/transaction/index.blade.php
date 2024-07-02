@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Your Transaction</h2>
                </div>
                <div class="card-body">
                    <div class="mt-4">
                        @if(session('transaction') && count(session('transaction')))
                            <form action="{{ route('transaction.update') }}" method="POST">
                                @csrf
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach(session('transaction') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity']; @endphp
                                            <tr>
                                                <td>{{ $details['name'] }}</td>
                                                <td>{{ $details['price'] }}</td>
                                                <td>
                                                    <input type="number" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}" min="1" class="form-control">
                                                </td>
                                                <td>{{ $details['price'] * $details['quantity'] }}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-danger" formaction="{{ route('transaction.remove', $id) }}">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                                            <td><strong>{{ $total }}</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Update Transaction</button>
                            </form>
                            <form action="{{ route('transaction.checkout') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-success">Checkout</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">Continue Shopping</a>
                            </form>
                        @else
                            <p>Your transaction is empty.</p>
                        @endif
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection