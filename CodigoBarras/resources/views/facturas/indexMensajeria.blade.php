@extends('partes.plantilla')

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
        <br>
        <table id="tablaUsuarios" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>NumFactura</th>
                    <th>Prefijo</th>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th>Editar</th>
                </tr>
            </thead>
        </table>
        <br>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('facturas.datatableMensajeria') }}",
                "columns": [
                    { "data": "NumFactura" },
                    { "data": "Prefijo" },
                    { 
                        "data": "fechaRegistrada",
                        "render": function(data, type, row) {
                            if (data) {
                                let fecha = new Date(data);
                                let year = fecha.getFullYear();
                                let month = ('0' + (fecha.getMonth() + 1)).slice(-2);
                                let day = ('0' + fecha.getDate()).slice(-2);
                                return `${year}-${month}-${day}`; // Formato aaaa-mm-dd
                            }
                            return '';
                        }
                    },
                    { 
                        "data": "ValorFactura",
                        "render": function(data, type, row) {
                            if (data) {
                                return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(data);
                            }
                            return '';
                        }
                    },
                    { "data": "editar" }
                ],
                "createdRow": function(row, data, dataIndex) {
                    if (data.plncod % 2 == 0) {
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