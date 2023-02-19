<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/products');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function () {
    return redirect('/products');
});

/**
 * Products Routes
 */
Route::get('/products/newProducts', [ProductController::class, 'newProducts'])->name('products.newProducts');
Route::resource('/products', ProductController::class);
Route::get('/products/{id}/approve', [ProductController::class, 'approve'])->name('products.approve');

/**
 * Cart Routes
 */
Route::group(['prefix' => 'cart'], function() {
    Route::any('/', [CartController::class, 'cart'])->name('cart');
    Route::get('/add/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::patch('/update', [CartController::class, 'updateCart'])->name('updateCart');
    Route::delete('/remove', [CartController::class, 'removeFromCart'])->name('removeFromCart');
});

Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('placeOrder');

/**
 * Cart Routes
 */
Route::group(['prefix' => 'orders'], function() {
    Route::get('/my', [OrderController::class, 'myOrders'])->name('myOrders');
    Route::get('/', [OrderController::class, 'index'])->name('Orders.index');
    Route::get('/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/{id}/completed', [OrderController::class, 'completed'])->name('order.completed');
});

/**
 * Products Roles
 */
Route::resource('roles', RolesController::class);

/**
 * Products Users
 */
Route::resource('users', UserController::class);