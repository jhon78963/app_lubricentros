<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use DataTables;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $suppliers = DB::table('suppliers')->get();

            return DataTables::of($suppliers)
                ->addColumn('action', function($suppliers){
                    $acciones = '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="editSupplier('.$suppliers->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="deleteSupplier" id="'.$suppliers->id.'" class="deleteSupplier btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = Auth::user();
        return view('suppliers.index', compact("usuario"));
    }

    public function store(Request $request)
    {
        if (Supplier::all()->count()) {
            $last_supplier_id = Supplier::all()->last()->id+1;
        } else {
            $last_supplier_id = 1;
        }

        $supplier = new Supplier();
        $supplier->id = $last_supplier_id;
        $supplier->business_name = $request->business_name;
        $supplier->business_representative = $request->business_representative;
        $supplier->phone = $request->phone;
        $supplier->line_business = $request->line_business;
        $supplier->save();

        return \Response::json([
            "mensaje" => "Proveedor registrado con exito ...!",
            "empl_id" => $last_supplier_id,
            "empl_name" => $request->name
        ]);
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    public function actualizar(Request $request)
    {
        $supplier = Supplier::findOrFail($request->id);
        $supplier->business_name = $request->business_name;
        $supplier->business_representative = $request->business_representative;
        $supplier->phone = $request->phone;
        $supplier->line_business = $request->line_business;
        $supplier->save();

        return \Response::json([
            "mensaje" => "Proveedor actualizado con exito ...!"
        ]);
    }

    public function eliminar($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('datos', 'El proveedor se ha eliminado correctamente.');
    }
}
