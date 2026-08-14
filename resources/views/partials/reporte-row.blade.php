<tr class="{{ $reporte->id_user ? 'warning' : 'active' }}"
    @if($reporte->id_user ==  auth()->user()->id)
        style="background-color: #FBBAB4"
    @endif>
    <td>
        <div class="btn-group-vertical">
            @if($reporte->id_user != null && $reporte->id_user !=  auth()->user()->id)
                <a href="{{ route('administrador.registro.solicitud.edit', $reporte->id) }}" class="btn btn-primary btn-xs disabled">
                    <i class="glyphicon glyphicon-wrench"></i>
                </a>
            @endif

            @if($reporte->id_user == null || $reporte->id_user ==  auth()->user()->id)
                <a href="{{ route('administrador.registro.solicitud.edit', $reporte->id) }}" class="btn btn-primary btn-xs">
                    <i class="glyphicon glyphicon-wrench"></i>
                </a>
            @endif

            @if($reporte->id_user ==  auth()->user()->id && $reporte->respuesta == null)
                <a href="{{ route('administrador.registro.solicitud.soltar', $reporte->id) }}" class="btn btn-warning btn-xs">
                    <i class="glyphicon glyphicon-share"></i> Soltar
                </a>
            @endif
        </div>
    </td>

    <td>{{ $reporte->funcionario }}</td>
    <td>{{ $reporte->tipo_solicitud }}</td>
    <td>{{ $reporte->solicitud }}</td>
    <td>{{ $reporte->despacho }}</td>

    <td>
        <strong>Atendi&oacute;:</strong> {{ $reporte->quien_da_solucion }}<br>
        <strong>Fecha S/TUD:</strong> {{ $reporte->fecha_solicitud }}<br>
        <strong>Fecha S/CION:</strong> {{ $reporte->fecha_solucion }}
    </td>

    <td style="width:30%;max-width:30%;word-wrap:break-word;white-space:normal;">
        <div style="max-width:100%;overflow-x:auto;max-height:300px;overflow-y:auto;">
            {!! $reporte->respuesta_formateada !!}
        </div>
    </td>
</tr>
