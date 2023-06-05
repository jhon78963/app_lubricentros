<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $categories = DB::table('categories')->get();
            return DataTables::of($categories)
                ->addColumn('action', function($categories){
                    $acciones = '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="editCategory('.$categories->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="deleteCategory" id="'.$categories->id.'" class="deleteCategory btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        return view("categories.create");
    }

    public function store(Request $request)
    {
        if (Category::all()->count()) {
            $last_category_id = Category::all()->last()->id+1;
        } else {
            $last_category_id = 1;
        }

        $category = new Category();
        $category->id = $last_category_id;
        $category->name = $request->name;
        $category->save();
        return \Response::json([
            "mensaje" => "Categoría registrado con exito ...!",
            "cate_id" => $last_category_id,
            "cate_name" => $request->name
        ]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function actualizar(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->save();
        return \Response::json([
            "mensaje" => "Categoría actualizado con exito ...!"
        ]);
    }

    public function eliminar($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('datos', 'La categoría se ha eliminado correctamente.');
    }
}
