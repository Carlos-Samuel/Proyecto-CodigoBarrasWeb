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
        ]);

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
        ]);

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
