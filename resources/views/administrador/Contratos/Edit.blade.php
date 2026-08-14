@extends('layouts.admin')

@section('title', 'Editar contrato')
@section('cabecera', 'Editar Contrato / Orden de Compra')

@section('content')
@include('../alerts.success')
@include('../alerts.request')
@include('alerts.flash-message')

<div class="container-fluid">

<form method="POST"
      action="{{ route('contratos.novedades.update', $contrato->id) }}"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="panel panel-default">

        <div class="panel-heading">
            <strong>Editar contrato</strong>
        </div>

        <div class="panel-body">

            {{-- TIPO --}}
            <div class="row">
                {{-- NUMERO CONTRATO --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label>N&uacute;mero</label>
                        <input type="text"
                               name="numero"
                               id="numero"
                               class="form-control"
                               value="{{ old('numero', isset($contrato) ? $contrato->numero : '') }}"
                               placeholder="Numero"
                               required>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" class="form-control" required>
                            <option value="CONTRATO" {{ $contrato->tipo == 'CONTRATO' ? 'selected' : '' }}>
                                Contrato
                            </option>
                            <option value="ORDEN_COMPRA" {{ $contrato->tipo == 'ORDEN_COMPRA' ? 'selected' : '' }}>
                                Orden de compra
                            </option>
                        </select>
                    </div>
                </div>
                {{-- CONTRATISTA --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Contratista</label>
                        <input type="text"
                               name="contratista"
                               id="contratista"
                               class="form-control"
                               value="{{ old('contratista',  $contrato->contratista) }}"
                               placeholder="Contratista"
                               required>
                    </div>
                </div>

                {{-- ESTADO --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" class="form-control" required>
                            @foreach(['ACTIVO','FINALIZADO','CERRADO'] as $estado)
                                <option value="{{ $estado }}" {{ $contrato->estado == $estado ? 'selected' : '' }}>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                
            </div>

            <div class="row">
                
                 {{-- VALOR --}}
                <div class="col-md-4">
                    <label>Valor del contrato</label>
                    <input type="text"
                           name="valor"
                           id="valor"
                           min="1"
                           class="form-control"
                           value="{{$contrato->valor}}"
                           placeholder="costo en pesos (10.000.000,00)"
                           required>
                </div>
                

                {{-- OBJETO --}}
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Objeto</label>
                        <textarea name="objeto"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('objeto', $contrato->objeto ) }}</textarea>
                    </div>
                </div>
                
                 {{-- OBJETO --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Forma de pago</label>
                        <textarea name="forma_pago"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('objeto', $contrato->forma_pago ?? '') }}</textarea>
                    </div>
                </div>
            
            </div>

            {{-- FECHAS --}}
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha inicio</label>
                        <input type="date"
                               name="fecha_inicio"
                               class="form-control"
                               value="{{ $contrato->fecha_inicio->format('Y-m-d') }}"
                               required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha pólizas</label>
                        <input type="date"
                               name="fecha_polizas"
                               class="form-control"
                               value="{{ optional($contrato->fecha_polizas)->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha terminación</label>
                        <input type="date"
                               name="fecha_terminacion"
                               class="form-control"
                               value="{{ $contrato->fecha_terminacion->format('Y-m-d') }}"
                               required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha cierre</label>
                        <input type="date"
                               name="fecha_cierre"
                               class="form-control"
                               value="{{ optional($contrato->fecha_cierre)->format('Y-m-d') }}">
                    </div>
                </div>

            </div>

            {{-- DOCUMENTO INICIAL --}}
            <hr>
            <div class="form-group">
                <label>Documento inicial (Contrato / Orden de compra)</label>

                @if($contrato->documento_inicial)
                    <p>
                        <a href="{{ asset('supervisioncontrato/'.$contrato->documento_inicial) }}"
                           target="_blank">
                            Ver documento actual
                        </a>
                    </p>
                @endif

                <input type="file" name="documento_inicial" class="form-control">
            </div>

        </div>

        <div class="panel-footer text-right">
            <button class="btn btn-success">
                Guardar cambios
            </button>

            <a href="{{ route('contratos.novedades.show', $contrato->id) }}"
               class="btn btn-default">
                Cancelar
            </a>
        </div>

    </div>
</form>

</div>


@endsection
