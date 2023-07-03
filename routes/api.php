<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/{id}', function($id) {
    return Product::find($id);
});
Route::get('product/search/{id}', function($id) {
    return DB::table('products')
        ->where('code_bar', $id)
        ->first();
});

Route::get('product/order/{id}', function($id){
    return DB::table('products')->where('id', $id)->get();
});

Route::get('vehiculo/{id}', function($id){
    return DB::table('vehiculos')->where('placa', $id)->first();
});

Route::get('sale/total/{id}/employee/{fecha_id}/{sale_id}', function($id, $fecha_id, $sale_id){
    return Sale::where('employee_id', $id)
        ->where(DB::raw("DATE_FORMAT(date_payment, '%Y')"), $sale_id)
        ->where(DB::raw("DATE_FORMAT(date_payment, '%m')"), $fecha_id)
        ->sum('total_payment');
});

Route::get('sale/numero/{id}/employee/{fecha_id}/{sale_id}', function($id, $fecha_id, $sale_id){
    return Sale::where('employee_id', $id)
        ->where(DB::raw("DATE_FORMAT(date_payment, '%Y')"), $sale_id)
        ->where(DB::raw("DATE_FORMAT(date_payment, '%m')"), $fecha_id)
        ->count();
});

Route::get('/consulta-dni/{cust_dni}', [App\Http\Controllers\ConsultaController::class, 'consultaDNI']);
Route::get('/sales/meses/{sale_id}', [App\Http\Controllers\ReportController::class, 'ventasxmes']);
Route::get('/sales/diarias/{sale_id}/{prod_id}', [App\Http\Controllers\ReportController::class, 'ventasxdia']);
Route::get('/sales/mensuales/{pago_id}', [App\Http\Controllers\ReportController::class, 'salesxpersonal']);
