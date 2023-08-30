<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        return view('admin.clientes.index');
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function edit($id)
    {
        return view('admin.clientes.edit', compact('id'));
    }
}
