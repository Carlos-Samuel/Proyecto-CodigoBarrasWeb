<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $primaryKey = 'idFacturas';
    public $timestamps = true;

    protected $fillable = [
        'Prefijo',
        'NumFactura',
        'ValorFactura',
        'Terminado',
        'fechaRegistrada',
        'fechaTerminada',
        'estado',
        'mensajeria',
        'vtaid'
    ];

    public function pagos()
    {
        return $this->hasMany(PagoFactura::class, 'Facturas_idFacturas');
    }

}
