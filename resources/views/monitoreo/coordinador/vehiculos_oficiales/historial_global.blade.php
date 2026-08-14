@extends('layouts.monitoreo.coordinador')
@section('title', 'Historial de Inspecciones')

@section('header')
<section class="content-header" style="margin-bottom: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="margin: 0; font-family: 'Outfit', sans-serif; font-weight: 700; color: #1e293b; letter-spacing: -0.5px;">
                Reportes Globales.
                <small style="color: #64748b; font-weight: 500; letter-spacing: 0;">Historial de todas las inspecciones preoperativas</small>
            </h1>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border-radius: 12px; border-top: 4px solid #1e40af; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <div class="box-header with-border" style="padding: 16px;">
                <h3 class="box-title" style="font-weight: 600; color: #334155;">Historial de Reportes</h3>
            </div>
            
            <div class="box-body" style="padding: 20px;">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tablaHistorial" style="width: 100%;">
                        <thead style="background-color: #f1f5f9; color: #475569; font-size: 13px;">
                            <tr>
                                <th>Fecha Inspección</th>
                                <th>Placa</th>
                                <th>Vehículo</th>
                                <th>Conductor</th>
                                <th>Estado/Diagnóstico</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inspecciones as $inspeccion)
                            <tr>
                                <td style="vertical-align: middle;">
                                    <span style="font-weight: 600;">{{ \Carbon\Carbon::parse($inspeccion->fecha)->format('d/m/Y') }}</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span style="font-size: 16px; font-weight: 800; color: #1e293b; font-family: monospace; letter-spacing: 1px;">{{ $inspeccion->placa ?? 'N/A' }}</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ $inspeccion->info_parqueadero->descripcion_vehiculo ?? 'N/A' }} 
                                    <br><small style="color:#666;">({{ $inspeccion->info_parqueadero->tipo_vehiculo ?? 'N/A' }})</small>
                                </td>
                                <td style="vertical-align: middle;">
                                    @if($inspeccion->info_parqueadero)
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-weight: 700; color: #3b82f6;">{{ $inspeccion->info_parqueadero->nombre }}</span>
                                            <small style="color: #64748b;">CC: {{ $inspeccion->info_parqueadero->cedula }}</small>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">
                                    @if($inspeccion->estado =="APTO")
                                        <span class="label label-success">APTO</span>
                                    @else
                                        <span class="label label-danger">NO APTO</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <a href="{{ route('coordinador.inspeccion.ver', $inspeccion->id) }}" class="btn btn-sm btn-info" title="Ver Detalles">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('coordinador.inspeccion.exportar', $inspeccion->id) }}" class="btn btn-sm btn-danger" title="Exportar PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i> PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tablaHistorial').DataTable({
            language: { url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json" },
            order: [[0, "desc"]]
        });
    });
</script>
@endpush
