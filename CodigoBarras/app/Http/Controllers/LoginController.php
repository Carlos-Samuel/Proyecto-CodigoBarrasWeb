<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function show(){
        if (Auth::check()){
            return redirect('/home');
        }
        return view('login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)){
            return redirect()->to('/login')->withErrors('Usuario o contraseña incorrectos');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if (!$user->activo) {
            return redirect()->to('/login')->withErrors(['message' => 'Tu cuenta está desactivada. Por favor, contacta al administrador.']);
        }    

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user){
        return redirect('/home');
    }
}
