@extends('layouts.monitoreo.coordinador')

@section('title', 'Gestión de Funcionarios')
@section('cabecera', 'Funcionarios Autorizados al Parqueadero')

@section('content')

@if(session('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('message') }}
    </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary" style="border-radius:12px;">
      <div class="box-header with-border">
        <div class="clearfix">
          <h3 class="box-title" style="float:left;"><i class="fa fa-id-card-o"></i> Listado de Funcionarios</h3>
          <div style="float:right;">
            <a href="{{ route('cooringreso.parqueadero.index') }}" class="btn btn-default btn-sm" style="border-radius:20px; margin-right:5px;">
              <i class="fa fa-building-o"></i> Ver Puestos
            </a>
            <a href="{{ route('cooringreso.funcionarios.create') }}" class="btn btn-success btn-sm" style="border-radius:20px;">
              <i class="fa fa-plus"></i> Nuevo Funcionario
            </a>
          </div>
        </div>
      </div>
      <div class="box-body">
        <div class="well well-sm" style="background:#f9f9f9; border-radius:8px; margin-bottom:15px;">
          <form method="GET" action="{{ route('cooringreso.funcionarios.index') }}" id="filterForm">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="small">Nombre / Cédula</label>
                  <input type="text" name="nombre" class="form-control input-sm" placeholder="Buscar..." value="{{ $nombre ?? '' }}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="small">Cargo / Despacho</label>
                  <input type="text" name="cargo" class="form-control input-sm" placeholder="Buscar..." value="{{ $cargo ?? '' }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="small">Placa</label>
                  <input type="text" name="placa" class="form-control input-sm" placeholder="ABC123" value="{{ $placa ?? '' }}" style="text-transform:uppercase;">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="small">No. Puesto</label>
                  <input type="text" name="puesto" class="form-control input-sm" placeholder="No." value="{{ $puesto ?? '' }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label><br>
                  <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i> Filtrar
                  </button>
                  <a href="{{ route('cooringreso.funcionarios.index') }}" class="btn btn-default btn-sm" title="Limpiar">
                    <i class="fa fa-refresh"></i>
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="tblFuncionarios">
            <thead style="background:#343a40; color:white;">
              <tr>
                <th>NOMBRE</th>
                <th>CÉDULA</th>
                <th style="min-width: 150px;">CARGO / DESPACHO</th>
                <th style="width: 100px;">PLACA</th>
                <th>TIPO VEH.</th>
                <th>PERMISO</th>
                <th>ESTADO</th>
                <th>PUESTO</th>
                <th class="text-center" style="width: 150px;">ACCIONES</th>
              </tr>
            </thead>
            <tbody>
              @forelse($funcionarios as $f)
              <tr>
                <td><strong>{{ $f->nombre }}</strong></td>
                <td>{{ $f->cedula }}</td>
                <td>
                  {{ $f->cargo ?? '' }}
                  @if($f->juzgado) <br><small class="text-muted">{{ $f->juzgado }}</small> @endif
                </td>
                <td>
                  <span class="label label-info">{{ $f->placa }}</span>
                </td>
                <td>{{ $f->tipo_vehiculo }}</td>
                <td>
                  @if($f->tipo_ingreso == 'GLOBAL')
                    <span class="label label-warning">GLOBAL</span>
                  @else
                    <span class="label label-default">LOCAL</span>
                  @endif
                </td>
                <td>
                  @if(($f->estado_funcionario ?? 'ACTIVO') == 'ACTIVO')
                    <span class="label label-success">ACTIVO</span>
                  @else
                    <span class="label label-danger">INACTIVO</span>
                  @endif
                </td>
                <td>
                  @if($f->puesto)
                    <span class="label label-success">{{ $f->puesto->parqueadero }}</span>
                    <br><small class="text-muted">{{ $f->puesto->edificio }}</small>
                  @else
                    <span class="label label-danger">Sin asignar</span>
                  @endif
                </td>
                <td class="text-center" style="white-space:nowrap;">
                  <a href="{{ route('cooringreso.funcionarios.assign', $f->id) }}"
                     class="btn btn-xs btn-primary" title="Asignar Puesto">
                    <i class="fa fa-building-o"></i>
                  </a>
                  <a href="{{ route('cooringreso.funcionarios.edit', $f->id) }}"
                     class="btn btn-xs btn-warning" title="Editar">
                    <i class="fa fa-pencil"></i>
                  </a>
                  @if($f->puesto)
                  <a href="{{ route('cooringreso.funcionarios.unassign', $f->id) }}"
                     class="btn btn-xs btn-default" title="Quitar Puesto"
                     onclick="return confirm('¿Quitar el puesto asignado a {{ $f->nombre }}?')">
                    <i class="fa fa-times"></i>
                  </a>
                  @endif
                  <a href="{{ route('cooringreso.funcionarios.inactivate', $f->id) }}"
                     class="btn btn-xs {{ ($f->estado_funcionario ?? 'ACTIVO') == 'ACTIVO' ? 'btn-default' : 'btn-success' }}" 
                     title="{{ ($f->estado_funcionario ?? 'ACTIVO') == 'ACTIVO' ? 'Inactivar' : 'Activar' }}">
                    <i class="fa {{ ($f->estado_funcionario ?? 'ACTIVO') == 'ACTIVO' ? 'fa-ban' : 'fa-check' }}"></i>
                  </a>
                  <form action="{{ route('cooringreso.funcionarios.destroy', $f->id) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('¿Eliminar a {{ $f->nombre }}? Esta acción no se puede deshacer.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-xs btn-danger" title="Eliminar">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @empty
              <tr><td colspan="9" class="text-center text-muted">No hay funcionarios registrados.</td></tr>
              @endforelse
            </tbody>
          </table>
          </form>
        </div>

        <div class="text-center premium-pagination">
            {{ $funcionarios->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
  // Auto-submit form when a select changes
  $('.table-header-filter select').on('change', function() {
    $(this).closest('form').submit();
  });

  $('#tblFuncionarios').DataTable({
    "paging": false,
    "info": false,
    "searching": false,
    "order": [[0,'asc']],
    "language": { "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" }
  });
});
</script>
@endpush
@endsection
