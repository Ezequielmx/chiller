<?php

namespace App\Http\Livewire\Admin\Ordenes;

use App\Mail\EnviaOrden;
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

use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

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

    public $status_mail = '';

    public $searchTerm;

    protected $listeners = ['guardar'];

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
        'orden.user_solic_id' => 'nullable',
        'orden.factura' => 'nullable',
        'orden.retirado' => 'required',
        'orden.estado_id' => 'required',
    ];

    public function mount($id = null)
    {
        $this->empresas = Empresa::all();
        $this->proveedores = Proveedore::orderBy('razon_social')->get();
        $this->clientes = Cliente::orderBy('razon_social')->get();
        $this->formasPago = FormaPago::all();
        $this->users = User::orderBy('name')->get();
        $this->estados = Estado::all();
        $this->rubros = Rubro::all();
        $this->unidades = Unidade::orderBy('nombre')->get();


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

        if (!$this->modeNew) {
            $this->orden = Ordene::find($this->orden_id);
        }
    }

    public function render()
    {
        $this->obras = $this->orden->cliente_id ? Cliente::find($this->orden->cliente_id)->obras->where('activo', 1)->sortBy('nombre') : [];

        //dd($this->orden->cliente_id);
        /*if ($this->orden->cliente_id) {
            $this->obras = $this->orden->cliente->obras->where('activo', 1)->sortBy('nombre');
        } else {
            $this->obras = [];
        }*/
        //$this->ordenDetalles = $this->ordenDetalles->fresh();

        if (!$this->modeNew) {
            $this->orden->load('detalles');
            $this->ordenDetalles = $this->orden->detalles;
        }

        if (!$this->modeNew) {
            $this->products = Producto::where('activo', 1)
                ->whereNotIn('id', $this->ordenDetalles->pluck('producto_id')->toArray())
                ->search($this->searchTerm)->orderBy('nombre')
                ->when($this->rubroSel, function ($query, $rubroSel) {
                    return $query->where('rubro_id', $rubroSel);
                })
                ->get();
        } else {
            $this->products = Producto::where('activo', 1)
                ->whereNotIn('id', array_column($this->ordenDetalles, 'producto_id'))
                ->search($this->searchTerm)->orderBy('nombre')
                ->when($this->rubroSel, function ($query, $rubroSel) {
                    return $query->where('rubro_id', $rubroSel);
                })
                ->get();
        }

        return view('livewire.admin.ordenes.form');
    }

    public function addProduct(Producto $producto)
    {
        if ($this->modeNew) {
            $this->ordenDetalles[] = [
                'producto_id' => $producto->id,
                'producto' => $producto->nombre,
                'cantidad' => 1,
                'unidad_id' => 1,
                'precio' => 0
            ];
        } else {
            $ordenDetalle = new OrdenDetalle();
            $ordenDetalle->orden_id = $this->orden->id;
            $ordenDetalle->producto_id = $producto->id;
            $ordenDetalle->cantidad = 1;
            $ordenDetalle->unidad_id = 1;
            $ordenDetalle->precio = 0;
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

    public function updatePrecio(OrdenDetalle $ordenDetalle, $precio)
    {
        if ($precio == "")
            $precio = 0;


        $ordenDetalle->precio = $precio;
        $ordenDetalle->save();
    }

    public function guardar(bool $mail = false)
    {
        $this->validate();

        if ($this->orden->factura) {
            $this->orden->estado_id = 4;
        } elseif ($this->orden->retirado) {
            $this->orden->estado_id = 3;
        }

        if ($this->modeNew) {
            $nro = Ordene::where('empresa_id', $this->orden->empresa_id)->max('nro')+1;
            $this->orden->nro = $nro;
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


            if ($mail) {
                $this->sendMail();
            }

            return redirect()->route('admin.ordenes.index')->with('info', 'Orden creada con éxito.' . $this->status_mail);
        } else {

            if ($mail) {
                $this->sendMail();
            }

            return redirect()->route('admin.ordenes.index')->with('info', 'Orden actualizada con éxito.' . $this->status_mail);
        }
    }

    public function autorizar()
    {
        $this->orden->autorizado = 1;
        $this->orden->user_aut_id = auth()->user()->id;
        $this->orden->save();
    }

    public function cancelarAutorizacion()
    {
        $this->orden->autorizado = 0;
        $this->orden->user_aut_id = null;
        $this->orden->save();
    }

    public function insertProduct()
    {
        $prod = new Producto();
        $prod->nombre = $this->searchTerm;
        $prod->rubro_id = $this->rubroSel;
        $prod->save();
        $this->searchTerm = '';
        $this->rubroSel = null;

        $this->addProduct($prod);
    }

    public function createOrden()
    {
        $this->guardar(true);
    }

    public function sendMail()
    {
        $orden = $this->orden;
        $pdf = PDF::loadView('admin.ordenes.print', compact('orden'));

        //return $pdf->stream('orden.pdf');

        $filename = 'OR_N°' . $orden->nro . '_' . $orden->proveedor->razon_social . '_' . date('Ymd', strtotime($orden->fecha)) . '.pdf';
        $path = 'pdf/' . $filename;

        Storage::put($path, $pdf->output());

        $emails = explode(';', $this->orden->proveedor->email);
        $to = trim($emails[0]);
        $cc = array_map('trim', array_slice($emails, 1));

        //add to cc the email of the user_solic of the order
        if ($this->orden->user_solic_id) {
            $cc[] = $this->orden->user_solic->email;
        }

        try {
            Mail::to($to)
                ->cc($cc)
                ->send(new EnviaOrden($this->orden->empresa->email, $this->orden->empresa->razon_social, $this->orden->id, $path));

            $this->status_mail = 'Mail enviado';
            $this->orden->estado_id = 2;
        } catch (\Exception $e) {
            $this->status_mail = 'Error al enviar mail: ' . $e->getMessage();
        }


        $this->orden->save();
    }
}
