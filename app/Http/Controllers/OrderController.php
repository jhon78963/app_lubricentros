<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use DataTables;
use DateTime;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $orders = DB::table('orders as o')
                    ->join('suppliers as s', 'o.supplier_id', 's.id')
                    ->select('o.id', 'o.date_order','o.total_payment','s.business_representative')
                    ->get();

            return DataTables::of($orders)
                ->addColumn('action', function($orders){
                    $acciones = '<a href="javascript:void(0)" onclick="goShow('.$orders->id.')" class="btn btn-warning btn-sm"> Mostrar </a>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $prod_ids = $request->idproducts;
        $prod_codes = $request->codesproducts;
        $prod_names = $request->nameproducts;
        $prod_stocks = $request->productstocks;

        $prod_new_codes = $request->newcodesproducts;
        $prod_new_names = $request->newnameproducts;
        $prod_new_stocks = $request->newproductstocks;

        if (Order::all()->count()) {
            $last_orde_id = Order::all()->last()->id+1;
        } else {
            $last_orde_id = 1;
        }

        $order = new Order();
        $order->id = $last_orde_id;
        $order->date_order = $request->date_order;
        $order->total_payment = 0;
        $order->supplier_id = $request->supplier_id;
        $order->save();

        for($i=0;$i<count($prod_ids);$i++){
            $detalle_od = new OrderDetail();
            $detalle_od->order_id = $last_orde_id;
            $detalle_od->product_id = $prod_codes[$i];
            $detalle_od->product_name = $prod_names[$i];
            $detalle_od->quantity = $prod_stocks[$i];
            $detalle_od->unit_price = 0;
            $detalle_od->save();
        }

        if($prod_new_codes != null){
            for($i=0;$i<count($prod_new_codes);$i++){
                $detalle_od = new OrderDetail();
                $detalle_od->order_id = $last_orde_id;
                $detalle_od->product_id = $prod_new_codes[$i];
                $detalle_od->product_name = $prod_new_names[$i];
                $detalle_od->quantity = $prod_new_stocks[$i];
                $detalle_od->unit_price = 0;
                $detalle_od->save();
            }
        }

        return back()->with('datos', 'Ingreso de mercadería nueva registrada con exito ...!');
    }

    public function show($id)
    {
        $date = new DateTime();
        $date = $date->format("d/m/Y");
        $order_details = DB::table('order_details')->where('order_id', $id)->get();
        $order = Order::findOrFail($id);
        if($order->id < 10){
            $num_compra = "#00000".$order->id;
        }else if($order->id > 9 && $order->id < 100){
            $num_compra = "#0000".$order->id;
        }else if($order->id > 99 && $order->id < 1000){
            $num_compra = "#000".$order->id;
        }else if($order->id > 999 && $order->id < 10000){
            $num_compra = "#00".$order->id;
        }else if($order->id > 9999 && $order->id < 100000){
            $num_compra = "#0".$order->id;
        }else if($order->id > 99999 && $order->id < 1000000){
            $num_compra = "#".$order->id;
        }


        return view('orders.show', compact('date', 'num_compra', 'order', 'order_details'));
    }

    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
