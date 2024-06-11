<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pucComercial extends Model
{
    use HasFactory;

    public $table = 'pucComercial';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'plncod', 
        'plnom', 
        'plntip', 
        'plnniv'
    ];
    
}
