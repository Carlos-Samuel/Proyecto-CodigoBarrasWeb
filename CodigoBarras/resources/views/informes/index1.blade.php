@extends('partes.plantilla')

@section('styles')
<style>
    .date-input {
        font-size: 1.5em;
        padding: 10px;
        width: 100%;
    }
</style>
@endsection

@section('content')
    <div class="global-container">
        <h1>Consolidado de ventas por medio de pago</h1>
        <p>Las fechas limite son las escaneadas, y los datos consolidados son solo los de estado cerrado que no han sido anulados</p>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>Fecha inicio: </h3>
                <input type="date" id="fInicio" class="date-input" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-6">
                <h3>Fecha final: </h3>
                <input type="date" id="fFinal" class="date-input" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
        </div>
        <hr>
        <br>
        <table id="tablaInforme1" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Metodo de Pago</th>
                    <th>Total</th>
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
                $('#tablaInforme1').DataTable().ajax.reload();
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

            $('#fInicio, #fFinal').on('change', function() {
                if (validateDates()) {
                    reloadTable();
                }
            });
            $('#tablaInforme1').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('informes.dataTableInforme1') }}",
                    "data": function (d) {
                        d.fInicio = $('#fInicio').val();
                        d.fFinal = $('#fFinal').val();
                    }
                },
                "columns": [
                    { "data": "metodo" },
                    { 
                        "data": "total",
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
                            return 'Consolidado de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    {
                        extend: 'csv',
                        title: function() {
                            return 'Consolidado de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    */
                    {
                        extend: 'excel',
                        title: function() {
                            return 'Consolidado de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    {
                        extend: 'pdf',
                        title: function() {
                            return 'Consolidado de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    },
                    {
                        extend: 'print',
                        title: function() {
                            return 'Consolidado de ventas del ' + $('#fInicio').val() + ' al ' + $('#fFinal').val();
                        }
                    }
                ]
            });

        });
    </script>
@endsection
