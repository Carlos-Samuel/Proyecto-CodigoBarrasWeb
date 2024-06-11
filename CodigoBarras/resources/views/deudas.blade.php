@extends('partes.plantilla')

@section('content')
    <div class="global-container">
        <h1>Deudas</h1>
        @include('partes.messages')
        <table id="tablaDeudas" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Deuda</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Boton</th>
                </tr>
            </thead>
        </table>
        <br>
        <button id="recargarTabla">Recargar Tabla</button>

    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            var tablaDeudas = $('#tablaDeudas').DataTable({
                ajax: {
                    url: "{{ route('data.tablaDeudas') }}",
                    dataSrc: ''
                },
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'descripcion' },
                    { data: 'monto' },
                    { data: 'estado' },
                    { data: 'boton' },
                ]
            });      

            $('#recargarTabla').click(function() {
                tablaDeudas.ajax.reload(); // Recarga la tabla utilizando AJAX
            });  
            
        });


    </script>
@endsection