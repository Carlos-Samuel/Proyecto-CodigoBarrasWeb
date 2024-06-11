@extends('partes.plantilla')

@section('styles')
    <style>
        .global-container{
            height:100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .tablaTicket thead, .celdaTitulo {
            /*background-color: #82c6ff; */
            background-color: #4e73df;
            color: #ffffff;
            text-align: center;
            border: 1px solid black; 
        }

        .tablaTicket td, .tablaTicket th {
            padding: 8px; 
            text-align: center;
            /* border: 1px solid black; */ /* Este es el que hace que los bordes aparezcan entre todas celdas */  
        }

        .tablaTicket tr:nth-child(even){
            background-color: #f2f2f2;
        }

        .tablaTicket {
            border: 1px solid black;
        }

        .align-right {
            text-align: right;
        }

        /* Estilos para el contenedor de la vista previa */
        .dz-preview {
            display: flex; /* Habilita Flexbox */
            flex-direction: column; /* Organiza los elementos en una columna */
            align-items: center; /* Centra los elementos horizontalmente */
            justify-content: center; /* Centra los elementos verticalmente (útil si quieres que todo esté centrado en el contenedor) */
        }

        .CancelarImagen {
            margin-top: 10px; /* Agrega un poco de espacio entre la imagen y el botón */
            font-size: 14px; /* Tamaño del texto */
            font-weight: bold; /* Negrita para el texto */
            color: white; /* Color del texto */
            background-color: #ff4d4d; /* Color de fondo */
            border: none; /* Sin bordes */
            border-radius: 5px; /* Bordes redondeados */
            padding: 10px 20px; /* Espaciado interno */
            cursor: pointer; /* Cursor tipo puntero para indicar clic */
            transition: background-color 0.3s ease; /* Transición suave del color de fondo */
        }

        .CancelarImagen:hover, .CancelarImagen:focus {
            background-color: #cc0000; /* Color de fondo al pasar el ratón o enfocar */
            outline: none; /* Elimina el contorno al enfocar */
        }

        .CancelarImagen:active {
            background-color: #990000; /* Color de fondo al hacer clic */
            transition: background-color 0.1s ease; /* Transición rápida del color de fondo */
        }

        .dropzone .dz-preview .dz-error-message {
            top: -10px !important;
            transform: translateY(-100%) !important;
            left: 0 !important;
            width: 100% !important;
            text-align: center !important;
        }

        #selectCategoria {
            width: 100%; /* Hace que el select ocupe el 100% del ancho de su contenedor */
            font-size: 1.4rem; /* Aumenta el tamaño de la letra */
            border: 2px solid #cccccc; /* Aplica un borde más suave y de color gris claro */
            border-radius: 10px; /* Redondea las esquinas del borde */
            padding: 5px; /* Añade un poco de espacio interior para que no esté tan pegado el texto al borde */
            box-sizing: border-box; /* Asegura que el padding y el borde sean incluidos en el ancho total del select */
        }

        #selectCategoria option {
            padding: 5px; /* Añade espacio alrededor del texto dentro de cada opción */
        }


    </style>
@endsection

@section('content')
    <h1 style="text-align: center;">
        Detalle del caso
    </h1>
    <br>
    <?php
        //$mensaje = "Mensaje de prueba";
    ?>

    <input type = "hidden" value = "<?php echo $caso->id; ?>" id = "idTicket" >
    <input type = "hidden" value = "<?php echo auth()->user()->id; ?>" id = "idUsuario" >

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
    <br>
    @endif

    <table class = "tablaTicket">
        <thead>
            <tr>
                <th>No. Caso</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>NIT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $caso->id }}</td>
                <td>{{ $caso->created_at }}</td>
                <td>{{ $caso->created_at }}</td>
                <td>{{ $caso->plnom }}</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Recibido en</th>
                <th>Prioritario</th>
                <th>Estado</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $caso->nombre_contacto }}</td>
                <td>{{ $caso->numero_contacto }}</td>
                <td>{{ $caso->clasificacion }}</td>
                <td>{{ $caso->clasificacion }}</td>
            </tr>
        </tbody>
    </table>

    <table class = "tablaTicket">
        <tr>
            <th class="celdaTitulo" style="width: 20%;">Categoría Principal</th>
            <td style="width: 40%;">{{ $caso->plnom }}</td>
            <th class="celdaTitulo" style="width: 20%;">Categoría Secundaria</th>
            <td style="width: 20%;">{{ $caso->plnom }}</td>
        </tr>
    </table>

    <table class = "tablaTicket">
        <tr>
            <th class="celdaTitulo" style="width: 20%;">Descripción</th>
            <td style="width: 80%;">{{ $caso->plnom }}</td>
        </tr>
    </table>

    <table class = "tablaTicket">
        <thead>
            <tr>
                <th>Nombre Contacto</th>
                <th>Teléfono Contacto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
            </tr>
        </tbody>
    </table>

    <table class = "tablaTicket">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acción</th>
                <th>Resultado Gestión</th>
                <th>Realizado por</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h3 style="text-align: center;">Imagenes subidas por el cliente</h3>
    <br>
    <table class = "tablaTicket">
        <thead>
            <tr>
                <th>Id</th>
                <th>Archivo</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
                <td>{{ $caso->plnom }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h3 style="text-align: center;">Imagenes subidas por el asesor</h3>
    <br>
    <table class = "tablaTicket" id = "tablaImagenesAsesor">
        <thead>
            <tr>
                <th>Id</th>
                <th>Archivo</th>
                <th>Autor</th>
                <th>Ver</th>
            </tr>
        </thead>
        
    </table>
    <br>
    <h3 style="text-align: center;">Agregar Gestión</h3>
    <br>

    <h3 style="text-align: center;">Actualizar Categoria</h3>
    <select class="form-select" id = "selectCategoria">
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->cate_nombre }}</option>
        @endforeach
    </select>
    <br>
    <br>
    <div class="align-right">
        <button id="actualizarCategoria" type="button" class="btn btn-primary">Actualizar Categoria</button>
    </div>
    <br>
    <h3 style="text-align: center;">Agregar Imagenes</h3>
    <br>
    <form action="{{ route('file.uploadImagenAsesor') }}" class="dropzone" id="my-awesome-dropzone">
    </form>
    <br>
    <div class="align-right">
        <button id="cargarImagenes" type="button" class="btn btn-primary">Cargar Archivos</button>
    </div>
    <br>
    <br>
    <hr>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!--
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Vista de Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                -->
                <div class="modal-body">
                    <img src="" id="imagenEnModal" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script>
        
        $(document).ready(function() {

            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // El nombre del parámetro que se usará para enviar el archivo
                maxFilesize: 2, // MB
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                autoProcessQueue: false, // No procesar la cola automáticamente
                dictDefaultMessage: "Arrastre los archivos aquí para subir", // Mensaje por defecto
                dictFallbackMessage: "Tu navegador no soporta arrastrar y soltar para subir archivos.",
                dictFileTooBig: "Archivo demasiado grande, tamaño máximo permitido: 2MB.",
                dictInvalidFileType: "No puedes subir archivos de este tipo.",
                dictResponseError: "Servidor respondió con error.",
                dictCancelUpload: "Cancelar subida",
                dictUploadCanceled: "Has cancelado la subida",
                dictCancelUploadConfirmation: "¿Estás seguro de que quieres cancelar esta subida?",
                dictRemoveFile: "Eliminar archivo",
                dictMaxFilesExceeded: "No puedes subir más archivos.",
                init: function() {

                    var myDropzone = this;

                    this.on("addedfile", function(file) {
                        var removeButton = Dropzone.createElement("<button class = 'CancelarImagen'>Cancelar Img</button>");
                        
                        removeButton.addEventListener("click", function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            myDropzone.removeFile(file);
                        });

                        file.previewElement.appendChild(removeButton);
                    });


                    document.getElementById("cargarImagenes").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue(); 
                    });

                    this.on("sending", function(file, xhr, formData) {
                        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        
                        idUsuario = $('#idUsuario').val();
                        idTicket = $('#idTicket').val();

                        formData.append('idUsuario', idUsuario);
                        formData.append('idTicket', idTicket);
                    
                    });

                    this.on("success", function(file, response) {
                        myDropzone.removeFile(file);
                        tablaImagenesAsesor.ajax.reload();
                    });
                }
            };


            Dropzone.discover();

            idUsuario = $('#idUsuario').val();
            idTicket = $('#idTicket').val();

            var tablaImagenesAsesor = $('#tablaImagenesAsesor').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('imagenesAsesor.dataTable') }}",
                    "data": function (d) {
                        d.idTicket = idTicket;
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "nombre_guardado" },
                    { "data": "usuario.name" },
                    { "data": "action" }
                ],
                "createdRow": function(row, data, dataIndex) {

                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
                "paging": false, // Deshabilita la paginación
                "searching": false, // Deshabilita la búsqueda
                "info": false, // Oculta el texto de "Mostrando x de y registros"
                "lengthChange": false // Oculta el selector de número de registros por página
            });

            $(document).on('click', '.ver-imagen', function(){
                var imagenUrl = $(this).data('imagen'); 
                $('#imagenEnModal').attr('src', imagenUrl);
            });


        });
    </script>
@endsection
