<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //munculkan data dengan pagination
        //lalu di view untuk mengeluarkan next dan prev pakai links() -> cari di laravel documentation
        $hotels = Hotel::paginate(4);
        return view('hotel.index', compact('hotels'));

        // nanti view nya di sini
        // return view("pagination", compact("hotels"));
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
    public function show(Hotel $hotels)
    {
        // ambil data hotel spesific menggunakan with untuk memanggil relasi supaya lebih optimal querynya
        $hotel = Hotel::where("id", $hotels->id)->with(["user", "typeHotel"])->first();

        // disini taruh return view nya bisa pake -> dd untuk lihat nama variable
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
