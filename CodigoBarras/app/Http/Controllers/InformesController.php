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

        return DataTables::of($query)->make(true);
    }

    public function indexInforme2()
    {
        $metodos = MetodoDePago::all();
        return view('informes.index2', compact('metodos'));
    }

    public function getDataTableInforme2(Request $request)
    {
        $fInicio = $request->get('fInicio');
        $fFinal = $request->get('fFinal');
        $metodoDePago = $request->get('metodoDePago');

        $query = PagoFactura::selectRaw('facturas.Prefijo as Prefijo, facturas.NumFactura as NumFactura, facturas.fechaRegistrada as fechaRegistrada, facturas.fechaTerminada as fechaTerminada, facturas.ValorFactura as ValorFactura, pagos_facturas.Cantidad as Cantidad')
            ->join('facturas', 'pagos_facturas.Facturas_idFacturas', '=', 'facturas.idFacturas')
            ->where('facturas.estado', true)
            ->where('facturas.Terminado', true)
            ->where('pagos_facturas.Metodos_de_pago_idMetodos_de_pago', $metodoDePago)
            ->whereBetween('facturas.fechaRegistrada', [$fInicio, $fFinal]);

        return DataTables::of($query)->make(true);
    }

}
