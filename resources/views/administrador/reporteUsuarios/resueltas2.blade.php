@extends('layouts.admin')

@section('title', 'Reportes Funcionarios')
@section('cabecera', 'Reporte de Usuarios')

@section('content')
@include('../alerts.success')
@include('../alerts.request')


<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

{{-- Spinner inicial --}}
<div id="spinner" class="spinner-overlay">
    <i class="fa fa-spinner fa-spin fa-5x text-primary" aria-hidden="true"></i>
    <span class="text-spinner">Cargando reporte, por favor espere...</span>
</div>

<div class="container-fluid" id="contenido" >
    <div class="table-responsive">
        <table id="table9" class="table table-hover table-condensed table-bordered" style="margin-bottom:20px;table-layout:fixed;">
            <colgroup>
                <col style="width:4%;">
                <col style="width:7%;">
                <col style="width:7%;">
                <col style="width:20%;">
                <col style="width:8%;">
                <col style="width:10%;">
                <col style="width:44%;">
            </colgroup>
            <thead style="background-color:#AFAFAF;color:#fff;">
                <tr>
                    <th>ACCIÓN</th>
                    <th>PRESENTÓ</th>
                    <th>TIPO SOLICITUD</th>
                    <th>SOLICITUD</th>
                    <th>JUZGADO</th>
                    <th>FECHA S/CION</th>
                    <th>SOLUCIÓN</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($reportes as $reporte)
                        <tr class="@if($reporte->id_user != null) warning @endif" data-id="{!!$reporte->id!!}" @if($reporte->id_user ==  auth()->user()->id)
                            style="background-color: #FBBAB4"
                        @endif>
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
                            <td>{{ $reporte->solicitud }}</td>
                            <td>
                                <strong>Atendi&oacute;:</strong> {{ $reporte->quien_da_solucion }}<br>
                                <strong>Fecha S/TUD:</strong> {{ $reporte->fecha_solicitud }}<br>
                                <strong>Fecha S/CION:</strong> {{ $reporte->fecha_solucion }}
                            </td>
                            <td style="width:30%;max-width:30%;word-wrap:break-word;white-space:normal;">
                                <div style="max-width:100%;overflow-x:auto;max-height:300px;overflow-y:auto;">
                                    {!! $reporte->respuesta_formateada !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center">
        {!! $reportes->links() !!}
    </div>
</div>

{{-- JS diferido para velocidad --}}

<script src="/js/jquery.js" defer></script>
<script src="/tablefilter/tablefilter.js" defer></script>
<script src="/js/filterSeisAdminResulestas.js" defer></script>


{{-- Spinner + inicio rápido --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Mostrar tabla tras renderizado
    setTimeout(() => {
        document.getElementById('spinner').style.display = 'none';
        document.getElementById('contenido').style.display = 'block';
    }, 300);
});
</script>

<style>
.spinner-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255,255,255,0.95);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.text-spinner {
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}
.table th, .table td {
    border: 1px solid #AFAFAF;
    vertical-align: middle;
}
.table thead th {
    background-color: #AFAFAF;
    color: #fff;
    font-weight: bold;
}
.table tbody tr.warning { background-color: #FBBAB4 !important; }
.table tbody tr.active { background-color: #f9f9f9; }
.btn-group-vertical {
    display: flex;
    flex-direction: column;
}
.btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    border-radius: 3px;
    margin: 2px 0;
}
.pagination { margin: 10px 0 0 0; }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
