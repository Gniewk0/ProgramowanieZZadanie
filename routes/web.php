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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', [App\Http\Controllers\ProductListController::class, 'index'])->name('getlist');
Route::get('/archivelist', [App\Http\Controllers\ProductListController::class, 'archiveindex'])->name('archivelist');
Route::post('/archivelist', [App\Http\Controllers\ProductListController::class, 'archiveupdate'])->name('archivelist');
Route::post('/list', [App\Http\Controllers\ProductListController::class, 'store'])->name('postlist');
Route::put('/list', [App\Http\Controllers\ProductListController::class, 'update'])->name('updatelist');
Route::put('/product', [App\Http\Controllers\ListItemController::class, 'update'])->name('product');
Route::delete('/list', [App\Http\Controllers\ProductListController::class, 'destroy'])->name('updatelist');
Route::get('/search', [App\Http\Controllers\ProductListController::class, 'search'])->name('search');
