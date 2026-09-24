@extends('layouts.admin')
@section('title')
Respuestas de Trabajo en Casa
@endsection

@section('cabecera')
Módulo: Trabajo en Casa 
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="text-secondary"><i class="fas fa-list-alt"></i> Listado de Respuestas</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.trabajocasa.excel') }}" class="btn btn-success font-weight-bold shadow-sm">
                <i class="fas fa-file-excel"></i> Descargar Reporte en Excel
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Cédula</th>
                            <th>Despacho</th>
                            <th>Ciudad</th>
                            <th>¿Cuenta con VPN?</th>
                            <th>¿Requiere VPN?</th>
                            <th>¿Tiene Elementos?</th>
                            <th>Computador</th>
                            <th>Impresora</th>
                            <th>Escáner</th>
                            <th>Internet</th>
                            <th>Silla</th>
                            <th>Escritorio</th>
                            <th>Aplicaciones</th>
                            <th>Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($encuestas as $encuesta)
                        <tr>
                            <td>{{ $encuesta->id }}</td>
                            <td>{{ $encuesta->cedula }}</td>
                            <td>{{ $encuesta->dependencia }}</td>
                            <td>{{ $encuesta->ciudad }}</td>
                            <td class="text-center">
                                @if($encuesta->tiene_vpn == 'SI')
                                    <span class="badge badge-success">SÍ</span>
                                @elseif($encuesta->tiene_vpn == 'NO')
                                    <span class="badge badge-danger">NO</span>
                                @else
                                    <span class="badge badge-secondary">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($encuesta->requiere_vpn == 'SI')
                                    <span class="badge badge-warning text-dark">SÍ</span>
                                @elseif($encuesta->requiere_vpn == 'NO')
                                    <span class="badge badge-info">NO</span>
                                @else
                                    <span class="badge badge-secondary">N/A</span>
                                @endif
                            </td>
                            <td class="text-center font-weight-bold">
                                {{ $encuesta->cuenta_todos_elementos ?: 'N/A' }}
                            </td>
                            <td>{{ $encuesta->computador }}</td>
                            <td>{{ $encuesta->impresora }}</td>
                            <td>{{ $encuesta->escaner }}</td>
                            <td>{{ $encuesta->conectividad }}</td>
                            <td>{{ $encuesta->silla }}</td>
                            <td>{{ $encuesta->escritorio }}</td>
                            <td>{{ $encuesta->aplicaciones ?: 'N/A' }}</td>
                            <td>{{ $encuesta->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16" class="text-center text-muted py-4">No hay respuestas registradas aún.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $encuestas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
