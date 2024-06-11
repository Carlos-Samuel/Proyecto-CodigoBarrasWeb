<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permiso): Response
    {
        $user = auth()->user();
        //$permisoId = 1; 
        $tienePermiso = $user->permisos()->where('permiso_id', $permiso)->exists(); // Verifica si el usuario tiene el permiso
        
        if ($tienePermiso){
            return $next($request);
        }
        
        return response(view('dashboard')->with('mensaje', 'No tienes permiso para acceder a esta sección'));
        
    }
}
