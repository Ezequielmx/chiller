<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RubroController extends Controller
{
    public function index()
    {
        return view('admin.rubros.index');
    }
}
