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

Route::get('/register', [ActionsController::class, 'register'])->name('register');
Route::post('/register/next', [ActionsController::class, 'registerPost'])->name('register.post');

Route::get('/logout', [ActionsController::class, 'logout'])->name('logout');