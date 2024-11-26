@extends('partes.plantilla')

@section('content')
<div class="container">
    <h1>Crear Método de Pago</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('metodos_de_pago.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="Descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="Descripcion" name="Descripcion" required>
        </div>
        <div class="mb-3">
            <label for="Cuenta" class="form-label">Cuenta</label>
            <input type="text" class="form-control" id="Cuenta" name="Cuenta" required>
        </div>
        <div class="mb-3">
            <label for="Imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="Imagen" name="Imagen">
        </div>
        <div class="mb-3">
            <label for="Activo" class="form-label">Activo</label>
            <select class="form-control" id="Activo" name="Activo" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="Efectivo" class="form-label">¿Es esta la opción de efectivo?</label>
            <select class="form-control" id="Efectivo" name="Efectivo" required>
                <option value="1">Sí</option>
                <option value="0" selected>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
