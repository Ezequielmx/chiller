<?php

namespace App\Http\Livewire\Admin\Ordenes;

use Livewire\Component;
use App\Models\Ordene;
use App\Models\Empresa;
use App\Models\Proveedore;
use App\Models\Cliente;
use App\Models\FormaPago;
use App\Models\User;
use App\Models\Estado;

class Form extends Component
{
    public $orden;
    public $modeNew = true;

    public $empresas;
    public $proveedores;
    public $clientes;
    public $obras;
    public $formasPago;
    public $users;
    public $estados;

    public $ordenDetalles;

    protected $rules = [
        'orden.empresa_id' => 'required',
        'orden.fecha' => 'required',
        'orden.user_id' => 'required',
        'orden.proveedor_id' => 'required',
        'orden.cliente_id' => 'required',
        'orden.obra_id' => 'required',
        'orden.forma_pago_id' => 'required',
        'orden.user_ret_id' => 'required',
        'orden.retirado' => 'requeried',
        'orden.user_aut_id' => 'nullable',
        'orden.factura' => 'nullable',
        'orden.estado_id' => 'required',
        'orden.autorizado' => 'requeried',
    ];
  
    public function mount($id = null)
    {
        $this->empresas = Empresa::all();
        $this->proveedores = Proveedore::all();
        $this->clientes = Cliente::all();
        $this->formasPago = FormaPago::all();
        $this->users = User::all();
        $this->estados = Estado::all();
        
        if($id){
            $this->orden = Ordene::find($id);
            $this->modeNew = false;
            $this->ordenDetalles = $this->orden->detalles;
        }
        else
        {
            $this->orden = new Ordene();
            $this->modeNew = true;
            $this->orden->fecha = date('Y-m-d');
            $this->orden->user_id = auth()->user()->id;
            $this->ordenDetalles = [];
        }        
    }


    public function render()
    {
        if($this->orden->cliente_id)
            $this->obras = $this->orden->cliente->obras;
        else
            $this->obras = [];
        
        return view('livewire.admin.ordenes.form');
    }
}
