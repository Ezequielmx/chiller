<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function ordenDetalles(){
        return $this->hasMany(OrdenDetalle::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('nombre', 'LIKE', '%'.$searchTerm.'%');
    }

}
