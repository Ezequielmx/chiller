<?php

namespace App\Http\Livewire\Admin\Obras;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Obra;

class Form extends Component
{
    public $obra;
    public $clientes;
    public $modeNew = true;
    public $activo = true;

    protected $rules = [
        'obra.nombre' => 'required|min:3',
        'obra.cliente_id' => 'required',
        'obra.detalle' => 'nullable',
        'obra.direccion' => 'required',
        'obra.presupuesto' => 'nullable | numeric',
    ];

    public function mount($id = null)
    {
        $this->clientes = Cliente::orderBy('razon_social')->get();
        if($id){
            $this->obra = Obra::find($id);
            $this->modeNew = false;
            $this->activo = $this->obra->activo;
        }
        else
        {
            $this->obra = new Obra();
            $this->activo = true;
            $this->modeNew = true;
        }        
    }

    public function render()
    {
        return view('livewire.admin.obras.form');
    }

    public function guardar()
    {
        $this->validate();
        $this->obra->activo = $this->activo;

        if($this->modeNew){
            $this->obra->save();
            $msg = 'Obra creada con éxito.';
        }else{
            $this->obra->update();
            $msg = 'Obra actualizada con éxito.';
        }
        
        return redirect()->route('admin.obras.index')->with('info', $msg);
    }
}
