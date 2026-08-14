@extends('layouts.usuarios')

@section('title', 'Solicitudes de Soporte')

@section('cabecera')
<div class="container-fluid">
    <div class="row text-center fade-in">
        @foreach($Ubicaciones as $ubicacion)
            <div class="col-xs-12 col-sm-3 mb-3">
                @php
                    $nombre1 = $Ubicaciones[0]->ciudad->nombre_edificio;
                @endphp

                <h5 class="mt-3 mb-2 text-uppercase" style="color: #2C3E50; font-weight: bold;">
                    {{ $nombre1 != $ubicacion->ciudad->nombre_edificio ? $ubicacion->ciudad->nombre_edificio : $nombre1 }}
                </h5>

                <a href="{{ route('usuario.reservas.reserva.salas', $ubicacion->id) }}" 
                   class="btn btn-piso fa fa-building">
                    {{ $ubicacion->ubicacion_nombre }}
                </a>
            </div>
        @endforeach
    </div>
</div>

<h2 class="text-center mt-4 mb-4" style="font-weight: bold; color: #2E4053;">
    <i class="fa fa-building-o"></i> SALAS DISPONIBLES EN {{ $edificio->nombre_edificio }} {{ $ubicacion->ubicacion_nombre }}
</h2>
@endsection


@section('content')
@push('scripts')
    <link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">
@endpush

<div class="container-fluid fade-in">
    <div class="row">
        @foreach($salas as $sala)
            <div class="col-xs-6 col-sm-3 mb-4">
                <a href="{{ url('/usuarios/sala/'.$sala->id) }}" class="sala-card-link">
                    <div class="sala-card">
                        <div class="sala-header">
                            <h3><strong>{{ strtoupper($sala->sala_nombre) }}</strong></h3>
                        </div>
                        <div class="sala-body">
                            <p><strong>USO DE LA SALA:</strong></p>
                            <p class="small text-muted">Cantidad de audiencias registradas:</p>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active"
                                     role="progressbar"
                                     aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                     style="width:70%;">
                                    70%
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<style>
/* --- ESTILOS PERSONALIZADOS 2025 --- */

/* Animación general */
.fade-in {
    animation: fadeIn 1s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Botones de pisos con hover moderno */
.btn-piso {
    display: inline-block;
    background: linear-gradient(45deg, #16A085, #138D75);
    color: #fff !important;
    font-weight: bold;
    border-radius: 30px;
    border: none;
    padding: 10px 18px;
    margin-top: 5px;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.btn-piso:hover {
    background: linear-gradient(45deg, #1ABC9C, #117864);
    transform: scale(1.08);
    box-shadow: 0 0 15px rgba(26, 188, 156, 0.7);
    text-decoration: none;
}

/* Tarjetas de salas */
.sala-card-link {
    text-decoration: none;
    color: inherit;
}
.sala-card {
    border-radius: 15px;
    border: 2px solid #A2D9CE;
    background-color: #FAFAFA;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: all 0.4s ease;
    padding: 20px;
    text-align: center;
}
.sala-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    background-color: #E8F8F5;
}

/* Encabezado de la tarjeta */
.sala-header h3 {
    font-weight: bold;
    color: #117864;
    margin-bottom: 10px;
}

/* Cuerpo de la tarjeta */
.sala-body p {
    margin: 5px 0;
    color: #2C3E50;
}

/* Progreso */
.progress {
    height: 10px;
    margin-top: 8px;
    border-radius: 10px;
    background-color: #E5E8E8;
}
.progress-bar {
    background-color: #17A589;
}

/* Ajustes de márgenes */
.mb-3 { margin-bottom: 15px !important; }
.mb-4 { margin-bottom: 25px !important; }
.mt-3 { margin-top: 15px !important; }
.mt-4 { margin-top: 25px !important; }
</style>
@endsection
