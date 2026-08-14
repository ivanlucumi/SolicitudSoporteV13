@extends('layouts.admin')

@section('title', 'Vista Despachos')
@section('cabecera', 'Despachos Inscritos')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

<style>
  .btn-modern-index {
    border: none;
    border-radius: 0.6rem;
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .btn-modern-index:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
  }
  .btn-crear-index {
    background: linear-gradient(135deg, #003f75 0%, #0056a3 100%);
    color: #fff;
  }
  .btn-crear-index:hover {
    background: linear-gradient(135deg, #0056a3 0%, #0074d9 100%);
    color: #fff;
  }
  .table-modern thead {
    background: linear-gradient(135deg, #003f75 0%, #0056a3 100%);
    color: #fff;
  }
  .table-modern thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.04em;
    padding: 0.75rem;
    border: none;
  }
  .table-modern tbody td {
    font-size: 0.9rem;
    padding: 0.75rem;
    vertical-align: middle;
  }
  .table-modern tbody tr {
    transition: all 0.2s ease;
  }
  .table-modern tbody tr:hover {
    background: rgba(0, 63, 117, 0.04);
  }
  .status-badge-table {
    display: inline-block;
    padding: 0.2rem 0.5rem;
    border-radius: 0.3rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
  }
  .status-activo { background: rgba(40, 167, 69, 0.12); color: #28a745; }
  .status-inactivo { background: rgba(220, 53, 69, 0.12); color: #dc3545; }
  .btn-accion {
    border: none;
    border-radius: 0.4rem;
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
  }
  .btn-accion:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
  }
  .btn-edit { background: rgba(0, 63, 117, 0.1); color: #003f75; }
  .btn-edit:hover { background: #003f75; color: #fff; }
  .btn-view { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }
  .btn-view:hover { background: #17a2b8; color: #fff; }
  .btn-delete { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
  .btn-delete:hover { background: #dc3545; color: #fff; }
</style>

<div class="row mb-3">
    <div class="col-xs-12 col-sm-3">
        <a href="{{ route('despachos.create') }}" class="btn-modern-index btn-crear-index">
            <i class="fa fa-plus"></i> Crear Despacho
        </a>
    </div>
    <div class="col-xs-12 col-sm-3">
        <a href="{{ route('despachos.export') }}" class="btn-modern-index btn-crear-index" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); margin-left: 0.5rem;">
            <i class="fa fa-file-excel-o"></i> Descargar Excel
        </a>
    </div>
</div>

<hr>

<div class="table-responsive">
    <table id="table9" class="table table-hover table-condensed table-bordered table-modern">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>NOMBRE</th>
                <th>SEDE</th>
                <th>CIUDAD</th>
                <th>DIRECCIÓN</th>
                <th>EDIFICIO</th>
                <th>PISO</th>
                <th>TELÉFONO</th>
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
                            <span class="status-badge-table status-activo">Activo</span>
                        @else
                            <span class="status-badge-table status-inactivo">{{ $despacho->estado }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <a href="{{ route('despachos.edit', $despacho->codigoDespacho) }}"
                                   class="btn-accion btn-edit btn-sm fa fa-pencil"
                                   title="Editar"></a>
                            </div>
                            <div class="col-xs-4">
                                <a href="{{ route('despachos.show', $despacho->codigoDespacho) }}"
                                   class="btn-accion btn-view btn-sm fa fa-eye"
                                   title="Ver"></a>
                            </div>
                            <div class="col-xs-4">
                                <a href="" data-target="#modal-delete-{{ $despacho->codigoDespacho }}"
                                   data-toggle="modal">
                                    <button class="btn-accion btn-delete btn-sm fa fa-power-off" title="Inactivar"></button>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @include('administrador.despachos.modaleliminar')
            @endforeach
        @endif
        </tbody>
    </table>
</div>

{{-- Scripts --}}
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSesisSS.js"></script>

@endsection
