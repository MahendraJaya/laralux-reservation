<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\TypeHotel;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

// use Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

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

        try {
            //lanjut buat program create
        } catch (\Throwable $th) {
            //
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->authorize('create-hotel', $user);
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

    public function showUserHotelDetail(Hotel $hotel)
    {
        $hotel = Hotel::where("id", $hotel->id)->with(["user", "typeHotel"])->first();

        return view('user.hotel.detail-hotel', compact('hotel'));
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
        
        $user = Auth::user();
        $this->authorize('create-hotel', $user);


        if (Auth::user()->role == "owner") {
            $hotels = Hotel::where("user_id", $user->id)->with(["user", "typeHotel"])->get();
            return view("admin.hotel.index", compact("hotels"));

        } else if (Auth::user()->role == "staff") {
            $hotels = Hotel::with(["user", "typeHotel"])->get();
            return view("admin.hotel.index", compact("hotels"));

        }

    }


    public function indexUser()
    {
        // Munculkan data dengan pagination
        $hotels = Hotel::paginate(6);
        return view('user.hotel.index', compact('hotels'));
    }
    public function showAdmin(Hotel $hotels)
    {
        $hotel = Hotel::where("id", $hotels->id)->with(["user", "typeHotel"])->first();
        return view("admin.hotel.show", compact("hotel"));
    }

    public function createAdmin()
    {
        $types = TypeHotel::all();
        return view("admin.hotel.create", compact("types"));
    }

    public function storeAdmin(Request $request)
    {
        $hotel = new Hotel();
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->telephone = $request->input('telephone');
        $hotel->email = $request->input("email");
        $hotel->image = "Default Image";
        $hotel->city = $request->input("city");
        $hotel->rating = $request->input("rating");
        $hotel->type_hotel_id = $request->input("type_hotel_id");
        $hotel->user_id = Auth::user()->id;
        $hotel->save();

        return redirect()->route("admin.hotel.indexAdmin");
    }

    public function editAdmin(Hotel $hotel)
    {
        $types = TypeHotel::all();
        return view("admin.hotel.edit", compact("hotel", "types"));
    }

    public function updateAdmin(Request $request)
    {
        $updatedHotel = Hotel::find($request->input('hotel_id'));

        // Update basic fields
        $updatedHotel->name = $request->input('name');
        $updatedHotel->address = $request->input('address');
        $updatedHotel->telephone = $request->input('telephone');
        $updatedHotel->city = $request->input('city');
        $updatedHotel->rating = $request->input('rating');
        $updatedHotel->type_hotel_id = $request->input('type_hotel_id');
        $updatedHotel->user_id = Auth::user()->id;

        // Handle image upload
        if ($request->hasFile('file_photo')) {
            $file = $request->file('file_photo');
            $folder = 'hotel/image';

            // Delete existing image if it exists
            if (!empty($updatedHotel->image) && File::exists(public_path($updatedHotel->image))) {
                File::delete(public_path($updatedHotel->image));
            }

            // Move the new file to the target directory
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path($folder), $filename);

            // Update the image path
            $updatedHotel->image = $folder . '/' . $filename;
        }
        // dd($request->all());
        // Save updated hotel details
        $updatedHotel->save();

        return redirect()->route('admin.hotel.indexAdmin');
    }

    public function deleteAdmin(Request $request)
    {
        $user = Auth::user();
        $this->authorize('delete-hotel', $user);
        //lanjut kode
    }
}
