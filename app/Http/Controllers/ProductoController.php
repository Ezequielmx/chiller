<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        return view('admin.productos.index');
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function edit($id)
    {
        return view('admin.productos.edit', compact('id'));
    }

}
