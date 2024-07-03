<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Membership;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;
        if ($role == 'owner') {
            $ownerId = Auth::id();
            $transactions = Transaction::where('owner', $ownerId)->get();
            return view('admin.transaction.index', compact('transactions'));

        } else if ($role == 'staff') {
            $transactions = Transaction::all();
            return view('admin.transaction.index', compact('transactions'));
        }

        // else{
        //     $userId = Auth::id();
        //     $transactions = Transaction::where('user_id', $userId);
        //     return view('user.transaction.index', compact('transactions'));
        // }
        $transaction = session()->get('transaction', []);
        $total = $this->calculateTotal($transaction);
        $totalWithTax = $total * 1.11;
        $pointDiscount = session()->get('point_discount', 0);
        $finalTotal = $totalWithTax - $pointDiscount;

        return view('user.transaction.index', compact('total', 'totalWithTax', 'pointDiscount', 'finalTotal'));
    }

    public function indexUser()
    {
        $userId = Auth::user()->id;
        $transactions = Transaction::with('product')->where('user_id', $userId)->get();
        $total = 0;
        foreach ($transactions as $transaction) {
            foreach ($transaction->product as $product) {
                $total += $product->pivot->subtotal;
            }
        }
        $totalWithTax = $total * 1.11;
        $pointDiscount = session()->get('point_discount', 0);
        $finalTotal = $totalWithTax - $pointDiscount;

        return view('user.transaction.indexAll', compact('transactions', 'total', 'totalWithTax', 'pointDiscount', 'finalTotal'));
    }


    public function add($productId)
    {

        $product = Product::findOrFail($productId);
        $transaction = session()->get('transaction', []);
        if (isset($transaction[$productId])) {
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

    public function update(Request $request)
    {
        $quantities = $request->quantities;
        $transaction = session()->get('transaction', []);
        foreach ($quantities as $id => $quantity) {
            if (isset($transaction[$id])) {
                $transaction[$id]['quantity'] = $quantity;
            }
        }
        session()->put('transaction', $transaction);
        return redirect()->route('transaction.index')->with('success', 'Transaction updated!');

    }

    public function addQty(Request $request, Transaction $transaction)
    {
        // $id = $request->id;
        // $transaction = session()->get('transaction');
        // $product = Product::find($transaction[$id]['id']);
        // if (isset($transaction[$id])) {
        //     $jumlahAwal = $transaction[$id]['quantity'];
        //     $jumlahPesan = $jumlahAwal + 1;
        //     if ($jumlahPesan < $product->available_room) {
        //         $transaction[$id]['quantity']++;
        //     } else {
        //         return redirect()->back()->with('error', 'Jumlah pemesanan melebihi total kamar yang tersedia');
        //     }
        // }
        // session()->forget('transaction');
        // session()->put('transaction', $transaction);
    }

    public function reduceQty(Request $request, Transaction $transaction)
    {

    }

    public function remove($productId)
    {
        $transaction = session()->get('transaction', []);
        if (isset($transaction[$productId])) {
            unset($transaction[$productId]);
            session()->put('transaction', $transaction);
        }
        return redirect()->route('transaction.index')->with('success', 'Product removed from transaction!');
    }

    public function redeemPoints(Request $request)
    {
        $pointsToRedeem = $request->input('pointsToRedeem', 0);
        $transaction = session()->get('transaction', []);

        $total = $this->calculateTotal($transaction);
        $totalWithTax = $total * 1.11;

        $membership = Auth::user()->membership;

        if (!$membership) {
            return redirect()->route('transaction.index')->with('error', 'You are not a member yet.');
        }

        if ($totalWithTax < 100000) {
            return redirect()->route('transaction.index')->with('error', 'Minimum spending of Rp. 100,000 (before tax) is required to redeem points.');
        }

        $maxPointsToRedeem = min($membership->point, floor($total / 100000));

        if ($pointsToRedeem < 0 || $pointsToRedeem > $maxPointsToRedeem) {
            return redirect()->route('transaction.index')->with('error', 'Invalid number of points to redeem.');
        }

        $discountAmount = $pointsToRedeem * 100000;

        session()->put('redeemed_points', $pointsToRedeem);
        session()->put('point_discount', $discountAmount);

        return redirect()->route('transaction.index')->with('success', 'Points redeemed successfully. Discount: Rp. ' . number_format($discountAmount, 0, ',', '.'));
    }

    public function checkout(Request $request)
    {
        $transaction = session()->get('transaction', []);

        if (empty($transaction)) {
            return redirect()->route('transaction.index')->with('error', 'Your transaction is empty!');
        }

        $totalAmount = 0;
        $pointsEarned = 0;

        // Calculate total amount and points first
        foreach ($transaction as $productId => $details) {
            $subtotal = $details['price'] * $details['quantity'];
            $subtotalWithTax = $subtotal * 1.11;
            $totalAmount += $subtotalWithTax;

            // Calculate points
            $product = Product::findOrFail($productId);
            if ($product->type_product && in_array($product->type_product->name, ['deluxe', 'superior', 'suite'])) {
                $pointsEarned += 5 * $details['quantity'];
            } else {
                $pointsEarned += floor($subtotal / 300000);
            }
        }

        // Apply point discount
        $redeemedPoints = session()->get('redeemed_points', 0);
        $pointDiscount = session()->get('point_discount', 0);
        $finalTotal = $totalAmount - $pointDiscount;

        // Create and save the transaction
        $newTransaction = new Transaction();
        $newTransaction->user_id = Auth::id();
        $newTransaction->check_in = now();
        $newTransaction->check_out = now();
        $newTransaction->total_transaction = $finalTotal;
        $newTransaction->point = strval($pointsEarned);
        $newTransaction->duration = '0';
        $newTransaction->save();

        // Attach products to the transaction
        foreach ($transaction as $productId => $details) {
            $product = Product::findOrFail($productId);

            $subtotal = $details['price'] * $details['quantity'];
            $subtotalWithTax = $subtotal * 1.11;

            $newTransaction->product()->attach($product->id, [
                'quantity' => strval($details['quantity']),
                'subtotal' => strval(round($subtotalWithTax, 2))
            ]);
        }

        // Update or create membership
        $membership = Membership::firstOrCreate(
            ['user_id' => Auth::id()],
            ['point' => 0]
        );
        $membership->point += $pointsEarned - $redeemedPoints;
        $membership->save();

        session()->forget(['transaction', 'redeemed_points', 'point_discount']);

        return redirect()->route('transaction.index')->with('success', 'Transaction completed! You earned ' . $pointsEarned . ' points and used a discount of Rp. ' . number_format($pointDiscount, 0, ',', '.'));
    }

    private function calculateTotal($transaction)
    {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $transaction));


        session()->forget('transaction');

        return redirect()->route('transaction.index')->with('success', 'Transaction completed!');
    }

    // public function remove($productId)
    // {
    //     $transaction = session()->get('transaction', []);
    //     if (isset($transaction[$productId])) {
    //         unset($transaction[$productId]);
    //         session()->put('transaction', $transaction);
    //     }
    //     return redirect()->route('transaction.index')->with('success', 'Product removed from transaction!');

    // }

    public function indexAdmin(Request $request){
        $role = Auth::user()->role;
        if($role == 'owner'){
            $userId = Auth::id();
            $ownerId = Auth::id();
            $transactions = Transaction::select('transactions.*')
            ->join('product_transaction', 'transactions.id', '=', 'product_transaction.transaction_id')
            ->join('products', 'product_transaction.product_id', '=', 'products.id')
            ->join('hotels', 'products.hotel_id', '=', 'hotels.id')
            ->where('hotels.user_id', $userId)
            ->get();            
            return view('admin.transaction.index', compact('transactions'));

        }

        else if($role == 'staff'){ 
            $transactions = Transaction::all();
            return view('admin.transaction.index', compact('transactions'));
        }
    }

    public function showAdmin(Transaction $transactions){
        $role = Auth::user()->role;
        return view('admin.transaction.show', compact('transactions'));
        
    }

    public function destroyAdmin(Request $request){
        $user = Auth::user();
        $this->authorize('delete-transaction', $user);
        try {
            $transactionId = $request->id;
            $transaction = Transaction::find($transactionId);
            $transaction->delete();

            return redirect()->route('admin.transaction.index')->with('status', 'Delete Transaction Successful');
        } catch (\Throwable $th) {

            return redirect()->route('admin.transaction.index')->with('status', $th);
        }
        
    }

}