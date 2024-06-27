<?php

use App\Http\Controllers\HotelController;
use App\Models\Hotel;
use Illuminate\Support\Facades\Route;

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


/*
 * Route group for admin section that requires authentication
 * Only routes accessible to owners and staff are defined here
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    // Check if the user is a buyer, if so, return a message
    // $user = Auth::user();
    // if($user && $user->role == "pembeli"){
    //     return "Ini masuk owner atau staff";
    // }

    Route::get("hotel", [HotelController::class, "index"])->name("hotel.index");

    Route::get("/", [HotelController::class, "indexAdmin"])->name("hotel.indexAdmin");
    // Define routes accessible to owners and staff here
});
