@extends('layouts.monitoreo.coordinador')

@section('cabecera', 'Gestión de Ingresos Temporales')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Listado de Personal Temporal / Contratistas</h3>
        <div class="box-tools">
            <a href="{{ route('cooringreso.temporales.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Nuevo Ingreso Temporal
            </a>
        </div>
    </div>
    <div class="box-body">
        <!-- Buscador -->
        <form method="GET" action="{{ route('cooringreso.temporales.index') }}" class="form-inline mb-20" style="margin-bottom: 20px;">
            <div class="form-group">
                <input type="text" name="placa" class="form-control" placeholder="Placa..." value="{{ request('placa') }}">
            </div>
            <div class="form-group">
                <input type="text" name="funcionario" class="form-control" placeholder="Nombre o CC..." value="{{ request('funcionario') }}">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Filtrar
            </button>
            <a href="{{ route('cooringreso.temporales.index') }}" class="btn btn-default">Limpiar</a>
        </form>

        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr style="background-color: #3c8dbc; color: white;">
                        <th>CÉDULA</th>
                        <th>NOMBRE</th>
                        <th>EMPRESA</th>
                        <th>PLACA</th>
                        <th class="text-center">VIGENCIA</th>
                        <th class="text-center">CIUDAD</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($temporales as $temp)
                        <tr>
                            <td>{{ $temp->cedula }}</td>
                            <td>{{ $temp->nombre }}</td>
                            <td>{{ $temp->empresa }}</td>
                            <td><span class="label label-warning" style="font-size: 1.1em;">{{ $temp->placa }}</span></td>
                            <td class="text-center">
                                <small>Del <b>{{ $temp->fecha_inicio }}</b> al <b>{{ $temp->fecha_fin }}</b></small>
                                <br>
                                @php $hoy = date('Y-m-d'); @endphp
                                @if($hoy < $temp->fecha_inicio)
                                    <span class="label label-default">PENDIENTE</span>
                                @elseif($hoy > $temp->fecha_fin)
                                    <span class="label label-danger">VENCIDO</span>
                                @else
                                    <span class="label label-success">ACTIVO</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $temp->juzgado }}</td>
                            <td class="text-center">
                                <a href="{{ route('cooringreso.temporales.edit', $temp->id) }}" class="btn btn-xs btn-primary" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('cooringreso.temporales.destroy', $temp->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar este registro temporal?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" title="Eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron registros temporales.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{ $temporales->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection
