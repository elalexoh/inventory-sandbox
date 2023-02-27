<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request)
    {
        $params_array = array(
            'name'              => $request->name,
            'description'       => $request->description,
            'price'             => $request->price,
        );

        $params = (object) $params_array;
        if (!empty($params) && !empty($params_array)) {

            // validamos los datos
            $validate = Validator::make($params_array, [
                'name'          => 'required',
                'description'   => 'required',
                'price'         => 'required|numeric',
            ]);

            if (!$validate->fails()) {
                $product = new Product();

                $product->name                  = $params->name;
                $product->description           = $params->description;
                $product->price                 = $params->price;
                $product->save();

                $data = response()->json(array(
                    'status'    => 'success',
                    'code'      => 200,
                    'message'   => 'Registro exitoso',
                ), 200);
            } else {
                // Validaciones fallan
                $data = response()->json(array(
                    'status'    => 'error',
                    'code'      => 400,
                    'message'   => 'Ha ocurrido un problema con la validación de los datos',
                    'errors'    => $validate->errors()
                ), 404);
            }
        } else {
            // Request vacio
            $data = response()->json(
                array(
                    'status'    => 'error',
                    'code'      => 404,
                    'message'   => 'No se han recibido los datos',
                    'datos'     => $request->input()
                ),
                404
            );
        }
        return $data;
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
