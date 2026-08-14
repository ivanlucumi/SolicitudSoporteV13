@php
    $inventario = $inventario ?? collect();
    $solicitudes = $solicitudes ?? collect();
@endphp

<div class="modal fade" id="modal_pedir_reporte_operario">
<div class="modal-dialog modal-md">
<div class="modal-content">

<div class="modal-header text-center" style="background-color:#004182;">
    <h4 class="modal-title" style="color:white;">
        <strong>PEDIR ELEMENTOS</strong>
    </h4>
    <button type="button" class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
</div>

<div id="msj-error" class="alert alert-danger" style="display:none">
    <strong id="msj"></strong>
</div>

<div class="modal-body">
<div class="container-fluid">

<!-- ============================= -->
<!-- SELECCIÓN DE ELEMENTOS -->
<!-- ============================= -->

<div class="row mb-3 mt-3">

<div class="col-md-3">
<label>ELEMENTOS PARA PEDIR A ALMACÉN</label>
</div>

<div class="col-md-4">
<select id="item-select" class="form-control select2">
    <option value="">SELECCIONE ELEMENTO</option>
    <option value="OTRO">OTRO</option>

    @forelse($inventario as $item)
        <option value="{{ $item->descripcion ?? '' }}">
            {{ $item->descripcion ?? 'Sin descripción' }}
        </option>
    @empty
        <option value="">SIN ELEMENTOS DISPONIBLES</option>
    @endforelse

</select>
</div>

<div class="col-md-3" id="otro-input-container" style="display:none;">
    <input type="text"
           id="otro-input"
           class="form-control"
           placeholder="Ingrese Nombre Elemento">
</div>

<div class="col-md-2">
    <button type="button"
            id="add-item"
            class="btn btn-primary btn-block">
        AGREGAR
    </button>
</div>

</div>

<hr>

<!-- ============================= -->
<!-- FORMULARIO TEMPORAL -->
<!-- ============================= -->

<div id="item-form" style="display:none;">

<div class="form-group">
<label>ELEMENTO SELECCIONADO:</label>
<input type="text"
       id="item-elemento"
       class="form-control"
       readonly>
</div>

<div class="form-group">
<label>CANTIDAD:</label>
<input type="number"
       id="item-cantidad"
       class="form-control"
       min="1"
       placeholder="Cantidad">
</div>

<div class="form-group">
<label>OBSERVACIONES:</label>
<textarea id="item-observaciones"
          class="form-control"
          style="height:100px"
          placeholder="Observaciones"></textarea>
</div>

<div class="row">
<div class="col-md-6">
<button type="button"
        id="save-item"
        class="btn btn-success btn-block">
    REGISTRAR
</button>
</div>
<div class="col-md-6">
<button type="button"
        class="btn btn-secondary btn-block"
        onclick="$('#item-form').hide();">
    CANCELAR
</button>
</div>
</div>

<hr>
</div>

<!-- ============================= -->
<!-- TABLA DE ELEMENTOS -->
<!-- ============================= -->

<div class="table-responsive">
<table class="table table-bordered table-hover">

<thead style="background:#274a8a;color:white;">
<tr>
<th>ELEMENTO</th>
<th>CANTIDAD</th>
<th>OBSERVACIONES</th>
<th>ACCIÓN</th>
</tr>
</thead>

<tbody id="items-table">

@forelse($solicitudes as $solicitud)

@php
    $estadoSolicitud = $solicitud->estado_solicitud ?? false;
@endphp

<tr id="item-{{ $solicitud->id ?? '' }}">

<td>{{ $solicitud->elemento ?? 'No definido' }}</td>
<td>{{ $solicitud->cantidad ?? 0 }}</td>
<td>{{ $solicitud->observaciones ?? 'Sin observaciones' }}</td>

<td>
@if($estadoSolicitud)
    <button class="btn btn-success btn-sm" disabled>
        REPORTADO
    </button>
@else
    <button type="button"
            class="btn btn-danger btn-sm delete-item"
            data-id="{{ $solicitud->id ?? '' }}">
        ELIMINAR
    </button>
@endif
</td>

</tr>

@empty

<tr>
<td colspan="4" class="text-center text-muted">
No hay elementos registrados
</td>
</tr>

@endforelse

</tbody>
</table>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button"
        class="btn btn-warning btn-block"
        data-dismiss="modal">
    CERRAR
</button>
</div>

</div>
</div>
</div>