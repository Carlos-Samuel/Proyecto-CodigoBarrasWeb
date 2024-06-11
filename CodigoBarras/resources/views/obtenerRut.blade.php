@extends('partes.plantilla')

@section('styles')
    <style>
        .global-container{
            height:100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>
@endsection

@section('content')
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Obtener Rut del usuario</h3>
                <div class="card-text">
                @if (isset($errors) && count($errors) > 0)
                    <div class = "alert alert-danger">
                        <ul class = "list-unstyled mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>                
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form action = "/formularioObtenerRut" method = "POST">
                        @csrf
                        <div class="form-group">
                            <label for="usuarioCorreo">Tipo de identificacion</label>
                            <input type="text" class="form-control form-control-sm" name = "tipoIdentificacion" id="tipoIdentificacion">
                        </div>
                        <div class="form-group">
                            <label for="usuarioCorreo">Identificacion</label>
                            <input type="number" class="form-control form-control-sm" name = "identificacion" id="identificacion">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
