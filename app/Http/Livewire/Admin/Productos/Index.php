<?php

namespace App\Http\Livewire\Admin\Productos;

use Livewire\Component;
use App\Models\Rubro;
use App\Models\Producto;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $rubros;

    public $search = '';
    public $rubro_id = null;

    protected $listeners = ['deleteProducto'];

    public function mount()
    {
        $this->rubros= Rubro::orderBy('nombre')->get();
    }
    public function render()
    {
        $productos = Producto::where('nombre','LIKE','%'.$this->search.'%')
        ->when($this->rubro_id, function ($query) {
            return $query->where('rubro_id', $this->rubro_id);
        })
        ->orderBy('activo','desc')
        ->orderBy('nombre')
        ->paginate(50);

        return view('livewire.admin.productos.index', compact('productos'));
    }

    public function borrarFiltros()
    {
        $this->reset(['search','rubro_id']);
    }

    public function deleteProducto(Producto $producto)
    {
        $producto->delete();
    }
}
