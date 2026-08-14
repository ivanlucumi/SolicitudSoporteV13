@extends('layouts.administrador')
@section('title', 'Almacén - Préstamo de Equipos')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-boxes"></i> Gestión de Préstamo de Equipos</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Solicitudes Recibidas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Radicado</th>
                            <th>Fecha</th>
                            <th>Despacho</th>
                            <th>Solicitante</th>
                            <th>Equipos Solicitados</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                        <tr>
                            <td class="font-weight-bold text-center">#{{ str_pad($solicitud->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $solicitud->created_at->format('d/m/Y h:i A') }}</td>
                            <td>{{ $solicitud->despacho }}</td>
                            <td>{{ $solicitud->nombre_solicitante }}<br><small>CC: {{ $solicitud->cedula_solicitante }}</small></td>
                            <td>
                                <ul class="pl-0 mb-0" style="font-size: 0.9em; list-style-type: none;">
                                    @foreach((array)($solicitud->equipos ?? []) as $emp)
                                        <li class="mb-2" style="border-bottom: 1px dashed #eee; padding-bottom: 5px;">
                                            <strong>{{ $emp['nombre'] ?? 'Empleado' }}</strong> <small class="text-muted">(CC: {{ $emp['cedula'] ?? '' }})</small>
                                            <ul style="font-size: 0.85em; list-style-type: circle; margin-left: 20px;" class="text-muted mb-0">
                                                @foreach((array)($emp['elementos'] ?? []) as $el)
                                                    <li>
                                                        {{ $el['elemento'] ?? '' }}: 
                                                        Placa: <strong>{{ $el['placa'] ?? '—' }}</strong> | 
                                                        S/N: {{ $el['serial'] ?? '—' }} | 
                                                        Marca: {{ $el['marca'] ?? '—' }}
                                                        @if(isset($el['entregado']) && $el['entregado'])
                                                            <span class="badge badge-success" style="font-size:0.7rem; padding: 1px 4px;">Entregado</span>
                                                        @else
                                                            <span class="badge badge-warning" style="font-size:0.7rem; padding: 1px 4px;">Pendiente</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($solicitud->estado == 'Pendiente Carga PDF')
                                    <span class="badge badge-warning">Pendiente PDF</span>
                                @elseif($solicitud->estado == 'En espera de autorizacion de almacen')
                                    <span class="badge badge-info">En revisión</span>
                                @elseif($solicitud->estado == 'Retirado')
                                    <span class="badge badge-success">Retirado</span>
                                @else
                                    <span class="badge badge-secondary">{{ $solicitud->estado }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($solicitud->archivo_pdf)
                                    <a href="{{ asset('storage/' . $solicitud->archivo_pdf) }}" target="_blank" class="btn btn-sm btn-primary mb-1" title="Ver PDF Firmado">
                                        <i class="fa fa-file-pdf"></i> Ver Firma
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-secondary mb-1" disabled title="Aún no sube el PDF firmado"><i class="fa fa-file-pdf"></i> Sin Firma</button>
                                @endif
                                
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#estadoModal{{ $solicitud->id }}">
                                    <i class="fa fa-edit"></i> Gestionar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Gestión Estado -->
                        <div class="modal fade" id="estadoModal{{ $solicitud->id }}" tabindex="-1" role="dialog" aria-labelledby="estadoModalLabel{{ $solicitud->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('admin.prestamo.equipos.estado', $solicitud->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="estadoModalLabel{{ $solicitud->id }}">Gestionar Solicitud #{{ $solicitud->id }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Estado de la Solicitud</label>
                                                <select name="estado" class="form-control">
                                                    <option value="En espera de autorizacion de almacen" {{ $solicitud->estado == 'En espera de autorizacion de almacen' ? 'selected' : '' }}>En espera de autorización</option>
                                                    <option value="Retirado" {{ $solicitud->estado == 'Retirado' ? 'selected' : '' }}>Equipo Retirado (Entregado)</option>
                                                    <option value="Rechazado" {{ $solicitud->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label class="font-weight-bold">Observaciones de Almacén</label>
                                                <textarea name="observaciones_almacen" class="form-control" rows="3" placeholder="Anotaciones internas del almacén...">{{ $solicitud->observaciones_almacen }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
