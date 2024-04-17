<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPago;
use App\Models\Proveedore;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('admin.proveedores.index');
    }

    public function edit(Proveedore $proveedore)
    {
        $formasPago = FormaPago::all()->pluck('descripcion', 'id');
        return view('admin.proveedores.edit', compact('proveedore', 'formasPago'));
    }

    public function create()
    {
        $formasPago = FormaPago::all()->pluck('descripcion', 'id');
        return view('admin.proveedores.create', compact('formasPago'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'razon_social' => 'required',
            'cuit' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'nullable|email',
            'forma_pago_id' => 'required',
        ]);

        if ($request->activo == 'on')
            $request->merge(['activo' => 1]);
        else
            $request->merge(['activo' => 0]);


        $proveedor = Proveedore::create($request->all());

        return redirect()->route('admin.proveedores.index', $proveedor)->with('info', 'El proveedor se creó con éxito');
    }

    public function update(Request $request, Proveedore $proveedore)
    {
        $request->validate([
            'razon_social' => 'required',
            'cuit' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'nullable | email',
            'forma_pago_id' => 'required',
        ]);

        if ($request->activo == 'on')
            $request->merge(['activo' => 1]);
        else
            $request->merge(['activo' => 0]);

        $proveedore->update($request->all());

        return redirect()->route('admin.proveedores.index', $proveedore)->with('info', 'El proveedor se actualizó con éxito');
    }
}
