@extends('layouts.Almacen.Almacen')
@section('title', 'Almacén - Solicitudes de Ingreso')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-sign-in-alt"></i> Gestión de Solicitudes de Ingreso</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> {{ session('warning') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Solicitudes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nº Seguimiento</th>
                            <th>Fecha Radicación</th>
                            <th>Titular</th>
                            <th>Empleado a Ingresar</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                        <tr>
                            <td class="font-weight-bold text-center">{{ $solicitud->numero_seguimiento }}</td>
                            <td>{{ $solicitud->created_at->format('d/m/Y h:i A') }}</td>
                            <td>
                                <strong>{{ $solicitud->nombre_titular }}</strong><br>
                                <small>CC: {{ $solicitud->cedula_titular }}</small><br>
                                <small class="text-muted">{{ $solicitud->correo_titular }}</small>
                            </td>
                            <td>
                                <strong>{{ $solicitud->nombre_empleado }}</strong><br>
                                <small>CC: {{ $solicitud->cedula_empleado }}</small><br>
                                <small class="text-muted">{{ $solicitud->cargo_empleado }}</small>
                            </td>
                            <td>{{ Str::limit($solicitud->motivo_ingreso, 80) }}</td>
                            <td class="text-center">
                                @if($solicitud->estado == 'Pendiente')
                                    <span class="badge badge-warning">Pendiente</span>
                                @elseif($solicitud->estado == 'Autorizada')
                                    <span class="badge badge-success">Autorizada</span><br>
                                    <small>{{ \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d/m/Y') }} {{ $solicitud->hora_ingreso }}</small>
                                @elseif($solicitud->estado == 'Denegada')
                                    <span class="badge badge-danger">Denegada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($solicitud->estado != 'Pendiente')
                                    <a href="{{ route('admin.solicitud_ingreso.pdf', $solicitud->numero_seguimiento) }}" class="btn btn-sm btn-primary mb-1" title="Descargar PDF">
                                        <i class="fa fa-file-pdf"></i> PDF
                                    </a>
                                @else
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#estadoModal{{ $solicitud->id }}">
                                        <i class="fa fa-edit"></i> Gestionar
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Gestión Estado -->
                        <div class="modal fade" id="estadoModal{{ $solicitud->id }}" tabindex="-1" role="dialog" aria-labelledby="estadoModalLabel{{ $solicitud->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('admin.solicitud_ingreso.responder', $solicitud->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="estadoModalLabel{{ $solicitud->id }}">Gestionar Solicitud {{ $solicitud->numero_seguimiento }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Motivo del Usuario:</label>
                                                <p class="p-2 bg-light border rounded">{{ $solicitud->motivo_ingreso }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label><strong>Respuesta de Almacén <span class="text-danger">*</span></strong></label>
                                                <select name="estado" class="form-control estado-select" required onchange="toggleFechas(this, {{ $solicitud->id }})">
                                                    <option value="">-- Seleccione --</option>
                                                    <option value="Autorizada" {{ $solicitud->estado == 'Autorizada' ? 'selected' : '' }}>Autorizar Ingreso</option>
                                                    <option value="Denegada" {{ $solicitud->estado == 'Denegada' ? 'selected' : '' }}>Denegar Ingreso</option>
                                                </select>
                                            </div>

                                            <div id="fechas-container-{{ $solicitud->id }}" style="display: {{ $solicitud->estado == 'Autorizada' ? 'block' : 'none' }}; border-left: 3px solid #28a745; padding-left: 10px; margin-bottom: 15px;">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Fecha de Ingreso <span class="text-danger">*</span></label>
                                                        <input type="date" name="fecha_ingreso" class="form-control" value="{{ $solicitud->fecha_ingreso ? \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('Y-m-d') : '' }}">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Hora de Ingreso <span class="text-danger">*</span></label>
                                                        <input type="time" name="hora_ingreso" class="form-control" value="{{ $solicitud->hora_ingreso ? \Carbon\Carbon::parse($solicitud->hora_ingreso)->format('H:i') : '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Observaciones Adicionales (Opcional)</label>
                                                <textarea name="observaciones_almacen" class="form-control" rows="3" placeholder="Ej. Debe presentar carnet físico...">{{ $solicitud->observaciones_almacen }}</textarea>
                                            </div>
                                            
                                            <small class="text-muted"><i class="fa fa-envelope"></i> Al guardar, se enviará un correo automático al Titular con la respuesta y el PDF.</small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar y Notificar</button>
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

<script>
    function toggleFechas(select, id) {
        var container = document.getElementById('fechas-container-' + id);
        var inputs = container.querySelectorAll('input');
        if (select.value === 'Autorizada') {
            container.style.display = 'block';
            inputs.forEach(input => input.required = true);
        } else {
            container.style.display = 'none';
            inputs.forEach(input => {
                input.required = false;
                input.value = '';
            });
        }
    }
</script>
@endsection
