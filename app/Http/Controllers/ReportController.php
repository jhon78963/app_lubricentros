<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EnLetras;
use Carbon\Carbon;
use DateTime;

class ReportController extends Controller
{
    public function salePDF($id)
    {
        $nro_venta = str_pad($id, 8, "0", STR_PAD_LEFT);

        $venta = Sale::find($id);

        $fecha = new DateTime($venta->date_payment);
        $fecha = $fecha->format('d/m/Y h:i A');

        $codebar = $id;

        $cliente = Customer::find($venta->customer_id);
        if($cliente != null){
            $clie_nombre = $cliente->name." ".$cliente->lastname;
            $clie_dni = $cliente->dni;
        }else{
            $clie_nombre = "cliente varios";
            $clie_dni = "";
        }

        $productos = DB::table('sale_details as sd')
                        ->join('products as p', 'sd.product_id', 'p.id')
                        ->where('sd.sale_id', $id)
                        ->select('p.name as prod_name', 'sd.quantity as sdet_quantity', 'sd.unit_price as sdet_unitprice', DB::raw("sd.quantity * sd.unit_price as sdet_totalprice"))
                        ->get();


        $igv = 0.18*$venta->total_payment;
        $op_grabada = $venta->total_payment - $igv;
        $total = $venta->total_payment;

        $metodo = $venta->method_payment;

        $empleado = Employee::find($venta->employee_id);
        $empl_nombre = $empleado->name;

        $customPaper = array(0,0,226.771653543,566.929133858);

        $enLetras = new EnLetras();
        //return view('sales.pdf', compact('usuario', 'date', 'num_venta', 'sale', 'mp', 'sale_details'));
        //$pdf = Pdf::loadView('sales.pdf', compact('nro_venta', 'venta', 'fecha', 'codebar', 'clie_nombre', 'clie_dni', 'productos', 'igv', 'total', 'op_grabada', 'metodo', 'empl_nombre', 'enLetras'));
        return view('sales.pdf', compact('nro_venta', 'venta', 'fecha', 'codebar', 'clie_nombre', 'clie_dni', 'productos', 'igv', 'total', 'op_grabada', 'metodo', 'empl_nombre', 'enLetras'));
        //$pdf->setPaper('A4', 'landscape');
        //return $pdf->stream();
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

        $mes = Carbon::now();
        $mes = $mes->format('m');
        $año = Carbon::now();
        $año = $año->format('Y');

        $ventasPorDia = DB::table('sales as s')
            ->join('sale_details as sd', 's.id', 'sd.sale_id')
            ->select(DB::raw("DATE_FORMAT(s.date_payment, '%d') as fecha"), DB::raw('SUM(sd.quantity*sd.unit_price) as monto'))
            ->groupBy(DB::raw("DATE_FORMAT(s.date_payment, '%d')"))
            ->where(DB::raw("DATE_FORMAT(s.date_payment, '%Y')"), $año)
            ->where(DB::raw("DATE_FORMAT(s.date_payment, '%m')"), $mes)
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
