@extends('layouts.monitoreo.coordinador')

@section('content')

<div class="container">
    <h3 class="page-header">
        <i class="glyphicon glyphicon-list-alt"></i>
        Reporte de Ingresos por Portería
    </h3>

    {{-- 🔎 Filtros --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            Filtros de búsqueda
        </div>

        <div class="panel-body">
            <form method="GET" action="{{ route('listado.reportes.ingresos') }}">

                <div class="row">

                    {{-- Usuario portería --}}
                    <div class="col-md-3">
                        <label>Usuario Portería</label>
                        <select name="portero" class="form-control">
                            <option value="">Todos</option>
                            @foreach($porteros as $p)
                                <option value="{{ $p->id }}"
                                    {{ request('portero') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }} {{ $p->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cédula --}}
                    <div class="col-md-3">
                        <label>Cédula</label>
                        <input type="text"
                               name="cedula"
                               value="{{ request('cedula') }}"
                               class="form-control"
                               placeholder="Ingrese cédula">
                    </div>

                    {{-- Fecha inicio --}}
                    <div class="col-md-2">
                        <label>Fecha Inicio</label>
                        <input type="date"
                               name="fecha_inicio"
                               value="{{ request('fecha_inicio') }}"
                               class="form-control">
                    </div>

                    {{-- Fecha fin --}}
                    <div class="col-md-2">
                        <label>Fecha Fin</label>
                        <input type="date"
                               name="fecha_fin"
                               value="{{ request('fecha_fin') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-2" style="margin-top:25px;">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="glyphicon glyphicon-search"></i> Buscar
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- 📋 Tabla resultados --}}
    <div class="panel panel-info">
        <div class="panel-heading">
            Resultados
        </div>

        <div class="panel-body table-responsive">

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cédula</th>
                        <th>Nombre Completo</th>
                        <th>Portero</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($registros as $r)
                        <tr>
                            <td>{{ $r->fecha_ingreso }}</td>
                            <td>{{ $r->hora_ingreso }}</td>
                            <td>{{ $r->identificacion }}</td>
                            <td>
                                {{ $r->p_nombre }}
                                {{ $r->s_nombre }}
                                {{ $r->p_apellido }}
                                {{ $r->s_apellido }}
                            </td>
                            <td>{{ $r->portero }}</td>
                            <td>{{ $r->observaciones }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No se encontraron registros
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $registros->appends(request()->query())->links() }}

        </div>
    </div>

</div>

@endsection
