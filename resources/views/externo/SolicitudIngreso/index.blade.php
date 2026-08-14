@extends('layouts.usuarios')
@section('title', 'Mis Solicitudes de Ingreso')
@section('cabecera', 'Mis Solicitudes de Ingreso')

@section('content')
<div class="container-fluid" style="background-color: #f8f9fc; min-height: 80vh; padding: 20px;">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{ session('success') }}
    </div>
  @endif

  {{-- Encabezado --}}
  <div class="panel panel-default">
    <div class="panel-heading" style="background: linear-gradient(135deg,#0a2a4a,#0d3b66); color:white; padding:14px 20px;">
      <div class="row">
        <div class="col-xs-8">
          <h4 style="margin:0; font-weight:700;"><i class="fa fa-sign-in"></i> Historial de Solicitudes de Ingreso</h4>
          <small style="opacity:0.8;">Revise el estado de sus solicitudes al almacén.</small>
        </div>
        <div class="col-xs-4 text-right">
          <a href="{{ route('solicitud_ingreso.create') }}" class="btn btn-warning" style="font-weight:600;">
            <i class="fa fa-plus"></i> Nueva Solicitud
          </a>
        </div>
      </div>
    </div>

    <div class="panel-body" style="padding: 10px 15px;">

      @forelse($solicitudes as $solicitud)
      {{-- Tarjeta por solicitud --}}
      <div style="background:#fff; border:1px solid #e2e8f0; border-radius:6px; margin-bottom:16px; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
        {{-- Cabecera de la tarjeta --}}
        <div style="background:#f8fafd; border-bottom:1px solid #e2e8f0; padding:10px 16px; border-radius:6px 6px 0 0;">
          <div class="row">
            <div class="col-xs-6">
              <strong style="font-size:1.05rem; color:#0a2a4a;">{{ $solicitud->numero_seguimiento }}</strong>
              <span class="text-muted" style="font-size:0.83rem; margin-left:8px;">
                <i class="fa fa-calendar"></i> {{ $solicitud->created_at->format('d/m/Y') }}
                &nbsp;<i class="fa fa-clock-o"></i> {{ $solicitud->created_at->format('h:i A') }}
              </span>
            </div>
            <div class="col-xs-6 text-right">
              @if($solicitud->estado == 'Pendiente')
                <span class="label label-warning" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-clock-o"></i> Pendiente
                </span>
              @elseif($solicitud->estado == 'Autorizada')
                <span class="label label-success" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-check"></i> Autorizada
                </span>
              @elseif($solicitud->estado == 'Denegada')
                <span class="label label-danger" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-times"></i> Denegada
                </span>
              @else
                <span class="label label-default" style="font-size:0.82rem; padding:5px 10px;">
                  {{ $solicitud->estado }}
                </span>
              @endif
              <a href="{{ route('solicitud_ingreso.pdf', $solicitud->numero_seguimiento) }}" class="btn btn-xs btn-default" style="margin-left:5px; border:1px solid #ccc;" title="Descargar PDF">
                <i class="fa fa-file-pdf-o text-danger"></i> PDF
              </a>
            </div>
          </div>
        </div>

        {{-- Cuerpo de la tarjeta --}}
        <div style="padding:16px;">
          <div class="row">
            {{-- Info del Titular y Empleado --}}
            <div class="col-md-7">
              <p style="font-size:0.78rem; text-transform:uppercase; font-weight:700; color:#64748b; margin-bottom:8px; letter-spacing:0.5px;">
                <i class="fa fa-users"></i> Involucrados
              </p>
              
              <div style="background:#f8fafd; border:1px solid #e2e8f0; border-radius:5px; padding:8px 12px; margin-bottom:8px;">
                <strong style="color:#0a2a4a;"><i class="fa fa-user-circle"></i> Titular: {{ $solicitud->nombre_titular }}</strong>
                <small class="text-muted">&nbsp;|&nbsp; CC: {{ $solicitud->cedula_titular }} &nbsp;|&nbsp; {{ $solicitud->cargo_titular }}</small>
              </div>

              <div style="background:#f8fafd; border:1px solid #e2e8f0; border-radius:5px; padding:8px 12px; margin-bottom:8px;">
                <strong style="color:#0a2a4a;"><i class="fa fa-user"></i> Empleado: {{ $solicitud->nombre_empleado }}</strong>
                <small class="text-muted">&nbsp;|&nbsp; CC: {{ $solicitud->cedula_empleado }} &nbsp;|&nbsp; {{ $solicitud->cargo_empleado }}</small>
              </div>
              
            </div>

            {{-- Info de Almacén y Respuesta --}}
            <div class="col-md-5">
              <p style="font-size:0.78rem; text-transform:uppercase; font-weight:700; color:#64748b; margin-bottom:8px; letter-spacing:0.5px;">
                <i class="fa fa-info-circle"></i> Detalles y Respuesta
              </p>
              <div style="font-size:0.875rem; color:#4a5568; margin-bottom:12px;">
                <strong>Motivo:</strong> {{ $solicitud->motivo_ingreso }}
              </div>
              
              @if($solicitud->estado != 'Pendiente')
              <div style="background:#f1f5f9; border-left:4px solid {{ $solicitud->estado == 'Autorizada' ? '#38c172' : '#e3342f' }}; padding:10px 12px; font-size:0.85rem; border-radius:4px;">
                @if($solicitud->estado == 'Autorizada')
                  <strong><i class="fa fa-calendar-check-o"></i> Fecha/Hora Autorizada:</strong> 
                  {{ \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($solicitud->hora_ingreso)->format('h:i A') }}
                  <br>
                @endif
                @if($solicitud->observaciones_almacen)
                  <strong style="display:inline-block; margin-top:5px;"><i class="fa fa-commenting-o"></i> Observación de Almacén:</strong> 
                  {{ $solicitud->observaciones_almacen }}
                @endif
              </div>
              @endif
            </div>

          </div>
        </div>
      </div>
      @empty
        <div class="text-center" style="padding: 40px; color:#64748b;">
          <i class="fa fa-inbox fa-3x" style="margin-bottom:15px; opacity:0.5;"></i>
          <h4>No tiene solicitudes de ingreso registradas.</h4>
        </div>
      @endforelse

    </div>
  </div>
</div>
@endsection
