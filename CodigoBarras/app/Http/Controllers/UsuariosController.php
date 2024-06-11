<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\EditarUserRequest;
use Yajra\DataTables\DataTables;

class UsuariosController extends Controller
{
 
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', compact('users'));
    }
 
    public function create(){

        //if (Auth::check()){
        //    return redirect('/home');
        //}
        return view('usuarios/create');

    }
 
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'cedula' => $request->input('cedula'),
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'correo' => $request->input('correo'),
            'password' => Hash::make($request->input('password')),
        ]);
    
        return redirect('/login')->with('success', 'Account created successfully');
    }

    public function getDatosDataTable()
    {
        $users = User::all();
        return DataTables::of($users)
            ->addColumn('activar', function($row){
                $activo = $row->activo ? "Desactivar" : "Activar";
                $btn = '<form action="'.route("usuarios.toggle", $row->idUsuarios).'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            <button type="submit" class="btn btn-sm btn-warning">'
                                .$activo.
                            '</button>
                        </form>';
                return $btn;
            })
            ->addColumn('editar', function($row){
                $btn = '<a href="'.route("usuarios.edit", $row->idUsuarios).'" class="btn btn-sm btn-primary">Editar</a>';
                return $btn;
            })
            ->addColumn('permisos', function($row){
                $btn = '<a href="'.route("usuarios.permissions", $row->idUsuarios).'" class="btn btn-sm btn-secondary">Permisos</a>';
                return $btn;
            })
            ->rawColumns(['activar', 'editar', 'permisos'])
            ->make(true);
    }
    
    
    public function toggle($id)
    {
        $user = User::findOrFail($id);
        $user->activo = !$user->activo;
        $user->save();
        return redirect()->route('usuarios.index')->with('success', 'Estado del usuario actualizado correctamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('usuarios.edit', compact('user'));
    }

    public function update(EditarUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->correo = $request->input('correo');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function permissions($id)
    {
        $user = User::findOrFail($id);
        $permisos = Permiso::all();
        return view('usuarios.permissions', compact('user', 'permisos'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->permisos()->sync($request->input('permisos', []));
        return redirect()->route('usuarios.index')->with('success', 'Permisos actualizados correctamente.');
    }

}
