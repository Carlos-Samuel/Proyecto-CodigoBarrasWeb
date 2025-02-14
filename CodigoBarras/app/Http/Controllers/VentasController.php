<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Prefijo;

class VentasController extends Controller
{
    public function show($id)
    {
        $venta = Venta::with('prefijo')->find($id);
        
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }
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
