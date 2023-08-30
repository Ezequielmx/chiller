<?php

namespace App\Http\Livewire\Admin\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Form extends Component
{
    public $cliente;
    public $modeNew = true;
    public $activo = true;

    protected $rules = [
        'cliente.razon_social' => 'required',
        'cliente.cuit' => 'required',
        'cliente.contacto' => 'required',
        'cliente.direccion' => 'required',
        'cliente.telefono' => 'required',
        'cliente.email' => 'required'
    ];

    public function mount($id = null)
    {
        if($id){
            $this->cliente = Cliente::find($id);
            $this->modeNew = false;
            $this->activo = $this->cliente->activo;
        }
        else
        {
            $this->cliente = new Cliente();
            $this->modeNew = true;
            $this->activo = true;
        }        
    }

    public function render()
    {
        return view('livewire.admin.clientes.form');
    }
    
    public function guardar()
    {
        $this->validate();
        $this->cliente->activo = $this->activo;

        if($this->modeNew){
            $this->cliente->save();
            $msg = 'Cliente creado con éxito.';
        }else{
            $this->cliente->update();
            $msg = 'Cliente actualizado con éxito.';
        }
        
        return redirect()->route('admin.clientes.index')->with('info', $msg);
    }
}
