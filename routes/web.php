<?php

use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeHotelController;
use App\Http\Controllers\TypeProductController;
use App\Models\Hotel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MembershipController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(Auth::user()->role == "owner"){
        return "Ini masuk owner";
    }else if(Auth::user()->role == "staff"){
        return "ini masuk staff";
    }else if(Auth::user()->role == "pembeli"){
        return "ini masuk pembeli";
    }
    // return view('welcome');
})->middleware('auth');

//halaman index
// Route::get('/', [HotelController::class, "index"]);

Route::resource('hotels', HotelController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');
Route::get('product', [ProductController::class, 'index'])->name('product.indexUser');

Route::get('user/hotel', [HotelController::class, 'indexUser'])->name('hotel.indexUser');
Route::get('/user/hotel/{hotel}', [HotelController::class, 'showUserHotelDetail'])->name('hotel.showUserHotel');


Route::post('/transaction/add/{product}', [TransactionController::class, 'add'])->name('transaction.add');
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction/update', [TransactionController::class, 'update'])->name('transaction.update');
Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
Route::post('/transaction/remove/{product}', [TransactionController::class, 'remove'])->name('transaction.remove');
Route::post('/transactions/apply-points', [TransactionController::class, 'applyPoints'])->name('transaction.applyPoints');
//Route::get('/membership/points', [TransactionController::class, 'showPoints'])->name('membership.index');

Route::post('/transaction/redeem-points', [TransactionController::class, 'redeemPoints'])->name('transaction.redeem-points');
Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');

Route::get('user/hotel/{hotel}/products', [ProductController::class, 'showHotelProduct'])->name('hotel.products');
// Route::get('user/hotel/{hotelId}/products', [HotelController::class, 'showHotelProducts'])->name('product.index');
Route::get('user/hotel/{hotelId}/products/{productId}', [ProductController::class, 'showUserProductDetail'])->name('product.detail');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');



/*
 * Route group for admin section that requires authentication
 * Only routes accessible to owners and staff are defined here
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'check.role:pembeli']], function () {
    // Define routes accessible to owners and staff here
    // Check if the user is a buyer, if so, return a message
    // $user = Auth::user();
    // if($user && $user->role == "pembeli"){
    //     return "Ini masuk owner atau staff";
    // }
    Route::resource('hotel/{hotel}/facility', FacilitiesController::class);
    Route::resource('typeproduct', TypeProductController::class);
    Route::resource('typehotel', TypeHotelController::class);

    // route untuk hotel
    // Route::get("hotel", [HotelController::class, "index"])->name("hotel.index");
    Route::get("hotel/create", [HotelController::class, "createAdmin"])->name("hotel.createAdmin");
    Route::get("hotel/{hotels}", [HotelController::class, "showAdmin"])->name("hotel.showAdmin");
    Route::get("/", [HotelController::class, "indexAdmin"])->name("hotel.indexAdmin");
    Route::post("/", [HotelController::class, "storeAdmin"])->name("hotel.storeAdmin");
    Route::get("hotel/{hotel}/edit", [HotelController::class, "editAdmin"])->name("hotel.editAdmin");
    Route::match(['put', 'patch'], "/", [HotelController::class, "updateAdmin"])->name("hotel.updateAdmin");
    // Route::get("hotel/{hotels}", [HotelController::class, "destroyAdmin"])->name("hotel.destroyAdmin");

    //route untuk product
    // Route::get("hotel/{hotel}/product", [ProductController::class, "indexAdmin"])->name("admin.product.indexAdmin");
    Route::get("admin/product", [ProductController::class, "indexAdmin"])->name("product.indexAdmin");
    Route::get("hotel/{hotel}/product/create", [ProductController::class, "createAdmin"])->name("product.createAdmin");
    Route::post("hotel/{hotel}/product", [ProductController::class, "storeAdmin"])->name("product.storeAdmin");
    Route::get("hotel/{hotel}/product/edit/{product}", [ProductController::class, "editAdmin"])->name("product.editAdmin");
    Route::get("hotel/{hotel}/product/{product}", [ProductController::class, "showAdmin"])->name("product.showAdmin");

    Route::match(['put', 'patch'], '/admin/hotels/{hotel}/product/{product}', [ProductController::class, 'updateAdmin'])->name('product.updateAdmin');

    //route untuk fasilitas
    // Route::get('hotel/{hotel}/facility', [FacilitiesController::class, "index"])->name("facility.indexAdmin");
    // Route::get('hotel/{hotel}/facility/create', [FacilitiesController::class, "create"])->name("facility.createAdmin");
    // Route::post('hotel/{hotel}/facility', [FacilitiesController::class, "store"])->name("facility.storeAdmin");
    // Route::delete("hotel/{hotel}/facility/{facility}", [FacilitiesController::class, "destroy"])->name("facility.destroyAdmin");
    // route untuk membership
    Route::resource('membership', MembershipController::class);

    
});
