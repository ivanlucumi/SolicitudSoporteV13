@extends('layouts.monitoreo.coordinador')

@section('title', 'Historial de Inspecciones — ' . strtoupper($vehiculo->placa))

@section('content')

<div class="row" style="margin: 20px 0;">
    <div class="col-md-10 col-md-offset-1">

        {{-- ===== HEADER CARD ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; overflow: hidden; margin-bottom: 24px;">
            <div style="height: 6px; background: linear-gradient(90deg, #2563eb, #3b82f6);"></div>
            <div class="box-body" style="padding: 28px 32px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa fa-{{ str_contains(strtoupper($vehiculo->tipo_vehiculo ?? ''), 'MOTO') ? 'motorcycle' : 'car' }}" style="color: #2563eb; font-size: 28px;"></i>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 24px; margin: 0; color: #0f172a; letter-spacing: 1.5px;">
                            {{ strtoupper($vehiculo->placa) }}
                        </h2>
                        <p style="color: #64748b; margin: 4px 0 0; font-size: 13px; font-weight: 500;">
                            Historial de Inspecciones Preoperativas &nbsp;·&nbsp;
                            <span style="color: #1e40af; font-weight: 700;">{{ $vehiculo->nombre }}</span>
                            &nbsp;–&nbsp;{{ $vehiculo->despacho }}
                        </p>
                    </div>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    
                    <a href="{{ route('cooringreso.vehiculos_oficiales.index') }}" class="btn btn-default" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 20px;">
                        <i class="fa fa-arrow-left"></i> Volver al Panel
                    </a>
                </div>
            </div> 
        </div>

        {{-- ===== RESUMEN ESTADÍSTICO ===== --}}
        @php
            $totalInspecciones = $inspecciones->count();
            $aptos             = $inspecciones->where('estado', 'APTO')->count();
            $observaciones     = $inspecciones->where('estado', 'OBSERVACIONES')->count();
            $noAptos           = $inspecciones->where('estado', 'NO APTO')->count();
        @endphp

        <div class="row" style="margin-bottom: 24px;">
            <div class="col-md-3 col-sm-6">
                <div class="box" style="border-radius: 16px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.04); background: #fff; padding: 20px; margin-bottom: 16px; border-left: 4px solid #3b82f6;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: #64748b; margin-bottom: 6px;">Total Inspecciones</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 32px; font-weight: 800; color: #1e293b; line-height: 1;">{{ $totalInspecciones }}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="box" style="border-radius: 16px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.04); background: #fff; padding: 20px; margin-bottom: 16px; border-left: 4px solid #22c55e;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: #64748b; margin-bottom: 6px;">Aptos</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 32px; font-weight: 800; color: #22c55e; line-height: 1;">{{ $aptos }}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="box" style="border-radius: 16px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.04); background: #fff; padding: 20px; margin-bottom: 16px; border-left: 4px solid #eab308;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: #64748b; margin-bottom: 6px;">Con Observaciones</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 32px; font-weight: 800; color: #eab308; line-height: 1;">{{ $observaciones }}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="box" style="border-radius: 16px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.04); background: #fff; padding: 20px; margin-bottom: 16px; border-left: 4px solid #ef4444;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: #64748b; margin-bottom: 6px;">No Aptos</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 32px; font-weight: 800; color: #ef4444; line-height: 1;">{{ $noAptos }}</div>
                </div>
            </div>
        </div>

        {{-- ===== LÍNEA DE TIEMPO ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 28px;">
                <i class="fa fa-history" style="color: #2563eb; margin-right: 8px;"></i>
                Línea de Tiempo de Inspecciones
            </h4>

            @forelse($inspecciones as $insp)
            @php
                $colorEstado = $insp->estado === 'APTO' ? '#22c55e' : ($insp->estado === 'OBSERVACIONES' ? '#eab308' : '#ef4444');
                $bgEstado    = $insp->estado === 'APTO' ? 'rgba(34, 197, 94, 0.08)' : ($insp->estado === 'OBSERVACIONES' ? 'rgba(234, 179, 8, 0.08)' : 'rgba(239, 68, 68, 0.08)');
                $iconoEstado = $insp->estado === 'APTO' ? 'check-circle' : ($insp->estado === 'OBSERVACIONES' ? 'exclamation-triangle' : 'times-circle');
            @endphp
            <div style="display: flex; gap: 20px; margin-bottom: 20px; position: relative;">

                {{-- Indicador de estado (columna izquierda) --}}
                <div style="display: flex; flex-direction: column; align-items: center; flex-shrink: 0; width: 48px;">
                    <div style="width: 48px; height: 48px; background: {{ $bgEstado }}; border: 2px solid {{ $colorEstado }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; position: relative; z-index: 1;">
                        <i class="fa fa-{{ $iconoEstado }}" style="color: {{ $colorEstado }}; font-size: 18px;"></i>
                    </div>
                    @if(!$loop->last)
                    <div style="width: 2px; background: #e2e8f0; flex: 1; min-height: 20px; margin-top: 4px;"></div>
                    @endif
                </div>

                {{-- Tarjeta de contenido --}}
                <div style="flex: 1; background: #f8fafc; border: 1px solid #e2e8f0; border-left: 3px solid {{ $colorEstado }}; border-radius: 14px; padding: 18px 20px; margin-bottom: 4px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
                        <div>
                            <span style="font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 800; color: #0f172a;">
                                Inspección #{{ $insp->id }}
                            </span>
                            <span style="margin-left: 10px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; color: #fff; background: {{ $colorEstado }};">
                                {{ $insp->estado }}
                            </span>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 13px; font-weight: 700; color: #1e293b;">
                                {{ $insp->fecha ? $insp->fecha->format('d/m/Y') : 'N/A' }}
                            </div>
                            <div style="font-size: 11px; color: #64748b;">{{ $insp->hora }}</div>
                        </div>
                    </div>

                    <div class="row" style="font-size: 12px; color: #64748b;">
                        <div class="col-md-4 col-sm-6" style="margin-bottom: 8px;">
                            <i class="fa fa-user-o" style="margin-right: 4px; color: #94a3b8;"></i>
                            <strong style="color: #475569;">Conductor:</strong>
                            {{ $insp->conductor ? strtoupper($insp->conductor->name . ' ' . $insp->conductor->lastname) : ($insp->conductor_cedula ?? 'N/A') }}
                        </div>
                        <div class="col-md-4 col-sm-6" style="margin-bottom: 8px;">
                            <i class="fa fa-tachometer" style="margin-right: 4px; color: #94a3b8;"></i>
                            <strong style="color: #475569;">Kilometraje:</strong>
                            {{ number_format($insp->kilometraje) }} km
                        </div>
                        <div class="col-md-4 col-sm-6" style="margin-bottom: 8px;">
                            <i class="fa fa-clipboard" style="margin-right: 4px; color: #94a3b8;"></i>
                            <strong style="color: #475569;">Formulario:</strong>
                            {{ $insp->tipo_vehiculo === 'MOTOCICLETA' ? 'F-SGSST-109' : 'F-SGSST-105' }}
                        </div>
                        @if($insp->quien_registro)
                        <div class="col-md-4 col-sm-6" style="margin-bottom: 8px;">
                            <i class="fa fa-shield" style="margin-right: 4px; color: #94a3b8;"></i>
                            <strong style="color: #475569;">Registrado por:</strong>
                            {{ $insp->quien_registro }}
                        </div>
                        @endif
                        @if($insp->observaciones)
                        <div class="col-md-8 col-sm-12" style="margin-bottom: 8px;">
                            <i class="fa fa-comment-o" style="margin-right: 4px; color: #94a3b8;"></i>
                            <strong style="color: #475569;">Obs. Generales:</strong>
                            {{ mb_strimwidth($insp->observaciones, 0, 100, '...') }}
                        </div>
                        @endif
                    </div>

                    <div style="margin-top: 12px; border-top: 1px solid #e2e8f0; padding-top: 12px; display: flex; justify-content: flex-end;">
                        <a href="{{ route('conductores.inspeccion.ver', $insp->id) }}" class="btn btn-xs btn-primary" style="border-radius: 8px; font-weight: 600; padding: 6px 14px;">
                            <i class="fa fa-eye"></i> Ver Detalle Completo
                        </a>
                    </div>
                </div>

            </div>
            @empty
            <div style="text-align: center; padding: 72px 0; color: #94a3b8;">
                <i class="fa fa-clipboard" style="font-size: 48px; margin-bottom: 16px; display: block; opacity: 0.3;"></i>
                <p style="font-size: 15px; font-weight: 600; color: #64748b;">No hay inspecciones registradas para este vehículo aún.</p>
                <a href="{{ route('conductores.inspeccion.crear', $vehiculo->placa) }}" class="btn btn-primary" style="margin-top: 16px; border-radius: 10px; font-weight: 700;">
                    <i class="fa fa-plus"></i> Registrar Primera Inspección
                </a>
            </div>
            @endforelse
        </div>

    </div>
</div>

@endsection
