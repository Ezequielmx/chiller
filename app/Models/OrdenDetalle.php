<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Ordene::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

}
