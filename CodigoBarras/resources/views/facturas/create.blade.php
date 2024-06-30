@extends('partes.plantilla')

@section('title', 'Facturas')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="container">
                <input type="hidden" name="usuarioId" id="usuarioId" value="{{ Auth::id() }}">
                <input id = "codigoFacturaText" type="text" class="form-control" style="height: 60px; font-size: 30px;" placeholder = "Escanear Factura">
                <br>
                <button id = "escanearBoton" class="btn btn-primary btn-block mb-3" style="height: 80px; font-size: 40px;" >Descargar Factura</button>
                <br>
                <h1 class="text-center">Datos Factura</h1>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Prefijo</h2>
                    </div>
                    <div class="col-md-6">
                        <input id = "prefijoText" type="text" class="form-control" style="height: 50px; font-size: 30px;" readOnly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h2># Factura</h2>
                    </div>
                    <div class="col-md-6">
                        <input id = "numeroFacturaText" type="text" class="form-control" style="height: 50px; font-size: 30px;" readOnly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Fecha</h2>
                    </div>
                    <div class="col-md-6">
                        <input id = "fechaText" type="text" class="form-control" style="height: 50px; font-size: 30px;" readOnly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Valor total</h2>
                    </div>
                    <div class="col-md-6">
                        <input id = "valorTotalText" type="text" class="form-control" style="height: 50px; font-size: 30px;" readOnly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Pendiente</h2>
                    </div>
                    <div class="col-md-6">
                        <input id = "pendienteText" type="text" class="form-control" style="height: 50px; font-size: 30px;" readOnly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <button id = "botonAnular" class="btn btn-danger btn-block mb-3" style="height: 80px; font-size: 40px;" disabled>Anular Factura</button>
                    </div>
                    <div class="col-md-6">
                        <button id = "botonCerrar" class="btn btn-primary btn-block mb-3" style="height: 80px; font-size: 40px;" disabled>Cerrar Factura</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="text-center">Medios de pago</h1>
            <br>
            @foreach ($metodos as $metodo)
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $metodo->Imagen) }}" alt="Imagen del método de pago" style="height: 100px; object-fit: cover;" data-id="{{ $metodo->idMetodos_de_pago }}" class="metodo-imagen">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control entrada-pago" data-id="{{ $metodo->idMetodos_de_pago }}" style="height: 100px; font-size: 40px;" disabled>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>
    <script>
        $(document).ready(function() {

            $('#codigoFacturaText').focus();

            var idFactura = "";
            var total = 0;
            var pagado = 0;
            var idUsuario = $('#usuarioId').val();
            var terminado = false;
            /*
            $('.entrada-pago').each(function() {
                new Cleave(this, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    prefix: '$ ',
                    numeralPositiveOnly: true,
                    rawValueTrimPrefix: true
                });
            });
            */
            $('.entrada-pago').on('blur', function() {
                var rawValue = $(this).val().replace(/[^\d.-]/g, '');

                if (rawValue == null || rawValue == undefined || rawValue == ''){
                    rawValue = 0;
                }

                var metodoId = $(this).data('id');
                console.log('Valor numérico: ' + rawValue + ', ID del método de pago: ' + metodoId + ' el idFactura: ' + idFactura + ' al Usuario: ' + idUsuario);

                var sumaTemporalPagos = 0;

                $('.entrada-pago').each(function() {
                    var crudo = $(this).val().replace(/[^\d,-]/g, '');
                    if (crudo) {
                        sumaTemporalPagos += parseFloat(crudo);
                    }
                });

                if (sumaTemporalPagos > total){
                    Swal.fire({
                            icon: 'error',
                            title: 'Total superado',
                            text: 'Pagos registrados superan el total de la factura',
                    });

                    $(this).val('');

                    sumarPagos();
                    
                    return ; 
                }else{
                    $.ajax({
                        url: '/pago-factura/register',
                        method: 'POST',
                        data: {
                            Facturas_idFacturas: idFactura,
                            Metodos_de_pago_idMetodos_de_pago: metodoId,
                            Cantidad: parseFloat(rawValue),
                            Usuarios_idUsuarios: idUsuario,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            sumarPagos();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Ocurrió un error al procesar la solicitud.');
                        }
                    });
                }
            });

            //$('.metodo-imagen').on('click', function() {
            //    var metodoId = $(this).data('id');
            //    console.log(metodoId);
            //});

            $('#escanearBoton').on('click', function() {
                var codigo = $('#codigoFacturaText').val();
                if (codigo === '') {
                    $('#codigoFacturaText').focus();
                } else {
                    limpiarInterfaz();
                    try {
                        var partes = codigo.split("'");
                        if (partes.length !== 4) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Código en formato incorrecto',
                                text: 'El código esta incompleto.',
                            });
                        }else{
                            var parte1 = partes[0];
                            var parte2 = partes[1];
                            var parte3 = partes[2].replace(/G/g, '/');
                            var parte4 = partes[3];

                            $('#prefijoText').val(parte1);
                            $('#numeroFacturaText').val(parte2);
                            $('#fechaText').val(parte3);
                            $('#valorTotalText').val(formatearComoPesosColombianos(parseFloat(parte4)));

                            checkOrCreateFactura(parte1, parte2, parte3, parte4)
                            $('#codigoFacturaText').val('');
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error inesperado',
                            text: 'Ocurrió un error inesperado. Por favor, inténtalo de nuevo.',
                        });
                        console.error(error);
                    }
                }
            });

            function formatearComoPesosColombianos(valor) {
                //return valor.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
                /*
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);

                const cleave = new Cleave(tempInput, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    prefix: '$ ',
                    numeralPositiveOnly: true,
                    rawValueTrimPrefix: true
                });

                tempInput.value = valor;
                cleave.setRawValue(valor);

                const valorFormateado = tempInput.value;

                document.body.removeChild(tempInput);
                
                return valorFormateado;
                */
               return valor;
            }

            function llenarValores(pagos) {
                pagos.forEach(function(pago) {
                    var input = $('.entrada-pago[data-id="' + pago.Metodos_de_pago_idMetodos_de_pago + '"]');
                    input.val(formatearComoPesosColombianos(pago.Cantidad));
                });

                sumarPagos();
            }

            function checkOrCreateFactura(prefijo, numFactura, fecha, valorTotal){
                $.ajax({
                    url: '/factura/check-or-create',
                    method: 'POST',
                    data: {
                        prefijo: prefijo,
                        numFactura: numFactura,
                        fecha: fecha,
                        valorTotal: valorTotal,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        terminado = response.terminado;
                        botonAnular.removeAttribute('disabled');
                        if (response.terminado) {
                            $('.entrada-pago').prop('disabled', true);
                            Swal.fire({
                                icon: 'error',
                                title: 'Factura terminada',
                                text: 'Esta factura ya fue cerrada',
                            });
                            total = valorTotal;
                            idFactura = response.idFacturas;  
                            llenarValores(response.pagos);
                        } else if (response.exists) {
                            total = valorTotal;
                            idFactura = response.idFacturas;  
                            llenarValores(response.pagos);
                            $('.entrada-pago').removeAttr('disabled');                          
                        } else {
                            total = valorTotal;
                            idFactura = response.idFacturas;
                            $('.entrada-pago').removeAttr('disabled');
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Ocurrió un error al procesar la solicitud.');
                    }
                });
            }

            function sumarPagos(){
                var sumaPagos = 0;
                $('.entrada-pago').each(function() {
                    var rawValue = $(this).val().replace(/[^\d,-]/g, '');
                    if (rawValue) {
                        sumaPagos += parseFloat(rawValue);
                    }
                });
                pagado = sumaPagos;

                var pendiente = parseFloat(total) - parseFloat(sumaPagos);

                $('#pendienteText').val(formatearComoPesosColombianos(pendiente));

                if (pendiente === 0 && !terminado) {
                    botonCerrar.removeAttribute('disabled');
                } else {
                    botonCerrar.setAttribute('disabled', 'disabled');
                }

            }

            $('#botonAnular').on('click', function() {
                
                $.ajax({
                    url: '/factura/anular',
                    method: 'POST',
                    data: {
                        idFactura: idFactura,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        limpiarInterfaz();
                        Swal.fire({
                            icon: 'error',
                            title: 'Anulado terminado',
                            text: response.mensaje,
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Ocurrió un error al procesar la solicitud.');
                    }
                });

            });

            function limpiarInterfaz(){

                idFactura = "";
                total = 0;
                pagado = 0;

                $('#prefijoText').val('');
                $('#numeroFacturaText').val('');
                $('#fechaText').val('');
                $('#valorTotalText').val('');
                $('#pendienteText').val('');

                $('.entrada-pago').each(function() {
                    $(this).val('');
                });

                botonAnular.setAttribute('disabled', 'disabled');

            }

            $('#botonCerrar').on('click', function() {
                
                $.ajax({
                    url: '/factura/cerrar',
                    method: 'POST',
                    data: {
                        idFactura: idFactura,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        limpiarInterfaz();
                        Swal.fire({
                            icon: 'success',
                            title: 'Cerrado',
                            text: response.mensaje,
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Ocurrió un error al procesar la solicitud.');
                    }
                });
                

            });

        });
    </script>
@endsection
