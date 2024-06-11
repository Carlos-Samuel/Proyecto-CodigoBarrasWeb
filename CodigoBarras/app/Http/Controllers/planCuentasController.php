<?php

namespace App\Http\Controllers;

use App\Models\pucComercial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class planCuentasController extends Controller
{
    public function index()
    {
        // Recuperar todas las cuentas ordenadas por su nivel jerárquico
        $cuentas = pucComercial::orderBy('plnniv')->get();

        $cuentas = pucComercial::orderByRaw("CAST(plncod AS CHAR) ASC")->get();


        // Construir la estructura jerárquica de las cuentas
        $listaPuc = [];
        foreach ($cuentas as $cuenta) {
            $nivel = $cuenta->plnniv;
            if (!isset($listaPuc[$nivel])) {
                $listaPuc[$nivel] = [];
            }
            $listaPuc[$nivel][] = $cuenta;
        }

        // Pasar la estructura jerárquica a la vista
        return view('modulos.contabilidad.planCuentas', compact('cuentas'));
    }

    public function importar(Request $request){
        dd('llega al controlador');
        dd($request);
    }
    
}
