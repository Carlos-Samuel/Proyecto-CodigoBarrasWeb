<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipo_documento';

    protected $fillable = [
        'nombre',
        'sigla'
    ];

    public function terceros()
    {
        return $this->hasMany(Tercero::class, 'tipo_identificacion_id');
    }
}
