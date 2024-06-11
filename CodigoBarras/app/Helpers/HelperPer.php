<?php

namespace App\Helpers;

class HelperPer
{
    public static function checkPermisos($permiso)
    {
        try {
            $user = auth()->user();
            
            if ($user === null) {
                return false;
            }
        
            $result = $user->permisos()->where('Permisos_idPermisos', $permiso)->exists();
            return $result;
        } catch (\Exception $e) {
            return false;
        }
                
   }
}