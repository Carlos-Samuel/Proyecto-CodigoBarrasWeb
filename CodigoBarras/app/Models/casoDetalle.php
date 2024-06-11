<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class casoDetalle extends Model
{
    protected $table = 'casoDetalle';

    protected $fillable = [
        'id_caso',
        'clasificacion',
        'nombre_contacto',
        'numero_contacto',
        'correo_contacto',
        'detalle',
    ];

    // Relación con el modelo Caso
    public function caso()
    {
        return $this->belongsTo(Caso::class, 'id_caso', 'id_caso');
    }
}