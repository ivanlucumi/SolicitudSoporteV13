@extends('layouts.mantenimiento')

@section('title', 'Reportes de Incidentes')
@section('cabecera', 'Registro de Incidentes')

@section('content') 
<div class="container-fluid">

  
    <!-- Tabla de incidentes -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info panel-shadow">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left text-uppercase">
                        <i class="fa fa-exclamation-triangle"></i> Listado de Incidentes Reportados Sin Soluci&oacute;n
                    </h3>
                    <div class="pull-right">
                        <button type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-target="#incidentes-listado">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="panel-body table-responsive panel-collapse collapse in">
                    <table id="table9" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr class="bg-primary text-white text-uppercase text-center">
                                <th>#</th>
                                <th>Categor&iacute;a</th>
                                <th>Reporte</th>
                                <th>Descripci&oacute;n</th>
                                <th>Despacho</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Asignado_A</th>
                                <th>Trasladado_A</th>
                                <th>Observaciones</th>
                                <th>Respuesta T&eacute;cnico</th>
                                <th>Obs. Internas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                  @if($incidentes != null)
                      @foreach($incidentes as $solicitud)
                      
                              <tbody data-id="{!!$solicitud->id!!}"  class="buscar">
                                      <tr class="table-light">
                                        <th scope="row"> {{$solicitud->consecutivo}} </th>
                                          <th scope="row"> {{$solicitud->categoria}} </th>
                                          <th scope="row"> {{$solicitud->item}}  </th>
                                          <th scope="row"> {{$solicitud->descripcion}} </th>
                                          <th scope="row"> {{$solicitud->nombre_despacho}} </th>
                                          <th scope="row"> 
                                          <span class="label 
                                            @if($solicitud->estado == 'PENDIENTE') label-danger
                                            @elseif($solicitud->estado == 'ARREGLO PARCIAL') label-warning
                                            @elseif($solicitud->estado == 'REALIZADO') label-success
                                            @else label-default @endif">
                                            {{ $solicitud->estado }}
                                          </span> 
                                        </th>
                                          <th scope="row"> {{$solicitud->created_at}} </th>
                                          <th scope="row"> {{$solicitud->asignado_a}} </th>
                                          <th scope="row"> {{$solicitud->trasladado_a}} </th>
                                          <th scope="row"> {{$solicitud->observaciones}} </th>
                                          <th scope="row"> {{$solicitud->respuesta_tecnico}} </th>
                                          <th scope="row"> {{$solicitud->comentarios_internos}} </th>
                                          <th scope="row">
                                            <div class="btn-group-vertical btn-block" style="width: 100%;">
                                                @if(empty($solicitud->asignado_a))
                                                    <a href="#" class="btn btn-danger btn-sm fa fa-eye ver" id="ver" title="Ver" style="margin-bottom: 5px;"> </a>
                                                    <a href="#" class="btn btn-warning btn-sm fa fa-exchange trasladar" id="trasladar" title="Trasladar" style="margin-bottom: 5px;"> </a>
                                                @endif
                                                <a href="#" class="btn btn-success btn-sm fa fa-lock cerrar" id="registrar" title="Cerrar" style="margin-bottom: 5px;"> </a>
                                            </div>
                                        </th>

                                          
                                          
                                      </tr>								 	                
                              </tbody>
                      @endforeach	  
                  @else
                        
                        @endif					
                      
                                  
                </table>
            </div>
          </div>
        </div>
  </div>

</div>

@include('mantenimiento.modal.revision')
@include('mantenimiento.modal.cerrar')
@include('mantenimiento.modal.trasladar')

<!--CONSULTA INGRESO -->
<form id="form-reporte-incidente" action="{{ route('reporte.incidente',':ID_ID') }}" method="POST">
    @csrf
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/FilterDoce.js"></script>

<script>





$(document).on('click', '.ver', function(e) {

    e.preventDefault();          
      var row   = $(this).parents('tbody')
      let id    = row.data('id');

    // Obtener ID correctamente (ajusta según tu HTML)
    //let id = $(this).data('id');

    if(!id){
        console.error('ID no encontrado');
        return;
    }

    let form = $('#form-reporte-incidente');

    if(!form.length){
        console.error('Formulario no encontrado');
        return;
    }

    let url = form.attr('action').replace(':ID_ID', id);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(result){

            if(!result){
                console.error('Respuesta vacía');
                return;
            }

            // Reset seguro
            let formEditar = $('#form-editar-incidente');
            if(formEditar.length){
                formEditar.trigger('reset');
            }

            // Limpiar selects antes de agregar
            $('#IdItem').empty();
            $('#idCategoria').empty();

            $('#IdItem').append(
                `<option value="${result.item ?? ''}">
                    ${result.item ?? 'No definido'}
                 </option>`
            );

            $('#idCategoria').append(
                `<option value="${result.categoria ?? ''}">
                    ${result.categoria ?? 'No definido'}
                 </option>`
            );

            // Manejo seguro fecha
            let creacion = '';
            if(result.created_at){
                let fechaObj = new Date(result.created_at);
                if(!isNaN(fechaObj)){
                    let fecha = fechaObj.toISOString().split("T")[0];
                    let hora  = fechaObj.toTimeString().slice(0,5);
                    creacion = fecha + " " + hora;
                }
            }

            // Asignación segura
            $('#id').val(result.id ?? '');
            $('#idCategoria').val(result.categoria ?? '');
            $('#IdItem').val(result.item ?? '');
            $('#idDescripcion').val(result.descripcion ?? '');
            $('#IdFecha').val(creacion);
            $('#idIReporte').val(result.marca ?? '');
            $('#IdEstado').val(result.estado ?? '');
            $('#Idobservaciones').val(result.observaciones ?? '');
            $('#Idcomentarios_internosV').val(result.comentarios_internos ?? '');

            // Abrir modal
            $('#modal_Revisar_reporte').modal('show');
        },
        error: function(xhr){
            console.error('Error AJAX:', xhr.responseText);
        }
    });

});
 

 $('.trasladar').click(function(e) {
  //alert('hola')
  e.preventDefault();           
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //alert(id);
  var form  = $('#form-reporte-incidente');
  var url   = form.attr('action').replace(':ID_ID', id);
  var data  = form.serialize();
  //alert(url);
  $.get(url,data, function(result){
      
       $('#form-reporte-incidente')[0].reset(); // limpia todos los campos 
            $('#IdItemt').append('<option value=" + result.item + ">' + result.item + '</option>');
            //idCategoria
            $('#idCategoriat').append('<option value=" + result.categoria + ">' + result.categoria + '</option>');
      
      const fechaHora = result.created_at;

    // Convertir a objeto Date
    const fechaObj = new Date(fechaHora);

    // Obtener fecha en formato YYYY-MM-DD
    const fecha = fechaObj.toISOString().split("T")[0];

    // Obtener hora en formato HH:MM
    const hora = fechaObj.toTimeString().slice(0, 5);
    
    const creacion = fecha+" "+hora
      console.log(result)
        $('#idt').val(result.id);
        $('#idCategoriat').val(result.categoria);       
        $('#IdItemt').val(result.item); 
        $('#idDescripciont').val(result.descripcion);
        $('#IdFechat').val(creacion); 
        $('#idIReportet').val(result.marca); 
        $('#IdEstadot').val(result.estado);
        $('#Idcomentarios_internos').val(result.comentarios_internos);
        $('#modal_trasladar_reporte').modal('show');
  });
 });

 $('.cerrar').click(function(e) {
  //alert('hola')
  e.preventDefault();           
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //alert(id);
  var form  = $('#form-reporte-incidente');
  var url   = form.attr('action').replace(':ID_ID', id);
  var data  = form.serialize();
  //alert(url);
  $.get(url,data, function(result){
      const fechaHora = result.created_at;

    // Convertir a objeto Date
    const fechaObj = new Date(fechaHora);

    // Obtener fecha en formato YYYY-MM-DD
    const fecha = fechaObj.toISOString().split("T")[0];

    // Obtener hora en formato HH:MM
    const hora = fechaObj.toTimeString().slice(0, 5);
    
    const creacion = fecha+" "+hora
      console.log(result)
        $('#idc').val(result.id);
        $('#idCategoriac').val(result.categoria);       
        $('#IdItemc').val(result.item); 
        $('#idDescripcionc').val(result.descripcion);
        $('#IdFechac').val(creacion); 
        $('#idIReportec').val(result.marca); 
        $('#IdEstadoc').val(result.estado);
        $('#Idobservacionec').val(result.observaciones);        
        $('#Idrepuesta').val(result.respuesta_tecnico);
        $('#Idcomentarios_internos').val(result.comentarios_internos);
        
        $('#modal_cerrar_reporte').modal('show');
  });
 });
               
</script>

<script>
    $(document).on('change', '#idCategoria', function () {
    const categoriaId = $(this).val();
    const itemSelect = $('#IdItem');
    itemSelect.empty().append('<option selected disabled>Cargando...</option>');

    $.get("/mantenimiento/reporte/incidentes/categories/elements/" + categoriaId, function (data) {
        itemSelect.empty();
        if (data.length > 0) {
            itemSelect.append('<option value="" disabled selected>Seleccione Requerimiento</option>');
            $.each(data, function (i, v) {
                itemSelect.append('<option value=" + v.id + ">' + v.elemento + '</option>');
            });
            itemSelect.append('<option value="otro">OTRO</option>');
        } else {
            itemSelect.append('<option disabled>No hay requerimientos disponibles</option>');
        }
    }).fail(function () {
        itemSelect.empty().append('<option disabled>Error al cargar requerimientos</option>');
    });
});

</script>

<script>
    $(document).on('change', '#idCategoriat', function () {
    const categoriaId = $(this).val();
    const itemSelected = $('#IdItemt');
    itemSelected.empty().append('<option selected disabled>Cargando...</option>');

    $.get("/mantenimiento/reporte/incidentes/categories/elements/" + categoriaId, function (data) {
        itemSelected.empty();
        if (data.length > 0) {
            itemSelected.append('<option value="" disabled selected>Seleccione Requerimiento</option>');
            $.each(data, function (i, v) {
                itemSelected.append('<option value=" + v.id + ">' + v.elemento + '</option>');
            });
            itemSelected.append('<option value="otro">OTRO</option>');
        } else {
            itemSelected.append('<option disabled>No hay requerimientos disponibles</option>');
        }
    }).fail(function () {
        itemSelected.empty().append('<option disabled>Error al cargar requerimientos</option>');
    });
});

</script>

<!--script>
  document.addEventListener('DOMContentLoaded', function () {
      var check = document.getElementById('checkDefault');
      var notiExtra = document.getElementById('notificacion_extra');

      check.addEventListener('change', function () {
          if (this.checked) {
              notiExtra.style.display = 'block';
          } else {
              notiExtra.style.display = 'none';
              document.getElementById('correos').value = '';
              document.getElementById('comentarios_notificacion').value = '';
          }
      });
  });
</script-->



@endsection