<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $employees = DB::table('employees')
                ->select('id', 'dni', DB::raw('CONCAT(name, " ", lastname) as full_name'), 'email')
                ->get();

            return DataTables::of($employees)
                ->addColumn('action', function($employees){
                    $acciones = '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="editEmployee('.$employees->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="deleteEmployee" id="'.$employees->id.'" class="deleteEmployee btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = Auth::user();
        return view('employees.index', compact("usuario"));
    }

    public function store(Request $request)
    {
        if (Employee::all()->count()) {
            $last_employee_id = Employee::all()->last()->id+1;
        } else {
            $last_employee_id = 1;
        }

        $employee = new Employee();
        $employee->id = $last_employee_id;
        $employee->dni = $request->dni;
        $employee->name = $request->name;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->save();

        return \Response::json([
            "mensaje" => "Personal registrado con exito ...!",
            "empl_id" => $last_employee_id,
            "empl_name" => $request->name
        ]);
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    public function actualizar(Request $request)
    {
        $employee = employee::findOrFail($request->id);
        $employee->dni = $request->dni;
        $employee->name = $request->name;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->save();

        return \Response::json([
            "mensaje" => "Personal actualizado con exito ...!"
        ]);
    }

    public function eliminar($id)
    {
        $employee = employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('datos', 'El personal se ha eliminado correctamente.');
    }
}
