<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\CasoDetalle;
use App\Models\Categoria;
use App\Models\pucComercial;
use App\Models\casos;
use App\Models\ImagenTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketsController extends Controller
{
    public function index(){

        return view('indexTickets');

    }

    public function getDatosDataTable(Request $request)
    {
        $pucComercial = pucComercial::select(['plncod', 'plnom', 'plntip', 'plnniv'])->get();
        
        $casosConDetalles = Caso::with('detalles')->get();

        $casosConDetalles = Caso::select('casos.*', 'casoDetalle.clasificacion', 'casoDetalle.nombre_contacto', 'casoDetalle.numero_contacto', 'casoDetalle.correo_contacto', 'casoDetalle.detalle')
        ->leftJoin('casoDetalle', 'casos.id', '=', 'casoDetalle.id_caso')
        ->get();

        return DataTables::of($casosConDetalles)
        ->addColumn('action', function($row){
            $btn = '<form action="/showTicket/'.$row->id.'" method="POST">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-success">Seleccionar</button>
                    </form>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);        
    }

    public function showTicket(Request $request)
    {

        $idCaso = $request->idCaso;

        $categorias = Categoria::where('activo', true)->get();

        $imagenesCliente = ImagenTicket::all();

        $imagenesAsesor = ImagenTicket::with('usuario')->get();

        $caso = Caso::where('id', $idCaso)->first();

        $caso = Caso::select('casos.*', 'casoDetalle.clasificacion', 'casoDetalle.nombre_contacto', 'casoDetalle.numero_contacto', 'casoDetalle.correo_contacto', 'casoDetalle.detalle')
        ->leftJoin('casoDetalle', 'casos.id', '=', 'casoDetalle.id_caso')
        ->where('casos.id', $idCaso)
        ->first();
        
        return view('ticket')->with('caso', $caso)->with('categorias', $categorias)->with('imagenesCliente', $imagenesCliente)->with('imagenesAsesor', $imagenesAsesor);
        
    }
}
