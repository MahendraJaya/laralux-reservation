<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use App\Models\TypeHotel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Hotel $hotel)
    {
        $products = Product::where('hotel_id', $hotel->id)->get();
        return view('product.index', compact('products', 'hotel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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

    public function indexAdmin(Hotel $hotel){
        $products = Product::where('hotel_id', $hotel->id)->get();
        return view('admin.product.index', compact('products', 'hotel'));
    }

    public function createAdmin(Hotel $hotel){
        $types = TypeHotel::all();
        return view('admin.product.create', compact('hotel', "types"));
    }

    public function storeAdmin(Request $request, Hotel $hotel){
        // dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->capacity = $request->capacity;
        $product->available_room = $request->available_room;
        $product->image = "https://picsum.photos/200/300";
        $product->type_product_id = $request->type_product_id;
        $product->hotel_id = $hotel->id;
        $product->save();
        return redirect()->route('admin.product.indexAdmin', $hotel);
    }
}
