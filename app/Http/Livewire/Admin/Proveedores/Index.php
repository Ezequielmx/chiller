<?php

namespace App\Http\Livewire\Admin\Proveedores;


use Livewire\Component;
use App\Models\Proveedore;
use App\Models\FormaPago;

class Index extends Component
{
    public $proveedores;
    public $formas_pago;

    protected $listeners = ['deleteProveedor'];

    public function mount()
    {
        $this->formas_pago = FormaPago::all();
    }
    public function render()
    {
        $this->proveedores = Proveedore::orderBy('activo', 'desc')->orderBy('razon_social')->get();
        return view('livewire.admin.proveedores.index');
    }

    public function deleteProveedor($id)
    {
        $proveedor = Proveedore::find($id);
        $proveedor->delete();
    }
}
