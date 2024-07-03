<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use App\Models\TypeHotel;
use App\Models\TypeProduct;
use Faker\Core\File as CoreFile;
use File;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;

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

        try {
            //lanjut kode disini
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        $user = Auth::user();
        $this->authorize('create', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function indexAdmin(Hotel $hotel)
    {
        $products = Product::where('hotel_id', $hotel->id)->get();
        return view('admin.product.index', compact('hotel','products'));
    }

    public function createAdmin(Hotel $hotel)
    {
        $user = Auth::user();
        $this->authorize('create-product', $user);
        $types = TypeProduct::all();
        return view('admin.product.create', compact('hotel', "types"));
    }

    public function storeAdmin(Request $request, Hotel $hotel)
    {
        // dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->capacity = $request->capacity;
        $product->available_room = $request->available_room;
        $file = $request->file("file_photo");
        $folder = 'hotel/' . $hotel->id . "/product";

        // Check if the directory exists, if not create it
        if (!FacadesFile::isDirectory(public_path($folder))) {
            FacadesFile::makeDirectory(public_path($folder), 0755, true, true);
        }

        $filename = time() . "_" . $file->getClientOriginalName();
        $product->image = $folder . "/" . $filename;

        // Move the file to the target directory
        $file->move(public_path($folder), $filename);
        $product->type_product_id = $request->type_product_id;
        $product->hotel_id = $hotel->id;
        $product->save();
        return redirect()->route('admin.product.index', $hotel);
    }

    public function editAdmin(Hotel $hotel, Product $product)
    {
        $types = TypeProduct::all();
        return view('admin.product.edit', compact('product', 'hotel', "types"));
    }

    public function showAdmin(Hotel $hotel,Product $product)
    {
        return view('admin.product.show', compact('product', 'hotel'));
    }

    public function updateAdmin(Request $request, Hotel $hotel, Product $product)
    {
        // Update product fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->capacity = $request->capacity;
        $product->available_room = $request->available_room;
        $product->type_product_id = $request->type_product_id;
        $product->hotel_id = $hotel->id;

        // Check if there is a new file
        if ($request->hasFile("file_photo")) {
            $file = $request->file("file_photo");
            $folder = 'hotel/' . $hotel->id . "/product";
            $filename = time() . "_" . $file->getClientOriginalName();
            $filePath = public_path($folder) . '/' . $filename;

            FacadesFile::delete(public_path($product->image));

            // Ensure the directory exists, create if not
            if (!FacadesFile::isDirectory(public_path($folder))) {
                FacadesFile::makeDirectory(public_path($folder), 0755, true, true);
            }

            // Move the new file to the target directory
            $file->move(public_path($folder), $filename);

            // Update the product image path
            $product->image = $folder . "/" . $filename;
        }

        // Save the updated product
        $product->save();

        // Redirect to the appropriate route
        return redirect()->route('admin.product.index', $hotel);
    }

    public function destroyAdmin(Request $request){
        $user = Auth::user();
        $this->authorize('delete-transaction', $user);
        try {
            $productId = $request->id;
            $transaction = Product::find($productId);
            $transaction->delete();

            return redirect()->route('admin.product.index')->with('status', 'Delete Product Successful');
        } catch (\Throwable $th) {

            return redirect()->route('admin.product.index')->with('status', $th);
        }
    }


}
