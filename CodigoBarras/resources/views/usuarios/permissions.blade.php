@extends('partes.plantilla')

@section('styles')
    <style>
        .form-check-label {
            font-size: 1.2em;
        }
        .form-check-input {
            transform: scale(1.5);
            margin-right: 10px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
        }
        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 20px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .btn-primary {
            font-size: 1.1em;
            padding: 10px 20px;
        }
    </style>

@endsection

@extends('partes.plantilla')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Modificar Permisos para {{ $user->nombres }} {{ $user->apellidos }}</h1>
    <form action="{{ route('usuarios.updatePermissions', $user->idUsuarios) }}" method="POST">
        @csrf
        <div class="card shadow">
            <div class="card-body">
                <div class="form-group">
                    @foreach ($permisos as $permiso)
                    <div class="form-check form-check-lg">
                        <input type="checkbox" class="form-check-input" name="permisos[]" value="{{ $permiso->idPermisos }}"
                            {{ $user->permisos->contains($permiso->idPermisos) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $permiso->Descripcion }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Actualizar Permisos</button>
            </div>
        </div>
    </form>
</div>
@endsection

