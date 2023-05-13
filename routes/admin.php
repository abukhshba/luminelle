<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AdminsController;
use App\Http\Controllers\Admin\Auth\UsersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserController;
use \Illuminate\Support\Facades\Route;

Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'LoginController@postLogin')->name('login.post');
Route::post('logout', 'LoginController@logout')->name('logout');

// Route::get('/', function () {
//     return "hhhhhhhhh";
// })->name('dashboard.index');

Route::get('/', 'DashboardController')->name('home');

Route::prefix('admins')->group(function () {
    Route::get('', [AdminsController::class, 'index'])->name('admins.index');
    Route::get('/create', [AdminsController::class, 'create'])->name('admins.create');
    Route::post('', [AdminsController::class, 'store'])->name('admins.store');
    Route::get('/{admin}', [AdminsController::class, 'show'])->name('admins.show');
    Route::get('/{admin}/edit', [AdminsController::class, 'edit'])->name('admins.edit');
    Route::put('/{admin}', [AdminsController::class, 'update'])->name('admins.update');
    Route::delete('/{admin}', [AdminsController::class, 'destroy'])->name('admins.destroy');
});



    Route::prefix('users')->group(function () {
    Route::get('', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('', [UsersController::class, 'store'])->name('users.store');
    Route::get('/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('users.destroy');


});

Route::prefix('products')->group(function () {
  
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});


Route::prefix('categories')->group(function () {
    
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
