<?php

namespace App\Http\Livewire\Admin\Empresas;

use Livewire\Component;
use App\Models\Empresa;

class Index extends Component
{
    public $empresas;

    public $editing_id = null;
    public $razon_social;
    public $cuit;
    public $direccion;
    public $telefono;
    public $email;


    public function render()
    {
        $this->empresas = Empresa::all();
        return view('livewire.admin.empresas.index');
    }


    public function editing(Empresa $empresa)
    {
        $this->editing_id = $empresa->id;
        $this->razon_social = $empresa->razon_social;
        $this->cuit = $empresa->cuit;
        $this->direccion = $empresa->direccion;
        $this->telefono = $empresa->telefono;
        $this->email = $empresa->email;
    }

    public function updateEmp(Empresa $empresa)
    {
        $this->validate([
            'razon_social' => 'required',
            'cuit' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $empresa->update([
            'razon_social' => $this->razon_social,
            'cuit' => $this->cuit,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ]);

        $this->editClose();
    }

    public function editClose()
    {
        $this->editing_id = null;
    }
}
