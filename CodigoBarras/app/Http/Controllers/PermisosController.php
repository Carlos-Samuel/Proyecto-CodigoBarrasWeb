<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class PermisosController extends Controller
{
    //Todo este codigo son pruebas de permisos
    public function index(){
        $user = auth()->user();
        //$user = User::find(1); 
        $permisoId = 1; 
        $tienePermiso = $user->permisos()->where('permiso_id', $permisoId)->exists(); // Verifica si el usuario tiene el permiso
        dd($tienePermiso);
    }
}
