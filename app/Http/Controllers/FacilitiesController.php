<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Hotel $hotel)
    {
        // Retrieve all facilities that have a product associated with the specified hotel.
        // The `whereHas` method is used to filter the facilities based on the existence of a product
        // that satisfies the given callback function.
        // The callback function specifies the condition that the product must meet:
        // it must have a `hotel_id` that matches the specified hotel's id.
        // The `use ($hotel)` part is used to pass the `$hotel` variable into the callback function.
        // The `get` method is used to retrieve all the filtered facilities.
        $facilities = Facilities::whereHas('product', function ($query) use ($hotel) {
            $query->where('hotel_id', $hotel->id);
        })->get();
        // dd($facilities);
        return view('admin.facility.index', compact('facilities', 'hotel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Hotel $hotel)
    {
        $products = Product::where('hotel_id', $hotel->id)->get();
        return view('admin.facility.create', compact('products', 'hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Hotel $hotel)
    {
        $hotels = $hotel;
        $facility = new Facilities();
        $facility->name = $request->input('name');
        $facility->product_id = $request->input('product');
        $facility->save();
        return redirect()->route('admin.facility.index', $hotels);
    }

    /**
     * Display the specified resource.
     */
    public function show(Facilities $facilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facilities $facilities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facilities $facilities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel, $id)
    {
        $facility = Facilities::find($id);
        // dd($facility);   
        if ($facility) {
            $facility->delete();
        }

        return redirect()->route('admin.facility.index', $hotel)
            ->with('success', 'Facility deleted successfully');
    }
}
