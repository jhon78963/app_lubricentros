<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculo;
use App\Models\Revision;

class RevisionController extends Controller
{
    public function index()
    {
        $revisiones = DB::table('revisiones as r')
            ->join('vehiculos as v', 'r.placa', 'v.placa')
            ->select(DB::raw("TO_CHAR(r.created_at, 'DD-MM-YYYY HH:MI:SS') AS fecha"), 'v.placa', 'v.propietario', 'v.tipo', 'r.id')
            ->get();

        return view('revisiones.index', compact('revisiones'));
    }

    public function store(Request $request)
    {
        $vehiculoExists = Vehiculo::where('placa', $request->input('placa'))->exists();

        if (!$vehiculoExists) {
            if (Vehiculo::all()->count()) {
                $last_vehiculo_id = Vehiculo::all()->last()->id+1;
            } else {
                $last_vehiculo_id = 1;
            }

            $vehiculo = new Vehiculo();
            $vehiculo->id = $last_vehiculo_id;
            $vehiculo->tipo = $request->tipo;
            $vehiculo->propietario = $request->propietario;
            $vehiculo->placa = $request->placa;
            $vehiculo->save();
        }

        $revision = new Revision();
        $revision->motor = $request->motor == 'opcion1' ? true : false;
        $revision->frenos = $request->frenos == 'opcion1' ? true : false;
        $revision->suspension_direccion = $request->suspension_direccion == 'opcion1' ? true : false;
        $revision->luces_señalizacion = $request->luces_señalizacion == 'opcion1' ? true : false;
        $revision->equipo_seguridad = $request->equipo_seguridad == 'opcion1' ? true : false;
        $revision->motor_detail = $request->motor_detail;
        $revision->frenos_detail = $request->frenos_detail;
        $revision->suspension_direccion_detail = $request->suspension_direccion_detail;
        $revision->luces_señalizacion_detail = $request->luces_señalizacion_detail;
        $revision->equipo_seguridad_detail = $request->equipo_seguridad_detail;
        $revision->placa = $request->placa;
        $revision->save();
        return back()->with('datos', 'Revisión Técnica registrada con exito ...!');
    }

    public function show($id)
    {
        $revision = DB::table('revisiones as r')
            ->join('vehiculos as v', 'r.placa', 'v.placa')
            ->where('r.id', $id)
            ->first();
        return view('revisiones.show', compact('revision'));
    }
}
