<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ordene;
use App\Models\Producto;
use App\Models\Unidade;

class OrdenDetalle extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'unidad_id',
    ];

    public function orden()
    {
        return $this->belongsTo(Ordene::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidade::class);
    }

}
