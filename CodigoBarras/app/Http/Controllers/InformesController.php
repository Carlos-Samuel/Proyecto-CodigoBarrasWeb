<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\MetodoDePago;
use App\Models\PagoFactura;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InformesController extends Controller
{

    public function indexInforme1()
    {
        return view('informes.index1');
    }

    public function getDataTableInforme1(Request $request)
    {
        $fInicio = $request->get('fInicio');
        $fFinal = $request->get('fFinal');
    
        $query = PagoFactura::selectRaw('metodos_de_pago.Descripcion as metodo, SUM(pagos_facturas.Cantidad) as total')
            ->join('metodos_de_pago', 'pagos_facturas.Metodos_de_pago_idMetodos_de_pago', '=', 'metodos_de_pago.idMetodos_de_pago')
            ->join('facturas', 'pagos_facturas.Facturas_idFacturas', '=', 'facturas.idFacturas')
            ->where('facturas.estado', true)
            ->where('facturas.Terminado', true)
            ->whereBetween('facturas.fechaRegistrada', [$fInicio, $fFinal])
            ->groupBy('metodos_de_pago.Descripcion');
    
        $dataTable = DataTables::of($query)
            ->addColumn('total', function ($row) {
                return $row->total;
            })
            ->make(true);
    
        $data = $dataTable->getData();
        $totalSum = collect($data->data)->sum('total');
    
        $data->data[] = [
            'metodo' => 'Total',
            'total' => $totalSum
        ];
    
        return response()->json($data);
    }
    

    public function indexInforme2()
    {
        $metodos = MetodoDePago::all();
        return view('informes.index2', compact('metodos'));
    }

    public function getDataTableInforme2(Request $request)
    {
        $metodoDePago = $request->get('metodoDePago');
        $fInicio = $request->get('fInicio');
        $fFinal = $request->get('fFinal');
    
        $query = PagoFactura::selectRaw(
            'metodos_de_pago.Descripcion as Metodo, 
            facturas.Prefijo as Prefijo, 
            facturas.NumFactura as NumFactura, 
            DATE(facturas.fechaRegistrada) as fechaRegistrada, 
            facturas.fechaTerminada as fechaTerminada, 
            facturas.ValorFactura as ValorFactura, 
            pagos_facturas.Cantidad as Cantidad'
        )
        ->join('facturas', 'pagos_facturas.Facturas_idFacturas', '=', 'facturas.idFacturas')
        ->join('metodos_de_pago', 'pagos_facturas.Metodos_de_pago_idMetodos_de_pago', '=', 'metodos_de_pago.idMetodos_de_pago')
        ->where('facturas.estado', true)
        ->where('facturas.Terminado', true)
        ->whereBetween('facturas.fechaRegistrada', [$fInicio, $fFinal]);
    
        if ($metodoDePago != -1) {
            $query->where('pagos_facturas.Metodos_de_pago_idMetodos_de_pago', $metodoDePago);
        }
    
        $query->orderBy('Metodo');
    
        $dataTable = DataTables::of($query)
            ->make(true);
    
        $data = $dataTable->getData();
        $totalSum = collect($data->data)->sum('Cantidad');
        
        /*
        $data->data[] = [
            'Metodo' => 'Total',
            'Prefijo' => '',
            'NumFactura' => '',
            'fechaRegistrada' => '',
            'fechaTerminada' => '',
            'ValorFactura' => '',
            'Cantidad' => $totalSum
        ];
        */
    
        return response()->json($data);
    }
    
    

}
