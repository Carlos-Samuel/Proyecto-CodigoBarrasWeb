<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terceros extends Model
{
    use HasFactory;

    protected $table = 'terceros';
    
    protected $fillable = [
        'numero_identificacion',
        'tipo_identificacion_id',
        'digito_verificacion',
        'primer_apellido',
        'segundo_apellido',
        'primer_nombre',
        'segundo_nombre',
        'razon_social',
        'direccion',
        'telefono',
        'fax',
        'celular',
        'email',
        'sitio_web',
        'pais_id',
        'ciudad',
        'regimen_id',
        'tipo_persona_id',
        'tipo_tercero',
        'activo'
    ];

    // Relaciones
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_identificacion_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function ciudad()
    {
        return $this->belongsTo(Divipola::class, 'ciudad');
    }

    public function regimen()
    {
        return $this->belongsTo(Regimen::class, 'regimen_id');
    }

    public function tipoPersona()
    {
        return $this->belongsTo(TipoPersona::class, 'tipo_persona_id');
    }
}
