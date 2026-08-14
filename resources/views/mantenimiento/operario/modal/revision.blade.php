@php
    $solicitud = $solicitud ?? null;
    $estado_actual = $solicitud?->estado ?? '';
@endphp

<div class="modal fade" id="modal_Revisar_reporte_operario">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header text-center" style="background-color:#004182;">
    <h4 class="modal-title" style="color:white;">
        <strong>VER Y GESTIONAR REPORTE DE INCIDENTE</strong>
    </h4>
    <button type="button" class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
</div>

<div id="msj-error" class="alert alert-danger" style="display:none">
    <strong id="msj"></strong>
</div>

<form action="{{ route('operario.reporte.incidente.comentar') }}" method="POST">
    @csrf
@csrf

<div class="modal-body">
<div class="container-fluid">

<input type="hidden" name="id" id="id_dato" value="{{ old('id') ?? '' }}">

<div class="row">

<div class="col-md-6">
<label>CATEGORÍA:</label>
<input type="text" class="form-control" id="idCategoria" readonly>
</div>

<div class="col-md-6">
<label>REPORTE:</label>
<input type="text" class="form-control" id="IdItem" readonly>
</div>

<div class="col-md-12">
<label>DESCRIPCIÓN:</label>
<textarea id="idDescripcion"
          class="form-control"
          style="height:120px"
          readonly></textarea>
</div>

<div class="col-md-6">
<label>FECHA REPORTE:</label>
<input type="text" id="IdFecha"
       class="form-control"
       readonly>
</div>

<div class="col-md-6">
<label>ESTADO ACTUAL:</label>
<input type="text"
       class="form-control"
       value="{{ $estado_actual }}"
       readonly>
</div>

<!-- COMENTARIOS EXISTENTES -->
<div class="col-md-6">
<label>COMENTARIOS INTERNOS:</label>
<textarea id="Idcomentarios_internos_existente"
          class="form-control"
          style="height:120px"
          readonly></textarea>
</div>

<div class="col-md-6">
<label>OBSERVACIONES:</label>
<textarea name="observaciones"
          id="Idobservaciones"
          class="form-control"
          style="height:120px"
          readonly></textarea>
</div>

<!-- CAMBIO ESTADO -->
<div class="col-md-6">
<label>CAMBIAR ESTADO:</label>
<select name="estado" id="estado" class="form-control" required>
    <option value="">SELECCIONE</option>
    <option value="ARREGLO PARCIAL"
        {{ $estado_actual=='ARREGLO PARCIAL'?'selected':'' }}>
        ARREGLO PARCIAL
    </option>
    <option value="PENDIENTE"
        {{ $estado_actual=='PENDIENTE'?'selected':'' }}>
        PENDIENTE
    </option>
    <option value="REALIZADO"
        {{ $estado_actual=='REALIZADO'?'selected':'' }}>
        REALIZADO
    </option>
</select>
</div>

<!-- NUEVO COMENTARIO -->
<div class="col-md-12" id="comentarios_nuevo_container" style="display:none;">
<label>REALIZAR COMENTARIO INTERNO:</label>
<textarea name="comentarios_internos"
          id="comentarios_nuevo"
          class="form-control"
          style="height:120px"
          placeholder="Describa las acciones realizadas"></textarea>
</div>

</div>
</div>
</div>

<div class="modal-footer">
<div class="row">
<div class="col-md-6">
<button class="btn btn-success btn-block" type="submit">COMENTAR</button>
</div>
<div class="col-md-6">
<button type="button"
        class="btn btn-warning btn-block"
        data-dismiss="modal">
    CANCELAR
</button>
</div>
</div>
</div>

</form>

</div>
</div>
<script>
$(function(){

    $('#estado').on('change', function(){

        let estado = $(this).val();

        if(estado === "ARREGLO PARCIAL"){
            $('#comentarios_nuevo_container').show();
            $('#Idobservaciones').prop('readonly', false);
        }
        else if(estado === "REALIZADO"){
            $('#comentarios_nuevo_container').hide();
            $('#Idobservaciones').prop('readonly', false);
        }
        else{
            $('#comentarios_nuevo_container').hide();
            $('#Idobservaciones').prop('readonly', true);
        }

    });

});
</script>
</div>