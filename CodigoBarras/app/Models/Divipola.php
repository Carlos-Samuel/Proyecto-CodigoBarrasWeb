<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divipola extends Model
{
    use HasFactory;

    protected $table = 'divipola'; 

    protected $primaryKey = 'codigo';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'nombre',      
        'departamento_id'  
    ];

    /**
     * Relación para acceder al departamento asociado, si aplica.
     */
    public function departamento()
    {
        return $this->belongsTo(Divipola::class, 'departamento_id');
    }

    /**
     * Relación para obtener los municipios de un departamento, si aplica.
     */
    public function municipios()
    {
        return $this->hasMany(Divipola::class, 'departamento_id');
    }

    public function terceros()
    {
        return $this->hasMany(Tercero::class, 'ciudad');
    }
}
