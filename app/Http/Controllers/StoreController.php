<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        try {
            $store = Store::with('Products')->get();
            $response = response()->json(array(
                'status'    =>  'success',
                'code'      =>  200,
                'data'      =>  $store
            ), 200);
        } catch (\Throwable $th) {
            $response = response()->json(array(
                'status'    =>  'error',
                'code'      =>   404,
                'message'   =>  'No se encontraron tiendas registradas.',
                'data'      =>  []
            ), 404);
        }

        return $response;
    }
}
