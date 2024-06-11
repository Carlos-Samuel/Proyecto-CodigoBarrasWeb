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
    
    <div id="container" style="width:100%; height:400px;"></div>
    <br>
    <div id="miGraficoDeLinea" style="width:100%; height:400px;"></div>
    <br>
    <div id="bar-chart" style="width:100%; height:400px;"></div>
    <br>
    <div id="graficoCircular" style="width: 100%; height: 400px;"></div>
    <br>
    <div id="scatterChart" style="width: 100%; height: 400px;"></div>
    <br>
    <div id="combinedChart" style="width: 100%; height: 400px;"></div>
    <br>
    <div id="mapChart" style="width: 100%; height: 400px;"></div>
    <br>
@endsection


@section('scripts')
    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('js/highcharts/modules/exporting.js') }}"></script>
    <script src="{{ asset('js/highcharts/modules/export-data.js') }}"></script>
    <script src="{{ asset('js/highcharts/modules/accessibility.js') }}"></script>

    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Fruit Consumption'
                },
                xAxis: {
                    categories: ['Apples', 'Bananas', 'Oranges']
                },
                yAxis: {
                    title: {
                        text: 'Fruit eaten'
                    }
                },
                series: [{
                    name: 'Jane',
                    data: @json($data)
                }, {
                    name: 'John',
                    data: [2, 3, 5]
                }]
            });
        });    

        Highcharts.chart('miGraficoDeLinea', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Ventas Mensuales'
            },
            subtitle: {
                text: 'Fuente: Empresa X'
            },
            xAxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            },
            yAxis: {
                title: {
                    text: 'Ventas (unidades)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Tokio',
                data: [7, 6, 9, 14, 18, 21, 25, 26, 23, 18, 13, 9]
            }, {
                name: 'Nueva York',
                data: [-0.2, 0.8, 5.7, 11.3, 17, 22, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Berlín',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17, 18.6, 17.9, 14.3, 9, 3.9, 1]
            }, {
                name: 'Londres',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });

        Highcharts.chart('bar-chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Ventas Anuales por Producto'
            },
            subtitle: {
                text: 'Fuente: Base de Datos Interna'
            },
            xAxis: {
                categories: ['Producto A', 'Producto B', 'Producto C', 'Producto D'],
                crosshair: true,
                title: {
                    text: 'Productos'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Ventas (millones)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} MM</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f} MM'
                    }
                }
            },
            series: [{
                name: '2023',
                data: [49.9, 71.5, 106.4, 129.2]
            }, {
                name: '2024',
                data: [83.6, 78.8, 98.5, 93.4]
            }],
            exporting: {
                enabled: true
            },
            credits: {
                enabled: false
            }
        });

        Highcharts.chart('graficoCircular', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Distribución de ventas por producto, 2024'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        connectorColor: 'silver'
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Ventas',
                colorByPoint: true,
                data: [{
                    name: 'Producto A',
                    y: 61.41,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Producto B',
                    y: 11.84
                }, {
                    name: 'Producto C',
                    y: 10.85
                }, {
                    name: 'Producto D',
                    y: 4.67
                }, {
                    name: 'Otros',
                    y: 11.23
                }]
            }]
        });

        Highcharts.chart('scatterChart', {

            chart: {
                type: 'scatter',
                zoomType: 'xy'
            },

            accessibility: {
                point: {
                    valueDescriptionFormat: '{index}. {xDescription}, {yDescription}.'
                }
            },

            title: {
                text: 'Altura vs Peso por Género'
            },

            subtitle: {
                text: 'Fuente: Heinz 2003'
            },

            xAxis: {
                title: {
                    enabled: true,
                    text: 'Altura (cm)'
                },
                startOnTick: true,
                endOnTick: true,
                showLastLabel: true
            },

            yAxis: {
                title: {
                    text: 'Peso (kg)'
                }
            },

            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                backgroundColor: Highcharts.defaultOptions.chart.backgroundColor,
                borderWidth: 1
            },

            plotOptions: {
                scatter: {
                    marker: {
                        radius: 5,
                        states: {
                            hover: {
                                enabled: true,
                                lineColor: 'rgb(100,100,100)'
                            }
                        }
                    },
                    states: {
                        hover: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>{series.name}</b><br>',
                        pointFormat: '{point.x} cm, {point.y} kg'
                    }
                }
            },

            series: [{
                name: 'Femenino',
                color: 'rgba(223, 83, 83, .5)',
                data: [[161.2, 51.6], [167.5, 59.0], [159.5, 49.2], [157.0, 63.0], [155.8, 53.6],
                    [170.0, 59.0], [159.1, 47.6], [166.0, 69.8], [176.2, 66.8], [160.2, 75.2]]

            }, {
                name: 'Masculino',
                color: 'rgba(119, 152, 191, .5)',
                data: [[174.0, 65.6], [175.3, 71.8], [193.5, 80.7], [186.5, 72.6], [187.2, 78.8],
                    [181.5, 74.8], [184.0, 86.4], [184.5, 78.4], [175.0, 62.0], [184.0, 81.6]]
            }]
        });


        Highcharts.chart('combinedChart', {
            title: {
                text: 'Combinación de Ventas, Tendencias y Objetivos'
            },
            xAxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            },
            labels: {
                items: [{
                    html: 'Total de ventas acumuladas',
                    style: {
                        left: '50px',
                        top: '18px',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: 'Ventas Mensuales',
                data: [3, 2, 1, 3, 4, 6, 2, 4, 6, 4, 3, 5]
            }, {
                type: 'spline',
                name: 'Tendencia',
                data: [2.67, 3, 2.33, 3, 3.33, 3.33, 2.33, 3.33, 4, 3.33, 3, 3.67],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            }, {
                type: 'pie',
                name: 'Total de consumo',
                data: [{
                    name: 'Jane',
                    y: 13,
                    color: Highcharts.getOptions().colors[0] // Jane's color
                }, {
                    name: 'John',
                    y: 23,
                    color: Highcharts.getOptions().colors[1] // John's color
                }, {
                    name: 'Joe',
                    y: 19,
                    color: Highcharts.getOptions().colors[2] // Joe's color
                }],
                center: [100, 80],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });
    </script>
@endsection
