<?php

use App\Http\Controllers\ActionsController;
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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/catalog', [MainController::class, 'catalog'])->name('catalog');

Route::get('/product/{product}', [MainController::class, 'product'])->name('product');

Route::get('/cart', [MainController::class, 'cart'])->name('cart');
Route::get('/cart/add/{id}', [MainController::class, 'addToCart'])->name('addToCart');
Route::get('/cart/remove/{id}', [MainController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/cart/delete/{id}', [MainController::class, 'deleteFromCart'])->name('deleteFromCart');
Route::post('/cart/next', [MainController::class, 'cartNext'])->name('cartNext');


Route::get('/auth', [ActionsController::class, 'auth'])->name('auth');
Route::post('/auth/next', [ActionsController::class, 'authPost'])->name('auth.post');

Route::get('/register', [ActionsController::class, 'register'])->name('register');
Route::post('/register/next', [ActionsController::class, 'registerPost'])->name('register.post');

Route::get('/logout', [ActionsController::class, 'logout'])->name('logout');