@extends('layouts.admin')

@section('title', 'Solicitudes')
@section('cabecera', 'Formulario Reporte a Grupo Soporte')

<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
:root{
    --primary:#002147;
    --primary2:#0d6efd;
    --font-scale: 0.55; /* Más pequeño */
}

label{
    font-size: 16px !important;
    font-weight: 600;
}

.page-header{
    background:linear-gradient(135deg,#002147,#004b8f);
    color:#fff;
    border-radius:20px;
    padding:30px;
    margin-bottom:25px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}
.page-header{
    padding:15px 16px;
}

.page-header h3{
    font-size:20px;
    font-weight:600;
    margin-bottom:3px;
}

.page-header p{
    font-size:12px;
    margin:0;
}
.modern-card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}
.section-title{
    font-weight:700;
    color:var(--primary);
    border-bottom:2px solid #eef2f7;
    padding-bottom:10px;
    margin:25px 0 20px;
}
.form-control{
    border-radius:12px;
}
trix-editor{
    min-height:350px;
    border-radius:0 0 12px 12px;
}
.btn-save{
    background:#198754;
    color:white;
}
.btn-cancel{
    background:#ffc107;
}
.file-box{
    background:#f8fafc;
    border:1px dashed #ced4da;
    border-radius:15px;
    padding:15px;
}
</style>

@section('content')

<div class="container-fluid">

    <div class="page-header">
        <h3><i class="fas fa-headset"></i> Solicitudes al Grupo de Soporte</h3>
        
        <div class="row">

                <div class="col-md-5 form-group">
                    <label>Tipo Solicitud</label>
                    <select name="tipo_solicitud" class="form-control select2" disabled>
                        @foreach($tipo_solicitud as $key => $value)
                            <option value="{{ $key }}" @if($reporte->tipo_solicitud == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 form-group">
                    <label>Fecha Solicitud</label>
                    <input type="text" class="form-control"
                           value="{{ $reporte->fecha_solicitud }}" readonly>
                </div>

                <div class="col-md-5 form-group">
                    <label>Funcionario</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $reporte->funcionario }} CC.{{ $reporte->id_funcionario }}"
                           readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label>Despacho</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $reporte->despacho }}"
                           readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label>Email Despacho</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $reporte->email_despacho }}"
                           readonly>
                </div>

            </div>
    </div>

    <div class="modern-card">

        <form action="{{ route('administrador.registro.solicitud.resolver', $reporte->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="section-title">
                <i class="fas fa-file-alt"></i> Requerimiento Reportado
            </div>

            <div class="form-group">
                <textarea class="form-control" readonly style="height:180px">{{ $reporte->solicitud }}</textarea>
            </div>

            <div class="section-title">
                <i class="fas fa-paperclip"></i> Archivos Adjuntos
            </div>

            <div class="file-box">
                <a href="#" onclick="window.open('/Soportes/{{ $reporte->anexo }}','popup','width=900,height=700');return false;">
                    {{ $reporte->anexo }}
                </a>
                <br>
                <a href="#" onclick="window.open('/Soportes/{{ $reporte->acta }}','popup','width=900,height=700');return false;">
                    {{ $reporte->acta }}
                </a>
            </div>

            <div class="section-title">
                <i class="fas fa-reply"></i> Respuesta del Grupo de Soporte
            </div>

            <input id="respuesta"
                   type="hidden"
                   name="respuesta"
                   value="{{ old('respuesta', $reporte->respuesta) }}">

            <trix-editor input="respuesta"></trix-editor>

            <div class="mt-4 row">
                <div class="col-md-3"></div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-save btn-block">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>

                <div class="col-md-3">
                    <a href="{{ url('/administrador/registro/solicitud/usuarios') }}"
                       class="btn btn-cancel btn-block">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>

                <div class="col-md-3"></div>
            </div>

        </form>
    </div>
</div>

@endsection
