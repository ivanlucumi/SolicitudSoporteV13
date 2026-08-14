@extends('layouts.encuesta')

@section('title', 'Encuestas y Llamadas')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('repetidos'))
        <div class="alert alert-warning">
            <strong>Atención:</strong> {{ count(session('repetidos')) }} usuarios ya estaban registrados y fueron omitidos para evitar duplicados.
            <div style="max-height: 150px; overflow-y: auto; margin-top: 10px; background: rgba(255,255,255,0.5); padding: 10px; border-radius: 4px;">
                <ul class="mb-0">
                    @foreach(array_slice(session('repetidos'), 0, 500) as $rep)
                        <li><strong>Documento:</strong> {{ $rep['cedula'] }} - <strong>Nombre:</strong> {{ $rep['nombre'] }}</li>
                    @endforeach
                    @if(count(session('repetidos')) > 500)
                        <li><em>...y {{ count(session('repetidos')) - 500 }} más.</em></li>
                    @endif
                </ul>
            </div>
        </div>
    @endif

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Usuarios a Contactar</h3>
            <div class="box-tools pull-right">
                @if($isAdminEncuesta)
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalImportar">
                        <i class="fa fa-upload"></i> Cargar CSV
                    </button>
                    <a href="{{ route('encuestas_llamadas.exportar') }}" class="btn btn-info btn-sm ml-2">
                        <i class="fa fa-download"></i> Descargar Excel
                    </a>
                    <a href="{{ route('encuestas_llamadas.historico') }}" class="btn btn-primary btn-sm ml-2">
                        <i class="fa fa-history"></i> Ver Histórico Completo
                    </a>
                @endif
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabla-llamadas">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Celular</th>
                        <th>Municipio</th>
                        <th>Despacho</th>
                        <th>Estado</th>
                        <th>Asignado A</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($llamadas as $ll)
                    <tr>
                        <td>{{ $ll->id }}</td>
                        <td>{{ $ll->cedula ?? 'N/A' }}</td>
                        <td>{{ $ll->nombre ?? 'Pendiente' }}</td>
                        <td>{{ $ll->celular ?? 'N/A' }}</td>
                        <td>{{ $ll->municipio ?? 'N/A' }}</td>
                        <td>{{ $ll->despacho ?? 'Pendiente' }}</td>
                        <td>
                            @if($ll->estado == 'Pendiente')
                                <span class="label label-warning">Pendiente</span>
                            @elseif($ll->estado == 'En proceso')
                                <span class="label label-info">En proceso</span>
                            @else
                                <span class="label label-success">Llamado</span>
                            @endif
                        </td>
                        <td>
                            {{ $ll->usuario ? $ll->usuario->name . ' ' . $ll->usuario->lastname : 'Nadie' }}
                        </td>
                        <td>
                            @if($ll->estado == 'Pendiente' || ($ll->estado == 'En proceso' && $ll->usuario_id == auth()->id()))
                                <a href="{{ route('encuestas_llamadas.llamar', $ll->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-phone"></i> Llamar
                                </a>
                            @elseif($ll->estado == 'Llamado')
                                <button class="btn btn-default btn-sm" disabled><i class="fa fa-check"></i> Completado</button>
                            @else
                                <button class="btn btn-danger btn-sm" disabled><i class="fa fa-lock"></i> Ocupado</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Importar CSV -->
@if($isAdminEncuesta)
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="{{ route('encuestas_llamadas.importar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h4 class="modal-title text-white">Importar Usuarios desde CSV</h4>
          </div>
          <div class="modal-body">
            <p>Sube un archivo <b>.csv</b> delimitado por punto y coma (;). El formato esperado (la 1ra fila de encabezados será ignorada) es:</p>
            <ul>
                <li>Columna A: Cédula (Número de documento)</li>
                <li>Columna B: Nombre Completo</li>
                <li>Columna C: Celular</li>
                <li>Columna D: Correo Electrónico</li>
                <li>Columna E: Municipio</li>
            </ul>
            <div class="form-group mt-3">
                <label>Archivo CSV</label>
                <input type="file" name="archivo_csv" class="form-control" accept=".csv" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Subir y Procesar</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endif


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Inicializar tabla
        $('#tabla-llamadas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "order": []
        });
    });
</script>
@endpush
