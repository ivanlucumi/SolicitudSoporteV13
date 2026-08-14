@extends('layouts.admin')

@section('title', 'Vista Despachos')
@section('cabecera', 'Despachos Inscritos')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <a href="{{ route('despachos.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Crear Despacho
                </a>
                <a href="{{ route('despachos.export') }}" class="btn btn-success" style="margin-left: 0.5rem;">
                    <i class="fa fa-file-excel-o"></i> Descargar Excel
                </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table9" class="table table-hover table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>C&Oacute;DIGO</th>
                        <th>NOMBRE</th>
                        <th>SEDE</th>
                        <th>CIUDAD</th>
                        <th>DIRECCI&Oacute;N</th>
                        <th>EDIFICIO</th>
                        <th>PISO</th>
                        <th>TEL&Eacute;FONO</th>
                        <th>CORREO</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                @if($despachos)
                    @foreach($despachos as $despacho)
                        <tr>
                            <td style="width: 100px; word-wrap: break-word;">
                                {{ $despacho->codigoDespacho }}
                            </td>
                            <td style="width: 160px; word-wrap: break-word;">
                                {{ $despacho->nombreDespacho }}
                            </td>
                            <td style="width: 120px; word-wrap: break-word;">
                                {{ $despacho->sede ?: '-' }}
                            </td>
                            <td>
                                {{ strtoupper($despacho->ciudad) }}
                            </td>
                            <td>
                                {{ $despacho->direccion }}
                            </td>
                            <td>
                                {{ $despacho->edificio ?: '-' }}
                            </td>
                            <td>
                                {{ $despacho->piso ?: '-' }}
                            </td>
                            <td>
                                {{ $despacho->telefono }}
                                {{ $despacho->extension ? ' ext ' . $despacho->extension : '' }}
                            </td>
                            <td style="width: 140px; word-wrap: break-word;">
                                {{ $despacho->correoD }}
                            </td>
                            <td>
                                @if($despacho->estado == 'Activo' || empty($despacho->estado))
                                    <span class="label label-success">Activo</span>
                                @else
                                    <span class="label label-danger">{{ $despacho->estado }}</span>
                                @endif
                            </td>
                            <td class="text-center" style="min-width: 120px;">
                                <div class="btn-group">
                                    <a href="{{ route('despachos.edit', $despacho->codigoDespacho) }}"
                                       class="btn btn-default btn-xs"
                                       title="Editar"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('despachos.show', $despacho->codigoDespacho) }}"
                                       class="btn btn-info btn-xs"
                                       title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="#" data-target="#modal-delete-{{ $despacho->codigoDespacho }}"
                                       data-toggle="modal"
                                       class="btn btn-danger btn-xs"
                                       title="Inactivar"><i class="fa fa-power-off"></i></a>
                                </div>
                            </td>
                        </tr>
                        @include('administrador.despachos.modaleliminar')
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSesisSS.js"></script>

@endsection
