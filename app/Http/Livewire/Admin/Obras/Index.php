<?php

namespace App\Http\Livewire\Admin\Obras;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Obra;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $clientes;
    public $cliente_id = null;
    public $search = '';

    protected $listeners = ['deleteObra'];

    public function mount()
    {
        $this->clientes = Cliente::orderBy('razon_social')->get();
    }


    public function render()
    {
        $obras = Obra::where('nombre','LIKE','%'.$this->search.'%')
        ->when($this->cliente_id, function ($query) {
            return $query->where('cliente_id', $this->cliente_id);
        })
        ->orderBy('activo','desc')
        ->orderBy('nombre')
        ->paginate(50);

        return view('livewire.admin.obras.index', compact('obras'));
    }

    public function borrarFiltros()
    {
        $this->reset(['search','cliente_id']);
    }

    public function deleteObra(Cliente $obra)
    {
        $obra->delete();
    }
}
