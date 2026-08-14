@extends('layouts.operario')
<!--ponerle titulo a la paginga-->
@section('title', 'Reporte de Incidentes')
@section('cabecera', 'Reporte de Incidentes')



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
                        <th>CATEGORIA</th>
                        <th>REPORTE</th>
                        <th>DESCRIPCION</th>	
                        <th>DESPACHO</th>	
                        <th>ESTADO</th>
                        <th>FECHA</th>
                        <th>ASIGNADO A</th>
                        <th>OBSERVACIONES</th>
                        <th>COMENTARIOS INTERNOS</th>
                        <th>RESPUESTA TECNICO</th>
                        <th>ACCION</th>
                        
                                              
                    </tr>
                  </thead>


                  @if($incidentes != null)
                      @foreach($incidentes as $solicitud)
                              <tbody data-id="{!!$solicitud->id!!}"  class="buscar">
                                      <tr class="table-light">
                                          <th scope="row"> {{$solicitud->categoria}} </th>
                                          <th scope="row"> {{$solicitud->item}}  </th>
                                          <th scope="row"> {{$solicitud->descripcion}} </th>
                                          <th scope="row"> {{$solicitud->nombre_despacho}}<hr> {{$solicitud->nombre_funcionario}}  </th>
                                          <th scope="row"> {{$solicitud->estado}} </th>
                                          <th scope="row"> {{$solicitud->created_at}} </th>
                                          <th scope="row"> {{$solicitud->asignado_a}} </th>
                                          <th scope="row"> {{$solicitud->observaciones}} </th>
                                          <th scope="row"> {{$solicitud->comentarios_internos}} </th>
                                          <th scope="row"> {{$solicitud->respuesta_tecnico}} </th>
                                          <th scope="row">
                                              
                                               <div class="btn-group-vertical btn-block" style="width: 100%;">
                                                <a href="#" class="btn btn-danger btn-sm fa fa-eye ver" id="ver" title="Ver" style="margin-bottom: 5px;"> </a>
                                                @if(1== 0)<!--a href="#" class="btn btn-danger btn-sm fa fa-eye btn-pedir-elementos" id="btn-pedir-elementos" title="btn-pedir-elementos" style="margin-bottom: 5px;">PEDIR </a-->
                                                <a href="{{ route('operario.pedir.elementos', $solicitud->id) }}" class="btn btn-primary btn-xs fa fa-pencil" style="margin-bottom: 5px;" title="Pedir Elementos"></a>@endif
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


<div id="pedir-elemento-section" style="display: none; margin-top: 20px;">
    <hr>
    <div class="form-group">
        <label for="item-select">SELECCIONE ELEMENTO:</label>
        <select id="item-select" class="form-control">
            <option value="">-- Seleccione --</option>
            <option value="OTRO">OTRO</option>
            @foreach($inventario as $item)
                <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" id="otro-input-container" style="display: none;">
        <input type="text" id="otro-input" class="form-control" placeholder="Ingrese Nombre Elemento">
    </div>

    <div class="form-group">
        <label for="cantidad">CANTIDAD:</label>
        <input type="number" id="cantidad" class="form-control" min="1" placeholder="Cantidad">
    </div>

    <div class="form-group">
        <label for="observaciones_elemento">OBSERVACIONES:</label>
        <textarea id="observaciones_elemento" class="form-control" placeholder="Observaciones sobre el elemento" rows="3"></textarea>
    </div>

    <button type="button" id="add-item" class="btn btn-primary btn-block mb-3">AGREGAR A LISTA</button>

    <h5>ELEMENTOS SOLICITADOS:</h5>
    <ul id="lista-elementos" class="list-group"></ul>
</div>


@include('mantenimiento.operario.modal.revision')
@include('mantenimiento.operario.modal.cerrar')
@include('mantenimiento.operario.modal.pedir')

<!--CONSULTA INGRESO -->
<form id="form-reporte-incidente-operario" action="{{ route('operario.reporte.incidente',':ID_ID') }}" method="POST">
    @csrf
</form>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/FilerOnce.js"></script>

<script>

$('.btn-pedir-elementos').click(function(e) {
  //alert('hola')
  e.preventDefault();           
  
    $('#modal_pedir_reporte_operario').modal('show');
  
 });

$('.ver').click(function(e) {
  //alert('hola')
  e.preventDefault();           
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //alert(id);
  var form  = $('#form-reporte-incidente-operario');
  var url   = form.attr('action').replace(':ID_ID', id);
  var data  = form.serialize();
  //alert(url);
  $.get(url,data, function(result){
      console.log(result)
        $('#id_dato').val(result.id);
        $('#idCategoria').val(result.categoria);       
        $('#IdItem').val(result.item); 
        $('#idDescripcion').val(result.descripcion);
        $('#IdFecha').val(result.created_at); 
        $('#idIReporte').val(result.marca); 
        $('#IdEstado').val(result.estado);
        $('#Idobservaciones').val(result.observaciones);
        //Idcomentarios_internos
        $('#Idcomentarios_internos').val(result.comentarios_internos);
        $('#modal_Revisar_reporte_operario').modal('show');
  });
 });

 
 $('.cerrar').click(function(e) {
  //alert('hola')
  e.preventDefault();           
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //alert(id);
  var form  = $('#form-reporte-incidente-operario');
  var url   = form.attr('action').replace(':ID_ID', id);
  var data  = form.serialize();
  //alert(url);
  $.get(url,data, function(result){
      console.log(result)
        $('#idc').val(result.id);
        $('#idCategoriac').val(result.categoria);       
        $('#IdItemc').val(result.item); 
        $('#idDescripcionc').val(result.descripcion);
        $('#IdFechac').val(result.created_at); 
        $('#idIReportec').val(result.marca); 
        $('#IdEstadoc').val(result.estado);
        $('#Idobservacionec').val(result.observaciones);        
        $('#Idrepuesta').val(result.respuesta_tecnico);
        $('#modal_cerrar_reporte_operario').modal('show');
  });
 });
               
</script>




@endsection