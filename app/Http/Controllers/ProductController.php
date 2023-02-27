<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return $products->toJson(JSON_PRETTY_PRINT);
    }

    public function detail($id)
    {
        try {
            $product = Product::findOrFail($id);
            $data = array(
                'name'              => $product->name,
                'description'       => $product->description,
                'price'             => $product->price,
            );
            $response = response()->json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   => 'Producto encontrado.',
                'data'      => $data
            ), 200);
        }
        // catch(Exception $e) catch any exception
        catch (\Throwable $th) {
            $data = response()->json(array(
                'status'    =>  'error',
                'code'      =>   404,
                'message'   =>  'No se encontro el producto.',
            ), 404);
        }
        return $response;
    }

    public function create()
    {
        return 'new Products';
    }

    public function edit()
    {
        return 'update Products';
    }

    public function remove()
    {
        return 'remove Products';
    }
}
