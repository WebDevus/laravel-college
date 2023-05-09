<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/catalog', 'catalog')->name('catalog');
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/product/{product}', 'product')->name('product');

    Route::get('/cart', 'cart')->name('cart');
    Route::get('/cart/add/{id}', 'addToCart')->name('addToCart');
    Route::get('/cart/remove/{id}', 'removeFromCart')->name('removeFromCart');
    Route::get('/cart/delete/{id}', 'deleteFromCart')->name('deleteFromCart');
    Route::post('/cart/next', 'cartNext')->name('cartNext');    
    Route::get('/cart/order/delete/{id}', 'orderDelete')->name('deleteOrder');
});

Route::controller(AdminController::class)->prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', 'index')->name('admin.index');
    Route::get('/order/accept/{id}', 'acceptOrder')->name('admin.acceptOrder');
    Route::get('/order/cancel', 'cancelOrder')->name('admin.cancelOrder');

    Route::get('/categories', 'categories')->name('admin.categories');
    Route::post('/categories/create', 'categoriesCreate')->name('admin.categories.create');
    Route::get('/categories/delete/{id}', 'categoriesDelete')->name('admin.categories.delete');

    Route::get('/products', 'products')->name('admin.products');
    Route::post('/product/new', 'productNew')->name('productNew');
    Route::get('/product/delete/{product}', 'productDelete')->name('admin.products.delete');
    Route::get('/product/{product}', 'product')->name('admin.products.show');
    Route::post('/product/{product}/edit', 'productEdit')->name('admin.products.edit');
});

Route::controller(ActionsController::class)->group(function () {
    Route::get('/auth', 'auth')->name('auth');
    Route::post('/auth/next', 'authPost')->name('auth.post');
    
    Route::get('/register', 'register')->name('register');
    Route::post('/register/next', 'registerPost')->name('register.post');
    
    Route::get('/logout', 'logout')->name('logout');
});

