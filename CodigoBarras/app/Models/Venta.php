<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $connection = 'mysql_agil'; // Se conecta a la segunda base de datos
    protected $table = 'ventas'; // Nombre exacto de la tabla
    
    protected $primaryKey = 'vtaid'; // Clave primaria
    public $incrementing = true; // AutoIncrement
    public $timestamps = false; // No tiene timestamps por defecto

    protected $fillable = [
        'VtaNum', 'prfid', 'vtafec', 'vtahor', 'TerId', 'TerNom', 'TerDir', 'TerTel',
        'vtadocref', 'BodId', 'VenId', 'VtaPlazo', 'VtaDesPor', 'VtaSubTot', 'VtaVlrDes', 
        'VtaVlrIva', 'VtaFltVlr', 'VtaRetFte', 'VtaRetIca', 'VtaRetIva', 'VtaImpCon', 
        'VtaEstado', 'VtaRetPor', 'VtaPrecio', 'VtaImpre', 'SucId', 'CtoId', 'CiuId', 
        'SecId', 'EmpId', 'VtaPorDesf', 'VtaFecDes', 'VtaDocAux', 'Acta', 'CjaId', 
        'VtaFecIni', 'VtaFecFin', 'VtaVlrDsf', 'VtaVlrFte', 'VenIdPed', 'VtaVlrCru', 
        'MaeId', 'TprId', 'VehId', 'VEhKm', 'VehTip', 'EstNom', 'DspId', 'MedId', 
        'VtaFecEnt', 'PlnCodTer', 'vtaemevlr', 'vtaobs', 'vtafeest', 'vtaaiuvlr', 'moneid',
        'vtatascam', 'fomid', 'fomvlr', 'vtaajupeso', 'vtadesprom', 'ac_ref', 'vtasbtvlr', 
        'vtaglbvlr', 'rutid', 'vtaotrimp', 'docfecenviosug', 'docemail'
    ];

    /**
     * Relación con Prefijo
     */
    public function prefijo()
    {
        return $this->belongsTo(Prefijo::class, 'prfid', 'prfid');
    }

}
