@extends('partes.plantilla')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
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
        <form action="{{ route('usuarios.update', $user->idUsuarios) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control form-control-sm" name="cedula" id="cedula" value="{{ old('cedula', $user->cedula) }}" readonly>
                @if ($errors->has('cedula'))
                    <span class="text-danger">{{ $errors->first('cedula') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="nombre">Nombres</label>
                <input type="text" class="form-control form-control-sm" name="nombres" id="nombres" value="{{ old('nombres', $user->nombres) }}">
                @if ($errors->has('nombres'))
                    <span class="text-danger">{{ $errors->first('nombres') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="apellido">Apellidos</label>
                <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" value="{{ old('apellidos', $user->apellidos) }}">
                @if ($errors->has('apellidos'))
                    <span class="text-danger">{{ $errors->first('apellidos') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="correo">Email</label>
                <input type="email" class="form-control form-control-sm" name="correo" id="correo" value="{{ old('correo', $user->correo) }}">
                @if ($errors->has('correo'))
                    <span class="text-danger">{{ $errors->first('correo') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control form-control-sm" name="password" id="password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control form-control-sm" name="password_confirmation" id="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
