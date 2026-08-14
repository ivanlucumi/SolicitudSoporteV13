@extends('layouts.monitoreo.ingreso')

@section('title', 'Registro Ingreso')

@section('cabecera')
   REGISTRO {{  auth()->user()->name }} {{  auth()->user()->lastname }}
@endsection

@section('content')

<style>
    .registro-container {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
        margin-top: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #333;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
        border-color: #ccc;
    }

    .btn-primary {
        font-weight: bold;
        border-radius: 8px;
    }

    .btn-warning {
        font-weight: bold;
        border-radius: 8px;
    }

    .foto-container {
        text-align: center;
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-top: 10px;
    }

    .foto-container img {
        display: block;
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        border: 4px solid #007bff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .foto-container img:hover {
        transform: scale(1.03);
    }

    @media only screen and (max-width: 700px) {
        .registro-container {
            padding: 15px;
        }
    }

    @keyframes latido {
        0%   { transform: scale(1);   box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.6); }
        30%  { transform: scale(1.03); box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); }
        60%  { transform: scale(1);   box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
        100% { transform: scale(1);   box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
    }

    .alerta-novedad {
        background: linear-gradient(135deg, #fff1f2, #ffe4e6);
        border: 2px solid #dc2626;
        border-left: 8px solid #dc2626;
        border-radius: 10px;
        padding: 18px 20px;
        margin-bottom: 20px;
        color: #7f1d1d;
        animation: latido 1.4s ease-in-out infinite;
        box-shadow: 0 4px 16px rgba(220, 38, 38, 0.3);
    }

    .alerta-novedad .titulo-novedad {
        font-weight: 800;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        color: #991b1b;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .alerta-novedad .titulo-novedad i {
        font-size: 26px;
        color: #dc2626;
        animation: latido 0.9s ease-in-out infinite;
    }

    .alerta-novedad .texto-novedad {
        font-size: 15px;
        font-weight: 600;
        margin-left: 34px;
        line-height: 1.5;
        color: #7f1d1d;
    }
</style>

<div class="container-fluid registro-container">
    <div class="row">
        <!-- Novedades de Coordinaci¨®n -->
            @if(!empty($verificacion->novedades))
            <div class="col-xs-12 col-sm-12 form-group" style="padding: 0 15px;">
                <div class="alerta-novedad">
                    <div class="titulo-novedad">
                        <i class="fa fa-exclamation-triangle"></i>
                        &#9888;&#65039; NOVEDAD REGISTRADA POR COORDINACI&Oacute;N:
                    </div>
                    <div class="texto-novedad">{{ $verificacion->novedades }}</div>
                </div>
            </div>
            @endif

        {{-- Columna Izquierda: Formulario --}}
        <div class="col-xs-12 col-sm-6">
            <form action="{{ route('biometria.registro.save.foto') }}" method="POST" enctype="multipart/form-data" id="biometria.registro.save">
            <div class="col-xs-12 col-lg-2 form-group ">
                <label for="tipo_doc">T.IDENT:</label>
                <input type="text" name="tipo_doc" value="{{ old('tipo_doc', $verificacion->tipo_doc) }}" id="tipo_doc" class="form-control shadow" required autocomplete="off" placeholder="Tipo de Documento" readonly>
            </div>

            <div class="col-xs-12 col-sm-4 form-group">
                <label for="identificacion">IDENTIFICACI&Oacute;N:</label>
                <input type="number" name="identificacion" value="{{ old('identificacion', $verificacion->identificacion) }}" id="identificacion" class="form-control shadow" required readonly>
            </div>

            <div class="col-xs-12 col-sm-6 form-group">
                <label for="p_apellido">PRIMER APELLIDO:</label>
                <input type="text" name="p_apellido" value="{{ old('p_apellido', $verificacion->p_apellido) }}" id="p_apellido" class="form-control shadow" required readonly>
            </div>

            <div class="col-xs-12 col-sm-6 form-group">
                <label for="s_apellido">SEGUNDO APELLIDO:</label>
                <input type="text" name="s_apellido" value="{{ old('s_apellido', $verificacion->s_apellido) }}" id="s_apellido" class="form-control shadow" readonly>
            </div>

            <div class="col-xs-12 col-sm-6 form-group">
                <label for="p_nombre">PRIMER NOMBRE:</label>
                <input type="text" name="p_nombre" value="{{ old('p_nombre', $verificacion->p_nombre) }}" id="p_nombre" class="form-control shadow" required readonly>
            </div>

            <div class="col-xs-12 col-sm-6 form-group">
                <label for="s_nombre">SEGUNDO NOMBRE:</label>
                <input type="text" name="s_nombre" value="{{ old('s_nombre', $verificacion->s_nombre) }}" id="s_nombre" class="form-control shadow" readonly>
            </div>

            <div class="col-xs-12 col-sm-6 form-group">
                <label for="tipo">TIPO INGRESO:</label>
                <input type="text" name="tipo" value="{{ old('tipo', $verificacion->tipo) }}" id="tipo" class="form-control shadow" readonly>
            </div>

           

            <div class="col-xs-12 col-sm-12 mt-4 mb-4 text-center">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <button type="submit" class="btn btn-primary btn-block">REGISTRAR INGRESO</button>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <a href="{!! url('/usuarios') !!}" class="btn btn-warning btn-block shadow">CANCELAR</a>
                    </div>
                </div>
            </div>

            </form>
        </div>

        {{-- Columna Derecha: Foto --}}
        <div class="col-xs-12 col-sm-6 foto-container">
            @php
                $rutaFoto = $verificacion->url_imagen 
                    ? asset($verificacion->url_imagen) 
                    : asset('img/default-avatar.png');
            @endphp

            <img 
            src="/Biometria/{{ $verificacion->url_imagen }}" 
                alt="Foto de verificaci¨®n" 
                loading="lazy">
        </div>

    </div>
</div>

@endsection
