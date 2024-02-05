<?php

namespace App\Http\Controllers;

use App\Models\Ordene;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


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

    public function print($id)
    {
        $orden = Ordene::find($id);
        $pdf = PDF::loadView('admin.ordenes.print', compact('orden'));

        $filename = 'OR_N°' . $id . '_' . $orden->proveedor->razon_social . '_' . date('Ymd', strtotime($orden->fecha)) . '.pdf';
            $path = 'pdf/' . $filename;

            Storage::put($path, $pdf->output());

            return response()->download(storage_path('app/' . $path), $filename);
    }
}

