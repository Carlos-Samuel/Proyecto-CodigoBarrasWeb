@extends('partes.plantilla')

@section('styles')
    <style>
        .global-container{
            height:100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #tablaTickets thead {
            background-color: #82c6ff;
            color: #ffffff;
        }

        #tablaTickets td, #tablaTickets th {
            padding: 8px; 
        }

        .row-highlight td {
            background-color: #ffcccc !important;
        }

        #tablaTickets tr:nth-child(even){
            background-color: #f2f2f2;
        }

        .global-container {
            display: flex;
            flex-direction: column;
        }

        .crear-btn-container {
            display: flex;        /* Utiliza flexbox para alinear los elementos dentro */
            justify-content: flex-end; /* Alinea los elementos a la derecha */
            margin-bottom: 20px; /* Espacio entre el botón y el mensaje o la tabla */
        }

        .table-container {
            margin-top: 20px; /* Espacio entre el mensaje y la tabla, si el mensaje está presente */
        }
        
        .alert-success {
            color: green;
            background-color: #D4EDDA;
            border-color: #C3E6CB;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

    </style>
@endsection

@section('content')

<div class="global-container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Tabla debajo -->
    <div class="table-container">
        <table id="tablaTickets" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
        </table>
    </div>
    
    <br>
    
    <div class="crear-btn-container">
        <a href="{{ route('terceros.crear') }}" class="btn btn-primary">Registrar Tercero</a>
    </div>
</div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tablaTickets').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('terceros.dataTable') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "numero_identificacion" },
                    { "data": "primer_nombre" },
                    { "data": "email" },
                    { "data": "action" },
                    { "data": "borrar" }
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

        function confirmDelete(id, nombre) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Seguro que deseas borrar a " + nombre + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection