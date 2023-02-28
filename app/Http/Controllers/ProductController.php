<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
  public function index()
  {
    try {
      $products = Product::all();
      $response = response()->json(array(
        'status'    =>  'error',
        'code'      =>   200,
        'data'      =>  $products
      ), 404);
    } catch (\Throwable $th) {
      $response = response()->json(array(
        'status'    =>  'error',
        'code'      =>   404,
        'message'   =>  'No se encontraron productos',
        'data'      =>  []
      ), 404);
    }

    return $response;
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
    // echo ($request);
    $params_array = array(
      'name'              => $request->name,
      'description'       => $request->description,
      'price'             => $request->price,
      'store_id'          => $request->store_id,
    );

    $params = (object) $params_array;
    if (!empty($params) && !empty($params_array)) {

      // validamos los datos
      $validate = Validator::make($params_array, [
        'name'          => 'required',
        'description'   => 'required',
        'price'         => 'required|numeric',
        'store_id'      => 'required|numeric',
      ]);

      if (!$validate->fails()) {
        $product = new Product();

        $product->name                  = $params->name;
        $product->description           = $params->description;
        $product->price                 = $params->price;
        $product->store_id              = $params->store_id;
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
          'errors'    => $validate->errors(),
          'debug'     => $request,
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

  public function edit(Request $request, $id)
  {
    try {
      $product = Product::findOrFail($id);
      $product->name = is_null($request->input('name')) ? $product->name : $request->input('name');
      $product->description = is_null($request->input('description')) ? $product->description : $request->input('description');
      $product->price = is_null($request->input('price')) ? $product->price : $request->input('price');
      $product->update();

      $response = response()->json(array(
        'status'    =>  'success',
        'code'      =>   200,
        'message'   =>  'Producto actualizado.',
        'data'      =>  $product
      ), 200);
    }
    // catch(Exception $e) catch any exception
    catch (\Throwable $th) {
      $response = response()->json(array(
        'status'    =>  'error',
        'code'      =>   404,
        'message'   =>  'No se encontro el producto.',
      ), 404);
    }
    return $response;
  }

  public function remove($id)
  {
    try {
      DB::beginTransaction();
      $product = Product::findOrFail($id);

      $product->delete();

      DB::commit();
      $response = response()->json(array(
        'status'        => 'success',
        'code'          =>   200,
        'message'       => 'Producto Eliminado satisfactoriamente.',
      ), 200);
    }
    // catch(Exception $e) catch any exception
    catch (\Throwable $th) {
      $response = response()->json(array(
        'status'    =>  'error',
        'code'      =>   404,
        'message'   =>  'No se encontro el producto.',
      ), 404);
    }
    return $response;
  }
}
