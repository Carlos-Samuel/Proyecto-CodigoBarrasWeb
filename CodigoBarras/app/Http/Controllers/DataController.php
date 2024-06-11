<?php

namespace App\Http\Controllers;

use App\Models\Deudas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DataController extends Controller
{
    public function tablaDeudas()
    {
        $data = Deudas::all();

        $datatableData = [];

        foreach ($data as $deuda) {

            if ($deuda->deudor == 1){
                $nombre = "Josue";
            }else{
                $nombre = "Daniela";
            }

            if ($deuda->pagado){
                $pagado = "Pagado";
            }else{
                $pagado = "Sin pagar";
            }

            $boton = '<a href="' . route('deuda.edit', $deuda->id) . '" class="btn btn-primary">Editar</a>
            <a href="' . route('deuda.destroy', $deuda->id) . '" class="btn btn-danger">Borrar</a>';
            
            $fila = [
                'id' => $deuda->id,
                'nombre' => $nombre,
                'monto' => '$' . number_format($deuda->cantidad, 2),
                'descripcion' => $deuda->descripcion,
                'estado' => $pagado,
                'boton' => $boton,
            ];
    
            $datatableData[] = $fila;
        }
    
        return response()->json($datatableData);
    }
    
    public function edit($id)
    {
        $deuda = Deudas::find($id);

        return view('editDeuda', compact('deuda'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|in:1,2',
            'monto' => 'required|numeric',
            'fecha' => 'required|string',
            'pagado' => 'required',
        ]);

        if ($validatedData['pagado'] == "1"){
            $pagado = true;
        }else{
            $pagado = false;
        }
    
        $deuda = Deudas::findOrFail($id);
    
        $deuda->deudor = $validatedData['nombre'];
        $deuda->cantidad = $validatedData['monto'];
        $deuda->descripcion = $validatedData['fecha'];
        $deuda->pagado = $pagado;
        
        $deuda->save();
    
        return view('deudas')->with('success', 'Los cambios se han guardado correctamente.');
    }

    public function destroy($id)
    {
        $deuda = Deudas::findOrFail($id);
        $deuda->delete();
        return view('deudas')->with('success', 'El registro se ha borrado correctamente.');
    }

    public function create()
    {
        return view('crearDeuda');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|in:1,2',
            'monto' => 'required|numeric',
            'descripcion' => 'required',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.in' => 'Seleccione un deudor',
            'monto.required' => 'El campo Monto es obligatorio.',
            'monto.numeric' => 'El campo Monto debe ser un número.',
            'descripcion.required' => 'El campo Descripcion es obligatorio.',
        ]);

        // Crea una nueva instancia del modelo Deudas y guarda los datos
        $deuda = new Deudas();
        $deuda->deudor = $request->nombre;
        $deuda->cantidad = $request->monto;
        $deuda->descripcion = $request->descripcion;
        $deuda->save();

        // Redirige a una página de éxito o cualquier otra acción que desees
        return view('deudas')->with('success', 'Deuda creada correctamente');
    }

    public function pagar(){

        Deudas::where('pagado', false)->update(['pagado' => true]);
        return redirect('/home');

    }
 
}
