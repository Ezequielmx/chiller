<?php

namespace App\Http\Livewire\Admin\Ordenes;

use App\Models\Empresa;
use App\Models\Ordene;
use App\Models\Proveedore;
use Livewire\Component;
use App\Models\Estado;
use Livewire\WithPagination;
use App\Models\User;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners  = ['deleteOrden'];
    public $empresa_id;
    public $proveedor_id;
    public $estado_id;
    public $finalizadas;
    public $aprobadas;
    public $user;
    public $user_realiz_id;

    public $empresas;
    public $users;
    
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
        $this->users = User::orderBy('name')->get();
        $this->empresas = Empresa::all();
    }

    public function render()
    {
        $ordenes = Ordene::orderBy('nro')
        ->when($this->empresa_id > 0, function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })
        ->when($this->user_realiz_id > 0, function ($query) {
            $query->where('user_id', $this->user_realiz_id);
        })
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
        $this->user_realiz_id = 0;
        $this->empresa_id = 0;
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
