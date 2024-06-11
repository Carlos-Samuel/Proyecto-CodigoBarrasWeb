@extends('partes.plantilla')

@section('content')
<div class="container">
    <h1>Métodos de Pago</h1>
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
    <br>
    <a href="{{ route('metodos_de_pago.create') }}" class="btn btn-primary">Crear Método de Pago</a>
    <br>
    <br>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Cuenta</th>
                <th>Imagen</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($metodos as $metodo)
            <tr>
                <td>{{ $metodo->idMetodos_de_pago }}</td>
                <td>{{ $metodo->Descripcion }}</td>
                <td>{{ $metodo->Cuenta }}</td>
                <td>
                    <img src="{{ asset('storage/' . $metodo->Imagen) }}" alt="Imagen del método de pago" style="width: 50px; height: 50px; object-fit: cover;">
                </td>
                <td>{{ $metodo->Activo ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('metodos_de_pago.show', $metodo->idMetodos_de_pago) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('metodos_de_pago.edit', $metodo->idMetodos_de_pago) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('metodos_de_pago.destroy', $metodo->idMetodos_de_pago) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>

</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('usuarios.dataTable') }}",
                "columns": [
                    { "data": "idUsuarios" },
                    { "data": "cedula" },
                    { "data": "nombres" },
                    { "data": "apellidos" },
                    { "data": "activar" },
                    { "data": "editar" },
                    { "data": "permisos" }
                ],
                "createdRow": function(row, data, dataIndex) {
                    if (data.plncod%2 == 0) {
                        $(row).addClass('row-highlight');
                    }
                },
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                }
            });
        });
    </script>
@endsection