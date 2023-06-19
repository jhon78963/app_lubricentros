<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\LoginController;

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
    return view('auth.login');
});

Route::middleware(['auth'])->get('/bienvenido', function () {
    $usuario = Auth::user();
    return view('welcome', compact('usuario'));
})->name('welcome.index');

// Login
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login/validar', [LoginController::class, 'validarCredenciales'])->name('login.validar');
Route::get('login/cerrarSesion', [LoginController::class, 'cerrarSesion'])->name('login.cerrarSesion');

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

// revisiones tecnicas
Route::get('revisiones', [RevisionController::class, 'index'])->name('revisiones.index');
Route::post('revisiones', [RevisionController::class, 'store'])->name('revisiones.store');
Route::get('revisiones/show/{id}', [RevisionController::class, 'show'])->name('revisiones.show');
