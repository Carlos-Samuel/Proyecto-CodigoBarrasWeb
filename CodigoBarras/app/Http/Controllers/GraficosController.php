<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficosController extends Controller
{
    public function index()
    {
        $data = [1, 2, 3, 4, 5];
        
        return view('grafico', compact('data'));
    }

    public function indexMapa()
    { 
        return view('graficoMapa');
    }

}
