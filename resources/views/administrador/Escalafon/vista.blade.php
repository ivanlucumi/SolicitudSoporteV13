@extends('layouts.admin')

@section('content')
<table class="table table-bordered table-striped table-condensed">
    <thead style="background:#f5f5f5;">
        <tr>
            <th>ID</th>
            <th>Despacho</th>
            <th>Cargo</th>
            <th>Propietario</th>
            <th>Provisional</th>
            <th>Escalafón</th>
            <th>Posesión</th>
            <th>Licencia</th>
            <th>Estado</th>
            <th>Fecha Posesión Prov.</th>
            <th>Act CSJVAC</th>
            <th>Reporte Lista</th>
            <th>Observaciones</th>
            <th>Comentarios</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registros as $r)
        <tr>
            <td>{{ $r->id }}</td>

            {{-- DESPACHO --}}
            <td>
               Codigo: {{ $r->cargo->despachoJudicial->codigoDespacho ?? '' }}<br>
               Despacho: {{ $r->cargo->despachoJudicial->nombreDespacho ?? '' }}<br>
               Jurisdiccion: {{ $r->cargo->despachoJudicial->jurisdiccion  ?? '' }}<br>
               Tipo Despacho: {{ $r->cargo->despachoJudicial->tipo_despacho  ?? '' }}<br>
               Competencia: {{ $r->cargo->despachoJudicial->competencia  ?? '' }}<br>
               Especialidad: {{ $r->cargo->despachoJudicial->especialidad  ?? '' }}<br>
               Subespecialidad: {{ $r->cargo->despachoJudicial->subespecialidad  ?? '' }}<br>
               Des Transformado:  {{ $r->cargo->despachoJudicial->despacho_transformado  ?? '' }}<br>
            </td>

            {{-- CARGO --}}
            <td>
                {{ $r->cargo->nombre_cargo ?? '' }} <br>
                Grado: {{ $r->cargo->grado ?? '' }}
            </td>

            {{-- PROPIETARIO --}}
            <td>
                {{ $r->propietario->nameE ?? '' }} {{ $r->propietario->lastnameE ?? '' }} <br>
                CC: {{ $r->propietario->cedulaE ?? '' }}
            </td>

            {{-- PROVISIONAL --}}
            <td>
                {{ $r->provisional->nameE ?? '' }} {{ $r->provisional->lastnameE ?? '' }} <br>
                CC: {{ $r->provisional->cedulaE ?? '' }}
            </td>

            {{-- ESCALAFON --}}
            <td>
                Novedad: {{ $r->escalafon->novedad ?? '' }} <br>
                Acto: {{ $r->escalafon->numero_acto ?? '' }} <br>
                Fecha: {{ $r->escalafon->fecha_acto ?? '' }}
            </td>

            {{-- POSESION --}}
            <td>
                Tipo: {{ $r->posesion->tipo_nombramiento ?? '' }} <br>
                Acto: {{ $r->posesion->no_acto_adtivo ?? '' }} <br>
                Fecha: {{ $r->posesion->fecha_posesion ?? '' }}
            </td>

            {{-- LICENCIA --}}
            <td>
                Resolución: {{ $r->licencia->no_resolucion ?? '' }} <br>
                Fecha: {{ $r->licencia->fecha ?? '' }} <br>
                Tiempo: {{ $r->licencia->tiempo ?? '' }}
            </td>

            <td>{{ $r->estado_actual }}</td>
            <td>{{ $r->fecha_posesion_provisional }}</td>
            <td>{{ $r->act_csjvac }}</td>
            <td>{{ $r->reporte_lista }}</td>
            <td style="max-width:200px;">{{ $r->observaciones }}</td>
            <td style="max-width:200px;">{{ $r->comentarios }}</td>

            <td>
                <a href="{{ route('despachos.show.escalafon.edit', $r->id) }}" 
                   class="btn btn-xs btn-primary">Editar</a>

                <form action="{{ route('despachos.show.escalafon.delete', $r->id) }}" 
                      method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-xs btn-danger" 
                            onclick="return confirm('¿Eliminar?')">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection