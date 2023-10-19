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
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Unidade;
use App\Models\OrdenDetalle;

class Form extends Component
{
    public $orden;
    public $orden_id;
    public $modeNew = true;

    public $empresas;
    public $proveedores;
    public $clientes;
    public $obras;
    public $formasPago;
    public $users;
    public $estados;

    public $ordenDetalles;
    public $products;
    public $rubros;
    public $rubroSel;
    public $unidades;

    public $searchTerm;

    protected $rules = [
        'orden.empresa_id' => 'required',
        'orden.fecha' => 'required',
        'orden.user_id' => 'required',
        'orden.proveedor_id' => 'required',
        'orden.cliente_id' => 'required',
        'orden.obra_id' => 'required',
        'orden.forma_pago_id' => 'required',
        'orden.user_ret_id' => 'required',
        'orden.user_aut_id' => 'nullable',
        'orden.factura' => 'nullable',
        'orden.retirado' => 'required',
        'orden.estado_id' => 'required',
    ];

    public function mount($id = null)
    {
        $this->empresas = Empresa::all();
        $this->proveedores = Proveedore::all();
        $this->clientes = Cliente::all();
        $this->formasPago = FormaPago::all();
        $this->users = User::all();
        $this->estados = Estado::all();
        $this->rubros = Rubro::all();
        $this->unidades = Unidade::all();


        if ($id) {
            $this->orden = Ordene::find($id);
            $this->orden_id = $id;
            $this->modeNew = false;
            $this->ordenDetalles = $this->orden->detalles;
        } else {
            $this->orden = new Ordene();
            $this->orden->estado_id = 1;
            $this->modeNew = true;
            $this->orden->fecha = date('Y-m-d');
            $this->orden->user_id = auth()->user()->id;
            $this->orden->retirado = 0;
            $this->ordenDetalles = [];
        }
    }

    public function render()
    {
        if ($this->orden->cliente_id){
            $this->obras = $this->orden->cliente->obras;
        }else{
            $this->obras = [];
        }

        if (!$this->modeNew) {
            $this->orden = Ordene::find($this->orden_id);
            $this->ordenDetalles = $this->orden->detalles;
        } 
            
        $this->products = Producto::where('activo', 1)->search($this->searchTerm)->orderBy('nombre')
            ->when($this->rubroSel, function ($query, $rubroSel) {
                return $query->where('rubro_id', $rubroSel);
            })
            ->get();

        return view('livewire.admin.ordenes.form');
    }

    public function addProduct(Producto $producto)
    {
        if ($this->modeNew) {
            $this->ordenDetalles[] = [
                'producto_id' => $producto->id,
                'producto' => $producto->nombre,
                'cantidad' => 1,
                'unidad_id' => 1
            ];
        }
        else{
            $ordenDetalle = new OrdenDetalle();
            $ordenDetalle->orden_id = $this->orden->id;
            $ordenDetalle->producto_id = $producto->id;
            $ordenDetalle->cantidad = 1;
            $ordenDetalle->unidad_id = 1;
            $ordenDetalle->save();
        }
    }

    public function removeProduct($index)
    {
        unset($this->ordenDetalles[$index]);
    }

    public function removeProductG(OrdenDetalle $ordenDetalle)
    {
        $ordenDetalle->delete();
    }

    public function updateCantidad(OrdenDetalle $ordenDetalle, $cantidad)
    {
        $ordenDetalle->cantidad = $cantidad;
        $ordenDetalle->save();
    }

    public function updateUnidad(OrdenDetalle $ordenDetalle, $unidad_id)
    {
        $ordenDetalle->unidad_id = $unidad_id;
        $ordenDetalle->save();
    }

    public function guardar()
    {
        $this->validate();

        if($this->orden->autorizado == 1){
            $this->orden->estado_id = 4;
        }elseif($this->orden->factura){
            $this->orden->estado_id = 3;
        }elseif($this->orden->retirado){
            $this->orden->estado_id = 2;
        }else{
            $this->orden->estado_id = 1;
        }

        $this->orden->save();

        if ($this->modeNew) {
            foreach ($this->ordenDetalles as $detalle) {
                $ordenDetalle = new OrdenDetalle();
                $ordenDetalle->orden_id = $this->orden->id;
                $ordenDetalle->producto_id = $detalle['producto_id'];
                $ordenDetalle->cantidad = $detalle['cantidad'];
                $ordenDetalle->unidad_id = $detalle['unidad_id'];
                $ordenDetalle->save();
            }

            return redirect()->route('admin.ordenes.index')->with('info', 'Orden creada con éxito');
        } else {
            return redirect()->route('admin.ordenes.index')->with('info', 'Orden actualizada con éxito');
        }
    }

    public function autorizar(){
        $this->orden->autorizado = 1;
        $this->orden->user_aut_id = auth()->user()->id;
        $this->orden->save();
    }

    public function cancelarAutorizacion(){
        $this->orden->autorizado = 0;
        $this->orden->user_aut_id = null;
        $this->orden->save();
    }
}
