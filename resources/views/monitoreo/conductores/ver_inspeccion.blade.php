@php
    $layout = 'layouts.monitoreo.parqueadero'; // Default
    if (auth()->check()) {
        if (auth()->user()->rol == 2 || auth()->user()->rol == 10) {
            $layout = 'layouts.monitoreo.coordinador';
        } elseif (auth()->user()->rol == 27) {
            $layout = 'layouts.monitoreo.conductor';
        }
    }
@endphp
@extends($layout)

@section('title', 'Detalle de Inspección Preoperativa')

@section('content')

<div class="row" style="margin: 20px 0;">
    <div class="col-md-10 col-md-offset-1">
        
        {{-- ===== HEADER CARD ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; overflow: hidden; margin-bottom: 24px;">
            <div style="height: 6px; background: {{ $inspeccion->estado === 'APTO' ? '#22c55e' : ($inspeccion->estado === 'OBSERVACIONES' ? '#eab308' : '#ef4444') }};"></div>
            <div class="box-body" style="padding: 32px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 64px; height: 64px; background: {{ $inspeccion->estado === 'APTO' ? 'rgba(34, 197, 94, 0.1)' : ($inspeccion->estado === 'OBSERVACIONES' ? 'rgba(234, 179, 8, 0.1)' : 'rgba(239, 68, 68, 0.1)') }}; border-radius: 18px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa fa-{{ $inspeccion->estado === 'APTO' ? 'check-circle' : ($inspeccion->estado === 'OBSERVACIONES' ? 'warning' : 'times-circle') }}" 
                           style="color: {{ $inspeccion->estado === 'APTO' ? '#22c55e' : ($inspeccion->estado === 'OBSERVACIONES' ? '#eab308' : '#ef4444') }}; font-size: 28px;"></i>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 22px; margin: 0; color: #0f172a; text-transform: uppercase;">
                            Ficha de Inspección #{{ $inspeccion->id }}
                        </h2>
                        <div style="display: flex; align-items: center; gap: 10px; margin-top: 4px;">
                            <span class="label" style="font-size: 11px; padding: 4px 8px; background-color: {{ $inspeccion->estado === 'APTO' ? '#22c55e' : ($inspeccion->estado === 'OBSERVACIONES' ? '#eab308' : '#ef4444') }};">
                                {{ $inspeccion->estado }}
                            </span>
                            <span style="color: #64748b; font-size: 13px; font-weight: 600;">
                                Registrado el {{ $inspeccion->fecha->format('d/m/Y') }} a las {{ $inspeccion->hora }}
                            </span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('conductores.inspeccion.exportar', $inspeccion->id) }}" class="btn btn-danger" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;" target="_blank">
                        <i class="fa fa-file-pdf-o"></i> Exportar PDF
                    </a>
                    <a href="{{ route('conductores.historial', $inspeccion->placa) }}" class="btn btn-default" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 20px;">
                        <i class="fa fa-history"></i> Historial
                    </a>
                    <a href="{{ route('conductores.index') }}" class="btn btn-primary" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;">
                        Volver al Panel
                    </a>
                </div>
            </div>
        </div>

        {{-- ===== INFORMACIÓN GENERAL ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 20px;">
                1. Información de la Inspección
            </h4>
            
            <div class="row">
                <div class="col-md-3 col-sm-6" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Vehículo Oficial</small>
                    <p style="font-size: 16px; font-weight: 800; color: #dc2626; margin-top: 4px; letter-spacing: 1px;">
                        {{ strtoupper($inspeccion->placa) }}
                    </p>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Tipo de Formulario</small>
                    <p style="font-size: 14px; font-weight: 700; color: #475569; margin-top: 4px;">
                        {{ $inspeccion->tipo_vehiculo === 'MOTOCICLETA' ? 'F-SGSST-109 (Moto)' : 'F-SGSST-105 (Carro)' }}
                    </p>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Kilometraje Reportado</small>
                    <p style="font-size: 14px; font-weight: 700; color: #475569; margin-top: 4px;">
                        {{ number_format($inspeccion->kilometraje) }} KM
                    </p>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Guardia de Registro</small>
                    <p style="font-size: 14px; font-weight: 700; color: #475569; margin-top: 4px; text-transform: uppercase;">
                        {{ $inspeccion->quien_registro }}
                    </p>
                </div>
            </div>

            <div class="row" style="border-top: 1px solid #f1f5f9; padding-top: 20px; margin-top: 10px;">
                <div class="col-md-4 col-sm-6" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Conductor</small>
                    <p style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 4px; text-transform: uppercase;">
                        {{ $inspeccion->conductor ? $inspeccion->conductor->name . ' ' . $inspeccion->conductor->lastname : 'N/A' }}
                    </p>
                </div>
                <div class="col-md-4 col-sm-6" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Identificación Conductor</small>
                    <p style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 4px;">
                        {{ $inspeccion->conductor_cedula }}
                    </p>
                </div>
                <div class="col-md-4 col-sm-12" style="margin-bottom: 16px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Sede / Juzgado / Dependencia</small>
                    <p style="font-size: 13px; font-weight: 600; color: #64748b; margin-top: 4px; text-transform: uppercase;">
                        {{ $vehiculo ? ($vehiculo->edificio . ' · ' . $vehiculo->despacho) : 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== DETALLES DEL CHECKLIST ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 20px;">
                2. Respuestas de la Lista de Verificación
            </h4>

            @foreach($detallesAgrupados as $grupo => $detalles)
            <div style="margin-bottom: 24px;">
                <h5 style="background: #f1f5f9; color: #475569; font-weight: 800; padding: 10px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 12px;">
                    {{ $grupo }}
                </h5>
                
                @foreach($detalles as $d)
                <div style="border-bottom: 1px solid #f1f5f9; padding: 12px 10px; display: flex; flex-direction: column; gap: 6px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px;">
                        <span style="font-weight: 500; color: #1e293b; font-size: 14px;">{{ $d->nombre_item }}</span>
                        
                        <span class="label" style="font-size: 11px; padding: 4px 8px; background-color: {{ $d->resultado === 'SI' ? '#22c55e' : ($d->resultado === 'NO' ? '#ef4444' : '#64748b') }};">
                            {{ $d->resultado }}
                        </span>
                    </div>

                    @if($d->resultado === 'NO' && $d->observaciones)
                        <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 8px 12px; margin-top: 4px; font-size: 12px; color: #991b1b; font-weight: 500;">
                            <strong>Observación de Fallo:</strong> {{ $d->observaciones }}
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

        {{-- ===== OBSERVACIONES GENERALES Y FIRMA ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 20px;">
                3. Observaciones Finales y Firma
            </h4>

            <div class="row">
                <div class="col-md-6" style="margin-bottom: 20px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Observaciones Generales</small>
                    <p style="font-size: 14px; color: #334155; margin-top: 8px; line-height: 1.6; background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; min-height: 120px;">
                        {{ $inspeccion->observaciones ? $inspeccion->observaciones : 'Sin observaciones generales registradas.' }}
                    </p>
                </div>
                
                <div class="col-md-6 text-center" style="margin-bottom: 20px;">
                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; display: block; margin-bottom: 8px;">Firma Registrada del Conductor</small>
                    @if($inspeccion->firma_conductor)
                        <div style="border: 1px solid #e2e8f0; border-radius: 16px; background: #fff; padding: 10px; display: inline-block;">
                            <img src="{{ $inspeccion->firma_conductor }}" alt="Firma Conductor" style="max-width: 350px; height: auto; border-radius: 8px;">
                        </div>
                    @else
                        <div style="border: 2px dashed #e2e8f0; border-radius: 16px; background: #f8fafc; padding: 32px; color: #64748b; display: inline-block; width: 100%; max-width: 350px;">
                            <i class="fa fa-eraser" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>
                            Firma no capturada
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
