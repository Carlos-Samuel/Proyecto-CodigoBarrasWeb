<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDet extends Model
{
    use HasFactory;

    protected $connection = 'mysql_agil'; // Se conecta a la segunda base de datos
    protected $table = 'ventasdet'; // Nombre exacto de la tabla

    protected $primaryKey = 'VtaDetId'; // Clave primaria
    public $incrementing = true; // AutoIncrement
    public $timestamps = false; // No tiene timestamps por defecto

    protected $fillable = [
        'VtaId',
        'VtaConse',
        'ProId',
        'ProNom',
        'BodId',
        'VtaCant',
        'VtaVlrUni',
        'VtaCanDEv',
        'VtaCanVale',
        'VtaPorDes',
        'VtaVlrDes',
        'IvaID',
        'VtaPorIva',
        'VtaCosto',
        'VtaEstado',
        'MovId',
        'MovCnsId',
        'MovCan',
        'EmpId',
        'ProUnd',
        'VtaVlrDev',
        'ProUndBas',
        'VtaCanBas',
        'VtaImpCon',
        'VenId',
        'ProUndCja',
        'SinIva',
        'PorDesAdi',
        'TipDesAdi',
        'VtaCanUnd',
        'VtaVlrUnd',
        'VtaCanCja',
        'VtaMetUnd',
        'IvaCmb',
        'VtaCanMez',
        'VtaCtoMez',
        'RetId',
        'VlrUniGen',
        'prodet',
        'retftepor',
        'vtafianza',
        'vtacerti',
        'vtagasto',
        'reticapor',
        'retivapor',
        'movnum',
        'prfcodmov',
        'movtip',
        'vtaporicn',
        'biencubierto',
        'vtapordes2',
        'ac_impor',
        'vtasbtvlr',
        'vtaglbvlr',
        'teridingrrec',
        'vtavlruning',
        'rettrspor',
        'vtaradicanum',
        'vtaremesanum',
        'vtatranscant',
        'vtatransunidad',
        'undid'
    ];

    /**
     * Relación con Venta (cabecera)
     */
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'VtaId', 'vtaid');
    }
}
