@extends('layouts.admin')

@section('title', 'Detalle contrato')
@section('cabecera', 'Seguimiento de Contrato')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">

{{-- DETALLE DEL CONTRATO --}}
<div class="panel panel-default">
    <div class="panel-heading">
        <center><strong>Detalle del contrato</strong></center>
    </div>

    <div class="panel-body">
        <div class="pull-left">
            <a href="{{ route('contratos.novedades.edit',$contrato->id) }}" class="btn btn-warning btn-sm">
                Editar
            </a>
            <a href="{{ route('contratos.novedades.index') }}" class="btn btn-danger btn-sm">
                Volver
            </a>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <div class="row">
            <div class="col-md-4">
                <strong>Numero:</strong><br>
                <span>
                    {{ $contrato->numero }}
                </span>
            </div>
            
            <div class="col-md-4">
                <strong>Contratista:</strong><br>
                <span>
                    {{ $contrato->contratista }}
                </span>
            </div>
            
            <div class="col-md-4">
                <strong>Estado:</strong><br>
                <span class="label label-{{ $contrato->semaforo }}">
                    {{ $contrato->estado }}
                </span>
            </div>
        </div>  
        <hr>
        <div class="row">
            <div class="col-md-4">
                <strong>Tipo:</strong><br>
                {{ $contrato->tipo }}
            </div>

            <div class="col-md-4">
                <strong>Estado:</strong><br>
                <span class="label label-{{ $contrato->semaforo }}">
                    {{ $contrato->estado }}
                </span>
            </div>

            <div class="col-md-4">
                <strong>Creado por:</strong><br>
                {{ $contrato->apoyo_supervision_id }}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-9">
                <strong>Objeto:</strong><br>
                {{ $contrato->objeto }}
            </div>

            <div class="col-md-3">
                <strong>Valor:</strong><br>
                ${{$contrato->valor }}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <strong>Fecha Inicio:</strong><br>
                <span class="label label-{{ $contrato->semaforoinicio }}">
                    {{ $contrato->fecha_inicio->format('d/m/Y') }}
                </span>
            </div>
            
            <div class="col-md-3">
                <strong>Fecha p&oacute;lizas:</strong><br>
                {{ optional($contrato->fecha_polizas)->format('d/m/Y') }}
            </div>
            
            <div class="col-md-3">
                <strong>Fecha Cierre:</strong><br>
                <span class="label label-{{ $contrato->semaforocierre }}">
                    {{ $contrato->fecha_cierre->format('d/m/Y') }}
                </span>
            </div>

            <div class="col-md-3">
                <strong>Fecha terminaci&oacute;n:</strong><br>
                {{ $contrato->fecha_terminacion->format('d/m/Y') }}
            </div>
        </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <!-- SEGUIMIENTO DE CONTRATO -->
                        <h4>Seguimiento del Contrato</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('contratos.seguimiento.update', $contrato->id) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="firmo_acta" {{ $contrato->firmo_acta && $contrato->firmo_acta ? 'checked' : '' }}>
                                            Firmó Acta
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="subio_secop" {{ $contrato->subio_secop && $contrato->subio_secop ? 'checked' : '' }}>
                                            Subió a SECOP
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="cerro_contrato" {{ $contrato->cerro_contrato && $contrato->cerro_contrato? 'checked' : '' }}>
                                            Cerró Contrato
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="subio_secop2" {{ $contrato->subio_secop2 && $contrato->subio_secop2 ? 'checked' : '' }}>
                                            Subió a SECOP II
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="termino_contrato_secop2" {{ $contrato->termino_contrato_secop2 && $contrato->termino_contrato_secop2 ? 'checked' : '' }}>
                                            Terminó Contrato en SECOP II
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Actualizar Seguimiento</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                
                <strong>Forma de Pago:</strong><br>
                {{ $contrato->forma_pago }}
            
            </div>
        </div>
        
        
        
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <hr>
                <h4>Documento inicial</h4>
                {{-- NOVEDADES --}}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <strong>Novedades / Modificaciones</strong>
                    </div>
                
                    <div class="panel-body">
                        {{-- FORMULARIO NOVEDAD --}}
                        <form method="POST" action="{{ route('contratos.novedades.save') }}">
                            @csrf
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                
                            <div class="form-group">
                                <textarea name="descripcion"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Describa la novedad o modificaci&oacute;n"
                                          required></textarea>
                            </div>
                
                            <button class="btn btn-primary btn-sm">
                                Agregar novedad
                            </button>
                        </form>
                
                        <hr>
                
                        {{-- LISTADO NOVEDADES --}}
                        @if($contrato->novedades->count())
                            <ul class="timeline">
                                @foreach($contrato->novedades as $n)
                                    <li>
                                        <strong>{{ $n->fecha->format('d/m/Y') }}</strong><br>
                                        {{ $n->descripcion }}<br>
                                        <small class="text-muted">
                                            Registrado por: {{ $n->usuario_id }}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No hay novedades registradas.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class=" col-xs-12 col-md-8">
                 {{-- DOCUMENTO INICIAL --}}
                <hr>
                <h4>Documento inicial</h4>
                
                @if($contrato->documento_inicial)
                    <hr>
                    <h4>
                        <i class="glyphicon glyphicon-file"></i>
                        Documento del contrato   
                        <a href="{{ asset('storage/'.$contrato->documento_inicial) }}"
                           class="btn btn-success btn-sm"
                           target="_blank">
                            <i class="glyphicon glyphicon-download"></i>
                            Descargar PDF
                        </a>
                    </h4>
                    
                    <div class="embed-responsive embed-responsive-4by3" style="border:1px solid #ddd">
                        <iframe
                            src="{{ asset('supervisioncontrato/'.$contrato->documento_inicial) }}"
                            type="application/pdf"
                            width="100%"
                            height="600px"
                            style="border:none;">
                        </iframe>
                    </div>
                    
                    <br>
                @else
                    <form method="POST"
                          action="{{ route('contratos.novedades.documento.id',$contrato->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
        
                        <input type="file" name="documento_inicial" required>
                        <br>
                        <button class="btn btn-primary btn-sm">
                            Subir documento
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <a href="{{ route('contratos.novedades.index') }}" class="btn btn-default">
            Volver
        </a>
    </div>
</div>
@endsection