@extends('layouts.notificaciones')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud de Notificaciones')
@section('cabecera', 'REQUERIMIENTOS')

@section('content')

@push('scripts')
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

@endpush
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<!--<label><input type="checkbox" onClick="toggle(this)" /> Seleccionar/Deseleccionar todos</label><br><br>

<form action="{{ route('notificaciones.excel') }}" method="POST">
    @csrf
<button class="btn btn-danger" style=" color: #fff;" type="submit">RESERVAR</button>-->

@if(!empty($notificaciones))
<div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
                            <th>REGISTRAR OFICIO</th>
						  	<th>RADICACION</th>
						  	<th>DELITO</th>
						    <th>AUDIENCIA</th>
						    <th>IDENTIFICACION</th>
                            <th>NOMBRES</th>
                            <th>TIPO PARTE</th>
                            <th>NOTIFICACION</th>
                            <th>DIRECCION</th>
                            <th>CIUDAD</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <th>OBSERVACIONES</th>

					      </tr>
						</thead>
						@foreach($notificaciones as $listad)
							 <tbody data-id="{!!$listad->id!!}" class="buscar " >
									 <tr class="table-light">
                                         <th>
                                            <input type="text" id="inputId{{$listad->id}}" name="oficio{{$listad->id}}" required>
                                            <a href="#" class="fa fa-save btn btn-warning btn-block  boton-almacenar-oficio" id="boton-almacenar-oficio{{$listad->id}}"></a>

                                         </th>
									     <th scope="row"> {{$listad->numero_radicado_proceso}} </th>
										 <th scope="row"> {{$listad->delito}} </th>
									     <th scope="row"> {{$listad->clase_audiencia}} <br>Fecha:{{$listad->fecha_audiencia}} <br>Hora: {{$listad->hora_inicio}} <br>Lugar:{{$listad->lugar}} </th>

									     <th scope="row"> {{$listad->tipo_identificacion }}: {{$listad->identificacion}} </th>
									     <th scope="row"> {{$listad->nombre_apellido}} </th>
									     <th scope="row"> {{$listad->tipo_parte}} </th>
									     <th scope="row"> {{$listad->tipo_notificacion}} </th>
									     <th scope="row"> {{$listad->direccion}} </th>
									     <th scope="row"> {{$listad->ciudad}} </th>
									     <th scope="row"> {{$listad->telefono_citado}} </th>
									     <th scope="row"> {{$listad->correo_citado}} </th>
									     <th scope="row"> {{$listad->observaciones}} </th>
                                        </th>

									 </tr>
								@endforeach
							 </tbody>
                            <!-- </form>-->

				     </table>
				  </div>
				</div>
			 </div>
@endif

<form id="form-almacenar-oficio" action="{{ route('notificaciones.guardar.oficio',':OFICIO_ID') }}" method="POST">
    @csrf
    @method('PUT')
  </form>

<script>
    function toggle(source) {
  checkboxes = document.getElementsByClassName('dinamico');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}
</script>

<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/notificacion.js"></script>


@push('scripts')
<script>
    //metodo para alacenar solicitud de audiencia virtual

    $('.boton-almacenar-oficio').click(function(e) {
       e.preventDefault();

       var row = $(this).parents('tbody')
       var id = row.data('id');
       var form = $('#form-almacenar-oficio');
       console.log(form)
       var url = form.attr('action').replace(':OFICIO_ID', id);
       //alert(url);
       var datos = form.serialize();

       var oficio = $('#inputId'+id).val();
        //alert(oficio)
       console.log(oficio)


       if(oficio === ""){
        alert("DEBE REGISTRAR OFICIO PARA GUARDAR");
        return false;

       }else{

            $.ajax({
                //ruta manual
               url:'/notificaciones/almacenar/oficio/'+ id,
                    type:'PUT',
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'oficio': oficio,
                    },
                    success:function(result) {
                        row.fadeOut();
                        //window.location.reload();
                    },
                /*url: url,
                type: 'put',
                data: {
                    '_token': $('input[name=_token]').val(),
                        'oficio': oficio,
                    },*/
                success: function(response) {
                    row.fadeOut();
                    oficio = "";
                    //window.location.reload();
                },
                error: function(msj) {
                    var mensajeError = "";
                    $.each(msj.responseJSON.errors, function(i, field) {
                        mensajeError += "<li>" + field + "</li>"
                    });
                    $("#msj-error").html("<ul>" + mensajeError + "</ul>").fadeIn();


                },

            });
      }

   });
</script>

@endpush


@endsection



