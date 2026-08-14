@extends('layouts.admin')

@section('title', 'Reportes Funcionarios')
@section('cabecera', 'Reporte de Usuarios')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">
    <!-- Panel de Registro de Solicitud -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Registrar Nueva Solicitud</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('administrador.registrar.solicitud.usuario') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <div class="form-group">
                            <label for="tipo_solicitud" class="control-label">Tipo Solicitud:</label>
                            <select name="tipo_solicitud" class="form-control" required>
                                <option value="">SELECCIONE TIPO SOLICITUD</option>
                                @foreach($tipo_solicitud as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-2">
                        <div class="form-group">
                            <label for="medio_solicitud" class="control-label">Medio Solicitud:</label>
                            <select name="medio_solicitud" class="form-control" required>
                                <option value="">MEDIO DE SOLICITUD</option>
                                @foreach($medio as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-2">
                        <div class="form-group">
                            <label for="id_funcionario" class="control-label">Identificación:</label>
                            <input type="number" name="id_funcionario" class="form-control" placeholder="Identificación" required id="id_funcionario">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <label for="funcionario" class="control-label">Nombre Completo:</label>
                            <input type="text" name="funcionario" value="{{ $reporte->funcionario }}" class="form-control" required placeholder="Nombre Completo" id="funcionario">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <label for="despacho" class="control-label">Despacho:</label>
                            <select name="despacho" class="form-control" required>
                                <option value="">SELECCIONE DESPACHO</option>
                                @foreach($despachos as $key => $value)
                                    <option value="{{ $key }}" @if(old('despacho') == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="solicitud" class="control-label">Requerimiento:</label>
                            <textarea name="solicitud" class="form-control" rows="4" required placeholder="Describa el Requerimiento">{{ $reporte->solicitud }}</textarea>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="respuesta" class="control-label">Respuesta:</label>
                            <textarea name="respuesta" id="compose-textarea" class="form-control" rows="4" required placeholder="Describa la Solución"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-floppy-disk"></i> Guardar Solicitud
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Panel de Historial de Solicitudes -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Historial de Solicitudes</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="table9" class="table table-bordered table-hover table-condensed">
                    <colgroup>
                        <col style="width: 8%;">    <!-- ACCIÓN -->
                        <col style="width: 10%;">   <!-- PRESENTÓ -->
                        <col style="width: 10%;">   <!-- TIPO SOLICITUD -->
                        <col style="width: 35%;">   <!-- SOLICITUD -->
                        <col style="width: 8%;">    <!-- ESTADO -->
                        <col style="width: 12%;">   <!-- JUZGADO -->
                        <col style="width: 10%;">   <!-- ATENDIO -->
                        <col style="width: 7%;">    <!-- FECHA -->
                    </colgroup>
                    <thead class="bg-primary">
                        <tr>  
                            <th class="text-center">ACCIÓN</th>
                            <th>PRESENTÓ</th>
                            <th>TIPO</th>
                            <th>SOLICITUD</th>
                            <th>ESTADO</th>
                            <th>JUZGADO</th>
                            <th>ATENDIÓ</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportes as $reporte)
                        <tr class="@if($reporte->id_user != null) warning @endif" data-id="{!!$reporte->id!!}">
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    @if($reporte->id_user != null && $reporte->id_user !=  auth()->user()->id)
                                    <button class="btn btn-primary disabled" title="Editar" disabled>
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    @else
                                    <a href="{{ route('administrador.registro.solicitud.edit', $reporte->id) }}" class="btn btn-primary" title="Editar">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @endif
                                    
                                    @if($reporte->id_user ==  auth()->user()->id && $reporte->respuesta == null)
                                    <a href="{{ route('administrador.registro.solicitud.soltar', $reporte->id) }}" class="btn btn-warning" title="Soltar">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $reporte->funcionario }}</td>
                            <td>{{ $reporte->tipo_solicitud }}</td>
                            <td>
                                <div style="max-height: 100px; overflow-y: auto;">
                                    {{ $reporte->solicitud }}
                                    @if($reporte->anexo)
                                    <div class="mt-2">
                                        <a href="#" onclick="window.open('/Soportes/{{$reporte->anexo}}','popup', 'width=800,height=600')" class="label label-info">
                                            <i class="glyphicon glyphicon-paperclip"></i> {{ $reporte->anexo }}
                                        </a>
                                    </div>
                                    @endif
                                    @if($reporte->acta)
                                    <div class="mt-1">
                                        <a href="#" onclick="window.open('/Soportes/{{$reporte->acta}}','popup', 'width=800,height=600')" class="label label-info">
                                            <i class="glyphicon glyphicon-file"></i> {{ $reporte->acta }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="label 
                                    @if($reporte->estado == 'Pendiente') label-warning
                                    @elseif($reporte->estado == 'Atendido') label-success
                                    @else label-default
                                    @endif">
                                    {{ $reporte->estado }}
                                </span>
                            </td>
                            <td>{{ $reporte->despacho }}</td>
                            <td>{{ $reporte->quien_da_solucion }}</td>
                            <td>{{ $reporte->fecha_solicitud }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery.js"></script> 
<script src="/tablefilter/tablefilter.js"></script> 
<script src="/js/filterOchoSoporte.js"></script>  

<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });
    
    // Validación de cédula
    var verifCedula = document.getElementById('id_funcionario');
    verifCedula.addEventListener('input', function() {
        $.get("/administrador/consulta/cedula/corte/" + this.value + "", function(response) {
            if (Object.keys(response).length > 0) {
                document.getElementById('funcionario').value = response.nameE + " " + response.lastnameE;
            } else {
                document.getElementById('funcionario').value = "";
            }
        });
    });
</script>

@push('styles')
<style>
    .panel {
        border-radius: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .panel-heading {
        border-radius: 0;
        padding: 10px 15px;
    }
    
    .panel-title {
        font-size: 16px;
        font-weight: bold;
    }
    
    .panel-primary .panel-heading {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
    }
    
    .table th {
        background-color: #f5f5f5;
        font-weight: bold;
    }
    
    .table>thead>tr>th {
        vertical-align: middle;
        border-bottom: 1px solid #ddd;
    }
    
    .table>tbody>tr>td {
        vertical-align: middle;
    }
    
    .label {
        display: inline-block;
        padding: 3px 6px;
        font-size: 12px;
        font-weight: bold;
        line-height: 1.4;
        border-radius: 3px;
    }
    
    .form-control {
        border-radius: 2px;
    }
    
    .btn {
        border-radius: 2px;
    }
    
    textarea {
        resize: vertical;
    }
</style>
@endpush

@push('scripts')
<script>
    // Inicialización de componentes
    $(document).ready(function() {
        // Inicializar tooltips
        $('[title]').tooltip();
        
        // Configuración de selects si se usa select2
        if($.fn.select2) {
            $('select').select2({
                minimumResultsForSearch: 10
            });
        }
    });
</script>
@endpush

@endsection