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
    public function detail()
    {
        return 'Product';
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
