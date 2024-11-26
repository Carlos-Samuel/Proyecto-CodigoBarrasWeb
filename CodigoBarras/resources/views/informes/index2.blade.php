@extends('partes.plantilla')

@section('styles')
<style>
    .input {
        font-size: 1.5em;
        padding: 10px;
        width: 100%;
    }
</style>
@endsection

@section('content')
    <div class="global-container">
        <h1>Detalle de ventas por medio de pago</h1>
        <p>Las fechas limite son las escaneadas, y las facturas a mostrar son solo los de estado cerrado que no han sido anulados</p>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <h3>Fecha inicio: </h3>
                <input type="date" id="fInicio" class="input" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-4">
                <h3>Fecha final: </h3>
                <input type="date" id="fFinal" class="input" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-4">
                <h3>Medio de pago</h3>
                <select id="metodoDePago" class="input">
                    <option value="-1" selected>Todos los métodos</option>
                    @foreach($metodos as $metodo)
                        <option value="{{ $metodo->idMetodos_de_pago }}" {{ $loop->first ? 'selected' : '' }}>
                            {{ $metodo->Descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <br>
        <h2><b>Total:</b> <span id="totalSum"></span></h2>
        <br>
        <table id="tablaInforme2" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Metodo</th>
                    <th>Prefijo</th>
                    <th>Numero Factura</th>
                    <th>Fecha Factura</th>
                    <th>Fecha Registrada</th>
                    <th>Valor total</th>
                    <th>Medio de pago</th>
                </tr>
            </thead>
        </table>
        <br>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {



            function reloadTable() {
                $('#tablaInforme2').DataTable().ajax.reload();
            }

            function validateDates() {
                let fInicio = $('#fInicio').val();
                let fFinal = $('#fFinal').val();

                if (fInicio && fFinal) {
                    if (fInicio > fFinal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de fecha',
                            text: 'La fecha de inicio no puede ser posterior a la fecha final.',
                        });
                        return false;
                    }
                }
                return true;
            }

            $('#fInicio, #fFinal, #metodoDePago').on('change', function() {
                if (validateDates()) {
                    reloadTable();
                }
            });

            $('#tablaInforme2').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('informes.dataTableInforme2') }}",
                    "data": function (d) {
                        d.fInicio = $('#fInicio').val();
                        d.fFinal = $('#fFinal').val();
                        d.metodoDePago = $('#metodoDePago').val();
                    }
                },
                "columns": [
                    { "data": "Metodo" },
                    { "data": "Prefijo" },
                    { "data": "NumFactura" },
                    { "data": "fechaRegistrada" },
                    { "data": "fechaTerminada" },
                    { 
                        "data": "ValorFactura",
                        "render": $.fn.dataTable.render.number(',', '.', 0, '$')
                    },
                    { 
                        "data": "Cantidad",
                        "render": $.fn.dataTable.render.number(',', '.', 0, '$')
                    }
                ],
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                },
                "dom": 'Bfrtip',
                "buttons": [
                    /*
                    {
                        extend: 'copy',
                        title: function() {
                            return 'Detalle de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    {
                        extend: 'csv',
                        title: function() {
                            return 'Detalle de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    */
                    {
                        extend: 'excel',
                        title: function() {
                            return 'Detalle de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    {
                        extend: 'pdf',
                        title: function() {
                            return 'Detalle de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    {
                        extend: 'print',
                        title: function() {
                            return 'Detalle de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    }
                ],
                "pageLength": 100,
                "footerCallback": function (row, data, start, end, display) {
                let total = 0;

                for (let i = 0; i < data.length; i++) {
                    let valor = parseFloat(data[i].Cantidad) || 0;
                    total += valor;
                }

                $('#totalSum').text('$' + total.toLocaleString('en-US', { minimumFractionDigits: 0 }));
            }
            });



        });
    </script>
@endsection