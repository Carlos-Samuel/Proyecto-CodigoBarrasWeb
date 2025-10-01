<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Factura;
use App\Models\PagoFactura;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
    public function create($idFacturaMensajeria = null)
    {
        $metodos = MetodoDePago::where('activo', true)->get();
        return view('facturas.create', compact('metodos', 'idFacturaMensajeria'));
    }    

    public function checkOrCreate(Request $request)
    {
        $codigo = $request->input('codigo');
        $prefijo = $request->input('prefijo');
        $numFactura = $request->input('numFactura');
        $fechaRegistrada = $request->input('fecha');
        //$date = DateTime::createFromFormat('d/m/Y', $fecha);
        //$fechaRegistrada = $date->format('Y-m-d');
        $valorTotal = $request->input('valorTotal');
        

        $factura = Factura::where('NumFactura', $numFactura)
                    ->where('Prefijo', $prefijo)
                    ->where('estado', true)
                    ->first();

        if ($factura) {

            if ($factura->Terminado){
                $pagos = PagoFactura::where('Facturas_idFacturas', $factura->idFacturas)
                ->get(['Metodos_de_pago_idMetodos_de_pago', 'Cantidad'])
                ->toArray();

                return response()->json([
                    'exists' => true,
                    'terminado' => true,
                    'idFacturas' => $factura->idFacturas,
                    'pagos' => $pagos
                ]);
            }else{
                $pagos = PagoFactura::where('Facturas_idFacturas', $factura->idFacturas)
                ->get(['Metodos_de_pago_idMetodos_de_pago', 'Cantidad'])
                ->toArray();
            
                return response()->json([
                    'exists' => true,
                    'terminado' => false,
                    'idFacturas' => $factura->idFacturas,
                    'pagos' => $pagos
                ]);
            }
        } else {
            $nuevaFactura = Factura::create(['vtaid' => $codigo,'Prefijo' => $prefijo, 'NumFactura' => $numFactura, 'fechaRegistrada' => $fechaRegistrada, 'ValorFactura' => $valorTotal]);
            return response()->json([
                'idFacturas' => $nuevaFactura->idFacturas,
                'terminado' => false,
                'exists' => false
            ]);
        }
    }

    public function registarPago(Request $request)
    {
        $Facturas_idFacturas = $request->input('Facturas_idFacturas');
        $Metodos_de_pago_idMetodos_de_pago = $request->input('Metodos_de_pago_idMetodos_de_pago');
        $Cantidad = $request->input('Cantidad');
        $Usuarios_idUsuarios = $request->input('Usuarios_idUsuarios');

        $pago = PagoFactura::where('Facturas_idFacturas', $Facturas_idFacturas)
            ->where('Metodos_de_pago_idMetodos_de_pago', $Metodos_de_pago_idMetodos_de_pago)
            ->first();

        if ($pago) {
            $updated = DB::update('UPDATE pagos_facturas 
                SET Cantidad = ?, Usuarios_idUsuarios = ? 
                WHERE Facturas_idFacturas = ? AND Metodos_de_pago_idMetodos_de_pago = ?', 
            [$Cantidad, $Usuarios_idUsuarios, $Facturas_idFacturas, $Metodos_de_pago_idMetodos_de_pago]);
        } else {
            
            PagoFactura::create(['Facturas_idFacturas' => $Facturas_idFacturas, 'Metodos_de_pago_idMetodos_de_pago' => $Metodos_de_pago_idMetodos_de_pago, 'Cantidad' => $Cantidad, 'Usuarios_idUsuarios' => $Usuarios_idUsuarios]);
        }

        return response()->json([
            'message' => 'Pagos registrados o actualizados exitosamente.'
        ]);
    }

    public function anular(Request $request)
    {
        $idFactura = $request->input('idFactura');

        $factura = Factura::where('idFacturas', $idFactura)
                    ->where('estado', true)
                    ->first();

        if ($factura) {
            $factura->estado = false;
            $factura->save();

            return response()->json([
                'mensaje' => "Factura anulada"
            ]);
        }

        return response()->json([
            'mensaje' => "Factura no encontrada"
        ]);

    }

    public function cerrar(Request $request)
    {
        $idFactura = $request->input('idFactura');

        $factura = Factura::where('idFacturas', $idFactura)
                    ->where('estado', true)
                    ->first();

        if ($factura) {
            $fechaTerminada = Carbon::now('America/Bogota');
            $factura->Terminado = true;
            $factura->fechaTerminada = $fechaTerminada;
            $factura->save();

            return response()->json([
                'mensaje' => "Factura cerrada exitosamente"
            ]);
        }

        return response()->json([
            'mensaje' => "Factura no encontrada"
        ]);

    }

    public function mensajeria(Request $request)
    {
        $idFactura = $request->input('idFactura');

        $factura = Factura::where('idFacturas', $idFactura)
                    ->where('estado', true)
                    ->first();

        if ($factura) {
            $factura->mensajeria = true;
            $factura->save();

            return response()->json([
                'mensaje' => "Envio a mensajeria exitoso"
            ]);
        }

        return response()->json([
            'mensaje' => "Factura no encontrada"
        ]);

    }


    public function indexMensajeria()
    {
        return view('facturas.indexMensajeria');
    }

    public function getDatosDataTableMensajeria()
    {
        $facturas = Factura::where('mensajeria', true)
                            ->where('estado', true)
                            ->where('Terminado', false)
                            ->orderBy('fechaRegistrada', 'asc')
                            ->get();

        return DataTables::of($facturas)
            ->addColumn('editar', function($row){
                $btn = '<a href="'.route("facturas.create", ['idFacturaMensajeria' => $row->vtaid]).'" class="btn btn-sm btn-secondary">Continuar</a>';
                return $btn;
            })
            ->rawColumns(['editar'])
            ->make(true);
                        
    }
    

}
