<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoFactura extends Model
{
    use HasFactory;

    protected $table = 'pagos_facturas';
    public $timestamps = true;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'Facturas_idFacturas',
        'Metodos_de_pago_idMetodos_de_pago',
        'Cantidad',
        'Usuarios_idUsuarios'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'Facturas_idFacturas');
    }

    public function metodoDePago()
    {
        return $this->belongsTo(MetodoDePago::class, 'Metodos_de_pago_idMetodos_de_pago');
    }

    // Asumiendo que existe un modelo 'Usuario'
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Usuarios_idUsuarios');
    }
}
