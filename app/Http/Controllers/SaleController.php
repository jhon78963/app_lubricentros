<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;
use DateTime;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', '0') ->orWhere('category_id', '=', 1)->get();
        $employees = Employee::all();
        $sales = Sale::all();
        return view('sales.index', compact('products', 'employees', 'sales'));
    }

    public function store(Request $request)
    {
        if (Sale::all()->count()) {
            $last_sale_id = Sale::all()->last()->id+1;
        } else {
            $last_sale_id = 1;
        }

        $date = new DateTime();
        $date = $date->format("Y-m-d");

        $sale = new Sale();
        $sale->id = $last_sale_id;
        $sale->total_payment = $request->total_save;
        $sale->employee_id = $request->empl_id;
        $sale->method_payment = $request->pmet_id;
        $sale->date_payment = $date;

        if($request->cust_dni != null){

            $customer_exists = DB::table('customers')->where('dni', $request->cust_dni)->count();

            if($customer_exists != 0){
                $customer = DB::table('customers')->where('dni', $request->cust_dni)->first();
                $sale->customer_id = $customer->id;
            }else{
                if (Customer::all()->count()) {
                    $last_cust_id = Customer::all()->last()->id+1;
                } else {
                    $last_cust_id = 1;
                }

                $customer = new Customer();
                $customer->id = $last_cust_id;
                $customer->dni = $request->cust_nrodocumento;
                $customer->lastname = $request->cust_apellidoPaterno.' '.$request->cust_apellidoMaterno;
                $customer->name = $request->cust_name;
                $customer->save();
                $sale->customer_id = $last_cust_id;
            }
        }

        $sale->save();

        $sale_prod_stocks = $request->sale_prod_stocks;
        $sale_prod_ids = $request->sale_prod_ids;
        $sale_quantities = $request->sale_quantities;
        $sale_unitprices = $request->sale_unitprices;
        $sale_total_prices = $request->sale_total_prices;

        for($i=0;$i<count($sale_unitprices);$i++){

            $detalle_sd = new SaleDetail();
            $detalle_sd->sale_id = $last_sale_id;
            $detalle_sd->product_id = $request->sale_prod_ids[$i];
            $detalle_sd->unit_price = $request->sale_unitprices[$i];
            $detalle_sd->quantity = $request->sale_quantities[$i];
            $detalle_sd->save();
            DB::table('products')->where('id', $request->sale_prod_ids[$i])->decrement('stock', $request->sale_quantities[$i]);
        }

        return redirect()->route('sales.index')->with('datos', 'Venta registrada con exito ...!');

    }

    public function show($id)
    {
        $date = new DateTime();
        $date = $date->format("d/m/Y");
        $mp = DB::table('sales as s')->where('s.id', $id)->first();
        $sale_details = DB::table('sale_details as sd')
            ->join('products as p', 'sd.product_id', 'p.id')
            ->where('sd.sale_id', $id)
            ->select('sd.quantity', 'p.name', 'p.id', DB::raw('sd.quantity * sd.unit_price as totalprice'))
            ->get();
        $sale = Sale::findOrFail($id);
        if($sale->sale_id < 10){
            $num_venta = "#00000".$sale->id;
        }else if($sale->id > 9 && $sale->id < 100){
            $num_venta = "#0000".$sale->id;
        }else if($sale->id > 99 && $sale->id < 1000){
            $num_venta = "#000".$sale->sale_id;
        }else if($sale->id > 999 && $sale->id < 10000){
            $num_venta = "#00".$sale->sale_id;
        }else if($sale->id > 9999 && $sale->id < 100000){
            $num_venta = "#0".$sale->sale_id;
        }else if($sale->id > 99999 && $sale->id < 1000000){
            $num_venta = "#".$sale->id;
        }


        return view('sales.show', compact('date', 'num_venta', 'sale', 'mp', 'sale_details'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
