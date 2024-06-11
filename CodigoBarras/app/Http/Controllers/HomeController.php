<?php

namespace App\Http\Controllers;

use App\Models\Deudas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $deudas = Deudas::all();

        $cantidad = 0;

        $deudor = "Josue";

        $mensaje = "";

        foreach ($deudas as $deuda) {

            if (!$deuda->pagado){
                if ($deuda->deudor == 1){
                    $cantidad += $deuda->cantidad;
                }else{
                    $cantidad -= $deuda->cantidad;
                }
            }
        
        }

        if ($cantidad > 0){
            $mensaje = "La deuda de Josue es de: $" . number_format($cantidad, 2, '.', ',');
        }elseif ($cantidad < 0){
            $mensaje = "La deuda de Daniela es de: $" . number_format(-$cantidad, 2, '.', ',');
        }else{
            $mensaje = "Nadie le debe nada a nada";
        }

        return view('index')->with('mensaje', $mensaje); 
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function deudas(){
        return view('deudas'); 
    }

    public function index2(){
        return view('index2'); 
    }

}
