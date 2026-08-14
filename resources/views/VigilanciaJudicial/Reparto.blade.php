@extends('layouts.VigilanciaJudicial')

@section('title', 'Repartos de Solicitud Vigilancia')
@section('cabecera', 'Hacer Reparto a Solicitud de Vigilancia')

@section('content')

<style>
/* ===== Estilo Minimal 2026 ===== */
.card-box {
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
    animation: fadeUp .6s ease;
}

.section-title {
    font-weight: 600;
    color: #004182;
    margin-bottom: 20px;
    border-bottom: 2px solid #eaeaea;
    padding-bottom: 8px;
}

.form-control[readonly] {
    background: #f9f9f9;
    border-left: 3px solid #004182;
}

.btn-primary {
    background: linear-gradient(135deg,#004182,#0056a3);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,.2);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="container-fluid">
    <div class="card-box">

        <h3 class="text-center section-title">
            DATOS COMPLETOS PARA ENVÍO DE INFORMACIÓN
        </h3>

        {{-- DATOS PERSONALES --}}
        <div class="row">
            @foreach([
                'tipo_solicitante' => 'CALIDAD DEL SOLICITANTE',
                'nombre_apellido' => 'NOMBRE COMPLETO',
                'cedula' => 'CÉDULA',
                'direccion' => 'DIRECCIÓN',
                'correo' => 'CORREO',
                'telefono' => 'TELÉFONO',
                'barrio' => 'BARRIO',
                'municipio' => 'MUNICIPIO'
            ] as $campo => $label)
            <div class="col-xs-12 col-md-3">
                <label class="text-center center-block">{{ $label }}</label>
                <input class="form-control @error('$campo') is-invalid @enderror" type="text" name="$campo" id="$campo" value="{{ old('$campo', $reparto->$campo) }}">
@error('$campo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            @endforeach
        </div>

        <hr>

        {{-- DATOS DEL PROCESO --}}
        <div class="row">
            <div class="col-md-4">
                <label for="despacho_encuentra">DESPACHO DEL PROCESO</label>
                <input class="form-control @error('despacho_encuentra') is-invalid @enderror" type="text" name="despacho_encuentra" id="despacho_encuentra" value="{{ old('despacho_encuentra', $reparto->despacho_encuentra) }}">
@error('despacho_encuentra')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-md-4">
                <label for="tipo_proceso">TIPO DE PROCESO</label>
                <input class="form-control @error('tipo_proceso') is-invalid @enderror" type="text" name="tipo_proceso" id="tipo_proceso" value="{{ old('tipo_proceso', $reparto->tipo_proceso) }}">
@error('tipo_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-md-4">
                <label for="num_radicado">NÚMERO RADICADO</label>
                <input class="form-control @error('num_radicado') is-invalid @enderror" type="text" name="num_radicado" id="num_radicado" value="{{ old('num_radicado', $reparto->num_radicado) }}">
@error('num_radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="demandante">DEMANDANTE</label>
                <input class="form-control @error('demandante') is-invalid @enderror" type="text" name="demandante" id="demandante" value="{{ old('demandante', $reparto->demandante) }}">
@error('demandante')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-md-6">
                <label for="demandado">DEMANDADO</label>
                <input class="form-control @error('demandado') is-invalid @enderror" type="text" name="demandado" id="demandado" value="{{ old('demandado', $reparto->demandado) }}">
@error('demandado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>

        <hr>

        {{-- ARCHIVOS --}}
        <div class="row text-center">
            <div class="col-md-6">
                <h4>FORMATO DE VIGILANCIA</h4>
                <a class="btn btn-default"
                   onclick="window.open('/VigilanciaJudicial/{{ $reparto->formato }}','popup','width=900,height=650')">
                    Ver Formato
                </a>
            </div>
            <div class="col-md-6">
                <h4>ANEXOS</h4>
                <a class="btn btn-default"
                   onclick="window.open('/VigilanciaJudicial/{{ $reparto->anexos }}','popup','width=900,height=650')">
                    Ver Anexos
                </a>
            </div>
        </div>

        <hr>

        {{-- FORMULARIO DE REPARTO --}}
        <form action="{{ route('reparto.vigilancia.judicial.asignar',$reparto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="observaciones">OBSERVACIONES</label>
            <textarea class="form-control @error('observaciones') is-invalid @enderror" rows="4" name="observaciones" id="observaciones">{{ old('observaciones', $reparto->observaciones ?? '') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="acta_reparto">ACTA DE REPARTO (PDF)</label>
                <input accept=".pdf" type="file" name="acta_reparto" id="acta_reparto" class="@error('acta_reparto') is-invalid @enderror">
@error('acta_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>

            <div class="col-md-6">
                <label for="reparto_asignado_a">DESPACHO PARA REPARTO</label>
                <select class="form-control @error('reparto_asignado_a') is-invalid @enderror" name="reparto_asignado_a" id="reparto_asignado_a">
    <option value="">SELECCIONE DESPACHOPARA REPARTO</option>
    @foreach([
                        '760011010101' => 'GRUPO SOPORTE TECNOLOGICO',
                        '760011398001' => 'CONSEJO SECCIONAL DE LA JUDICATURA DE VALLE DEL CAUCA - DESPACHO 1 ',
                        '760011398002' => 'CONSEJO SECCIONAL DE LA JUDICATURA DE VALLE DEL CAUCA - DESPACHO 2 ',
                        '760011398003' => 'CONSEJO SECCIONAL DE LA JUDICATURA DE VALLE DEL CAUCA - DESPACHO 3 ',
                    ] as $key => $value)
        <option value="{{ $key }}" @selected(old('reparto_asignado_a') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('reparto_asignado_a')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-primary btn-block" type="submit">Guardar Reparto</button>
            </div>
        </div>

        </form>
    </div>
</div>

@endsection
