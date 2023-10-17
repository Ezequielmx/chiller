<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index()
    {
        return view('admin.ordenes.index');
    }

    public function create()
    {
        return view('admin.ordenes.create');
    }

    public function edit($id)
    {
        return view('admin.ordenes.edit', compact('id'));
    }
}
