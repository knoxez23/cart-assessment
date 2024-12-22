<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);



Route::middleware(['web'])->group(function () {
    Route::get('home', [ProductController::class, 'index'])->name('products.index');

    Route::post('cart/add', [CartController::class, 'addToCart']);
    Route::get('cart/all', [CartController::class, 'displayCart'])->name('cart.index');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/complete-order', [OrderController::class, 'completeOrder'])->name('cart.completeOrder');
    Route::get('orders/all', [OrderController::class, 'viewOrders'])->name('orders.all');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.details');
});

