<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaction.index');
    }
    public function add($productId) {
        $product = Product::findOrFail($productId);
        $transaction = session()->get('transaction', []);
        if(isset($transaction[$productId])) {
            $transaction[$productId]['quantity']++;
        } else {
            $transaction[$productId] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1
            ];
        }
        session()->put('transaction', $transaction);
        return redirect()->back()->with('success', 'Product added to transaction!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $quantities = $request->quantities;
        $transaction = session()->get('transaction', []);
        foreach ($quantities as $id => $quantity) {
            if(isset($transaction[$id])) {
                $transaction[$id]['quantity'] = $quantity;
            }
        }
        session()->put('transaction', $transaction);
        return redirect()->route('transaction.index')->with('success', 'Transaction updated!');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function checkout(Request $request)
    {
        $transaction = session()->get('transaction', []);

        if (empty($transaction)) {
            return redirect()->route('transaction.index')->with('error', 'Your transaction is empty!');
        }

        $newTransaction = new Transaction();
        $newTransaction->user_id = Auth::id();
        $newTransaction->check_in = now();
        $newTransaction->check_out = now();
        $newTransaction->save();

        foreach ($transaction as $productId => $details) {
            $product = Product::findOrFail($productId);
            
            $newTransaction->product()->attach($product->id, [
                'quantity' => $details['quantity'],
                'subtotal' => $details['price'] * $details['quantity']
            ]);
        }

        session()->forget('transaction');
        
        return redirect()->route('transaction.index')->with('success', 'Transaction completed!');
    }



    public function remove($productId) {
        $transaction = session()->get('transaction', []);
        if (isset($transaction[$productId])) {
            unset($transaction[$productId]);
            session()->put('transaction', $transaction);
        }
        return redirect()->route('transaction.index')->with('success', 'Product removed from transaction!');
    }
}
