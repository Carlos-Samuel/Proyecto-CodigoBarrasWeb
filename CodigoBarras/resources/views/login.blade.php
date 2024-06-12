@extends('plantillaVanila.vanilla')

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

{{-- @section('content') --}}
	<div class="global-container">
		<div class="card login-form">
			<div class="card-body">
				<h3 class="card-title text-center">Inicio de sesión a ADMIN CB</h3>
				<div class="card-text">
				@if (isset($errors) && count($errors) > 0)
					<div class = "alert alert-danger">
						<ul class = "list-unstyled mb-0">
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>                
							@endforeach
						</ul>
					</div>
				@endif
					<form action = "/login" method = "POST">
						@csrf
						<div class="form-group">
							<label for="usuarioCorreo">Cedula</label>
							<input type="text" class="form-control form-control-sm" name = "cedula" id="cedula">
						</div>
						<div class="form-group">
							<label for="contraseña">Contraseña</label>
							<input type="password" class="form-control form-control-sm" name = "password" id="password">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
					</form>
					<!--
					<a href = "/register"><button class="btn btn-success btn-block">Registrar Usuario</button></a>
					-->
				</div>
			</div>
		</div>
	</div>
	{{-- @endsection --}}
