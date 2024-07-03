@extends('layouts.frontend')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                        @foreach(session('transaction') as $id => $details)
                                            <tr>
                                                <td>{{ $details['name'] }}</td>
                                                <td>{{ number_format($details['price'], 2, ',', '.') }}</td>
                                                <td>
                                                    <input type="number" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}" min="1" class="form-control">
                                                </td>
                                                <td>{{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-danger" formaction="{{ route('transaction.remove', $id) }}">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Update Transaction</button>
                            </form>
                        @else
                            <p>Your transaction is empty.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Invoice</h2>
                </div>
                <div class="card-body">
                    @if(session('transaction') && count(session('transaction')))
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                                    <td><strong>{{ number_format($total, 2, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tax (11%)</strong></td>
                                    <td><strong>{{ number_format($totalWithTax - $total, 2, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total (including tax)</strong></td>
                                    <td><strong>{{ number_format($totalWithTax, 2, ',', '.') }}</strong></td>
                                </tr>
                                @if($pointDiscount > 0)
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Point Discount</strong></td>
                                        <td><strong>-{{ number_format($pointDiscount, 2, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Final Total</strong></td>
                                        <td><strong>{{ number_format($finalTotal, 2, ',', '.') }}</strong></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        
                        @php
                            $membership = Auth::user()->membership;
                            $availablePoints = $membership ? $membership->point : 0;
                            $maxRedeemablePoints = min($availablePoints, floor($total / 100000));
                        @endphp
                        
                        @if($availablePoints > 0 && $total >= 100000)
                            <form action="{{ route('transaction.redeem-points') }}" method="POST" class="mt-3">
                                @csrf
                                <div class="form-group">
                                    <label for="pointsToRedeem">Redeem Points (Available: {{ $availablePoints }}, Max: {{ $maxRedeemablePoints }})</label>
                                    <input type="number" class="form-control" id="pointsToRedeem" name="pointsToRedeem" 
                                           min="1" max="{{ $maxRedeemablePoints }}" value="1">
                                </div>
                                <button type="submit" class="btn btn-warning">Redeem Points</button>
                            </form>
                        @endif

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
<br>
<br>
@endsection
