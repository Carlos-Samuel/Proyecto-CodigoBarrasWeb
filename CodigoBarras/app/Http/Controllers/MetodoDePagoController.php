<?php
namespace App\Http\Controllers;

use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MetodoDePagoController extends Controller
{
    public function index()
    {
        $metodos = MetodoDePago::all();
        return view('metodos_de_pago.index', compact('metodos'));
    }

    public function create()
    {
        return view('metodos_de_pago.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Descripcion' => 'required|max:45',
            'Cuenta' => 'required|max:45',
            'Imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Activo' => 'required|boolean',
            'Efectivo' => 'required|boolean',
        ]);

        if ($request->Efectivo) {
            $metodoExistente = MetodoDePago::where('Efectivo', true)->first();
            if ($metodoExistente) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Solo puede existir un método de pago como Efectivo.');
            }
        }
    

        $data = $request->all();
        if ($request->hasFile('Imagen')) {
            $data['Imagen'] = $request->file('Imagen')->store('imagenes', 'public');
        }

        MetodoDePago::create($data);

        return redirect()->route('metodos_de_pago.index')->with('success', 'Método de pago creado con éxito.');
    }

    public function show($id)
    {
        $metodo = MetodoDePago::find($id);
        return view('metodos_de_pago.show', compact('metodo'));
    }

    public function edit($id)
    {
        $metodo = MetodoDePago::find($id);
        return view('metodos_de_pago.edit', compact('metodo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Descripcion' => 'required|max:45',
            'Cuenta' => 'required|max:45',
            'Imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Activo' => 'required|boolean',
            'Efectivo' => 'required|boolean',
        ], [
            'Descripcion.required' => 'La descripción es obligatoria.',
            'Descripcion.max' => 'La descripción no puede tener más de 45 caracteres.',
            'Cuenta.required' => 'La cuenta es obligatoria.',
            'Cuenta.max' => 'La cuenta no puede tener más de 45 caracteres.',
            'Imagen.image' => 'La imagen debe ser un archivo válido.',
            'Imagen.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg, gif o svg.',
            'Imagen.max' => 'La imagen no puede ser mayor a 2048 KB.',
            'Activo.required' => 'El campo activo es obligatorio.',
            'Activo.boolean' => 'El campo activo debe ser verdadero o falso.',
            'Efectivo.required' => 'El campo efectivo es obligatorio.',
            'Efectivo.boolean' => 'El campo efectivo debe ser verdadero o falso.',
        ]);

        if ($request->Efectivo) {
            $metodoExistente = MetodoDePago::where('Efectivo', true)->where('idMetodos_de_pago', '!=', $id)->first();
            if ($metodoExistente) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Solo puede existir un método de pago como Efectivo.');
            }
        }
    

        $metodo = MetodoDePago::find($id);
        $data = $request->all();
        if ($request->hasFile('Imagen')) {
            if ($metodo->Imagen) {
                Storage::disk('public')->delete($metodo->Imagen);
            }
            $data['Imagen'] = $request->file('Imagen')->store('imagenes', 'public');
        }

        $metodo->update($data);

        return redirect()->route('metodos_de_pago.index')->with('success', 'Método de pago actualizado con éxito.');
    }

    public function destroy($id)
    {
        $metodo = MetodoDePago::find($id);
        if ($metodo->Imagen) {
            Storage::disk('public')->delete($metodo->Imagen);
        }
        $metodo->delete();

        return redirect()->route('metodos_de_pago.index')->with('success', 'Método de pago eliminado con éxito.');
    }
}
