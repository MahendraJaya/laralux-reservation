<?php

namespace App\Http\Controllers;

use App\Models\TypeHotel;
use Illuminate\Http\Request;

class TypeHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeHotels = TypeHotel::all();
        return view('admin.type_hotel.index', compact('typeHotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type_hotel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = new TypeHotel();
        $type->name = $request->input('name');
        $type->save();
        return redirect()->route('admin.typehotel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeHotel $typeHotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeHotel $typehotel)
    {
        // dd($typehotel);
        return view('admin.type_hotel.edit', compact('typehotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeHotel $typehotel)
    {
        $typehotel->name = $request->input('name');
        $typehotel->save();
        return redirect()->route('admin.typehotel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeHotel $typehotel)
    {
        //
    }
}
