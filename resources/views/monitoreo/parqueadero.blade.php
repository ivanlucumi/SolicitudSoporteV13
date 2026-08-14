@extends('layouts.monitoreo.parqueadero')

@section('title', 'Monitor Parqueadero')

@section('content')

{{-- ===== STATS ROW ===== --}}
<div class="row" style="margin: 32px 0 16px;">

    <div class="col-md-4 col-sm-4">
        <div class="box" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; background: #fff;">
            <div style="height: 5px; background: linear-gradient(90deg, #1e40af, #3b82f6);"></div>
            <div class="box-body" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 56px; height: 56px; background: rgba(59, 130, 246, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-users" style="color: #2563eb; font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 4px;">Personas Adentro</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #1e293b; line-height: 1;" id="count-personas">{{ $contarUsuario ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4">
        <div class="box" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; background: #fff;">
            <div style="height: 5px; background: linear-gradient(90deg, #2563eb, #60a5fa);"></div>
            <div class="box-body" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 56px; height: 56px; background: rgba(37, 99, 235, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-car" style="color: #1d4ed8; font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 4px;">Automóviles</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #1e293b; line-height: 1;" id="count-carros">{{ $contarCarros ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4">
        <div class="box" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; background: #fff;">
            <div style="height: 5px; background: linear-gradient(90deg, #3b82f6, #93c5fd);"></div>
            <div class="box-body" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
                <div style="width: 56px; height: 56px; background: rgba(59, 130, 246, 0.08); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-motorcycle" style="color: #3b82f6; font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 4px;">Motocicletas</div>
                    <div style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #1e293b; line-height: 1;" id="count-motos">{{ $contarMotos ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===== SEARCH + TABLE ===== --}}
<div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; background: #fff;">

    {{-- Search Bar --}}
    <div style="padding: 32px 40px; border-bottom: 1px solid #f1f5f9;">
        <div class="row" style="align-items: center; display: flex;">
            <div class="col-md-8">
                <div style="display: flex; align-items: center; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; padding: 4px; transition: all 0.3s ease-in-out;" id="searchWrap">
                    <div style="padding: 0 20px; color: #64748b; font-size: 20px;">
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text"
                           id="unifiedSearch"
                           placeholder="Buscar por placa o identificación..."
                           style="flex: 1; border: none; background: transparent; font-size: 17px; font-weight: 600; padding: 14px 0; outline: none; color: #0f172a; text-transform: uppercase;"
                           onfocus="document.getElementById('searchWrap').style.borderColor='#2563eb'; document.getElementById('searchWrap').style.boxShadow='0 0 0 4px rgba(37, 99, 235, 0.1)';"
                           onblur="document.getElementById('searchWrap').style.borderColor='#e2e8f0'; document.getElementById('searchWrap').style.boxShadow='none';">
                    <button type="button" id="btnUnifiedSearch"
                            style="background: #2563eb; color: #fff; border: none; padding: 14px 32px; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.2s; letter-spacing: 0.5px;">
                        CONSULTAR
                    </button>
                </div>
            </div>
            <div class="col-md-4 text-right" style="display: flex; flex-direction: column; align-items: flex-end; gap: 12px;">
                <div style="padding: 8px 16px; background: #eff6ff; border-radius: 99px; display: inline-flex; align-items: center; gap: 8px;">
                    <span style="width: 8px; height: 8px; background: #2563eb; border-radius: 50%; display: inline-block;"></span>
                    <span style="font-size: 13px; font-weight: 600; color: #1e40af;">Portería {{  auth()->user()->direccion_porteria ?? 'General' }}</span>
                </div>
                <a href="{{ route('porteria.contratistas.index') }}" 
                   style="display: inline-flex; align-items: center; gap: 10px; background: #0f172a; color: #fff; padding: 12px 24px; border-radius: 14px; font-weight: 700; font-size: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-transform: uppercase; letter-spacing: 0.5px;"
                   onmouseover="this.style.background='#1e293b'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.background='#0f172a'; this.style.transform='translateY(0)';"
                >
                    <i class="fa fa-id-card-o"></i> Registro Contratistas
                </a>
            </div>
        </div>
    </div>

    {{-- Table Filter --}}
    <div style="padding: 20px 40px 0;">
        <div style="display: flex; align-items: center; gap: 12px; max-width: 300px; background: #f8fafc; padding: 8px 16px; border-radius: 12px;">
            <i class="fa fa-filter" style="color: #94a3b8; font-size: 14px;"></i>
            <input type="text" id="tableSearch" placeholder="Filtrar movimientos..."
                   style="border: none; background: transparent; font-size: 13px; font-weight: 600; outline: none; color: #475569; width: 100%;">
        </div>
    </div>

    {{-- Table --}}
    <div class="box-body" style="padding: 20px 40px 40px;">
        <div class="table-responsive">
            <table id="tableIngresos" class="table" style="border-collapse: separate; border-spacing: 0 8px; width: 100%;">
                <thead>
                    <tr style="color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px;">
                        <th style="padding: 12px; font-weight: 700; border: none;">Identificación</th>
                        <th style="padding: 12px; font-weight: 700; border: none;">Funcionario</th>
                        <th style="padding: 12px; font-weight: 700; border: none;">Despacho / Dependencia</th>
                        <th style="padding: 12px; font-weight: 700; border: none;">Placa / Vehículo</th>
                        <th style="padding: 12px; font-weight: 700; border: none; text-align:center;">Puesto</th>
                        <th style="padding: 12px; font-weight: 700; border: none; text-align:center;">Entrada</th>
                        <th style="padding: 12px; font-weight: 700; border: none; text-align:center;">Salida</th>
                        <th style="padding: 12px; font-weight: 700; border: none; text-align:center;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ingresos as $ingreso)
                    @php
                        // Priorizar datos de la tabla parqueadero (puesto) y caer en bitácora si es visitante
                        $cedula = $ingreso->cedula_puesto ?? $ingreso->cedula ?? 'N/A';
                        $nombre = $ingreso->nombre_puesto ?? $ingreso->nombre ?? 'DESCONOCIDO';
                        $despacho = $ingreso->despacho_puesto ?? 'N/A';
                        $placa = $ingreso->placa ?? 'N/A';
                    @endphp
                    <tr style="background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 15px rgba(0,0,0,0.05)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.02)';">
                        <td style="padding: 18px 12px; border: none; border-left: 4px solid {{ $ingreso->hora_salida ? '#e2e8f0' : '#2563eb' }}; border-radius: 12px 0 0 12px; vertical-align: middle;">
                            <span style="font-size: 13px; font-weight: 600; color: #475569;">{{ $cedula }}</span>
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle;">
                            <span style="font-size: 14px; font-weight: 700; color: #1e293b; text-transform: uppercase;">{{ $nombre }}</span>
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle;">
                            <span style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">{{ $despacho }}</span>
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; background: #eff6ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-{{ str_contains(strtoupper($ingreso->vehiculo ?? ''), 'MOTO') ? 'motorcycle' : 'car' }}" style="color: #2563eb; font-size: 16px;"></i>
                                </div>
                                <div style="display: flex; flex-direction: column;">
                                    <span style="font-size: 15px; font-weight: 800; letter-spacing: 1.5px; color: #1e293b; line-height: 1.2;">{{ $placa }}</span>
                                    @if($ingreso->descripcion_puesto)
                                        <small style="font-size: 10px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 2px;">{{ $ingreso->descripcion_puesto }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle; text-align: center;">
                            <span style="background: #f1f5f9; color: #475569; border-radius: 8px; padding: 6px 12px; font-size: 12px; font-weight: 700;">
                                {{ $ingreso->no_puesto ?? 'N/A' }}
                            </span>
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle; text-align: center; font-weight: 700; color: #2563eb; font-size: 14px;">
                            {{ $ingreso->hora_ingreso }}
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle; text-align: center; font-weight: 700; color: #ef4444; font-size: 14px;">
                            {{ $ingreso->hora_salida ?? '—' }}
                        </td>
                        <td style="padding: 18px 12px; border: none; vertical-align: middle; text-align: center; border-radius: 0 12px 12px 0;">
                            @if($ingreso->hora_salida)
                                <span style="background: #f1f5f9; color: #64748b; border-radius: 99px; padding: 6px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Finalizado</span>
                            @else
                                <span style="background: #dce8f5; color: #15803d; border-radius: 99px; padding: 6px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Adentro</span>
                                <button type="button" class="btn-dar-salida" data-buscar="{{ $placa !== 'N/A' ? $placa : $cedula }}" style="margin-top: 8px; background: #ef4444; color: white; border: none; border-radius: 8px; padding: 6px 12px; font-size: 10px; font-weight: bold; cursor: pointer; display: block; width: 100%; transition: background 0.2s;" onmouseover="this.style.background='#dc2626" onmouseout="this.style.background='#ef4444">
                                    <i class="fa fa-sign-out"></i> DAR SALIDA
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 80px 0; text-align: center; border: none;">
                            <i class="fa fa-inbox" style="font-size: 48px; color: #e2e8f0; display: block; margin-bottom: 16px;"></i>
                            <p style="color: #94a3b8; font-size: 15px; font-weight: 500;">No hay movimientos registrados para hoy</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ===== MODALS ===== --}}
@include('monitoreo.parqueadero.verificarIngreso')
@include('monitoreo.parqueadero.yaIngreso')
@include('monitoreo.parqueadero.verificarIngreso2')
@include('monitoreo.parqueadero.noAutorizado')

{{-- ===== HIDDEN AJAX FORMS ===== --}}
<form id="form-consulta-placa-ingreso" action="{{ route('parqueadero.verificacion.ingreso.placa',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<form id="form-registrar-ingreso" action="{{ route('parqueadero.registar.ingreso.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<form id="form-registrar-salida" action="{{ route('parqueadero.registar.salida.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<form id="form-registrar-ingreso-veh" action="{{ route('parqueadero.registar.ingreso.dos',':CEDULA_ID','PARQ') }}" method="POST">
    @csrf
</form>

@push('scripts')
<script src="/js/ingreso/parqueadero1.js"></script>

<script>
$(document).ready(function () {

    // ---- Filtro de tabla ----
    $('#tableSearch').on('keyup', function () {
        var val = $(this).val().toLowerCase();
        $('#tableIngresos tbody tr').each(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
        });
    });

    // ---- Foco inicial ----
    function resetFocus() {
        setTimeout(function () {
            var s = document.getElementById('unifiedSearch');
            if (s) { s.focus(); s.value = ''; }
        }, 400);
    }

    // ---- Cerrar modal → reset foco ----
    $('.modal').on('hidden.bs.modal', function () {
        resetFocus();
    });

    // ---- Botón Dar Salida en Tabla ----
    $(document).on('click', '.btn-dar-salida', function(e) {
        e.preventDefault();
        var buscar = $(this).data('buscar');
        $('#unifiedSearch').val(buscar);
        $('#btnUnifiedSearch').click();
    });

    window.mayus = function (el) { el.value = el.value.toUpperCase(); };
});
</script>
@endpush
@endsection