<?php

namespace App\Http\Controllers;

use App\Models\Paises;
use App\Models\Regimen;
use App\Models\Terceros;
use App\Models\Divipola;
use App\Models\TipoPersona;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;
use Yajra\DataTables\DataTables;

class TercerosController extends Controller
{
    public function index(){

        /*

        Terceros::create([
            'numero_identificacion' => '123456789',
            'tipo_identificacion_id' => 1,
            'digito_verificacion' => '1',
            'primer_nombre' => 'Carlos',
            'segundo_nombre' => 'Samuel',
            'primer_apellido' => 'Medina',
            'segundo_apellido' => 'Pardo',
            'razon_social' => 'Carlos Medina AS',
            'direccion' => 'Calle 123',
            'telefono' => '3210001122',
            'fax' => 'Esto que',
            'celular' => '3002211333',
            'email' => 'juan.perez@example.com',
            'sitio_web' => 'samuel.com',
            'pais_id' => 170, 
            'ciudad' => 50001,
            'regimen_id' => 1,
            'tipo_persona_id' => 1,
            'tipo_tercero' => 1 
        ]);
        */

        return view('modulos/terceros/indexTerceros');

    }
    
    public function getDatosDataTable(Request $request)
    {
        $terceros = Terceros::where('activo', true)->get();

        return DataTables::of($terceros)
        ->addColumn('action', function($row){
            $btn = '<form action="'.route('terceros.show', ['tercero' => $row->id]).'" method="GET">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-success">Seleccionar</button>
                    </form>';
        
            return $btn;
        })
        ->addColumn('borrar', function($row){
            $nombreCompleto = $row->primer_nombre . ' ' . $row->segundo_nombre . ' ' . $row->primer_apellido . ' ' . $row->segundo_apellido;
            
            //Así era antes con un mensaje mas simple, dejo el codigo por si acaso
            $btnAntiguo = '<form action="'.route('terceros.delete', ['tercero' => $row->id]).'" method="POST" >
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" data-nombre="'.$nombreCompleto.'" onclick="return confirm(\'¿Seguro que desea borrar a ' . $nombreCompleto . '?\')">Borrar</button>
                </form>';
            
            $btn = '<form id="delete-form-' . $row->id . '" action="'.route('terceros.delete', ['tercero' => $row->id]).'" method="POST" style="display:none;">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
                <button type="button" class="btn btn-danger" onclick="confirmDelete('.$row->id.',\''.$nombreCompleto.'\')">Borrar</button>';
    

            return $btn;
        })
        
        
        ->rawColumns(['action', 'borrar'])
        ->make(true);        
    }
    
    public function crearTercero(Request $request)
    {
        $paises = Paises::all();
        $ciudades = Divipola::whereNotNull('departamento_id')->get();
        $regimenes = Regimen::all();
        $tiposDocumento = TipoDocumento::all();
        $tiposPersona = TipoPersona::all();
        
        return view('modulos/terceros/crearTercero', compact('paises', 'ciudades', 'regimenes', 'tiposDocumento', 'tiposPersona'));
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero_identificacion' => 'required|unique:terceros,numero_identificacion,',
            'tipo_identificacion_id' => 'required',
            'digito_verificacion' => 'nullable',
            'primer_nombre' => 'required',
            'segundo_nombre' => 'nullable',
            'primer_apellido' => 'required',
            'segundo_apellido' => 'nullable',
            'razon_social' => 'nullable',
            'direccion' => 'required',
            'telefono' => 'nullable',
            'fax' => 'nullable',
            'celular' => 'required',
            'email' => 'required|email',
            'sitio_web' => 'nullable',
            'pais_id' => 'required',
            'ciudad' => 'required',
            'regimen_id' => 'required',
            'tipo_persona_id' => 'required',
            'tipo_tercero' => 'required'
        ]);

        $tercero = Terceros::create($validatedData);

        return redirect()->route('terceros.index')->with('success', 'Tercero creado con éxito');
    }

    public function showTercero(Request $request, $id)
    {
        $tercero = Terceros::findOrFail($id);

        $paises = Paises::all();
        $ciudades = Divipola::whereNotNull('departamento_id')->get();
        $regimenes = Regimen::all();
        $tiposDocumento = TipoDocumento::all();
        $tiposPersona = TipoPersona::all();

        return view('modulos/terceros/crearTercero', compact('tercero', 'paises', 'ciudades', 'regimenes', 'tiposDocumento', 'tiposPersona'));
    }

    public function update(Request $request, $id)
    {

        try {
            $tercero = Terceros::findOrFail($id); 
        
            $validatedData = $request->validate([
                'numero_identificacion' => 'required',
                'tipo_identificacion_id' => 'required|integer',
                'digito_verificacion' => 'nullable|integer',
                'primer_nombre' => 'required|string|max:255',
                'segundo_nombre' => 'nullable|string|max:255',
                'primer_apellido' => 'required|string|max:255',
                'segundo_apellido' => 'nullable|string|max:255',
                'razon_social' => 'nullable|string|max:255',
                'direccion' => 'required|string|max:255',
                'telefono' => 'nullable|string|max:255',
                'fax' => 'nullable|string|max:255',
                'celular' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'sitio_web' => 'nullable|url|max:255',
                'pais_id' => 'required|integer',
                'ciudad' => 'required|string',
                'regimen_id' => 'required|integer',
                'tipo_persona_id' => 'required|integer',
                'tipo_tercero' => 'required|integer'
            ]);

            $tercero->update($validatedData);

            return redirect()->route('terceros.index')->with('success', 'Tercero actualizado con éxito');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $tercero = Terceros::findOrFail($id);
            $tercero->activo = false;
            $tercero->save();
        
            return redirect()->route('terceros.index')->with('success', 'Tercero borrado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('terceros.index')->with('error', 'Error al borrar el tercero');
        }
    }
    

}
