<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('user.registration');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('user.register');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('user.login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('user.authenticate');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('user.logout');

Route::get('/orders/create', [\App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
Route::post('/orders/create', [\App\Http\Controllers\OrdersController::class, 'store'])->name('orders.create');
Route::get('/orders/{order}', [\App\Http\Controllers\OrdersController::class, 'show'])->name('orders.show');
Route::post('/orders/change-status/{order}', [\App\Http\Controllers\OrdersController::class, 'changeStatus'])->name('orders.change-status');
