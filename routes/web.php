<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\registerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Homepage'
    ]);
});



Route::get('/dashboard', [productController::class, 'index'])->name('dashboard');
// Route::get('/cart', [productController::class, ]);

Route::get('/create-product', [productController::class, 'createProduct'])->middleware('is_admin');
Route::POST('/store-product', [productController::class, 'store'])->middleware('is_admin');
Route::get('/display-product/{product:id}', [productController::class, 'display'])->middleware('auth');
Route::DELETE('/delete-product/{product:id}', [productController::class, 'delete'])->middleware('is_admin');
Route::get('/edit-product/{product:id}', [productController::class, 'edit'])->middleware('is_admin');
Route::PATCH('/update-product/{product:id}', [productController::class, 'update'])->middleware('is_admin');
Route::POST('/addcart/{id}', [productController::class, 'Addcart'])->name('Add.to.cart')->middleware('auth');
Route::get('/shopping-cart', [productController::class, 'Cart'])->name('shopping.cart')->middleware('auth');
Route::delete('/delete-cart-product', [productController::class, 'deleteProduct'])->name("delete.cart.product")->middleware('auth');
Route::get('/checkout', [productController::class, 'checkout'])->name('check.out')->middleware('auth');

Route::get('/invoice/{orderId}', [productController::class, 'viewInvoice'])->name('view.invoice')->middleware('auth');
Route::get('/invoice/{orderId}/generate', [productController::class, 'downloadInvoice'])->name('download.invoice')->middleware('auth');

Route::get('/categories', [categoryController::class, 'index'])->middleware('is_admin');
Route::get('/create-category', [categoryController::class, 'createCategory'])->middleware('is_admin');
Route::POST('/store-category', [categoryController::class, 'store'])->middleware('is_admin');

//customerController
Route::get('/customer/{customer:id}', [customerController::class, 'display']);


//loginController
Route::get('/login', [loginController::class, 'login'])->name('login')->middleware('guest');
Route::POST('/login', [loginController::class, 'authenticate']);
Route::POST('/logout', [loginController::class, 'logout'])->middleware('auth');

//registerController
Route::get('/register', [registerController::class, 'register'])->middleware('guest');
Route::POST('/register', [registerController::class, 'store']);

Route::get('/receipt/{orderId}', [productController::class, 'receipt'])->name('place.order')->middleware('auth');
Route::get('/clear-cart', [ProductController::class, 'clearCart'])->name('clear')->middleware('auth');



