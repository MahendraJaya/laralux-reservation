<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $products = Product::paginate(6);
        return view('product.index', compact('products'));
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
    public function show(Product $product)
    {
        //
    }

    public function showHotelProduct(Hotel $hotel)
    {
        $products = Product::where('hotel_id', $hotel->id)->get();
        return view('user.product.index', compact('products', 'hotel'));
    }

    public function showUserProductDetail($hotelId, $productId)
    {
        $product = Product::where("id", $productId)->with(["typeProduct"])->first();

        return view('user.product.product-detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
