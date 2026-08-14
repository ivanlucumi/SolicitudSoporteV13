@extends('layouts.digitalizacion.digitalizacion')

@section('title', 'Registro de Actividad en Despacho')
@section('cabecera', 'Registro de Actividad en Despacho')

@section('content')
<div class="container-fluid" style="background-color: #f8f9fa; padding: 30px 15px;">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="text-primary" style="margin-bottom:5px;">
                <i class="fa fa-building"></i> Despachos Asignados
            </h2>
            <p class="text-muted">Gestiona y registra las actividades de tus despachos asignados</p>
            <hr>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if ($despachos->isEmpty())
        <div class="alert alert-info text-center" style="padding: 30px;">
            <i class="fa fa-info-circle fa-2x text-info"></i>
            <h4>No tienes despachos asignados en tus circuitos.</h4>
        </div>
    @else
        <div class="panel panel-default" style="box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <div class="panel-heading" style="background: linear-gradient(to right, #003f75, #6610f2); color: white;">
                <h4 class="panel-title" style="margin: 0;">
                    <i class="fa fa-list"></i> Listado de Despachos Asignados
                    <span class="badge" style="background-color: rgba(255,255,255,0.3); margin-left: 10px;">{{ $despachos->count() }}</span>
                </h4>
            </div>
            <div class="panel-body" style="background-color: white;">
                <div class="table-responsive">
                    <table id="table9" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="active">
                                <th><i class="fa fa-building"></i> DESPACHO</th>
                                <th><i class="fa fa-map-marker"></i> CIRCUITO</th>
                                <th><i class="fa fa-city"></i> CIUDAD</th>
                                <th><i class="fa fa-location-arrow"></i> DIRECCI&Oacute;N</th>
                                <th><i class="fa fa-phone"></i> TEL&Eacute;FONO</th>
                                <th><i class="fa fa-envelope"></i> CORREO</th>
                                <th class="text-center"><i class="fa fa-cogs"></i>REGISTRAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($despachos as $despacho)
                                <tr>
                                    <td>
                                        <strong>{{ $despacho->nombreDespacho }}</strong>
                                    </td>
                                    <td>
                                        <span class="label label-primary">{{ $despacho->circuito }}</span>
                                    </td>
                                    <td>
                                        <i class="fa fa-map-marker text-muted"></i> {{ $despacho->ciudad->nombreCiudad }}
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $despacho->direccion }}</span>
                                    </td>
                                    <td>
                                        <i class="fa fa-phone"></i> {{ $despacho->telefono }}
                                        @if($despacho->extension)
                                            <small class="text-muted">Ext {{ $despacho->extension }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fa fa-envelope"></i> <a href="mailto:{{ $despacho->correoD }}">{{ $despacho->correoD }}</a>
                                    </td>
                                    <td class="text-center">
                                        @if ($despacho->actividades_count > 0)
                                            <a href="{{ route('actividades.create', ['despacho_id' => $despacho->codigoDespacho]) }}"
                                               class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i> Ver Registro
                                            </a>
                                        @else
                                            <a href="{{ route('actividades.create', ['despacho_id' => $despacho->codigoDespacho]) }}"
                                               class="btn btn-danger btn-sm">
                                                <i class="fa fa-plus"></i> Registrar
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSesisSS.js"></script> 

@endsection
