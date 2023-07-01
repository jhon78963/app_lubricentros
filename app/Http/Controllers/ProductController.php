<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $products = DB::table('products as p')
                    ->join('categories as c', 'p.category_id', 'c.id')
                    ->select('p.id', 'p.name','p.stock','p.sale_price as price', 'c.name AS category_name')
                    ->get();

            return DataTables::of($products)
                ->addColumn('action', function($products){
                    $acciones = '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="editProduct('.$products->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="deleteProduct" id="'.$products->id.'" class="deleteProduct btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $categories = Category::all();
        $products = Product::where('stock', '>', '0')->get();
        $suppliers = Supplier::all();
        $usuario = Auth::user();
        return view('products.index', compact("categories", "products", "suppliers", "usuario"));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact("categories"));
    }

    public function store(Request $request)
    {
        if (Product::all()->count()) {
            $last_product_id = Product::all()->last()->id+1;
        } else {
            $last_product_id = 1;
        }

        $product = new Product();
        $product->id = $last_product_id;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->code_bar = $request->code_bar;
        $product->save();

        return \Response::json([
            "mensaje" => "Producto registrado con exito ...!",
            "prod_id" => $last_product_id,
            "prod_name" => $request->name
        ]);
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->get();
        return response()->json($product);
    }

    public function actualizar(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->code_bar = $request->code_bar;
        $product->save();

        return \Response::json([
            "mensaje" => "Producto actualizado con exito ...!"
        ]);
    }

    public function eliminar($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
