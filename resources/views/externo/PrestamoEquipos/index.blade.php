@extends('layouts.usuarios')
@section('title', 'Mis Solicitudes de Préstamo')
@section('cabecera','Solicitud de Préstamo de Equipo de Cómputo')

@section('content')
<div class="container-fluid" style="background-color: #f8f9fc; min-height: 80vh; padding: 20px;">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{ session('error') }}
    </div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  {{-- Encabezado --}}
  <div class="panel panel-default">
    <div class="panel-heading" style="background: linear-gradient(135deg,#0a2a4a,#0d3b66); color:white; padding:14px 20px;">
      <div class="row">
        <div class="col-xs-8">
          <h4 style="margin:0; font-weight:700;"><i class="fa fa-laptop"></i> Mis Solicitudes de Préstamo de Equipos</h4>
          <small style="opacity:0.8;">Gestione sus solicitudes y cargue el PDF firmado aquí.</small>
        </div>
        <div class="col-xs-4 text-right">
          <a href="{{ route('prestamo.equipos.create') }}" class="btn btn-warning" style="font-weight:600;">
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
              <strong style="font-size:1.05rem; color:#0a2a4a;">#{{ str_pad($solicitud->id, 4, '0', STR_PAD_LEFT) }}</strong>
              <span class="text-muted" style="font-size:0.83rem; margin-left:8px;">
                <i class="fa fa-calendar"></i> {{ $solicitud->created_at->format('d/m/Y') }}
                &nbsp;<i class="fa fa-clock-o"></i> {{ $solicitud->created_at->format('h:i A') }}
              </span>
            </div>
            <div class="col-xs-6 text-right">
              @if($solicitud->estado == 'Pendiente Carga PDF')
                <span class="label label-warning" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-clock-o"></i> Pendiente: Firmar y cargar PDF
                </span>
              @elseif($solicitud->estado == 'En espera de autorizacion de almacen')
                <span class="label label-info" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-hourglass-half"></i> En espera de autorización de Almacén
                </span>
              @elseif($solicitud->estado == 'Retirado')
                <span class="label label-success" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-check"></i> Equipo Retirado
                </span>
              @elseif($solicitud->estado == 'Rechazado')
                <span class="label label-danger" style="font-size:0.82rem; padding:5px 10px;">
                  <i class="fa fa-times"></i> Rechazado
                </span>
              @else
                <span class="label label-default" style="font-size:0.82rem; padding:5px 10px;">
                  {{ $solicitud->estado }}
                </span>
              @endif
            </div>
          </div>
        </div>

        {{-- Cuerpo de la tarjeta --}}
        <div style="padding:16px;">
          <div class="row">

            {{-- Columna: Equipo(s) solicitado(s) --}}
            <div class="col-md-7">
              <p style="font-size:0.78rem; text-transform:uppercase; font-weight:700; color:#64748b; margin-bottom:8px; letter-spacing:0.5px;">
                <i class="fa fa-desktop"></i> Equipos Solicitados
              </p>
              @foreach($solicitud->equipos as $emp)
              <div style="background:#f8fafd; border:1px solid #e2e8f0; border-radius:5px; padding:8px 12px; margin-bottom:8px;">
                <strong style="color:#0a2a4a;"><i class="fa fa-user"></i> {{ strtoupper($emp['nombre'] ?? '') }}</strong>
                <small class="text-muted">&nbsp;|&nbsp; CC: {{ $emp['cedula'] ?? '' }} {{ !empty($emp['cargo']) ? '&nbsp;|&nbsp; '.$emp['cargo'] : '' }}</small>
                <ul style="list-style:none; padding:0; margin:5px 0 0 0; font-size:0.82rem; color:#4a5568;">
                  @foreach($emp['elementos'] ?? [] as $el)
                    <li style="padding:2px 0;">
                      <i class="fa fa-tag"></i>&nbsp;
                      <strong>{{ $el['elemento'] ?? '' }}</strong>
                      @if(!empty($el['placa'])) &mdash; Placa: <strong>{{ $el['placa'] }}</strong> @endif
                      @if(!empty($el['marca'])) &mdash; {{ $el['marca'] }} @endif
                      @if(!empty($el['serial'])) &mdash; S/N: {{ $el['serial'] }} @endif
                    </li>
                  @endforeach
                </ul>
              </div>
              @endforeach

              @if($solicitud->observaciones_almacen)
              <div class="alert alert-info" style="font-size:0.85rem; padding:8px 12px; margin-top:6px; margin-bottom:0;">
                <i class="fa fa-comment"></i> <strong>Obs. Almacén:</strong> {{ $solicitud->observaciones_almacen }}
              </div>
              @endif
            </div>

            {{-- Columna: Acciones PDF --}}
            <div class="col-md-5">
              <p style="font-size:0.78rem; text-transform:uppercase; font-weight:700; color:#64748b; margin-bottom:8px; letter-spacing:0.5px;">
                <i class="fa fa-file-pdf-o"></i> PDF y Acciones
              </p>

              @if($solicitud->archivo_pdf)
                {{-- ✅ PDF firmado ya cargado: solo muestra el firmado --}}
                <div style="background:#d4edda; border:1px solid #c3e6cb; border-radius:5px; padding:10px 14px; margin-bottom:10px; text-align:center;">
                  <i class="fa fa-check-circle" style="color:#155724; font-size:1.3rem;"></i><br>
                  <strong style="color:#155724; font-size:0.9rem;">PDF Firmado cargado correctamente</strong>
                </div>
                <a href="{{ route('prestamo.equipos.pdf_firmado', $solicitud->id) }}"
                   class="btn btn-success btn-block" style="font-weight:600;">
                  <i class="fa fa-file-pdf-o"></i> Ver / Descargar PDF Firmado
                </a>

              @else
                {{-- ⬇️ Sin PDF firmado: ofrecer descarga del original --}}
                <a href="{{ route('prestamo.equipos.pdf', $solicitud->id) }}"
                   class="btn btn-default btn-block" style="margin-bottom:12px; border:1px solid #cbd5e1; font-weight:600;">
                  <i class="fa fa-download"></i> Descargar Solicitud (sin firma)
                </a>

                @if($solicitud->estado == 'Pendiente Carga PDF')
                {{-- 📤 Zona de carga --}}
                <div style="background:#fffbeb; border:1px dashed #f59e0b; border-radius:5px; padding:12px;">
                  <p style="font-size:0.82rem; color:#92400e; margin-bottom:8px; font-weight:600;">
                    <i class="fa fa-exclamation-triangle"></i> Próximo paso:
                  </p>
                  <ol style="font-size:0.8rem; color:#78350f; margin-bottom:10px; padding-left:18px;">
                    <li>Descargue la solicitud (botón de arriba)</li>
                    <li>Fírmela e imprímala</li>
                    <li>Escanéela y cárguela aquí abajo</li>
                  </ol>
                  <form action="{{ route('prestamo.equipos.subir_pdf', $solicitud->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom:6px;">
                      <input type="file" name="archivo_pdf" accept=".pdf" required class="form-control input-sm">
                    </div>
                    <button type="submit" class="btn btn-warning btn-block btn-sm" style="font-weight:700;">
                      <i class="fa fa-upload"></i> Cargar PDF Firmado
                    </button>
                  </form>
                </div>
                @endif

              @endif
            </div>

          </div>
        </div>
      </div>

      @empty
      <div class="text-center" style="padding:60px 20px; color:#94a3b8;">
        <i class="fa fa-inbox" style="font-size:3.5rem; margin-bottom:15px; display:block; color:#cbd5e1;"></i>
        <p style="font-size:1.05rem; margin-bottom:16px;">No ha realizado ninguna solicitud de préstamo aún.</p>
        <a href="{{ route('prestamo.equipos.create') }}" class="btn btn-primary" style="background:#2563eb; border:none; font-weight:600; padding:10px 24px;">
          <i class="fa fa-plus"></i> Crear Primera Solicitud
        </a>
      </div>
      @endforelse

    </div>
  </div>
</div>
@endsection
