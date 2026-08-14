@php
    $layout = 'layouts.monitoreo.conductor'; // Base por defecto para este módulo
    if (auth()->check()) {
        if (auth()->user()->rol == 2) {
            $layout = 'layouts.monitoreo.coordinador';
        }
    }
@endphp
@extends($layout)

@section('title', 'Módulo de Conductores')

@section('content')

{{-- ===== INDICADORES SEMÁFORO (Solo para portería/admin) ===== --}}
@if(auth()->user()->rol != 27)
<div class="row" style="margin: 32px 0 16px;">
    
    <div class="col-md-4 col-sm-4">
        <div class="box" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; background: #fff;">
            <div style="height: 5px; background: #22c55e;"></div> {{-- Verde --}}
            <div class="box-body" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 56px; height: 56px; background: rgba(34, 197, 94, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-check-circle" style="color: #22c55e; font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 4px;">Vehículos Aptos (Hoy)</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #1e293b; line-height: 1;">{{ $totalAptos }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4">
        <div class="box" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; background: #fff;">
            <div style="height: 5px; background: #eab308;"></div> {{-- Amarillo --}}
            <div class="box-body" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 56px; height: 56px; background: rgba(234, 179, 8, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-exclamation-triangle" style="color: #eab308; font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 4px;">Con Observaciones</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #1e293b; line-height: 1;">{{ $totalObservaciones }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4">
        <div class="box" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; background: #fff;">
            <div style="height: 5px; background: #ef4444;"></div> {{-- Rojo --}}
            <div class="box-body" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-times-circle" style="color: #ef4444; font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 4px;">Vehículos No Aptos</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #1e293b; line-height: 1;">{{ $totalNoAptos }}</div>
                </div>
            </div>
        </div>
    </div>

</div>
@endif

{{-- ===== SECCIÓN PRINCIPAL: VEHÍCULOS OFICIALES ===== --}}
<div class="row">
    
    <div class="col-md-{{ auth()->user()->rol == 27 ? '12' : '8' }}">
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 24px;">
            <div class="box-header" style="border-bottom: 1px solid #f1f5f9; padding: 0 0 16px; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center;">
                <h3 class="box-title" style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 18px; margin: 0; color: #0f172a;">
                    Vehículos Oficiales Registrados
                </h3>
            </div>
            
            <div class="table-responsive">
                <table class="table" style="border-collapse: separate; border-spacing: 0 8px; width: 100%;">
                    <thead>
                        <tr style="color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px;">
                            <th style="padding: 12px; border: none;">Placa / Vehículo</th>
                            <th style="padding: 12px; border: none;">Funcionario Asignado</th>
                            <th style="padding: 12px; border: none;">Puesto</th>
                            <th style="padding: 12px; border: none; text-align: center;">Inspección Hoy</th>
                            <th style="padding: 12px; border: none; text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehiculosOficiales as $v)
                        <tr style="background: #f8fafc; transition: all 0.2s ease;">
                            <td style="padding: 16px 12px; border: none; border-radius: 12px 0 0 12px; vertical-align: middle;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 40px; height: 40px; border-radius: 8px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #475569;">
                                        {{ substr($v->placa, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $v->placa }}</div>
                                        <div style="font-size: 12px; color: #64748b;">{{ \Illuminate\Support\Str::limit($v->descripcion_vehiculo, 20) }} - {{ $v->tipo_vehiculo }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 16px 12px; border: none; vertical-align: middle;">
                                <div style="font-weight: 600; color: #334155; font-size: 13px;">{{ $v->cedula }}</div>
                                <div style="font-size: 11px; color: #94a3b8;"><i class="fa fa-user" style="margin-right: 4px;"></i> Conductor</div>
                            </td>
                            <td style="padding: 16px 12px; border: none; vertical-align: middle;">
                                <span style="display: inline-block; padding: 4px 10px; background: #f1f5f9; color: #475569; border-radius: 6px; font-size: 11px; font-weight: 600;">
                                    {{ $v->puesto->nombre_puesto ?? 'SIN PUESTO' }}
                                </span>
                            </td>
                            <td style="padding: 16px 12px; border: none; vertical-align: middle; text-align: center;">
                                @if($v->inspeccion_hoy)
                                    @if($v->inspeccion_hoy->estado == 'APTO')
                                        <span class="label" style="background: #22c55e; padding: 6px 12px; border-radius: 20px; font-size: 11px;"><i class="fa fa-check-circle" style="margin-right: 4px;"></i> APTO</span>
                                    @elseif($v->inspeccion_hoy->estado == 'OBSERVACIONES')
                                        <span class="label" style="background: #eab308; padding: 6px 12px; border-radius: 20px; font-size: 11px;"><i class="fa fa-exclamation-triangle" style="margin-right: 4px;"></i> OBS.</span>
                                    @else
                                        <span class="label" style="background: #ef4444; padding: 6px 12px; border-radius: 20px; font-size: 11px;"><i class="fa fa-times-circle" style="margin-right: 4px;"></i> NO APTO</span>
                                    @endif
                                @else
                                    <span class="label" style="background: #e2e8f0; color: #475569; padding: 6px 12px; border-radius: 20px; font-size: 11px;">PENDIENTE</span>
                                @endif
                            </td>
                            <td style="padding: 16px 12px; border: none; border-radius: 0 12px 12px 0; vertical-align: middle; text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center;">
                                    <a href="{{ route('conductores.inspeccion.crear', $v->placa) }}" class="btn btn-xs btn-primary" title="Nueva Inspección" style="border-radius: 6px;">
                                        <i class="fa fa-plus"></i> Inspección
                                    </a>
                                    <a href="{{ route('conductores.historial', $v->placa) }}" class="btn btn-xs btn-default" title="Ver Historial" style="border-radius: 6px; border: 1px solid #cbd5e1; background: #fff;">
                                        <i class="fa fa-history"></i> Historial
                                    </a>
                                    @if($v->inspeccion_hoy)
                                        <a href="{{ route('conductores.inspeccion.ver', $v->inspeccion_hoy->id) }}" class="btn btn-xs btn-info" title="Ver Detalle" style="border-radius: 6px;">
                                            <i class="fa fa-eye"></i> Detalle
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 64px 0; color: #94a3b8;">
                                <i class="fa fa-info-circle" style="font-size: 32px; margin-bottom: 12px;"></i>
                                <p>No hay vehículos oficiales registrados o activos.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(auth()->user()->rol != 27)
    <div class="col-md-4">
        {{-- ===== NOVEDADES ACTIVAS ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 24px;">
            <div class="box-header" style="border-bottom: 1px solid #f1f5f9; padding: 0 0 16px; margin-bottom: 16px;">
                <h3 class="box-title" style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 16px; margin: 0; color: #0f172a;">Novedades Activas</h3>
            </div>
            
            <div style="max-height: 450px; overflow-y: auto; padding-right: 4px;">
                @forelse($novedades as $n)
                <div style="background: #fef2f2; border: 1px solid #fee2e2; border-left: 4px solid #ef4444; border-radius: 12px; padding: 14px; margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px;">
                        <span class="label label-danger" style="font-size: 11px; padding: 2px 6px;">{{ $n->placa }}</span>
                        <small style="color: #64748b; font-weight: 600;">{{ $n->fecha->format('d/m/Y') }}</small>
                    </div>
                    <p style="font-size: 12px; color: #991b1b; margin: 6px 0; font-weight: 500; line-height: 1.4;">
                        {{ $n->descripcion }}
                    </p>
                    <div style="margin-top: 8px; font-size: 11px; color: #64748b;">
                        <i class="fa fa-user-o"></i> Conductor: {{ $n->conductor ? $n->conductor->name . ' ' . $n->conductor->lastname : 'N/A' }}
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 48px 0; color: #94a3b8;">
                    <i class="fa fa-check-circle" style="font-size: 24px; color: #22c55e; margin-bottom: 8px;"></i>
                    <p style="font-size: 13px;">Sin novedades ni vehículos inhabilitados hoy</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @endif

</div>

@endsection
