<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deudas extends Model
{
    protected $table = 'deudas';

    protected $fillable = [
        'cantidad',
        'deudor',
        'descripcion',
        'pagado',
    ];

}
