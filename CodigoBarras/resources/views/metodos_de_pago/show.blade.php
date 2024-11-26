@extends('partes.plantilla')

@section('content')
<div class="container">
    <h1>Detalles del Método de Pago</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $metodo->idMetodos_de_pago }}</td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td>{{ $metodo->Descripcion }}</td>
        </tr>
        <tr>
            <th>Cuenta</th>
            <td>{{ $metodo->Cuenta }}</td>
        </tr>
        <tr>
            <th>Imagen</th>
            <td>
                @if($metodo->Imagen)
                    <img src="{{ asset('storage/' . $metodo->Imagen) }}" alt="{{ $metodo->Descripcion }}" class="img-thumbnail" style="max-width: 200px;">
                @endif
            </td>
        </tr>
        <tr>
            <th>Activo</th>
            <td>{{ $metodo->Activo ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <th>Efectivo</th>
            <td>{{ $metodo->Efectivo ? 'Sí' : 'No' }}</td>
        </tr>
    </table>
    <a href="{{ route('metodos_de_pago.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
