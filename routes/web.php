<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});


Route::resource('products', ProductsController::class);

Route::post('cart/remove/{productId}', [CartController::class, 'removeProductFromCart'])
    ->name('cart.remove');

Route::delete('cart/clear', [CartController::class, 'removeAllProductsFromCart'])
    ->name('cart.clear');


Route::post('cart', [CartController::class, 'store'])
    ->name('cart.store');

Route::get('cart', [CartController::class, 'viewcart']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin_dashboard', [PagesController::class, 'admin_dashboard'])->name('admin_dashboard');
});
