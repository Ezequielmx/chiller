<?php

namespace App\Http\Livewire\Admin\Productos;

use App\Models\Producto;
use Livewire\Component;
use App\Models\Rubro;

class Form extends Component
{
    public $producto;
    public $rubros;
    public $modeNew = true;
    public $activo = true;
    
    protected $rules = [
        'producto.nombre' => 'required|min:3',
        'producto.rubro_id' => 'required',
        'producto.detalle' => 'nullable'
    ];

    public function mount($id = null)
    {
        $this->rubros = Rubro::orderBy('nombre')->get();
        if($id){
            $this->producto = Producto::find($id);
            $this->modeNew = false;
            $this->activo = $this->producto->activo;
        }
        else
        {
            $this->producto = new Producto();
            $this->activo = true;
            $this->modeNew = true;
        }        
    }

    public function render()
    {
        return view('livewire.admin.productos.form');
    }

    public function guardar()
    {
        $this->validate();
        $this->producto->activo = $this->activo;

        if($this->modeNew){
            $this->producto->save();
            $msg = 'Producto creado con éxito.';
        }else{
            $this->producto->update();
            $msg = 'Producto actualizado con éxito.';
        }
        
        return redirect()->route('admin.productos.index')->with('info', $msg);
    }
}
