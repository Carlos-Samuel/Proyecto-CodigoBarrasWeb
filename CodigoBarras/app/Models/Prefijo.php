<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefijo extends Model
{
    use HasFactory;

    protected $connection = 'mysql_agil'; // Conexión a la segunda base de datos
    protected $table = 'prefijo'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'PrfId'; // Clave primaria
    public $incrementing = true; // AutoIncrement
    public $timestamps = false; // No tiene timestamps por defecto

    protected $fillable = [
        'PrfCod', 'PrfNom', 'prfnoact', 'ctoid', 'PrfPos', 'PrfOtr', 'PrfIng',
        'PrfPag', 'PrfMen', 'PrfSinImp', 'PrfNoVta', 'PrfBas', 'PrfCom', 'VentDiaw',
        'CiuId', 'EmpId', 'prftal', 'prfdespa', 'prfremc', 'tabprepos', 'tabprecli',
        'prfgto', 'prfnocxc', 'prfnocxcig', 'prfplz0nocar', 'prfact', 'prfimpincluido',
        'prfautovta', 'prfultimodoc', 'prfdir', 'prftel', 'prfpln0car', 'prfultvta',
        'prfdev', 'prfncc', 'prfnde', 'prfcel', 'prfdevcods', 'agilact'
    ];

    /**
     * Relación con la tabla Ventas
     */
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'PrfId', 'PrfId');
    }
}
