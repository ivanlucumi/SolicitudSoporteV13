@extends('layouts.mantenimiento')
<!--ponerle titulo a la paginga-->
@section('title', 'Reporte de Incidentes')
@section('cabecera', 'Reporte de Incidentes Cerrados')


@section('content') 
<div class="container-fluid">

  
    <!-- Tabla de incidentes -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info panel-shadow">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left text-uppercase">
                        <i class="fa fa-exclamation-triangle"></i> LISTADO DE INCIDENTES REPORTADOS YA CERRADOS
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
                                <th>Categoría</th>
                                <th>Reporte</th>
                                <th>Descripción</th>
                                <th>Despacho</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Asignado A</th>
                                <th>Trasladado A</th>
                                <th>Observaciones</th>
                                <th>Respuesta Técnico</th>
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
                                             
                                            <a href="#" class="btn btn-danger fa fa-lock cerrar btn-block" id="registrar" title="Cerrar" style="margin-bottom: 5px;"></a>
                                            <button class="btn btn-info btn-sm ver-encuesta"
                                                    data-consecutivo="{{ $solicitud->id }}">
                                                <i class="glyphicon glyphicon-eye-open"></i> Ver Resultado
                                            </button>


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

@include('mantenimiento.modal.REncuesta')
@include('mantenimiento.modal.revision')
@include('mantenimiento.modal.cerrar')
@include('mantenimiento.modal.trasladar')




<!--CONSULTA INGRESO -->
<form id="form-reporte-incidente" action="{{ route('reporte.incidente',':ID_ID') }}" method="POST">
    @csrf
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/FilerOnce.js"></script>

<script>

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

$('.ver-encuesta').click(function(){

    var consecutivo = $(this).data('consecutivo');

    $('#tituloConsecutivo').text(consecutivo);
    $('#modalEncuesta').modal('show');

    $('#contenidoEncuesta').html(`
        <div class="text-center">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
            <p>Cargando resultados...</p>
        </div>
    `);

    $.get("{{ url('/mantenimiento/reporte/incidentes/ajax/encuesta') }}/" + consecutivo, function(result){

        if(result.error){
            $('#contenidoEncuesta').html(
                '<div class="alert alert-warning text-center">No hay encuesta registrada.</div>'
            );
            return;
        }

        var promedio = (
            result.tiempo_respuesta +
            result.atencion_personal +
            result.calidad_tecnica +
            result.satisfaccion_general
        ) / 4;

        var porcentaje = (promedio / 5) * 100;

        var html = `
            <div class="text-center">
                <h4><strong>Índice General del Servicio</strong></h4>
                <div class="progress" style="height:25px;">
                    <div class="progress-bar progress-bar-success"
                         style="width:${porcentaje}%;">
                        ${promedio.toFixed(1)} / 5
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">
                    <div class="well">
                        <strong>¿Problema solucionado?</strong><br>
                        ${result.problema_solucionado == 1
                            ? '<span class="label label-success">Sí</span>'
                            : '<span class="label label-danger">No</span>'}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="well">
                        <strong>Tiempo de Respuesta</strong>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info"
                                 style="width:${(result.tiempo_respuesta/5)*100}%;">
                                 ${result.tiempo_respuesta} / 5
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="well">
                        <strong>Atención del Personal</strong>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning"
                                 style="width:${(result.atencion_personal/5)*100}%;">
                                 ${result.atencion_personal} / 5
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="well">
                        <strong>Calidad Técnica</strong>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary"
                                 style="width:${(result.calidad_tecnica/5)*100}%;">
                                 ${result.calidad_tecnica} / 5
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Comentario</strong></div>
                        <div class="panel-body">
                            ${result.comentario ? result.comentario : '<em>No hay comentarios.</em>'}
                        </div>
                    </div>
                </div>

            </div>
        `;

        $('#contenidoEncuesta').html(html);

    });

});
</script>

@endsection