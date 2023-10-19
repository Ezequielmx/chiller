<?php

namespace App\Http\Livewire\Admin\Ordenes;

use App\Models\Ordene;
use Livewire\Component;

class Index extends Component
{
    protected $listeners  = ['deleteOrden'];

    public function mount()
    {
    }

    public function render()
    {
        $ordenes = Ordene::orderBy('fecha')->paginate(50);
        return view('livewire.admin.ordenes.index', compact('ordenes'));
    }

    public function deleteOrden($id)
    {
        $orden = Ordene::find($id);
        $orden->delete();
    }
}
