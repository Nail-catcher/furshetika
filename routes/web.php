<?php

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


Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');
Route::get('/product/{product}', [App\Http\Controllers\MainController::class, 'product'])->name('product');
Route::get('/endorder', [App\Http\Controllers\MainController::class, 'endOrder'])->name('endOrder');
Route::post('/order', [App\Http\Controllers\MainController::class, 'order'])->name('order');
Route::get('/cardpay', [App\Http\Controllers\MainController::class, 'cardpay'])->name('cardpay');
Route::get('/info', [App\Http\Controllers\InfoController::class, 'index'])->name('info');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
