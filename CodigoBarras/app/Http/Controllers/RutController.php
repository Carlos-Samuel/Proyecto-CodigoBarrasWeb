<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutController extends Controller
{
    public function index(){

        return view('obtenerRut');

    }

    public function obtenerRut(Request $request){

        dd("Index de prueba");

        //return redirect('/login')->with('success', 'Account created successfully');

    } 
}
