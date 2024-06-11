<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
    use HasFactory;

    protected $table = 'regimen'; 

    protected $fillable = [
        'descripcion' 
    ];

    public function terceros()
    {
        return $this->hasMany(Tercero::class, 'regimen_id');
    }
}
