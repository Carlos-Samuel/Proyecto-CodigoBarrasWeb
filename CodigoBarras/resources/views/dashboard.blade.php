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
        @if(HelperPer::checkPermisos(1))
            <!-- <p>El usuario tiene este permiso.</p> -->
        @else
            <!-- <p>El usuario no tiene este permiso.</p> -->
        @endif
        <br>
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
    </div>
@endsection

