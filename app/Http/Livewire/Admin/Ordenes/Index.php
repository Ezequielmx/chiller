<?php

namespace App\Http\Livewire\Admin\Ordenes;

use App\Models\Ordene;
use App\Models\Proveedore;
use Livewire\Component;
use App\Models\Estado;

class Index extends Component
{
    protected $listeners  = ['deleteOrden'];
    public $proveedor_id;
    public $estado_id;
    public $finalizadas;
    public $aprobadas;
    public $user;

    public $proveedores;
    public $estados;

    public function mount()
    {
        $this->proveedores = Proveedore::whereHas('ordenes')->orderBy('razon_social')->get();
        $this->estados = Estado::all();
        $this->proveedor_id = 0;
        $this->estado_id = 0;
        $this->finalizadas = 0;
        $this->aprobadas = -1;
        $this->user = auth()->user();
    }

    public function render()
    {
        $ordenes = Ordene::orderBy('fecha')
        ->when($this->proveedor_id > 0, function ($query) {
            $query->where('proveedor_id', $this->proveedor_id);
        })
        ->when($this->estado_id > 0, function ($query) {
            $query->where('estado_id', $this->estado_id);
        })
        ->when(!$this->finalizadas, function ($query) {
            $query->where('estado_id', '<' , 4);
        })
        ->when($this->aprobadas != -1, function ($query) {
            $query->where('autorizado', $this->aprobadas);
        })
        ->when($this->user->hasRole('Operario Retiros'), function ($query) {
            $query->where('user_ret_id', $this->user->id);
        })
        /*
        ->when($this->user->hasRole('Generador Ordenes'), function ($query) {
            $query->where('user_ret_id', $this->user->id)->orWhere('user_id', $this->user->id);
        })*/
        ->paginate(50);

        return view('livewire.admin.ordenes.index', compact('ordenes'));
    }

    public function deleteOrden($id)
    {
        $orden = Ordene::find($id);
        $orden->delete();
    }

    public function borrarFiltros()
    {
        $this->proveedor_id = 0;
        $this->estado_id = 0;
        $this->finalizadas = 0;
        $this->aprobadas = -1;
    }

    public function autorizar($id)
    {
        $orden = Ordene::find($id);
        if($orden->autorizado == 1){
            $orden->autorizado = 0;
            $orden->user_aut_id = null;
        }else{
            $orden->autorizado = 1;
            $orden->user_aut_id = auth()->user()->id;
        }
        
        $orden->save();
    }


    
}
