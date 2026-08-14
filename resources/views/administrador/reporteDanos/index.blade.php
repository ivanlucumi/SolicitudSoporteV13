@extends('layouts.admin')
@section('title', 'Reporte de Fallas y Daños')
@section('cabecera', 'Listado de Solicitudes de Daños (Hardware)')

@section('content')

@include('../alerts.success')
@include('../alerts.request')

<div class="row">
    <div class="col-xs-12 col-sm-2">
        <!-- Opcional: algún botón adicional -->
    </div>
</div>
<hr>

<div class="table-responsive">
    <table id="table9" class="table table-hover table-condensed table-bordered">
        <thead style="background-color: #AFAFAF; color: #fff;">
            <tr>
                <th>ID</th>
                <th>FECHA REPORTE</th>
                <th>DESPACHO / DEPENDENCIA</th>
                <th>USUARIO REPORTA</th>
                <th>CATEGORÍAS AFECTADAS</th>
                <th>ACCIONES</th>                                             
            </tr>
        </thead>
        @if($reportes != null)
            <tbody class="buscar">
                @foreach($reportes as $reporte)
                <tr class="table-light">
                    <td scope="row">{{ $reporte->id }}</td>
                    <td scope="row">{{ $reporte->created_at->format('d/m/Y h:i A') }}</td>
                    <td scope="row"><strong>{{ $reporte->juzgado }}</strong></td>
                    <td scope="row">{{ $reporte->nombre_empleado }}</td>
                    <td>
                        @if(is_array($reporte->tipos_falla))
                            @foreach($reporte->tipos_falla as $tipo)
                                <span class="badge bg-secondary" style="color:#000;">{{ ucfirst($tipo) }}</span>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td scope="row"> 
                        <a href="{{ route('admin.reporte.danos.pdf', $reporte->id) }}" class="btn btn-danger btn-xs" title="Generar PDF" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                    </td>                               
                </tr>                   
                @endforeach
            </tbody>
        @endif
    </table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCuatroSSSS.js"></script> 

@endsection
