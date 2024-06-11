<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $table = 'casos';

    protected $fillable = [
        'fecha',
        'numero_caso',
        'responsable',
        'estado'
    ];



    public function detalles()
    {
        return $this->hasMany(casoDetalle::class, 'id_caso', 'id_caso');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'responsable');
    }
}
