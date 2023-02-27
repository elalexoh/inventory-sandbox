<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return 'Products';
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
