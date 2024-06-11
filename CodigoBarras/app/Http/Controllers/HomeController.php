<?php

namespace App\Http\Controllers;

use App\Models\Deudas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        return view('index'); 
    }

    public function dashboard()
    {
        return view('dashboard');
    }

}
