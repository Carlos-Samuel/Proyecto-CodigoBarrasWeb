@extends('partes.plantilla')

@section('content')
<div class="container">
    <h1>Crear Método de Pago</h1>
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
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
