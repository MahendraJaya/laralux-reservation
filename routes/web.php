<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Models\Hotel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;

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

// Route::get('/', function () {
//     if(Auth::user()->role == "owner"){
//         return "Ini masuk owner";
//     }else if(Auth::user()->role == "staff"){
//         return "ini masuk staff";
//     }else if(Auth::user()->role == "pembeli"){
//         return "ini masuk pembeli";
//     }
//     // return view('welcome');
// })->middleware('auth');

//halaman index
Route::get('/', [HotelController::class, "index"]);

Route::resource('hotels', HotelController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');

Route::get('/hotel/{hotel}/products', [ProductController::class, 'index'])->name('hotel.products');
Route::get('/hotel/{hotelId}/products', [HotelController::class, 'showHotelProducts'])->name('product.index');

Route::post('/transaction/add/{product}', [TransactionController::class, 'add'])->name('transaction.add');
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction/update', [TransactionController::class, 'update'])->name('transaction.update');
Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
Route::post('/transaction/remove/{product}', [TransactionController::class, 'remove'])->name('transaction.remove');


Route::get('/products', [ProductController::class, 'index'])->name('product.index');


Route::group(['middleware' => 'auth'], function () {
   //ini tempat route yang tidak bisa di akses oleh user yang bukan owner atau staff
});
