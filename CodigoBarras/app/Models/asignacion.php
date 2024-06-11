<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asinacion extends Model
{
    protected $table = 'asignacion';

    protected $fillable = [
        'fecha',
        'numero_caso',
    ];

    // Relación con el modelo Caso
    public function caso()
    {
        return $this->belongsTo(Caso::class, 'numero_caso');
    }
}