@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Your Transaction</h2>
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-md-8">
                            @if(session('transaction') && count(session('transaction')))
                                <form action="{{ route('transaction.update') }}" method="POST" id="transaction-form">
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
                                                <tr data-id="{{ $id }}" data-price="{{ $details['price'] }}">
                                                    <td>{{ $details['name'] }}</td>
                                                    <td>{{ $details['price'] }}</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-danger btn-decrement">-</button>
                                                            <input type="number" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}" min="1" class="form-control text-center quantity-input" readonly>
                                                            <button type="button" class="btn btn-success btn-increment">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="subtotal">{{ $details['price'] * $details['quantity'] }}</td>
                                                    <td>
                                                        <button type="submit" class="btn btn-danger" formaction="{{ route('transaction.remove', $id) }}">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            @else
                                <p>Your transaction is empty.</p>
                            @endif
                        </div>
                        
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Receipt</h3>
                                </div>
                                <div class="card-body">
                                    @if(session('transaction') && count(session('transaction')))
                                        <p>Total Products Price: <strong id="total-products-price">{{ $total }}</strong></p>
                                        @php
                                            $tax = $total * 0.11; 
                                            $totalWithTax = $total + $tax;
                                        @endphp
                                        <p>Tax (11%): <strong id="tax">{{ $tax }}</strong></p>
                                        <p>Total Price with Tax: <strong id="total-price-with-tax">{{ $totalWithTax }}</strong></p>
                                        <form action="{{ route('transaction.checkout') }}" method="POST" class="mt-3">
                                            @csrf
                                            <div class="form-group">
                                                <label for="points">Redeem Points:</label>
                                                <input type="number" id="points" name="points" class="form-control" placeholder="Enter points to redeem">
                                            </div>
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
        </div>
    </div>
</div>

@section('javascript')
    <script>
 

    function addQty(id)
    {
        $.ajax({
        type:'POST',
        url:'{{route("transaction.addQty")}}',
        data: {
            '_token' : '<?php echo csrf_token() ?>',
            'id': id
        },
        success: function(data){
            location.reload();
        }
        });
    }
    </script>
@endsection

@endsection
