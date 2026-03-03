<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Prefijo;

class VentasController extends Controller
{
    public function show($id)
    {
        $venta = Venta::with([
                'detalles' => function ($q) {
                    $q->select([
                        'VtaDetId',
                        'VtaId',
                        'VtaCant',
                        'VtaVlrUni',
                        'VtaPorDes',
                        'retftepor',
                        'retivapor',
                        'reticapor',
                    ]);
                }
            ])->find($id);
        
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        $prefijoId = $venta->PrfId ?? $venta->prfid ?? null;

        if (!$prefijoId) {
            return response()->json(['message' => 'La venta no tiene prefijo asociado'], 404);
        }

        $prefijo = \App\Models\Prefijo::find($prefijoId);

        if (!$prefijo) {
            return response()->json(['message' => 'Prefijo no encontrado'], 404);
        }

        $venta->setRelation('prefijo', $prefijo);

        $totDescuento = 0.0;
        $totRetFte = 0.0;
        $totRetIva = 0.0;
        $totRetIca = 0.0;
        

        foreach ($venta->detalles as $d) {
            $cant     = (float) ($d->VtaCant ?? 0);
            $vlrUni   = (float) ($d->VtaVlrUni ?? 0);
            $porDes   = (float) ($d->VtaPorDes ?? 0);

            $retFtePor = (float) ($d->retftepor ?? 0);
            $retIvaPor = (float) ($d->retivapor ?? 0);
            $retIcaPor = (float) ($d->reticapor ?? 0);
            
            // if ($d->VtaDetId == 47){
            //     dd($d);
            // }
            

            // Subtotal por ítem
            $subtotalItem = $cant * $vlrUni;

            // Subtotal neto (aplicando descuento):
            $factorDescuento = (100 - $porDes) / 100;
            $subtotalNeto = $subtotalItem * $factorDescuento;

            // Retenciones por ítem
            $totRetFte += $subtotalNeto * ($retFtePor / 100);
            $totRetIva += $subtotalNeto * ($retIvaPor / 100);

            $totRetIca += $subtotalNeto * ($retIcaPor / 1000);
        }

        $venta->vtaretfte = round($totRetFte, 2);
        $venta->vtaretiva = round($totRetIva, 2);
        $venta->vtaretica = round($totRetIca, 2);

        unset($venta->detalles);

        return response()->json($venta);
    }


    public function obtenerCodigo($prefijo, $numero)
    {
        // Obtener el ID del prefijo basado en prfcod
        $prefijoId = Prefijo::where('prfcod', $prefijo)->value('prfid');
    
        if (!$prefijoId) {
            return response()->json(['message' => 'Prefijo no encontrado'], 404);
        }
    
        // Buscar la venta utilizando el prefijoId y VtaNum
        $venta = Venta::where('prfid', $prefijoId)->where('VtaNum', $numero)->first();
    
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }
    
        return response()->json(['vtaid' => $venta->vtaid]);
    }
    

}
