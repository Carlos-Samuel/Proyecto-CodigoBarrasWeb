<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\caso;
use App\Models\casoDetalle;
use Illuminate\Support\Carbon;

class casoscontroller extends Controller
{
    public function registrarCaso(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'numero' => 'required|numeric',
            'nombre' => 'required|string',
            'frase' => 'required|string',
        ]);

        // Crear un nuevo caso con los datos del formulario
        $caso = new Caso();
        $caso->fecha= Carbon::now();
        $caso->estado=0;
        // Aquí puedes asignar valores para otras columnas si es necesario

        // Guardar el caso en la base de datos
        $caso->save();

        $casoDetalle=new casoDetalle;
        $casoDetalle->nombre_contacto=$request->nombre;
        $casoDetalle->numero_contacto=$request->numero;
        $casoDetalle->clasificacion = 1;
        $casoDetalle->correo_contacto = "correoDefecto@gmail.com";
        $casoDetalle->detalle = "Creo que aquí va la descripcion";
        $casoDetalle->id_caso = $caso->id;

        $casoDetalle->save();

        // Redireccionar a una página de éxito o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'El caso ha sido registrado correctamente.');
    }
}
