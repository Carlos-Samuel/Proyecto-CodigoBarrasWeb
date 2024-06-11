@extends('plantillaVanila.vanilla')

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

@section('contenido')
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Registrar usuario en Roomies Finance</h3>
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
                    <form action = "/register" method = "POST">
                        @csrf
                        <div class="form-group">
                            <label for="usuarioCorreo">Usuario</label>
                            <input type="text" class="form-control form-control-sm" name = "name" id="">
                        </div>
                        <div class="form-group">
                            <label for="usuarioCorreo">Email</label>
                            <input type="email" class="form-control form-control-sm" name = "email" id="">
                        </div>
                        <div class="form-group">
                            <label for="usuarioCorreo">Cedula</label>
                            <input type="text" class="form-control form-control-sm" name = "cedula" id="">
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" class="form-control form-control-sm" name = "password" id="">
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Confirmar Contraseña</label>
                            <input type="password" class="form-control form-control-sm" name = "password_confirmation" id="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
