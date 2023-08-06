<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout', [CartController::class, 'showCheckOut'])->name('cart.index');
});
