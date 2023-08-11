<?php

namespace App\Http\Livewire\Admin\Rubros;
use App\Models\Rubro;

use Livewire\Component;

class Index extends Component
{
    public $rubros;
    public $editing_id = null;
    public $nombre;
    public $detalle;

    public $newNombre;
    public $newDetalle;         
    
    public function render()
    {
        $this->rubros = Rubro::orderBy('nombre')->get();
        return view('livewire.admin.rubros.index');
    }

    public function editing(Rubro $rubro)
    {
        $this->editing_id = $rubro->id;
        $this->nombre = $rubro->nombre;
        $this->detalle = $rubro->detalle;
    }

    public function updateRub(Rubro $rubro)
    {
        $this->validate([
            'nombre' => 'required'
        ]);

        $rubro->update([
            'nombre' => $this->nombre,
            'detalle' => $this->detalle,
        ]);

        $this->editClose();
    }

    public function editClose()
    {
        $this->editing_id = null;
    }

    public function deleteRubro($rubro_id){
        $rubro = Rubro::find($rubro_id);
        $rubro->delete();
    }

    public function createRubro(){
        $this->validate([
            'newNombre' => 'required'
        ]);

        Rubro::create([
            'nombre' => $this->newNombre,
            'detalle' => $this->newDetalle,
        ]);

        $this->newNombre = '';
        $this->newDetalle = '';
    }

}
