@extends('layouts.encuesta')

@section('title', 'Histórico de Encuestas y Llamadas')

@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Histórico de Usuarios (Todos los registros)</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('encuestas_llamadas.index') }}" class="btn btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i> Volver a Llamadas
                </a>
                <a href="{{ route('encuestas_llamadas.exportar') }}" class="btn btn-info btn-sm ml-2">
                    <i class="fa fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabla-historico">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Celular</th>
                        <th>Municipio</th>
                        <th>Estado</th>
                        <th>Asesor que llamó</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($llamadas as $ll)
                    <tr>
                        <td>{{ $ll->id }}</td>
                        <td>{{ $ll->cedula }}</td>
                        <td>{{ $ll->nombre }}</td>
                        <td>{{ $ll->celular }}</td>
                        <td>{{ $ll->municipio }}</td>
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
                            {{ $ll->usuario ? $ll->usuario->name . ' ' . $ll->usuario->lastname : 'N/A' }}
                        </td>
                        <td>
                            {{ $ll->observaciones ?: 'Sin observaciones' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tabla-historico').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "order": []
        });
    });
</script>
@endpush
