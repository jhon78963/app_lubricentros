<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome.index');

// Categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('categories/actualizar', [CategoryController::class, 'actualizar'])->name('categories.actualizar');
Route::get('categories/eliminar/{id}', [CategoryController::class, 'eliminar'])->name('categories.eliminar');

// products
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('products/actualizar', [ProductController::class, 'actualizar'])->name('products.actualizar');
Route::get('products/eliminar/{id}', [App\Http\Controllers\ProductController::class, 'eliminar'])->name('products.eliminar');


// sales
Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
Route::get('sales/show/{id}', [SaleController::class, 'show'])->name('sales.show');

// orders
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
