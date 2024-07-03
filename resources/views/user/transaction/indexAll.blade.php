@extends('layouts.frontend')
@section('content')
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
                            <h3>Reservasion for : {{ Auth::user()->name }}</h3>
                            @if (isset($transactions))
                                
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @dd($transactions) --}}
                                            @foreach ($transactions as $transaction)
                                                @foreach ($transaction->product as $id => $details)
                                                    <tr>
                                                        <td>{{ $details['name'] }}</td>
                                                        <td>{{ number_format($details['price'], 2, ',', '.') }}</td>
                                                        <td>
                                                            {{ $details->pivot->quantity }}
                                                        </td>
                                                        <td>{{ number_format($details['price'] * $details->pivot->quantity, 2, ',', '.') }}
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                <div>
                                    <h5>Check in : {{ $transactions[0]->check_in }}</h5>
                                    <h5>Check out : {{ $transactions[0]->check_out }}</h5>
                                </div>
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
                        {{-- @dd($total) --}}
                        @if (isset($transactions))
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
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Point Received</strong></td>
                                        <td><strong>{{ number_format($transactions[0]->point, 2, ',', '.') }}</strong></td>
                                    </tr>
                                    @if ($pointDiscount > 0)
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

@endsection
