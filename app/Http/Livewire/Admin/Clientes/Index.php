<?php

namespace App\Http\Livewire\Admin\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Index extends Component
{
    protected $listeners = ['deleteCliente'];

    public function render()
    {
        $clientes = Cliente::orderBy('activo', 'desc')->orderBy('razon_social')->paginate(50);
        return view('livewire.admin.clientes.index', compact('clientes'));
    }

    public function deleteCliente(Cliente $cliente)
    {
        $cliente->delete();
    }
}
