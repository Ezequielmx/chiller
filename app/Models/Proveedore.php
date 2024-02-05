<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'razon_social',
        'cuit',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'web',
        'forma_pago_id',
        'activo',
    ];

    public function formaPago()
    {
        return $this->belongsTo('App\Models\FormaPago');
    }

    public function ordenes()
    {
        return $this->hasMany('App\Models\Ordene', 'proveedor_id');
    }
}
