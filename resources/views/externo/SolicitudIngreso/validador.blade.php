@extends('layouts.ensayo1')

@section('title', 'Validación de Ingreso - ' . $solicitud->numero_seguimiento)

@section('content')
<style>
    .card-validador { 
        max-width: 850px; 
        margin: 40px auto; 
        border-radius: 16px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        border: none; 
        overflow: hidden; 
        background-color: white;
    }
    .card-header { 
        background: linear-gradient(135deg, #0a2a4a 0%, #154374 100%); 
        color: white; 
        text-align: center; 
        padding: 30px 20px 20px; 
        border-bottom: none; 
    }
    .logo-img { 
        max-width: 250px; 
        margin-bottom: 20px; 
        background: white; 
        padding: 12px; 
        border-radius: 8px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .status-badge { 
        font-size: 1.3rem; 
        padding: 12px 30px; 
        border-radius: 50px; 
        font-weight: 700; 
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: inline-block;
    }
    .bg-success-custom { background-color: #10b981; color: white; }
    .bg-danger-custom { background-color: #ef4444; color: white; }
    .bg-warning-custom { background-color: #f59e0b; color: white; }
    .info-section { padding: 30px; }
    .info-row { margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 16px; text-align: left;}
    .info-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    .info-label { font-weight: 600; color: #64748b; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
    .info-value { color: #1e293b; font-size: 1.25rem; font-weight: 500; }
    .section-title { 
        color: #0a2a4a; 
        font-weight: 700; 
        font-size: 1.15rem; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        margin-bottom: 20px; 
        display: flex;
        align-items: center;
        text-align: left;
    }
    .section-title i { margin-right: 10px; font-size: 1.3rem; color: #3b82f6; }
    
    .alert-custom { border-radius: 12px; border: none; padding: 15px; text-align: left;}
    .alert-success-custom { background-color: #ecfdf5; color: #065f46; }
    .alert-info-custom { background-color: #eff6ff; color: #1e3a8a; }
    
    .card-footer-custom { background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 0.95rem; padding: 15px; text-align: center; color: #666;}
    .btn-outline-secondary-custom {
        display: inline-block;
        width: 100%;
        max-width: 400px;
        padding: 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        color: #555;
        text-align: center;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-outline-secondary-custom:hover {
        background-color: #f1f5f9;
        color: #333;
        text-decoration: none;
    }
    
    /* Espaciado para la segunda columna en móviles */
    @media (max-width: 767px) {
        .col-autorizado { margin-top: 40px; }
    }
</style>

<div class="container px-3" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="card-validador">
        <div class="card-header">
            @php
              $logoPath = public_path('img/logoLargo.png');
              if (file_exists($logoPath)) {
                  $logoUrl = asset('img/logoLargo.png');
              } else {
                  $logoUrl = '';
              }
            @endphp
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo" class="logo-img img-responsive mx-auto" style="margin: 0 auto 20px auto; display: block;">
            @else
                <h4 style="margin:0; font-weight: bold;">Sistema de Administración Judicial</h4>
            @endif
            <h4 style="margin-top: 10px; margin-bottom: 0; font-weight: 400; color: rgba(255,255,255,0.9);">Validación de Ingreso</h4>
        </div>
        
        <div class="info-section text-center" style="padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            <div style="margin-bottom: 25px; margin-top: 10px;">
                @if($solicitud->estado == 'Autorizada')
                    <div class="status-badge bg-success-custom">
                        <i class="fa fa-check-circle" style="margin-right: 8px;"></i> AUTORIZADO
                    </div>
                @elseif($solicitud->estado == 'Denegada')
                    <div class="status-badge bg-danger-custom">
                        <i class="fa fa-times-circle" style="margin-right: 8px;"></i> DENEGADO
                    </div>
                @else
                    <div class="status-badge bg-warning-custom">
                        <i class="fa fa-clock-o" style="margin-right: 8px;"></i> PENDIENTE
                    </div>
                @endif
            </div>

            <h3 style="color: #0f172a; font-weight: bold; margin-bottom: 5px; font-size: 2rem;">{{ $solicitud->numero_seguimiento }}</h3>
            <p style="color: #64748b; font-size: 1rem; margin-bottom: 0;">Solicitado el {{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y') }}</p>
        </div>

        <div class="info-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title"><i class="fa fa-user"></i> Datos del Visitante</div>
                    
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="flex: 1; min-width: 0;">
                            <div class="info-row">
                                <div class="info-label">Nombre Completo</div>
                                <div class="info-value">{{ $solicitud->nombre_empleado }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Documento de Identidad</div>
                                <div class="info-value">{{ $solicitud->cedula_empleado }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Cargo / Función</div>
                                <div class="info-value">{{ $solicitud->cargo_empleado }}</div>
                            </div>
                        </div>
                        @if(isset($empleado) && $empleado->foto_url)
                        <div style="flex-shrink: 0;">
                            <img src="{{ $empleado->foto_url }}" alt="Foto" style="width: 100px; height: 130px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 2px solid #f1f5f9;">
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-6 col-autorizado">
                    <div class="section-title"><i class="fa fa-building"></i> Autorizado Por</div>
                    
                    <div class="info-row">
                        <div class="info-label">Titular / Despacho</div>
                        <div class="info-value">{{ $solicitud->nombre_titular }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Motivo de Ingreso</div>
                        <div class="info-value" style="color: #475569; font-size: 1.15rem; line-height: 1.6;">
                            {{ $solicitud->motivo_ingreso }}
                        </div>
                    </div>
                </div>
            </div>

            @if($solicitud->estado == 'Autorizada' && $solicitud->fecha_ingreso)
            <div class="alert-custom alert-success-custom" style="margin-top: 30px;">
                <h5 style="font-weight: bold; margin-top: 0; margin-bottom: 12px;"><i class="fa fa-calendar" style="margin-right: 8px;"></i>Fecha Autorizada de Ingreso</h5>
                <p style="margin-bottom: 0; font-size: 1.25rem;">{{ \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d/m/Y') }} <span style="font-weight: bold;">a las {{ $solicitud->hora_ingreso }}</span></p>
            </div>
            @endif

            @if($solicitud->observaciones_almacen)
            <div class="alert-custom alert-info-custom" style="margin-top: 25px;">
                <h5 style="font-weight: bold; margin-top: 0; margin-bottom: 12px;"><i class="fa fa-comment" style="margin-right: 8px;"></i>Observaciones</h5>
                <p style="margin-bottom: 0; font-size: 1.1rem;">{{ $solicitud->observaciones_almacen }}</p>
            </div>
            @endif

            <div style="margin-top: 40px; text-align: center;">
                <a href="{{ route('solicitud_ingreso.validar_form') }}" class="btn-outline-secondary-custom">
                    <i class="fa fa-arrow-left" style="margin-right: 8px;"></i> Consultar otra solicitud
                </a>
            </div>
        </div>
        
        <div class="card-footer-custom">
            Consulta realizada el {{ \Carbon\Carbon::now()->format('d/m/Y h:i A') }}
        </div>
    </div>
</div>
@endsection
