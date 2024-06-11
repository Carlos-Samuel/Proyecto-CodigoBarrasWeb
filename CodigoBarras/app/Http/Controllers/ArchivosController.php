<?php

namespace App\Http\Controllers;

use App\Models\ImagenTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArchivosController extends Controller
{
    public function storeImagenAsesor(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName(); 
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/imagenesTickets'), $filename);

            $user = ImagenTicket::create([
                'nombre_original' => $originalName,
                'nombre_guardado' => $filename,
                'tipo_imagen' => 2,
                'tick_id' => $request->input('idTicket'),
                'usuario_id' => $request->input('idUsuario')
            ]);    

            return response()->json(['success' => $filename, 'originalName' => $originalName]);

        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function getImagenesAsesorDataTable(Request $request)
    {

        $imagenesAsesor = ImagenTicket::with('usuario')
        ->where('tick_id', $request->idTicket)
        ->get();


        //$pucComercial = pucComercial::where('plncod', $idTicket)->first(); 

        return DataTables::of($imagenesAsesor)
        ->addColumn('action', function($imagen){
            $btn = "<button type='button' class='btn btn-primary ver-imagen' data-toggle='modal' data-target='#imagenModal' data-imagen='" . asset('uploads/imagenesTickets/' . $imagen->nombre_guardado) . "'>
                        <i class='fas fa-search'></i>
                    </button>";
            return $btn;
        })    
        ->rawColumns(['action'])
        ->make(true);        
    }

}
