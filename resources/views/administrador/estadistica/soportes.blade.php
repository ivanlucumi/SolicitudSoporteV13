@extends('layouts.admin')
@section('title', 'Estadísticas de Soportes')
@section('cabecera', 'Estadísticas de Soportes')

@section('content')

<style>
  /* ===== Estilo 2025 (compatible con Bootstrap 3) ===== */
  .mb-10 { margin-bottom: 10px; }
  .mb-15 { margin-bottom: 15px; }
  .mb-20 { margin-bottom: 20px; }
  .mt-10 { margin-top: 10px; }
  .mt-20 { margin-top: 20px; }

  .card-2025 {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.06);
    overflow: hidden;
  }
  .card-2025 .card-header {
    padding: 12px 16px;
    border-bottom: 1px solid #eef2f7;
    background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);
    color: #fff;
    font-weight: 700;
    letter-spacing: .02em;
  }
  .card-2025 .card-body { padding: 16px; }

  .section-title {
    font-weight: 800;
    color: #0f172a;
    letter-spacing: .015em;
    margin: 0;
  }

  .btn-2025 {
    background: linear-gradient(90deg, #0ea5e9, #22c55e);
    border: none;
    color: #fff !important;
    font-weight: 600;
    border-radius: 8px;
    box-shadow: 0 6px 14px rgba(34,197,94,0.25);
  }
  .btn-2025:hover { opacity: .95; }

  .table-modern {
    margin-bottom: 0;
    border-radius: 8px;
    overflow: hidden;
  }
  .table-modern thead tr {
    background: linear-gradient(90deg, #111827, #1f2937);
    color: #fff;
  }
  .table-modern > thead > tr > th {
    border: none !important;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: .06em;
  }
  .table-modern > tbody > tr:hover { background: #f8fafc; }
  .table-modern > tfoot > tr {
    background: #f3f4f6;
    font-weight: 700;
  }
  .table-modern > tfoot > tr > th,
  .table-modern > tfoot > tr > td {
    border-top: 1px solid #e5e7eb !important;
  }

  /* Inputs full-width en móviles */
  @media (max-width: 768px) {
    .form-inline .form-group { display: block; width: 100%; }
    .form-inline .form-control { width: 100%; }
  }
</style>

<div class="container-fluid">

  {{-- FILTRO DE FECHAS --}}
  <div class="row">
    <div class="col-xs-12 mb-20">
      <div class="card-2025">
        <div class="card-header">
          <span class="section-title"><i class="fa fa-filter"></i> Filtro de Estadísticas</span>
        </div>
        <div class="card-body">
          <form class="form-inline" action="{{ route('administrador.registro.solicitud.estadistica') }}" method="GET">
            <div class="row">
              <div class="col-xs-12 col-sm-4 mb-10">
                <div class="form-group" style="width:100%">
                  <label for="agendadorMesi">Fecha inicio:</label>
                  <input type="date" name="agendadorMesi" id="agendadorMesi" value="{{ $agendadoI }}" class="form-control" required style="width:100%">
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 mb-10">
                <div class="form-group" style="width:100%">
                  <label for="agendadorMesf">Fecha fin:</label>
                  <input type="date" name="agendadorMesf" id="agendadorMesf" value="{{ $agendadoF }}" class="form-control" required style="width:100%">
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 mb-10">
                <label>&nbsp;</label>
                <div class="form-group" style="width:100%">
                  <button class="btn btn-2025" type="submit" style="width:100%"><i class="fa fa-search"></i> Filtrar Datos</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    {{-- USUARIOS QUE RESOLVIERON --}}
    <div class="col-xs-12 col-md-6 mb-20">
      <div class="card-2025">
        <div class="card-header">
          <span class="section-title"><i class="fa fa-users"></i> Soportes Resueltos por Funcionario</span>
        </div>
        <div class="card-body">
          <p class="text-muted"><small>
            @if($agendadoI != '' && $agendadoF != '')
              Desde: <strong>{{ $agendadoI }}</strong> hasta <strong>{{ $agendadoF }}</strong>
            @else
              Filtro: <strong>Todos los tiempos</strong>
            @endif
          </small></p>
          <div class="table-responsive">
            @php $totalA = 0; @endphp
            <table class="table table-modern table-hover table-condensed table-bordered">
              <thead>
                <tr>
                  <th>Nombre Funcionario</th>
                  <th class="text-center">Soportes Resueltos</th>
                </tr>
              </thead>
              @if(isset($estadisticaFuncionarioM) && count($estadisticaFuncionarioM) > 0)
                <tbody>
                  @foreach($estadisticaFuncionarioM as $funcionario)
                    @php $totalA += (int) $funcionario->cantidad; @endphp
                    <tr>
                      <td>
                        @if ($funcionario->nombre == null)
                          Falta por Gestionar
                        @else
                          {{ $funcionario->nombre }}
                        @endif
                      </td>
                      <td class="text-center">{{ $funcionario->cantidad }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-right">Total:</th>
                    <th class="text-center">{{ number_format($totalA) }}</th>
                  </tr>
                </tfoot>
              @else
                <tbody>
                  <tr><td colspan="2" class="text-center text-muted">No se encontraron soportes resueltos en este rango de fechas.</td></tr>
                </tbody>
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- TIPO DE SOLICITUD --}}
    <div class="col-xs-12 col-md-6 mb-20">
      <div class="card-2025">
        <div class="card-header">
          <span class="section-title"><i class="fa fa-tags"></i> Por Tipo de Solicitud</span>
        </div>
        <div class="card-body">
          <p class="text-muted"><small>
            @if($agendadoI != '' && $agendadoF != '')
              Desde: <strong>{{ $agendadoI }}</strong> hasta <strong>{{ $agendadoF }}</strong>
            @else
              Filtro: <strong>Todos los tiempos</strong>
            @endif
          </small></p>
          <div class="table-responsive">
            @php $totalSop = 0; @endphp
            <table class="table table-modern table-hover table-condensed table-bordered">
              <thead>
                <tr>
                  <th>Tipo solicitud</th>
                  <th class="text-center">Cantidad</th>
                </tr>
              </thead>
              @if(isset($estadisticaTipoSolicitud) && count($estadisticaTipoSolicitud) > 0)
                <tbody>
                  @foreach($estadisticaTipoSolicitud as $solicitudes)
                    @php $totalSop += (int) $solicitudes->cantidad; @endphp
                    <tr>
                      <td>{{ $solicitudes->tipo_solicitud }}</td>
                      <td class="text-center">{{ $solicitudes->cantidad }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-right">Total:</th>
                    <th class="text-center">{{ number_format($totalSop) }}</th>
                  </tr>
                </tfoot>
              @else
                <tbody>
                  <tr><td colspan="2" class="text-center text-muted">No se encontraron solicitudes en este rango de fechas.</td></tr>
                </tbody>
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection