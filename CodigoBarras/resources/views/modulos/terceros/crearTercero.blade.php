@extends('partes.plantilla')

@section('styles')
    <style>
        label {
            display: block;
            margin-top: 10px;
        }

        .select2-container {
            width: 100% !important;
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($tercero) ? route('terceros.update', $tercero->id) : route('terceros.guardar') }}">
        @csrf
        @if(isset($tercero))
            @method('PUT')
        @endif

        <label for="numero_identificacion">Número de Identificación:</label>
        <input type="text" id="numero_identificacion" name="numero_identificacion" value="{{ old('numero_identificacion', $tercero->numero_identificacion ?? '') }}">

        <label for="tipo_identificacion_id">Tipo de Identificación:</label>
        <select id="tipo_identificacion_id" name="tipo_identificacion_id" class="select2">
            @foreach ($tiposDocumento as $tipoDocumento)
                <option value="{{ $tipoDocumento->id }}" {{ (old('tipo_identificacion_id', $tercero->tipo_identificacion_id ?? '') == $tipoDocumento->id) ? 'selected' : '' }}>
                    {{ $tipoDocumento->sigla }} - {{ $tipoDocumento->nombre }}
                </option>
            @endforeach
        </select>

        <label for="digito_verificacion">Dígito de Verificación:</label>
        <input type="text" id="digito_verificacion" name="digito_verificacion" value="{{ old('digito_verificacion', $tercero->digito_verificacion ?? '') }}">

        <label for="primer_nombre">Primer Nombre:</label>
        <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $tercero->primer_nombre ?? '') }}">

        <label for="segundo_nombre">Segundo Nombre:</label>
        <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $tercero->segundo_nombre ?? '') }}">

        <label for="primer_apellido">Primer Apellido:</label>
        <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $tercero->primer_apellido ?? '') }}">

        <label for="segundo_apellido">Segundo Apellido:</label>
        <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $tercero->segundo_apellido ?? '') }}">

        <label for="razon_social">Razón Social:</label>
        <input type="text" id="razon_social" name="razon_social" value="{{ old('razon_social', $tercero->razon_social ?? '') }}">

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $tercero->direccion ?? '') }}">

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $tercero->telefono ?? '') }}">

        <label for="fax">Fax:</label>
        <input type="text" id="fax" name="fax" value="{{ old('fax', $tercero->fax ?? '') }}">

        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" value="{{ old('celular', $tercero->celular ?? '') }}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $tercero->email ?? '') }}">

        <label for="sitio_web">Sitio Web:</label>
        <input type="text" id="sitio_web" name="sitio_web" value="{{ old('sitio_web', $tercero->sitio_web ?? '') }}">

        <label for="pais_id">País:</label>
        <select id="pais_id" name="pais_id" class="select2">
            @foreach ($paises as $pais)
                <option value="{{ $pais->codigo_iso_numeric }}" {{ (old('pais_id', $tercero->pais_id ?? '') == $pais->codigo_iso_numeric) ? 'selected' : '' }}>
                    {{ $pais->nombre }}
                </option>
            @endforeach
        </select>

        <label for="ciudad">Ciudad:</label>
        <select id="ciudad" name="ciudad" class="select2">
            @foreach ($ciudades as $ciudad)
                <option value="{{ $ciudad->codigo }}" {{ (old('ciudad', $tercero->ciudad ?? '') == $ciudad->codigo) ? 'selected' : '' }}>
                    {{ $ciudad->nombre }}
                </option>
            @endforeach
        </select>

        <label for="regimen_id">Régimen:</label>
        <select id="regimen_id" name="regimen_id" class="select2">
            @foreach ($regimenes as $regimen)
                <option value="{{ $regimen->id }}" {{ (old('regimen_id', $tercero->regimen_id ?? '') == $regimen->id) ? 'selected' : '' }}>
                    {{ $regimen->descripcion }}
                </option>
            @endforeach
        </select>

        <label for="tipo_persona_id">Tipo de Persona:</label>
        <select id="tipo_persona_id" name="tipo_persona_id" class="select2">
            @foreach ($tiposPersona as $tipoPersona)
                <option value="{{ $tipoPersona->id }}" {{ (old('tipo_persona_id', $tercero->tipo_persona_id ?? '') == $tipoPersona->id) ? 'selected' : '' }}>
                    {{ $tipoPersona->descripcion }}
                </option>
            @endforeach
        </select>

        
        <label for="tipo_tercero">Tipo de Tercero:</label>
        <select id="tipo_tercero" name="tipo_tercero" class="select2">
            <option value="1" {{ (old('tipo_tercero', $tercero->tipo_tercero ?? '') == 1) ? 'selected' : '' }}>Cliente</option>
            <option value="2" {{ (old('tipo_tercero', $tercero->tipo_tercero ?? '') == 2) ? 'selected' : '' }}>Proveedor</option>
            <option value="3" {{ (old('tipo_tercero', $tercero->tipo_tercero ?? '') == 3) ? 'selected' : '' }}>Empleado</option>
        </select>

        <br>
        <br>
        <button type="submit">Enviar</button>
    </form>

</div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection