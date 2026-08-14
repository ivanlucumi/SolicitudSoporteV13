@extends('layouts.monitoreo.coordinador')

@section('cabecera')
    Informe de Ingresos - Contratistas
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- FILTROS --}}
        <div class="box box-info">
            <div class="box-header with-border" style="background:#0f3460; padding:10px 18px;">
                <h3 class="box-title" style="color:#fff; font-size:15px;">
                    <i class="fa fa-filter"></i> &nbsp;Filtros de Búsqueda
                </h3>
            </div>
            <div class="box-body">
                <form action="{{ route('coordinador.informe') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size:12px; color:#666;">
                                    <i class="fa fa-calendar"></i> &nbsp;Fecha Inicial
                                </label>
                                <input type="date" name="fecha_inicial" class="form-control"
                                       value="{{ $fechaInicial }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size:12px; color:#666;">
                                    <i class="fa fa-calendar-check-o"></i> &nbsp;Fecha Final
                                </label>
                                <input type="date" name="fecha_final" class="form-control"
                                       value="{{ $fechaFinal }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size:12px; color:#666;">
                                    <i class="fa fa-id-card"></i> &nbsp;Cédula (opcional)
                                </label>
                                <input type="text" name="cedula" class="form-control"
                                       placeholder="Ej: 1234567890"
                                       value="{{ $cedula }}"
                                       style="font-family:monospace; letter-spacing:1px;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size:12px; color:transparent;">-</label>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-search"></i> &nbsp;Consultar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:-5px;">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-success btn-sm" onclick="exportToCsv()">
                                <i class="fa fa-file-excel-o"></i> Exportar CSV
                            </button>
                            @if($cedula || $fechaInicial !== now()->toDateString() || $fechaFinal !== now()->toDateString())
                            <a href="{{ route('coordinador.informe') }}" class="btn btn-default btn-sm">
                                <i class="fa fa-times"></i> Limpiar filtros
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- RESULTADOS --}}
        <div class="box box-default">
            <div class="box-header with-border" style="padding:10px 18px;">
                <h3 class="box-title" style="font-size:14px;">
                    <i class="fa fa-list"></i> &nbsp;
                    @if($cedula)
                        Registros de cédula <strong>{{ $cedula }}</strong>
                        &mdash; {{ $fechaInicial }} al {{ $fechaFinal }}
                    @else
                        Ingresos del {{ $fechaInicial }} al {{ $fechaFinal }}
                    @endif
                    &nbsp;&nbsp;
                    <span class="badge" style="background:#0f3460;">{{ $ingresos->count() }} registro(s)</span>
                </h3>
            </div>
            <div class="box-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed" id="tabla_informe" style="margin:0; font-size:13px;">
                        <thead style="background:#f5f5f5;">
                            <tr>
                                <th style="padding:9px 12px;">Fecha</th>
                                <th style="padding:9px 12px;">Hora</th>
                                <th style="padding:9px 12px; width:50px;">Foto</th>
                                <th style="padding:9px 12px;">Cédula</th>
                                <th style="padding:9px 12px;">Nombre</th>
                                <th style="padding:9px 12px;">Empresa</th>
                                <th style="padding:9px 12px;">Puerta</th>
                                <th style="padding:9px 12px;">Registrado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ingresos as $i)
                            <tr>
                                <td style="padding:7px 12px; color:#555;">{{ $i->fecha_ingreso }}</td>
                                <td style="padding:7px 12px; color:#0f3460; font-weight:600;">{{ $i->hora_ingreso }}</td>
                                <td style="padding:5px 10px; text-align:center;">
                                    @if($i->contratista && $i->contratista->foto && file_exists(public_path('contratistas/' . $i->contratista->foto)))
                                        <img src="{{ asset('contratistas/' . $i->contratista->foto) }}" alt="Foto"
                                             style="width:40px;height:40px;object-fit:cover;border-radius:50%;border:2px solid #0f3460;">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#1a1a2e,#0f3460);display:flex;align-items:center;justify-content:center;margin:0 auto;">
                                            <i class="fa fa-user" style="color:#fff;font-size:16px;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td style="padding:7px 12px; font-family:monospace; font-size:13px;">{{ $i->contratista->cedula ?? 'N/A' }}</td>
                                <td style="padding:7px 12px;">{{ $i->contratista->nombre ?? 'N/A' }}</td>
                                <td style="padding:7px 12px; color:#555;">{{ $i->contratista->empresa ?? 'N/A' }}</td>
                                <td style="padding:7px 12px;">
                                    <span class="label label-info">{{ $i->puerta }}</span>
                                </td>
                                <td style="padding:7px 12px; font-size:12px; color:#777;">
                                    {{ $i->portero->name ?? 'N/A' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center" style="padding:30px; color:#999;">
                                    <i class="fa fa-info-circle fa-2x"></i><br>
                                    <span style="margin-top:8px;display:block;">No hay registros para los filtros seleccionados.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
function exportToCsv() {
    let csv = [];
    let rows = document.querySelectorAll("#tabla_informe tr");

    for (let i = 0; i < rows.length; i++) {
        let row = [], cols = rows[i].querySelectorAll("td, th");
        for (let j = 0; j < cols.length; j++) {
            // Saltar la columna de foto (índice 2) en el export
            if (j === 2 && i > 0) continue;
            row.push("' + cols[j].innerText.replace(/"/g, ""').trim() + "');
        }
        csv.push(row.join(","));
    }

    let csvFile = new Blob(["\ufeff" + csv.join("\n")], {type: "text/csv;charset=utf-8;"});
    let downloadLink = document.createElement("a");
    downloadLink.download = "ingresos_contratistas_{{ $fechaInicial }}_{{ $fechaFinal }}.csv";
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
</script>
@endpush
@endsection
