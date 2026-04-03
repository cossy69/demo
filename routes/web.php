<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/login', function() {
    return view('auth.login');
})->name('login');  

Route::get('/register', function() {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login')->with('success', 'Đăng xuất thành công!');
})->name('logout');

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('client')->group(function() {
    Route::get('/product/{id}', [HomeController::class, 'showProduct'])->name('product.detail');

    Route::get('/list', function() {
        return view('client.list');
    });
});
Route::middleware('admin')->group(function() {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});