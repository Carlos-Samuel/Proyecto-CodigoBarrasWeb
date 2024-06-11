<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;

    protected $table = 'paises';

    protected $primaryKey = 'codigo_iso_numeric';
    public $incrementing = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'codigo_iso_numeric', 
        'nombre',             
        'codigo_iso2',        
        'codigo_iso3'
    ];

    public function terceros()
    {
        return $this->hasMany(Tercero::class, 'pais_id');
    }
}
