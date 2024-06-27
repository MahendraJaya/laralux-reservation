<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Auth;

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
        $hotel = new Hotel();
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->telephone = $request->input('telephone');
        $hotel->email = $request->input("email");
        $hotel->city = $request->input("city");
        $hotel->type_hotel_id = $request->input("type_hotel_id");
        $hotel->user_id = Auth::user()->id;
        $hotel->save();

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
    public function edit(Hotel $hotels)
    {
        //ambil data hotel dan tipe produk
        $hotel = $hotels;
        $typeProducts = TypeProduct::all();
        
        //return view di sini
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

    public function indexAdmin()
    {
        if (Auth::user()->role == "owner") {
            $hotels = Hotel::where("user_id", "=", Auth::user()->id)->with(["user", "typeHotel"])->get();
        } else if(Auth::user()->role == "staff"){
            $hotels = Hotel::with(["user", "typeHotel"])->get();
        }

        return view("admin.hotel.index", compact("hotels"));
    }
}
