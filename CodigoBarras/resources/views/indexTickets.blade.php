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
    </style>
@endsection

@section('content')

    <div class="global-container">
        @if(!empty($mensaje))
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center"></h3>
                <div class="card-text">
                    <div class="alert alert-warning">
                        {{ $mensaje }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        <table id="tablaTickets" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Borrar</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tablaTickets').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('tickets.dataTable') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "nombre_contacto" },
                    { "data": "numero_contacto" },
                    { "data": "correo_contacto" },
                    { "data": "action" }
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