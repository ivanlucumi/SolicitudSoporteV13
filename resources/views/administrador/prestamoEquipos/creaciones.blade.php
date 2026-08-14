@extends('layouts.Almacen.Almacen')
@section('title', 'Mis Creaciones Pendientes - Almacén')
@section('content')
<div class="container-fluid" style="background-color: #f8f9fc; min-height: 80vh; padding: 20px;">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-times-circle"></i> {{ session('error') }}
    </div>
  @endif

  <div class="panel panel-default" style="box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none;">
    <div class="panel-heading" style="background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); color: white; padding: 15px 20px;">
      <div class="row">
        <div class="col-sm-9">
          <h4 style="margin: 0; font-weight: bold; font-size: 18px;"><i class="fa fa-list-alt"></i> Actas Creadas por Almacén Pendientes de Firma</h4>
          <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">
            Aquí puede ver las actas que usted generó a nombre de un despacho y que todavía no tienen el documento PDF firmado cargado.
          </p>
        </div>
        <div class="col-sm-3 text-right">
          <a href="{{ route('almacen.prestamo.equipos.create') }}" class="btn btn-warning" style="font-weight: bold; font-size: 14px; margin-top: 5px;">
            <i class="fa fa-plus"></i> Crear Nueva Acta
          </a>
        </div>
      </div>
    </div>

    <div class="panel-body" style="padding: 0;">
      <div class="table-responsive">
        <table class="table table-hover table-striped text-center" style="margin-bottom: 0; font-size: 15px;">
          <thead style="background-color: #f1f5f9; color: #475569;">
            <tr>
              <th style="padding: 12px; vertical-align: middle;">Acta #</th>
              <th style="padding: 12px; vertical-align: middle;">Fecha</th>
              <th style="padding: 12px; vertical-align: middle;">Despacho</th>
              <th style="padding: 12px; vertical-align: middle;">Titular</th>
              <th class="text-left" style="padding: 12px; vertical-align: middle;">Equipos Asignados</th>
              <th style="padding: 12px; vertical-align: middle;">Acciones PDF</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pendientes as $sol)
            <tr>
              <td style="vertical-align: middle; font-weight: bold; font-size: 18px; color: #0a2a4a;">
                #{{ str_pad($sol->id, 4, '0', STR_PAD_LEFT) }}
              </td>
              <td style="vertical-align: middle; font-size: 14px;">
                {{ $sol->created_at->format('d/m/Y') }}<br>
                <small class="text-muted" style="font-size: 13px;">{{ $sol->created_at->format('h:i A') }}</small>
              </td>
              <td class="text-left" style="vertical-align: middle; font-size: 14px;">
                <strong>{{ $sol->despacho }}</strong><br>
                <span class="label label-info" style="font-size: 12px; margin-top: 4px; display: inline-block;">Circuito: {{ $sol->circuito }}</span>
              </td>
              <td class="text-left" style="vertical-align: middle; font-size: 14px;">
                {{ $sol->nombre_juez }}<br>
                <small class="text-muted" style="font-size: 13px;">{{ $sol->cargo_titular }}</small>
              </td>
              <td class="text-left" style="vertical-align: middle; min-width: 280px; font-size: 14px;">
                @foreach((array)($sol->equipos ?? []) as $emp)
                  @php
                      $nombreEmp = $emp['nombre'] ?? '';
                      if (empty($nombreEmp) && !empty($emp['cedula'])) {
                          $empleadoDb = \App\Models\Empleado::where('cedulaE', $emp['cedula'])->first();
                          if ($empleadoDb) {
                              $nombreEmp = trim($empleadoDb->nameE . ' ' . $empleadoDb->lastnameE);
                          }
                      }
                      $nombreEmp = $nombreEmp ?: 'Servidor / Empleado';
                  @endphp
                  <div style="margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px dashed #ddd;">
                    <strong><i class="fa fa-user" style="color: #666;"></i> {{ $nombreEmp }}</strong> 
                    <small class="text-muted" style="font-size: 13px;">(CC: {{ $emp['cedula'] ?? 'N/A' }})</small>
                    <ul class="text-muted" style="list-style: none; margin: 5px 0 0 0; padding-left: 15px;">
                      @foreach((array)($emp['elementos'] ?? []) as $el)
                        <li style="margin-bottom: 3px;"><i class="fa fa-caret-right"></i> {{ $el['elemento'] ?? '' }} 
                          @if(!empty($el['placa'])) <strong>(Placa: {{ $el['placa'] }})</strong> @endif
                        </li>
                      @endforeach
                    </ul>
                  </div>
                @endforeach
              </td>
              <td style="vertical-align: middle;">
                {{-- Botón para descargar el PDF original sin firma --}}
                <a href="{{ route('almacen.prestamo.equipos.pdf_generado', $sol->id) }}" class="btn btn-sm btn-default btn-block" style="margin-bottom: 10px; font-weight: bold; font-size: 13px;" title="Descargar Acta Original (Sin firma)">
                  <i class="fa fa-download"></i> Descargar
                </a>
                
                {{-- Formulario para subir el PDF firmado --}}
                <form action="{{ route('almacen.prestamo.equipos.subir_pdf', $sol->id) }}" method="POST" enctype="multipart/form-data" style="margin: 0;">
                  @csrf
                  <div style="text-align: left;">
                    <label for="pdf_{{ $sol->id }}" style="font-size: 12px; margin-bottom: 2px;">Cargar Acta Firmada:</label>
                    <input type="file" name="archivo_pdf" id="pdf_{{ $sol->id }}" accept="application/pdf" required class="form-control input-sm" style="font-size: 13px; height: auto; padding: 3px;" onchange="this.form.submit()">
                  </div>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center text-muted" style="padding: 50px 20px;">
                <i class="fa fa-check-circle" style="font-size: 48px; color: #28a745; margin-bottom: 15px;"></i><br>
                <h5 style="margin-bottom: 0; font-size: 20px;">Todo al día</h5>
                <p style="font-size: 15px;">No hay creaciones pendientes de carga de documento por parte de Almacén.</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@if(session('descargar_pdf'))
<script>
  window.addEventListener('DOMContentLoaded', (event) => {
      // Abre el PDF en una nueva pestaña (el navegador forzará la descarga según la cabecera Content-Disposition)
      window.open("{{ route('almacen.prestamo.equipos.pdf_generado', session('descargar_pdf')) }}", "_blank");
  });
</script>
@endif
@endsection
