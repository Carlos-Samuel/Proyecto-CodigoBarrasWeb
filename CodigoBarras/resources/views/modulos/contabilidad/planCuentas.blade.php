@extends('partes.plantilla')



@section('content')
<style>
    .nivel-2,
    .nivel-3,
    .nivel-4 {
        display: none;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border-top: 1px solid #dddddd;
    }

    td {
        border-bottom: 1px solid #dddddd;
        padding: 8px;
        position: relative;
    }

    .toggle-button {
        position: absolute;
        left: 4px; /* Ajusta el valor según sea necesario */
        top: 50%;
        transform: translateY(-50%);
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border-radius: 3px;
        color: #333333;
        padding: 4px 8px;
        font-size: 12px;
        cursor: pointer;
    }

    .toggle-button:hover {
        background-color: #f2f2f2;
    }

    .importar {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
    }

    #guardar-button {
        margin-top: 20px;
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-right: 8px;
        cursor: pointer;
        border-radius: 5px;
    }

    #guardar-button:hover {
        background-color: #45a049;
    }
</style>

<table>
@foreach($cuentas as $cuenta)
    <tr class="nivel-{{ $cuenta->plnniv }}">
        <td colspan="2">
            @for ($i = 0; $i < (4 * $cuenta->plnniv) + 8; $i++)
                &nbsp;
            @endfor 
            <button class="toggle-button" onclick="toggleRow(event)">+</button>
            Código: {{ $cuenta->plncod }}, Nivel: {{ $cuenta->plnniv }}
            <span class="importar"><input type="checkbox" name="importar[]" value="{{ $cuenta->id }}"> Importar</span>
        </td>
    </tr>
@endforeach
</table>

<button id="guardar-button" onclick="guardarCuentas()">Guardar</button>

<script>
    function toggleRow(event) {
        event.stopPropagation(); // Evitar la propagación del evento clic al hacer clic en el botón
        var button = event.target;
        var row = button.parentNode.parentNode;
        var nextLevelRow = row.nextElementSibling;
        while (nextLevelRow && nextLevelRow.querySelector('td').innerHTML.includes('&nbsp;') && nextLevelRow.classList.contains('nivel-' + (parseInt(row.classList[0].split('-')[1]) + 1))) {
            nextLevelRow.style.display = nextLevelRow.style.display === 'none' ? 'table-row' : 'none';
            nextLevelRow = nextLevelRow.nextElementSibling;
        }
        button.textContent = button.textContent === '+' ? '-' : '+';
    }

    function guardarCuentas() {
        var cuentasSeleccionadas = [];
        document.querySelectorAll('input[name="importar[]"]:checked').forEach(function(checkbox) {
            var row = checkbox.parentNode.parentNode.parentNode;
            var codigo = row.querySelector('td').textContent.match(/Código: (\d+)/)[1];
            var nivel = row.classList[0].split('-')[1];
            cuentasSeleccionadas.push({codigo: codigo, nivel: nivel});
        });
        console.log(JSON.stringify(cuentasSeleccionadas));
    }
</script>


    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ocultar todas las sublistas al principio
            $('.sub-cuentas').hide();

            // Mostrar u ocultar la lista secundaria cuando se hace clic en el botón
            $('.toggle').click(function() {
                $(this).next('.sub-cuentas').toggle();
            });
        });
    </script>
@endsection