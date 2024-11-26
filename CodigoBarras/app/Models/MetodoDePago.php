<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoDePago extends Model
{
    use HasFactory;

    protected $table = 'metodos_de_pago';
    protected $primaryKey = 'idMetodos_de_pago';
    public $timestamps = true;

    protected $fillable = [
        'Descripcion',
        'Cuenta',
        'Imagen',
        'Activo',
        'Efectivo'
    ];

    public function pagos()
    {
        return $this->hasMany(PagoFactura::class, 'Metodos_de_pago_idMetodos_de_pago');
    }
}
