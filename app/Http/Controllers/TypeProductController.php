<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeProducts = TypeProduct::all();
        return view('admin.type_product.index', compact('typeProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type_product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = new TypeProduct();
        $type->name = $request->input('name');
        $type->save();
        return redirect()->route('admin.typeproduct.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeProduct $typeProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeProduct $typeproduct)
    {
        return view('admin.type_product.edit', compact('typeproduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeProduct $typeproduct)
    {
        $typeproduct->name = $request->input('name');
        $typeproduct->save();
        return redirect()->route('admin.typeproduct.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeProduct $typeProduct)
    {
        //
    }
}
