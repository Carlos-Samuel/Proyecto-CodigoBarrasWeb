<?php

namespace App\Helpers;

class HelperPer
{
    /*
        Codigo que usabamos para llamar esta función (Era de pruebas)

        @foreach(filtrar($cuentas, 1) as $cuenta)
            <p>Código: {{ $cuenta->plncod }}, Nivel: {{ $cuenta->plnniv }}</p>
            @foreach(filtrar($cuentas, 2, $cuenta) as $subcuenta)
                <p>&nbsp;&nbsp;Código: {{ $subcuenta->plncod }}, Nivel: {{ $subcuenta->plnniv }}</p>
                @foreach(filtrar($cuentas, 3, $subcuenta) as $subsubcuenta)
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;Código: {{ $subsubcuenta->plncod }}, Nivel: {{ $subsubcuenta->plnniv }}</p>
                    @foreach(filtrar($cuentas, 4, $subsubcuenta) as $subsubsubcuenta)
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código: {{ $subsubsubcuenta->plncod }}, Nivel: {{ $subsubsubcuenta->plnniv --}}</p>
                    @endforeach
                @endforeach
            @endforeach

        @endforeach

    
    function filtrar($listaPuc, $nivel, $padre = null) {
        $cuentasFiltradas = [];
        foreach ($listaPuc as $cuenta) {
            if ($cuenta->plnniv == $nivel) {
                if ($padre !== null) {
                    if (esPadre($cuenta, $padre)) {
                        $cuentasFiltradas[] = $cuenta;
                        unset($cuenta);
                    }
                } else {
                    $cuentasFiltradas[] = $cuenta;
                    unset($cuenta);
                }
            }
        }
        return $cuentasFiltradas;
    }

    function esPadre($hijo, $padre){

        $codPadre = strval($padre->plncod);

        if($padre->plnniv == 1){
            $numCaracteres = 1;
            
        }else{
            $numCaracteres = 2 * ($padre->plnniv-1);
            $codPadre = $padre->plncod;
        }
        
        $corteDatos = substr(strval($hijo->plncod), 0, $numCaracteres);

        
        //echo "El corte de datos es: ". $corteDatos . " hijo: " . $hijo->plncod . " padre: " . $codPadre . " resultado: ";
        //if ($hijo->plnniv == ($padre->plnniv + 1) && $corteDatos == $codPadre){
        //    echo "1";
        //}else{
        //    echo "0";
        //}
        //echo "<br>";
        
        //return ($hijo->plnniv == ($padre->plnniv + 1) && $corteDatos == $codPadre);
    }

    function miFuncionGlobal() {
        return "algo";
    }

    function checkPermiso($permiso)
    {
        // Aquí implementas tu lógica
        return $numero > 10; // Ejemplo de lógica
    }
    */

    public static function checkPermisos($permiso)
    {
        try {
            $user = auth()->user();
            
            if ($user === null) {
                return false;
            }
        
            $result = $user->permisos()->where('permiso_id', $permiso)->exists();
            return $result;
        } catch (\Exception $e) {
            return false;
        }
                
   }
}