<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordene extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'empresa_id',
        'proveedor_id',
        'ciente_id',
        'obra_id',
        'forma_pago_id',
        'user_ret_id',
        'user_aut_id',
        'factura',
        'estado_id',
        'autorizado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedore::class, 'proveedor_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function forma_pago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function user_ret()
    {
        return $this->belongsTo(User::class, 'user_ret_id');
    }

    public function user_aut()
    {
        return $this->belongsTo(User::class, 'user_aut_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function detalles()
    {
        return $this->hasMany(OrdenDetalle::class, 'orden_id');
    }
}
