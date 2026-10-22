<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RepairTicketController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Shop catalog
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{slug}', [ShopController::class, 'show'])->name('products.show');

// Shopping Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/item/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirm-payment');

// Repairs Service
Route::get('/repairs', [RepairTicketController::class, 'index'])->name('repairs.index');
Route::get('/repairs/create', [RepairTicketController::class, 'create'])->name('repairs.create');
Route::post('/repairs', [RepairTicketController::class, 'store'])->name('repairs.store');
Route::post('/repairs/track', [RepairTicketController::class, 'track'])->name('repairs.track');
Route::get('/repairs/{ticketNumber}', [RepairTicketController::class, 'show'])->name('repairs.show');
Route::post('/repairs/{ticket}/advance-status', [RepairTicketController::class, 'advanceStatus'])->name('repairs.advance-status');

// Demo Fallbacks (No Auth)
Route::get('/dashboard', fn () => redirect()->route('shop.index'))->name('dashboard');
Route::get('/login', fn () => redirect()->route('shop.index'))->name('login');
Route::get('/register', fn () => redirect()->route('shop.index'))->name('register');

require __DIR__.'/settings.php';
