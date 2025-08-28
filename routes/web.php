<?php

use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LogItemController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
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
    return redirect(route('items.index'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/items/get-code-item', [ItemsController::class, 'getCodeItem'])->name('items.get-code-item');
    Route::get('/items/get-item-by-category', [ItemsController::class, 'getItemByCategory'])->name('items.get-item-by-category');
    Route::resource('items', ItemsController::class);
    Route::resource('item-category', ItemCategoryController::class);
    Route::resource('stock-in', StockInController::class);
    Route::resource('stock-out', StockOutController::class);
    Route::resource('log-item', LogItemController::class);
});
