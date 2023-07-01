<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sale;
use DateTime;

class ReportController extends Controller
{
    public function salePDF($id)
    {
        $usuario = Auth::user();
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
        //return view('sales.pdf', compact('usuario', 'date', 'num_venta', 'sale', 'mp', 'sale_details'));
        $pdf = Pdf::loadView('sales.pdf', compact('usuario', 'date', 'num_venta', 'sale', 'mp', 'sale_details'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function revisionPDF($id)
    {
        $usuario = Auth::user();
        $revision = DB::table('revisiones as r')
            ->join('vehiculos as v', 'r.placa', 'v.placa')
            ->where('r.id', $id)
            ->first();
        $pdf = Pdf::loadView('revisiones.pdf', compact('revision', 'usuario'));
        return $pdf->stream();
    }

    public function venta()
    {
        $usuario = Auth::user();

        $sql_1 = "SELECT DISTINCT DATE_FORMAT(date_payment, '%Y') AS sale_paymentDate FROM sales order by sale_paymentDate ASC";
        $año_ventas = DB::select($sql_1);

        $ventasPorDia = DB::table('sales as s')
            ->join('sale_details as sd', 's.id', 'sd.sale_id')
            ->select(DB::raw("DATE_FORMAT(s.date_payment, '%d %b, %Y') as fecha"), DB::raw('SUM(sd.quantity*sd.unit_price) as monto'))
            ->groupBy(DB::raw("DATE_FORMAT(s.date_payment, '%d %b, %Y')"))
            ->get();

        $ventasPorMes = DB::table('sales as s')
            ->join('sale_details as sd', 's.id', 'sd.sale_id')
            ->select(DB::raw('YEAR(s.date_payment) as year'), DB::raw('MONTH(s.date_payment) as month'), DB::raw('SUM(sd.quantity*sd.unit_price) as monto'))
            ->groupBy(DB::raw('YEAR(s.date_payment)'), DB::raw('MONTH(s.date_payment)'))
            ->get();

        return view('reports.sale', compact('usuario', 'año_ventas', 'ventasPorDia', 'ventasPorMes'));
    }

    public function ventasxmes($sale_id)
    {
        $ventas_meses = sale::where(DB::raw("DATE_FORMAT(sales.date_payment, '%Y')"), '=', $sale_id)
                            ->select(DB::raw("DATE_FORMAT(date_payment, '%m') AS sale_paymentDate, DATE_FORMAT(date_payment, '%M') AS Mes"))
                            ->distinct()
                            ->get();
        return $ventas_meses;
    }

    public function ventasxdia($sale_id, $prod_id){
        $ventas_diarias = DB::table('sale_details as sd')
                            ->join('products as p', 'sd.product_id', 'p.id')
                            ->where(DB::raw("DATE_FORMAT(sd.created_at, '%Y')"), '=', $sale_id)
                            ->where(DB::raw("DATE_FORMAT(sd.created_at, '%m')"), '=', $prod_id)
                            ->select(DB::raw('SUM(sd.quantity*sd.unit_price) as sdet_totalprice') , 'p.purchase_price as prod_purchasePrice')
                            ->groupBy('p.purchase_price')
                            ->get();
        return $ventas_diarias;
    }

    public function salesxpersonal($pago_id){
        $pagos_diarios = DB::table('sales as s')
                        ->join('employees as e', 's.employee_id', 'e.id')
                        ->where(DB::raw("DATE_FORMAT(s.date_payment, '%m')"), $pago_id)
                        ->select('s.employee_id', DB::raw("CONCAT(e.name, ' ',e.lastname) AS empl_fullName"))
                        ->distinct()
                        ->get();
        return response()->json($pagos_diarios);
    }
}
