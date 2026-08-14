@extends('layouts.ReservaSalas')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera')
<h2><strong>SALAS DISPONIBLES EN  {{$edificio->nombre_edificio}} {{$ubicacion->ubicacion_nombre}}</strong></h2>
@endsection
@section('content')

@push('scripts')
<link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">
<link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">

@endpush
<style>
    .sala-card {
        border: 3px solid #A2D9CE;
        border-radius: 10px;
        padding: 20px;
        height: 100%;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sala-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .sala-link {
        text-decoration: none;
        color: black;
    }

    .sala-title {
        font-size: 1.5em;
        text-align: center;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .sala-subtitle {
        font-weight: bold;
        color: #333;
    }

    .sala-inactiva {
        font-size: 1.2em;
        color: red;
        font-weight: bold;
    }

    .sala-wrapper {
        margin-bottom: 40px;
    }
    .sala-card {
    border: 3px solid #A2D9CE;
    border-radius: 10px;
    padding: 20px;
    height: 100%;
    background-color: #eff3f5; /* ← Fondo azul claro */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

</style>

<div class="container-fluid">
    <div class="row mt-3 mb-3 pb-3">
        @foreach($salas as $sala)
            <div class="col-xs-12 col-sm-4 col-md-3 sala-wrapper">
                @php
                    $visible = !( auth()->user()->id != 2040 && $sala->id == 139);
                @endphp
                @if($visible)
                    <a href="https://www.disajcali.gov.co/administracion/sala/{{$sala->id}}" class="sala-link">
                        <div class="sala-card">
                            <div class="sala-title">{{ $sala->sala_nombre }}</div>

                            @if($sala->estado == 0)
                                <div class="sala-inactiva" title="En esta Sala No Se Puede Realizar Reservas, Solo Ver y Editar">SALA INACTIVA</div>
                            @else
                                <div class="sala-subtitle">USO DE LA SALA</div>
                            @endif

                            <div class="mt-2">
                                <span><strong>PENDIENTES:</strong> {{ $sala->total_reservas }}</span>
                                <!-- Aquí podrías insertar una barra de progreso si se desea -->
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection



