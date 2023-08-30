<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function index()
    {
        return view('admin.obras.index');
    }

    public function create()
    {
        return view('admin.obras.create');
    }

    public function edit($id)
    {
        return view('admin.obras.edit', compact('id'));
    }

    
}
