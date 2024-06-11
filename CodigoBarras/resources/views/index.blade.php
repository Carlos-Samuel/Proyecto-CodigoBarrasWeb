@extends('partes.plantilla')

@section('content')
    <div class="global-container">
        
        @auth
            <p>Bienvenido a Roomies Finance {{auth()->user()->name ?? auth()->user()->username}}. </p>
            <br>
            <h3>{{ $mensaje }}</h3>
            <br>
            <a href = "/pagar"><button class="btn btn-success btn-block">Pagar todo</button></a>

        @endauth

        @guest
            <p>Para ver el contenido <a href="/login">inicia sesion</a></p>
        @endguest
    </div>
@endsection
