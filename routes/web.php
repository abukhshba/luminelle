<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');;
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');


    Route::get('/categories/{id}/products', [CategoryController::class, 'showProducts'])->name('categories.products');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{product}/reviews', [ProductController::class, 'storeReview'])->name('reviews.store');

    Route::get('/orders/book/{id}', [OrderController::class, 'bookNow'])->name('orders.bookNow');
    Route::get('/orders/contact', [OrderController::class, 'contact'])->name('orders.contact');
    Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create');


    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');
    Route::get('/termsAndConditions', [HomeController::class, 'termsAndConditions'])->name('termsAndConditions');



});
