<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $customers = DB::table('customers')
                ->select('id', 'dni', DB::raw('CONCAT(name, " ", lastname) as full_name'), 'email')
                ->get();

            return DataTables::of($customers)
                ->addColumn('action', function($customers){
                    $acciones = '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="editCustomer('.$customers->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="deleteCustomer" id="'.$customers->id.'" class="deleteCustomer btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = Auth::user();
        return view('customers.index', compact("usuario"));
    }

    public function store(Request $request)
    {
        if (Customer::all()->count()) {
            $last_customer_id = Customer::all()->last()->id+1;
        } else {
            $last_customer_id = 1;
        }

        $customer = new customer();
        $customer->id = $last_customer_id;
        $customer->dni = $request->dni;
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->save();

        return \Response::json([
            "mensaje" => "Cliente registrado con exito ...!"
        ]);
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function actualizar(Request $request)
    {
        $customer = Customer::findOrFail($request->id);
        $customer->dni = $request->dni;
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->save();

        return \Response::json([
            "mensaje" => "Cliente actualizado con exito ...!"
        ]);
    }

    public function eliminar($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('datos', 'El cliente se ha eliminado correctamente.');
    }
}
