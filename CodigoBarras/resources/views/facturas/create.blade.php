@extends('partes.plantilla')

@section('title', 'Facturas')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="container">
                <input type="hidden" name="usuarioId" id="usuarioId" value="{{ Auth::id() }}">
                <input type="hidden" name="idFacturaMensajeria" id="idFacturaMensajeria" value="{{ $idFacturaMensajeria }}">
                <input id = "codigoFacturaText" type="text" class="form-control" style="height: 60px; font-size: 30px;" placeholder = "Escanear Factura">
                <br>
                <button id = "escanearBoton" class="btn btn-primary btn-block mb-3" style="height: 80px; font-size: 40px;" >Procesar</button>
                <br>
                <button id = "enviarMensajeria" class="btn btn-success btn-block mb-3" style="height: 80px; font-size: 40px;" disabled>Mensajeria</button>
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
                        <input type="text" id="inputRecibido" placeholder="Dinero Recibido" style="height: 70px; font-size: 30px;">
                    </div>
                    <div class="col-md-6">
                        <button id="botonCalcular" style="height: 70px; font-size: 15px;" >Calcular Cambio</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <button id = "botonAnular" class="btn btn-danger btn-block mb-3" style="height: 80px; font-size: 40px;" disabled>Anular</button>
                    </div>
                    <div class="col-md-6">
                        <button id = "botonCerrar" class="btn btn-primary btn-block mb-3" style="height: 80px; font-size: 40px;" disabled>Cerrar</button>
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
                @if ($metodo->Efectivo)
                    <input type="hidden" id="idEfectivo" value="{{ $metodo->idMetodos_de_pago }}">
                @endif
                <br>
            @endforeach
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>
    <script>
        $(document).ready(function() {

            var idFacturaMensajeria = $("#idFacturaMensajeria").val();

            if (idFacturaMensajeria) {
                obtenerFactura(idFacturaMensajeria);
            }

            document.getElementById('botonCalcular').addEventListener('click', calcularCambio);
            $('#codigoFacturaText').focus();

            var idFactura = "";
            var total = 0;
            var pagado = 0;
            var idUsuario = $('#usuarioId').val();
            var terminado = false;

            function limpiarNumeros(numero){
                return numero.replace(/[^\d-]/g, '');
            }
            
            $('.entrada-pago').on('blur', function() {
                var rawValue = limpiarNumeros($(this).val());

                if (rawValue == null || rawValue == undefined || rawValue == ''){
                    rawValue = 0;
                }


                let valorFormateado = formatearComoPesosColombianos(rawValue);


                $(this).val(valorFormateado);

                var metodoId = $(this).data('id');
                console.log('Valor numérico: ' + rawValue + ', ID del método de pago: ' + metodoId + ' el idFactura: ' + idFactura + ' al Usuario: ' + idUsuario);

                var sumaTemporalPagos = 0;

                $('.entrada-pago').each(function() {
                    var crudo = limpiarNumeros($(this).val());
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


            function obtenerFactura(codigo) {
                limpiarInterfaz();

                $.ajax({
                    url: '/ventas/' + codigo,
                    method: 'GET',
                    success: function(response) {
                        $('#prefijoText').val(response.prefijo.prfcod);
                        $('#numeroFacturaText').val(response.vtanum);
                        $('#fechaText').val(response.vtafec);
                        //let total = response.VtaSubTot-response.VtaVlrDes+response.VtaVlrIva-response.VtaRetFte-response.VtaRetIva-response.VtaRetIca+response.VtaImpCon+response.VtaVlrIcn
                        let total = Math.floor(
                            parseFloat(response.vtasubtot) - 
                            parseFloat(response.vtavlrdes) + 
                            parseFloat(response.vtavlriva) - 
                            parseFloat(response.vtaretfte) - 
                            parseFloat(response.vtaretiva) - 
                            parseFloat(response.vtaretica)
                        );                        

                        $('#valorTotalText').val(formatearComoPesosColombianos(parseFloat(total)));
                        $('#pendienteText').val(formatearComoPesosColombianos(parseFloat(total)));

                        checkOrCreateFactura(codigo, response.prefijo.prfcod, response.vtanum, response.vtafec, total)
                        
                        $('#codigoFacturaText').val('');

                    },
                    error: function(xhr, status, error) {
                        console.error(JSON.parse(xhr.responseText).message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: JSON.parse(xhr.responseText).message,
                        });
                    }
                });


            }


            function obtenerCodigo(prefijo, numero) {
                limpiarInterfaz();

                $.ajax({
                    url: '/obtenerCodigo/' + prefijo + '/' + numero,
                    method: 'GET',
                    success: function(response) {

                        obtenerFactura(response.vtaid);
                    },
                    error: function(xhr, status, error) {
                        console.error(JSON.parse(xhr.responseText).message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: JSON.parse(xhr.responseText).message,
                        });
                    }
                });


            }



            $('#escanearBoton').on('click', function() {
                var datos = $('#codigoFacturaText').val().replace(/^\*+|\*+$/g, '');
                if (datos === '') {
                    $('#codigoFacturaText').focus();
                } else {

                    var partes = datos.split("/");

                    if (partes.length !== 2){
                        Swal.fire({
                            icon: 'error',
                            title: 'Codigo en formato incorrecto',
                            text: 'El codigo esta mal generado o leido',
                        });

                    }else{
                        var prefijo = partes[0];
                        var numero = partes[1];

                        let codigo = obtenerCodigo(prefijo, numero);

                    }

                }
            });

            function formatearComoPesosColombianos(valor) {
                //return valor.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
                
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);

                const cleave = new Cleave(tempInput, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    numeralPositiveOnly: true,
                    rawValueTrimPrefix: true
                });

                tempInput.value = valor;
                cleave.setRawValue(valor);

                const valorFormateado = tempInput.value;

                document.body.removeChild(tempInput);
                
                return valorFormateado;
                
               return valor;
            }

            function llenarValores(pagos) {
                pagos.forEach(function(pago) {
                    var input = $('.entrada-pago[data-id="' + pago.Metodos_de_pago_idMetodos_de_pago + '"]');
                    input.val(formatearComoPesosColombianos(pago.Cantidad));
                });

                sumarPagos();
            }

            function checkOrCreateFactura(codigo, prefijo, numFactura, fecha, valorTotal){
                $.ajax({
                    url: '/factura/check-or-create',
                    method: 'POST',
                    data: {
                        codigo: codigo,
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
                            $('#inputRecibido').prop('disabled', true);
                            $('#botonCalcular').prop('disabled', true);
                            Swal.fire({
                                icon: 'error',
                                title: 'Factura terminada',
                                text: 'Esta factura ya fue cerrada',
                            });
                            total = valorTotal;
                            idFactura = response.idFacturas;  
                            llenarValores(response.pagos);
                        } else if (response.exists) {
                            $('#inputRecibido').removeAttr('disabled');    
                            $('#botonCalcular').removeAttr('disabled'); 
                            enviarMensajeria.removeAttribute('disabled');
                            total = valorTotal;
                            idFactura = response.idFacturas;  
                            llenarValores(response.pagos);
                            $('.entrada-pago').removeAttr('disabled');                          
                        } else {
                            $('#inputRecibido').removeAttr('disabled'); 
                            $('#botonCalcular').removeAttr('disabled'); 
                            enviarMensajeria.removeAttribute('disabled');
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
                    var rawValue = limpiarNumeros($(this).val());
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
                enviarMensajeria.setAttribute('disabled', 'disabled');
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

            $('#enviarMensajeria').on('click', function() {
                
                $.ajax({
                    url: '/factura/mensajeria',
                    method: 'POST',
                    data: {
                        idFactura: idFactura,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        limpiarInterfaz();
                        Swal.fire({
                            icon: 'success',
                            title: 'Enviado',
                            text: response.mensaje,
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Ocurrió un error al procesar la solicitud.');
                    }
                });
                

            });

            $('#inputRecibido').on('blur', function() {
                var rawValue = limpiarNumeros($(this).val());

                if (rawValue == null || rawValue == undefined || rawValue == ''){
                    rawValue = 0;
                }

                let valorFormateado = formatearComoPesosColombianos(rawValue);


                $(this).val(valorFormateado);
            
            });

            function calcularCambio() {

                if ($('#idEfectivo').val() == undefined){
                    alert("Para usar esta opción requiere un medio de pago marcado como efectivo")
                }else{

                    let recibido = parseInt(limpiarNumeros(document.getElementById('inputRecibido').value));
                    let valorAPagar = parseInt(limpiarNumeros(document.getElementById('pendienteText').value));

                    if (valorAPagar == NaN){

                    }

                    let cambio = recibido - valorAPagar;

                    if (isNaN(recibido)){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Calcular Cambio',
                            text: 'Ingrese cuanto dinero fue entregadó',
                        });
                        return ;
                    }

                    if (isNaN(valorAPagar)){

                        valorAPagar = parseInt(document.getElementById('valorTotalText').value);

                        if (isNaN(valorAPagar)){

                            Swal.fire({
                                icon: 'error',
                                title: 'Error al Calcular Cambio',
                                text: 'El valor pendiente esta vacio',
                            });
                            return ;

                        }
                    }

                    if (valorAPagar > recibido){

                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Calcular Cambio',
                            text: 'El valor pendiente es mayor que el dinero recibido',
                        });
                        return ;

                    }

                    cambioM = formatearComoPesosColombianos(cambio);
                    valorAPagarM = formatearComoPesosColombianos(valorAPagar);
                    Swal.fire({
                        title: 'El valor a devolver es: $' + cambioM,
                        text: 'El valor pagado es: $' + valorAPagarM,
                        icon: 'info',
                        confirmButtonText: 'Aceptar'
                    });

                    document.getElementById('inputRecibido').value = '';
                    $('.entrada-pago[data-id="' + $('#idEfectivo').val() + '"]').val(valorAPagar);
                    $('.entrada-pago[data-id="' + $('#idEfectivo').val() + '"]').trigger('blur');

                }
            }

        });
    </script>
@endsection
