<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
Route::get('/cart', [CartController::class, 'viewCart']);
Route::post('/orders', [OrderController::class, 'placeOrder']);
Route::get('/orders', [OrderController::class, 'viewOrders']);
Route::get('/products', [ProductController::class, 'index']);