@extends('partes.plantilla')

@section('content')
<div class="container">
    <h1>Editar Método de Pago</h1>
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
    <form action="{{ route('metodos_de_pago.update', $metodo->idMetodos_de_pago) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="Descripcion" name="Descripcion" value="{{ $metodo->Descripcion }}" required>
        </div>
        <div class="mb-3">
            <label for="Cuenta" class="form-label">Cuenta</label>
            <input type="text" class="form-control" id="Cuenta" name="Cuenta" value="{{ $metodo->Cuenta }}" required>
        </div>
        <div class="mb-3">
            <label for="Imagen" class="form-label">Imagen</label>
            @if($metodo->Imagen)
                <img src="{{ asset('storage/' . $metodo->Imagen) }}" alt="{{ $metodo->Descripcion }}" class="img-thumbnail mb-2" style="max-width: 200px;">
            @endif
            <input type="file" class="form-control" id="Imagen" name="Imagen">
        </div>
        <div class="mb-3">
            <label for="Activo" class="form-label">Activo</label>
            <select class="form-control" id="Activo" name="Activo" required>
                <option value="1" {{ $metodo->Activo ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$metodo->Activo ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="efectivo" class="form-label">¿Es esta la opción de efectivo?</label>
            <select class="form-control" id="Efectivo" name="Efectivo" required>
                <option value="1" {{ $metodo->Efectivo ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$metodo->Efectivo ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
