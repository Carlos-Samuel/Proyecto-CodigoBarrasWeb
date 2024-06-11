@extends('partes.plantilla')

@section('styles')
	<style>
		.global-container{
			height:100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
@endsection

@section('content')
    <div class="global-container">

		<div class="card login-form">
			<div class="card-body">
				<h3 class="card-title text-center">Deuda</h3>
				<div class="card-text">
					@include('partes.messages')
                    <form action="/deuda/{{ $deuda->id }}/update" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">Deudor</label>
                            <select class="form-control form-control-sm" name="nombre">
                                <option value="0">Seleccione una opción</option>
                                <option value="1" {{ $deuda->deudor == 1 ? 'selected' : '' }}>Josue</option>
                                <option value="2" {{ $deuda->deudor == 2 ? 'selected' : '' }}>Daniela</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="monto">Monto</label>
                            <input type="number" class="form-control form-control-sm" name="monto" value="{{ $deuda->cantidad }}">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Descripcion</label>
                            <input type="text" class="form-control form-control-sm" name="fecha" value="{{ $deuda->descripcion }}">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control form-control-sm" name="pagado">
                                <option value="1" {{ $deuda->pagado ? 'selected' : '' }}>Pagado</option>
                                <option value="2" {{ !$deuda->pagado == 2 ? 'selected' : '' }}>Sin pagar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
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
                    { data: 'boton' },
                ]
            });      

            $('#recargarTabla').click(function() {
                tablaDeudas.ajax.reload(); // Recarga la tabla utilizando AJAX
            });  
            
        });


    </script>
@endsection