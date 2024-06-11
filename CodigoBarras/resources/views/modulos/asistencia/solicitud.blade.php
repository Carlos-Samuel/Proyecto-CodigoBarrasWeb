@extends('partes.plantilla')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ayuda</title>
</head>
<body>
<h1>Solicitar ayuda</h1>
<form action="/ayuda" method="post">
    @csrf
    <label for="numero">Numero de contacto</label><br>
    <input type="number" id="numero" name="numero"><br><br>
    <label for="nombre">Nombre de contacto</label><br>
    <input type="text" id="nombre" name="nombre"><br><br>


    <label for="frase">Seleccione una frase:</label><br>
        <select id="frase" name="frase">
            <option value="frase1">caso 1</option>
            <option value="frase2">caso 2</option>
            <option value="frase3">caso 3</option>
        </select><br><br>

    <input type="submit">
</form>

</body>
</html>
@endsection