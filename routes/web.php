<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===============
// PUBLIC ROUTES 
// ===============

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('user.booking.index');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/service', [App\Http\Controllers\ServiceController::class, 'index'])->name('service');


// ==============
// USER ROUTES 
// ==============
Route::middleware(['auth'])->group(function () {

    Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('user.booking.index');
    Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('user.booking.store');

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

    Route::get('/riwayat-pesanan', [App\Http\Controllers\OrderController::class, 'index'])->name('riwayat.pesanan');
    Route::get('/riwayat-booking', [App\Http\Controllers\BookingController::class, 'history'])->name('riwayat.booking');

    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/{id}', [App\Http\Controllers\CartController::class, 'store'])->name('checkout.store');
    Route::delete('/checkout/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('checkout.delete');

    Route::post('/checkout/buy/{id}', [App\Http\Controllers\CheckoutController::class, 'buy'])->name('checkout.buy');
    Route::post('/checkout/direct/{id}', [App\Http\Controllers\CheckoutController::class, 'direct'])->name('checkout.direct');

    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/checkout/process/{id}', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/payment/{id}', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment');

    Route::get('/payment/success/{id}', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/pending/{id}', [App\Http\Controllers\PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('/payment/failed/{id}', [App\Http\Controllers\PaymentController::class, 'failed'])->name('payment.failed');

    Route::get('/invoice/{id}', [App\Http\Controllers\PaymentController::class, 'invoice'])->name('invoice');
});

Route::post('/midtrans-callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('midtrans.callback');


// ==============
// ADMIN ROUTES
// ==============
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/', [App\Http\Controllers\Backend\IndexController::class, 'index'])->name('admin.dashboard');
    Route::resource('product', App\Http\Controllers\Backend\ProductController::class);
    Route::resource('booking', App\Http\Controllers\Backend\BookingController::class)
        ->names([
            'index' => 'admin.booking.index',
            'store' => 'admin.booking.store',
            'destroy' => 'admin.booking.destroy',
            'create' => 'admin.booking.create',
            'edit' => 'admin.booking.edit',
            'update' => 'admin.booking.update',
            'show' => 'admin.booking.show',
        ]);

    Route::get('/orders', [App\Http\Controllers\Backend\OrderanController::class, 'index'])->name('admin.orders.index');
    Route::delete('/orders/{id}', [App\Http\Controllers\Backend\OrderanController::class, 'destroy'])->name('admin.orders.destroy');

    Route::resource('users', \App\Http\Controllers\Backend\UserController::class)
        ->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
            'show' => 'admin.users.show',
        ]);
});
// =======
// AUTH
// =======
Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');