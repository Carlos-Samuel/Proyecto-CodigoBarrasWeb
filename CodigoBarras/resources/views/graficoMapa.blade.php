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
    <div id="container" style="width: 100%; height: 500px;"></div>
    <br>
@endsection


@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/maps/modules/map.js"></script>
    <script src="https://code.highcharts.com/maps/modules/data.js"></script>
    <script src="https://code.highcharts.com/mapdata/custom/world.js"></script>

    <script>
       
        Highcharts.mapChart('container', {
            chart: {
                map: 'custom/world'
            },
            title: {
                text: 'Distribución Mundial'
            },
            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },
            colorAxis: {
                min: 0
            },
            series: [{
                data: [
                    // Aquí van los datos. Ejemplo: ['us', 100], ['jp', 83]
                ],
                name: 'Población',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }]
        });
    </script>
@endsection
