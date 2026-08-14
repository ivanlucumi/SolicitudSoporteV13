@extends('layouts.administrador')
@section('title', 'Almacén - Solicitudes de Préstamo')

@section('content')
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
      <i class="fa fa-archive"></i> Almacén — Solicitudes de Préstamo de Equipos
    </h1>
    <a href="{{ route('almacen.prestamo.equipos.excel') }}" class="btn btn-success" style="font-weight:600;">
      <i class="fa fa-file-excel-o"></i> Descargar Excel General
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="fa fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="fa fa-times-circle"></i> {{ session('error') }}
    </div>
  @endif

  {{-- =============================================
       SECCIÓN 1: PENDIENTES DE AUTORIZACIÓN
       (PDF firmado cargado, en espera de almacén)
  ============================================== --}}
  <div class="card shadow mb-4">
    <div class="card-header py-3" style="background: linear-gradient(135deg,#155724,#1e7e34); color:white;">
      <h6 class="m-0 font-weight-bold">
        <i class="fa fa-hourglass-half"></i>
        Solicitudes Pendientes de Autorización
        <span class="badge badge-light ml-2" style="color:#155724;">{{ $pendientes->count() }}</span>
      </h6>
    </div>
    <div class="card-body p-0">
      @if($pendientes->isEmpty())
        <div class="text-center py-5 text-muted">
          <i class="fa fa-inbox" style="font-size:2.5rem; display:block; margin-bottom:10px; color:#dee2e6;"></i>
          No hay solicitudes pendientes de autorización en este momento.
        </div>
      @else
      <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th class="text-center">#</th>
              <th>Fecha</th>
              <th>Despacho</th>
              <th>Solicitante</th>
              <th>Nominador / Juez</th>
              <th>Equipo</th>
              <th class="text-center">Estado</th>
              <th class="text-center">PDF Firmado</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pendientes as $sol)
            <tr>
              <td class="text-center font-weight-bold">#{{ str_pad($sol->id, 4, '0', STR_PAD_LEFT) }}</td>
              <td style="white-space:nowrap;">
                {{ $sol->created_at->format('d/m/Y') }}<br>
                <small class="text-muted">{{ $sol->created_at->format('h:i A') }}</small>
              </td>
              <td>
                <strong>{{ $sol->despacho }}</strong><br>
                <small class="text-muted">Cód: {{ $sol->codigo_despacho }}</small>
              </td>
              <td>
                {{ $sol->nombre_solicitante }}<br>
                <small class="text-muted">CC: {{ $sol->cedula_solicitante }}</small>
              </td>
              <td>
                {{ $sol->nombre_juez }}<br>
                <small class="text-muted">CC: {{ $sol->cedula_juez }}</small>
              </td>
              <td style="font-size:0.85rem; min-width:320px;">
                @foreach((array)($sol->equipos ?? []) as $empIndex => $emp)
                  <div style="margin-bottom:8px; border-bottom:1px dashed #ddd; padding-bottom:6px;">
                    <span style="font-weight:700; color:#0c2540;">{{ $emp['nombre'] ?? 'Empleado' }}</span> 
                    <small class="text-muted">(CC: {{ $emp['cedula'] ?? '' }})</small>
                    
                    <ul style="list-style:none; padding-left:12px; margin:4px 0 0 0; color:#555;">
                      @foreach((array)($emp['elementos'] ?? []) as $elIndex => $el)
                        @php $isEntregado = isset($el['entregado']) && $el['entregado']; @endphp
                        <li style="margin-bottom:4px; display:flex; align-items:center; justify-content:space-between;">
                          <div>
                            <i class="fa fa-desktop fa-fw text-muted"></i>
                            <strong>{{ $el['elemento'] ?? '' }}</strong> — 
                            Placa: <strong>{{ $el['placa'] ?? '—' }}</strong> 
                            <small class="text-muted">(S/N: {{ $el['serial'] ?? '—' }} | Marca: {{ $el['marca'] ?? '—' }})</small>
                          </div>
                          
                          {{-- Botón interactivo para marcar entregado --}}
                          <button type="button" 
                                  class="btn btn-xs {{ $isEntregado ? 'btn-success' : 'btn-outline-secondary' }} btn-toggle-entrega"
                                  data-sol-id="{{ $sol->id }}"
                                  data-emp-idx="{{ $empIndex }}"
                                  data-el-idx="{{ $elIndex }}"
                                  data-entregado="{{ $isEntregado ? 1 : 0 }}"
                                  style="padding:1px 6px; font-size:0.75rem; border-radius:3px; margin-left:8px;">
                            <i class="fa {{ $isEntregado ? 'fa-check-square-o' : 'fa-square-o' }}"></i> 
                            {{ $isEntregado ? 'Entregado' : 'Pendiente' }}
                          </button>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                @endforeach
              </td>
              <td class="text-center">
                @if($sol->estado == 'Pendiente Carga PDF')
                  <span class="badge badge-warning" style="font-size:0.78rem; padding:5px 8px;">
                    <i class="fa fa-clock-o"></i> Sin PDF firmado
                  </span>
                @elseif($sol->estado == 'En espera de autorizacion de almacen')
                  <span class="badge badge-info" style="font-size:0.78rem; padding:5px 8px;">
                    <i class="fa fa-hourglass-half"></i> PDF recibido
                  </span>
                @else
                  <span class="badge badge-secondary" style="font-size:0.78rem; padding:5px 8px;">{{ $sol->estado }}</span>
                @endif
              </td>
              <td class="text-center">
                @if($sol->archivo_pdf)
                  <a href="{{ route('almacen.prestamo.equipos.pdf', $sol->id) }}"
                     class="btn btn-sm btn-outline-primary" title="Descargar PDF Firmado">
                    <i class="fa fa-download"></i> Descargar
                  </a>
                @else
                  <span class="badge badge-danger" style="font-size:0.78rem; padding:5px 8px;">
                    <i class="fa fa-times-circle"></i> Sin PDF
                  </span>
                @endif
              </td>
              <td class="text-center">
                {{-- Botón Gestionar (todos los estados) --}}
                <button type="button" class="btn btn-sm btn-primary mb-1" data-toggle="modal"
                        data-target="#modalGestionar{{ $sol->id }}" title="Cambiar estado de la solicitud">
                  <i class="fa fa-edit"></i> Gestionar
                </button>
                {{-- Botón Autorizar solo si tiene PDF --}}
                @if($sol->archivo_pdf)
                <button type="button" class="btn btn-sm btn-success mb-1" data-toggle="modal"
                        data-target="#modalRetirar{{ $sol->id }}" title="Marcar como equipo retirado">
                  <i class="fa fa-check"></i> Autorizar
                </button>
                @endif
                {{-- Botón Rechazar (siempre disponible) --}}
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                        data-target="#modalRechazar{{ $sol->id }}" title="Rechazar/Cancelar solicitud">
                  <i class="fa fa-times"></i> Rechazar
                </button>
              </td>
            </tr>

            {{-- Modal: Gestionar Estado General --}}
            <div class="modal fade" id="modalGestionar{{ $sol->id }}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="{{ route('almacen.prestamo.equipos.gestionar', $sol->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title"><i class="fa fa-edit"></i> Gestionar Solicitud #{{ str_pad($sol->id,4,'0',STR_PAD_LEFT) }}</h5>
                      <button type="button" class="close" data-dismiss="modal" style="color:white;"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>Despacho:</strong> {{ $sol->despacho }}<br>
                         <strong>Solicitante:</strong> {{ $sol->nombre_solicitante }}<br>
                         <strong>Estado actual:</strong> 
                         <span class="badge {{ $sol->archivo_pdf ? 'badge-info' : 'badge-warning' }}">
                           {{ $sol->estado }}
                         </span>
                      </p>
                      <div class="form-group">
                        <label class="font-weight-bold">Nuevo Estado:</label>
                        <select name="estado" class="form-control" required>
                          <option value="Pendiente Carga PDF" {{ $sol->estado == 'Pendiente Carga PDF' ? 'selected' : '' }}>Pendiente Carga PDF</option>
                          <option value="En espera de autorizacion de almacen" {{ $sol->estado == 'En espera de autorizacion de almacen' ? 'selected' : '' }}>En espera de autorización</option>
                          <option value="Retirado" {{ $sol->estado == 'Retirado' ? 'selected' : '' }}>Equipo Retirado (Entregado)</option>
                          <option value="Rechazado" {{ $sol->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado / Cancelado</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Observaciones:</label>
                        <textarea name="observaciones_almacen" class="form-control" rows="3"
                          placeholder="Observación sobre el estado...">{{ $sol->observaciones_almacen }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Estado</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- Modal: Autorizar / Equipo Retirado --}}
            <div class="modal fade" id="modalRetirar{{ $sol->id }}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="{{ route('almacen.prestamo.equipos.gestionar', $sol->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="estado" value="Retirado">
                    <div class="modal-header" style="background:#155724; color:white;">
                      <h5 class="modal-title"><i class="fa fa-check-circle"></i> Autorizar Entrega — #{{ str_pad($sol->id,4,'0',STR_PAD_LEFT) }}</h5>
                      <button type="button" class="close" data-dismiss="modal" style="color:white;"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <p>Está a punto de marcar esta solicitud como <strong>"Equipo Retirado"</strong>.</p>
                      <p><strong>Despacho:</strong> {{ $sol->despacho }}<br>
                         <strong>Solicitante:</strong> {{ $sol->nombre_solicitante }}</p>
                      <div class="form-group mt-3">
                        <label class="font-weight-bold">Observaciones (opcional):</label>
                        <textarea name="observaciones_almacen" class="form-control" rows="3"
                          placeholder="Ej: Equipo entregado el día de hoy a las 10am...">{{ $sol->observaciones_almacen }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirmar Retiro</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- Modal: Rechazar / Cancelar --}}
            <div class="modal fade" id="modalRechazar{{ $sol->id }}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="{{ route('almacen.prestamo.equipos.gestionar', $sol->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="estado" value="Rechazado">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title"><i class="fa fa-times-circle"></i> Rechazar Solicitud — #{{ str_pad($sol->id,4,'0',STR_PAD_LEFT) }}</h5>
                      <button type="button" class="close" data-dismiss="modal" style="color:white;"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <p>Está rechazando/cancelando la solicitud de <strong>{{ $sol->nombre_solicitante }}</strong> del despacho <strong>{{ $sol->despacho }}</strong>.</p>
                      <div class="form-group mt-2">
                        <label class="font-weight-bold text-danger">Motivo del rechazo / Novedad: <span class="text-danger">*</span></label>
                        <textarea name="observaciones_almacen" class="form-control" rows="4" required
                          placeholder="Explique el motivo del rechazo o la novedad presentada..."></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Confirmar Rechazo</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>

  {{-- =============================================
       SECCIÓN 2: HISTORIAL (Retirados y Rechazados)
  ============================================== --}}
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-secondary">
        <i class="fa fa-history"></i> Historial de Solicitudes Procesadas
        <span class="badge badge-secondary ml-2">{{ $historial->count() }}</span>
      </h6>
    </div>
    <div class="card-body p-0">
      @if($historial->isEmpty())
        <div class="text-center py-4 text-muted">No hay solicitudes procesadas aún.</div>
      @else
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th class="text-center">#</th>
              <th>Fecha</th>
              <th>Despacho</th>
              <th>Solicitante</th>
              <th>Equipo</th>
              <th class="text-center">Estado</th>
              <th>Observaciones</th>
              <th class="text-center">PDF</th>
            </tr>
          </thead>
          <tbody>
            @foreach($historial as $sol)
            <tr class="{{ $sol->estado === 'Rechazado' ? 'table-danger' : 'table-success' }}" style="opacity:0.85;">
              <td class="text-center"><strong>#{{ str_pad($sol->id,4,'0',STR_PAD_LEFT) }}</strong></td>
              <td style="white-space:nowrap; font-size:0.85rem;">{{ $sol->updated_at->format('d/m/Y H:i') }}</td>
              <td style="font-size:0.85rem;">{{ $sol->despacho }}</td>
              <td style="font-size:0.85rem;">{{ $sol->nombre_solicitante }}<br><small>CC: {{ $sol->cedula_solicitante }}</small></td>
              <td style="font-size:0.8rem;">
                @foreach((array)($sol->equipos ?? []) as $emp)
                  <div style="margin-bottom:4px;">
                    <strong>{{ $emp['nombre'] ?? 'Empleado' }}:</strong>
                    <span class="text-muted" style="font-size:0.75rem;">
                      @php
                        $elStrs = [];
                        foreach((array)($emp['elementos'] ?? []) as $el) {
                            $ent = (isset($el['entregado']) && $el['entregado']) ? ' (Entregado)' : ' (Pendiente)';
                            $elStrs[] = ($el['elemento'] ?? '') . $ent;
                        }
                        echo implode(', ', $elStrs);
                      @endphp
                    </span>
                  </div>
                @endforeach
              </td>
              <td class="text-center">
                @if($sol->estado === 'Retirado')
                  <span class="badge badge-success"><i class="fa fa-check"></i> Retirado</span>
                @else
                  <span class="badge badge-danger"><i class="fa fa-times"></i> Rechazado</span>
                @endif
              </td>
              <td style="font-size:0.82rem;">{{ $sol->observaciones_almacen ?? '—' }}</td>
              <td class="text-center">
                @if($sol->archivo_pdf)
                  <a href="{{ route('almacen.prestamo.equipos.pdf', $sol->id) }}"
                     class="btn btn-xs btn-outline-secondary" style="font-size:0.78rem; padding:2px 8px;">
                    <i class="fa fa-download"></i> PDF
                  </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Escuchar clics en los botones de cambio de entrega
    document.querySelectorAll('.btn-toggle-entrega').forEach(function(btn) {
      btn.onclick = function() {
        var currentBtn = this;
        var solId = currentBtn.getAttribute('data-sol-id');
        var empIdx = currentBtn.getAttribute('data-emp-idx');
        var elIdx = currentBtn.getAttribute('data-el-idx');
        var currentEntregado = parseInt(currentBtn.getAttribute('data-entregado'));
        var newEntregado = currentEntregado === 1 ? 0 : 1;

        currentBtn.disabled = true;

        var formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('emp_index', empIdx);
        formData.append('el_index', elIdx);
        formData.append('entregado', newEntregado);

        fetch('{{ url("/almacen/prestamo-equipos/marcar-elemento") }}/' + solId, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            currentBtn.setAttribute('data-entregado', newEntregado);
            if (newEntregado === 1) {
              currentBtn.className = 'btn btn-xs btn-success btn-toggle-entrega';
              currentBtn.innerHTML = '<i class="fa fa-check-square-o"></i> Entregado';
            } else {
              currentBtn.className = 'btn btn-xs btn-outline-secondary btn-toggle-entrega';
              currentBtn.innerHTML = '<i class="fa fa-square-o"></i> Pendiente';
            }
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(err => {
          console.error(err);
          alert('Ocurrió un error al actualizar el estado de entrega.');
        })
        .finally(() => {
          currentBtn.disabled = false;
        });
      };
    });
  });
</script>
@endsection
