@extends('layouts.usuarios')

@section('title', 'Solicitudes de Servicios')
@section('cabecera', '📑 Formulario de Solicitudes al Grupo de Soporte')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<style>
/* === Botones estilo Material === */
.btn-material {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px 18px;
    font-size: 14px;
    font-weight: 500;
    color: #444;
    text-transform: uppercase;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
}
.btn-material i { opacity: 0.8; font-size: 16px; }
.btn-material:hover {
    background: #fff;
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    transform: translateY(-2px);
    color: #222;
}
.btn-material:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
.btn-material-block { width: 100%; }
</style>

<div class="container-fluid">

    {{-- Alertas dinámicas --}}
    <div id="msj-error" class="alert alert-danger alert-dismissible fade in" role="alert" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong id="msj"></strong>
    </div> 

    <div id="msj-eliminacion" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong id="msj"></strong>
    </div>

    {{-- Seccion formatos --}}
    <div class="row text-center">
        <h3 class="text-muted">Formatos para Adjuntar seg&uacute;n Requerimiento</h3>
        <hr>
        <div class="col-xs-12 col-sm-4">
            <a onclick="window.open('/img/1formatos/FormatoFimaElectronica .xlsx','popup','width=800,height=600')" class="btn-material btn-material-block">
                <i class="fa fa-file-excel-o"></i> Formato Firma Electr&oacute;nica
            </a>
        </div>  
        <div class="col-xs-12 col-sm-4">
            <a onclick="window.open('/img/1formatos/FormulariosolicitudVPN.docx','popup','width=800,height=600')" class="btn-material btn-material-block">
                <i class="fa fa-file-word-o"></i> Formato Solicitud Usuario Remoto
            </a>
        </div> 
        <div class="col-xs-12 col-sm-4">
            <a onclick="window.open('/img/1formatos/FormatoSolicitudUsuarioPagWeb.xls','popup','width=800,height=600')" class="btn-material btn-material-block">
                <i class="fa fa-file-excel-o"></i> Formato Solicitud Usuario P&aacute;gina Web
            </a>
        </div> 
        <div class="col-xs-12 col-sm-4">
            <a onclick="window.open('/img/1formatos/SolicitudUsuariosJXXIWeb.pdf','popup','width=800,height=600')" class="btn-material btn-material-block">
                <i class="fa fa-file-pdf-o"></i> Formato Solicitud Justicia XXI Web
            </a>
        </div> 
        <div class="col-xs-12 col-sm-4">
            <a onclick="window.open('/img/1formatos/CorreccionesJusticiaXXIWEB.pdf','popup','width=800,height=600')" class="btn-material btn-material-block">
                <i class="fa fa-file-pdf-o"></i> Formato Correcciones Justicia XXI Web
            </a>
        </div> 
        <div class="col-xs-12 col-sm-4">
            <a onclick="window.open('/img/1formatos/Formato Solicitud Usuario SGDE.docx','popup','width=800,height=600')" class="btn-material btn-material-block">
                <i class="fa fa-file-word-o"></i> Formato Solicitud Usuario SGDE
            </a>
        </div>
    </div>

    <hr>

    {{-- Formulario --}}
    <form enctype="multipart/form-data" id="almacenar_reporte_radicado" action="{{ route('usuario.store.servicio') }}" method="POST">
    @csrf
        <input type="hidden" name="id_despacho" id="id_despacho" value="{{  auth()->user()->cedula }}">
        <input type="hidden" name="despacho" id="despacho" value="{{  auth()->user()->name.' '. auth()->user()->lastname }}">

        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="tipo_solicitud">Tipo Solicitud</label>
                <select class="form-control select2 @error('tipo_solicitud') is-invalid @enderror" id="select" name="tipo_solicitud">
    <option value="">Seleccione tipo de Solicitud</option>
    @foreach($tipo_solicitud as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            </div>
            <div class="col-sm-4 form-group">
                <label for="id_funcionario">Identificación</label>
                <input class="form-control @error('id_funcionario') is-invalid @enderror" placeholder="Ingrese No. Identificación" type="number" name="id_funcionario" id="id_funcionario" value="{{ old('id_funcionario') }}">
@error('id_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-sm-4 form-group">
                <label for="funcionario">Nombre(s) y Apellido(s)</label>
                <input class="form-control @error('funcionario') is-invalid @enderror" placeholder="Ingrese Nombre Completo" type="text" name="funcionario" id="funcionario" value="{{ old('funcionario') }}">
@error('funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>

        {{-- Archivos dinámicos --}}
        <div class="row">
            <div class="col-md-6 form-group" style="display:none" id="anexos">
                <label for="archivo">Formato</label>
                <input class="form-control @error('anexos') is-invalid @enderror" id="file_anexo" type="file" name="anexos">
@error('anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <span id="info-acta" class="alert alert-warning  help-block text-danger" style="display:none">
                    Es obligatorio adjuntar Acta de Posesión o Resolución de Nombramiento.
                </span>
                <span id="bancoA" class="alert alert-warning  help-block text-warning" style="display:none">
                    Indique la Cédula del solicitante y la acción requerida.
                </span>
                <span id="SgdeCreacion" class="alert alert-warning help-block text-warning" style="display:none">
                    Asegúrese de tener el  Formato Solicitud Usuario SGDE debidamente diligenciado y adjuntarlo.
                </span>
                <span id="TybaCreacion" class="alert alert-warning help-block text-warning" style="display:none">
                    Si es creacion, asegúrese de tener el  Formato Solicitud Justicia XXI WEB debidamente diligenciado y adjuntarlo.
                </span>
            </div>
            <div class="col-md-6 form-group" style="display:none" id="acta">
                <label for="archivo">Acta Nombramiento</label>
                <input class="form-control @error('acta_nombramiento') is-invalid @enderror" id="file_acta" type="file" name="acta_nombramiento">
@error('acta_nombramiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
        
        
        {{-- Mensajes dinámicos --}}
        <div id="mensaje_solicitud" class="alert alert-info" style="display:none;"></div>

        <div class="form-group">
            <label for="solicitud">Descripci&oacute;n del Requerimiento</label>
            <textarea class="form-control @error('solicitud') is-invalid @enderror" rows="4" placeholder="Describa el requerimiento solicitado" name="solicitud" id="solicitud">{{ old('solicitud') }}</textarea>
@error('solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>

        <div class="row text-center">
            <div class="col-sm-6">
                <button class="btn-material btn-material-block" type="submit">Guardar</button>
            </div>
            <div class="col-sm-6">
                <a href="{!! url('/usuarios')!!}" class="btn-material btn-material-block">Cancelar</a>
            </div>
        </div>
    </form>

    <hr>

    {{-- Listado solicitudes --}}
@if($solicitudes != null)
    <div class="text-right mb-2">
        <button onclick="location.reload()" class="btn-material">
            Actualizar listado
        </button>
    </div>

    <div class="table-responsive">
        <table id="table9" class="table table-bordered table-striped table-hover table-solicitudes">
            <thead>
                <tr>
                    <th class="col-presento">Present&oacute;</th>
                    <th class="col-tipo">Tipo Solicitud</th>
                    <th class="col-solicitud">Solicitud</th>
                    <th class="col-estado">Estado</th>
                    <th class="col-solucion">Soluci&oacute;n</th>
                    <th class="col-accion">Acci&oacute;n</th>
                </tr>
            </thead>  
            <tbody>
                @foreach($solicitudes as $radicado)
                    <tr data-id="{!!$radicado->id!!}">
                        <td>{{$radicado->funcionario}}</td>
                        <td><span class="label label-info">{{$radicado->tipo_solicitud}}</span></td>
                        <td>{!!$radicado->solicitud!!}</td>
                        <td>
                            <span class="label label-{{$radicado->estado=='PENDIENTE'?'warning':'success'}}">
                                {{$radicado->estado}}
                            </span>
                            <br>
                            <small>{{$radicado->fecha_solucion}}</small>
                        </td>
                        <td>
                            <div class="respuesta-solucion">
                                {!! preg_replace('/<img(.*?)style="(.*?)"(.*?)>/i', 
                                    '<img$1style="$2 max-width:100%; height:auto;"$3>', 
                                    $radicado->respuesta) !!}
                            </div>
                        </td>
                        <td class="text-center">
                            @if($radicado->respuesta == null)
                                <a id="eliminarRegistro" class="btn-material eliminarRegistro">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<style>
/* Ajuste responsive con tamaños definidos */
.table-solicitudes {
    font-size: 14px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    width: 100% !important;
    table-layout: fixed; /* aplica anchos de columnas */
}

/* Cabecera */
.table-solicitudes th {
    background: #004182;
    color: #fff;
    text-align: center;
    font-size: 15px;
}

/* Columnas con ancho definido */
.col-presento  { width: 10%; }
.col-tipo      { width: 10%; }
.col-solicitud { width: 25%; }
.col-estado    { width: 8%; }
.col-solucion  { width: 42%; }
.col-accion    { width: 5%; }

/* Ajustes de celdas */
.table-solicitudes td {
    vertical-align: middle !important;
    word-wrap: break-word;
    white-space: normal;
}

/* Solución con scroll interno */
.respuesta-solucion {
    max-height: 200px;
    overflow-y: auto;
    padding: 5px;
}

/* Hover suave */
.table-solicitudes tbody tr:hover {
    background: rgba(0, 125, 110, 0.08);
    transition: all 0.3s ease;
}
</style>


    <form id="form-delete-Registro" action="{{ route('usuario.delete.servicio',':REGISTRO_ID') }}" method="POST">
    @csrf
    @method('DELETE')
    </form>
</div>

@push('scripts')
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/indexSolicitudUsuario.js"></script> 

<script>
$(document).ready(function() {
    // Eliminar registro
    $('.eliminarRegistro').click(function(e) {       
        e.preventDefault();
        let row = $(this).closest('tbody');
        let id = row.data('id');
        let form = $('#form-delete-Registro');
        let url = form.attr('action').replace(':REGISTRO_ID', id);
        let data = form.serialize();

        row.fadeOut();
        $.post(url, data, function(result){
            $("#msj-eliminacion").html("<ul>" + result + "</ul>").fadeIn();
        });
    });

    // Mostrar campos según tipo de solicitud
    $('#select').on('change', function() {
        let val = this.value;
        let anexos = $("#anexos"), acta = $("#acta"), info = $("#info-acta"), banco = $("#bancoA"), sgde = $("#SgdeCreacion"), Tyba = $("#TybaCreacion");
        anexos.hide(); acta.hide(); info.hide(); banco.hide(); sgde.hide();
        $('#file_anexo, #file_acta').removeAttr('required');

        if(['CREACION USUARIO BESTDOC','VPN (USUARIO REMOTO)','CREACION USUARIO DOMINIO','TYBA (JUSTICIA XXI WEB)'].includes(val)){
            anexos.show(); $('#file_anexo').attr('required', true);
        }
        if(val === 'CREACION CORREO ELECTRONICO'){
            anexos.show(); info.show(); $('#file_anexo').attr('required', true);
        }
        if(val === 'CREACION USUARIO SGDE'){
            anexos.show(); sgde.show(); $('#file_anexo').attr('required', true);
        }
        if(val === 'TYBA (JUSTICIA XXI WEB)'){
            anexos.show(); Tyba.show(); $('#file_anexo').attr('required', true);
        }
        if(val === 'SOLICITUD FIRMA ELECTRONICA'){
            anexos.show(); acta.show(); $('#file_anexo,#file_acta').attr('required', true);
        }
        if(val === 'BANCO AGRARIO'){
            banco.show().html('<strong><span style="color:green;">ES IMPORTANTE INDICAR CÉDULA DEL SOLICITANTE Y ACCIÓN A REALIZAR</span></strong>');
        }
    });
});
</script>

<script>
$(document).ready(function () {
    $('#tipo_solicitud').on('change', function () {
        var opcion = $(this).val();
        var mensajeBox = $('#mensaje_solicitud');
        var campoOtro = $('#campo_otro');

        mensajeBox.hide().text('');
        campoOtro.hide();

        switch(opcion) {
            case 'VPN':
                mensajeBox.text('🔐 Ha seleccionado VPN. Asegúrese de tener autorización previa y el formato debidamente diligenciado').fadeIn();
                break;
            case 'CREACION CORREO ELECTRONICO':
                mensajeBox.text('📧 Ha seleccionado Correo Institucional. Es obligatorio adjuntar Acta de Posesión o Resolución de Nombramiento.').fadeIn();
                break;
            case 'SOLICITUD FIRMA ELECTRONICA':
                mensajeBox.text('✍️ Ha seleccionado Firma Electrónica. Asegúrese de tener autorización previa y el formato debidamente diligenciado.').fadeIn();
                break;
            case 'CREACION USUARIO SGDE':
                mensajeBox.text('✍️ Asegúrese de tener el  Formato Solicitud Usuario SGDE debidamente diligenciado y adjuntarlo.').fadeIn();
                break;
            case 'OTRO':
                mensajeBox.text('📝 Ha seleccionado "Otro". Por favor especifique en el campo habilitado.').fadeIn();
                campoOtro.fadeIn();
                break;
            default:
                mensajeBox.hide();
        }
    });
});
</script>

{{-- Exportar tabla --}}
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>
<script>
$("table").tableExport({
    formats: ["xlsx"],
    position: 'top',
    bootstrap: true,
    fileName: "Solicitud al Grupo Soporte",
});
</script>
@endpush

@endsection
