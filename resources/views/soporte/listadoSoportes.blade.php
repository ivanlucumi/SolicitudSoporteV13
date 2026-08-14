@extends('layouts.soporte')
@if( auth()->user()->rol == 1)
 @section('title', 'Listado de IPS admin')
@else
 @section('title', 'Listado de IPS tecnico')
@endif
<!--ponerle titulo a la paginga-->

@section('cabecera', 'Listado de Soportes Pendientes')

@section('content')
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
<div class="row">   
    <form action="{{ route('tecnico.siniestro.reenviar.correo') }}" method="POST">
    @csrf
               <input class="form-group @error('num_caso') is-invalid @enderror" placeholder="Ingresar Numero de Caso" autocomplete="off" type="text" name="num_caso" id="num_caso" value="{{ old('num_caso') }}">
@error('num_caso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Reenviar Correo</button>
    </form>
    
</div>

         <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>NUM CASO</th>
						      <th>FECHA HORA</th>
						  	  <th>MEDIO</th>
						      <th>SECCIONAL</th>
						      <th>DESPACHO</th>
						      <th>USUARIO</th>
						      <th>FALLA</th>
						      <th>ESTADO</th>
						      <th>TECNICO</th>
                              <th>ACCIONES</th>
						      @if( auth()->user()->email =="jbolivarr@disajcali.gov.co")
						      <th>ACCIONES</th>
						      @endif
					      </tr>
						</thead>

						@if(!empty($soportes))
						@foreach($soportes as $listad)
							 <tbody class="buscar">
									 <tr class="table-light">
									     <th scope="row"> {{$listad->num_caso}} </th>
									     <th scope="row"> {{$listad->fecha_solicitud}} {{$listad->hora_solicitud}}</th>
										 <th scope="row"> {{$listad->medio_solicitud}} </th>
									     <th scope="row"> {{$listad->seccional}} </th>
									     <th scope="row"> {{$listad->despacho}} </th>
									     <th scope="row"> {{$listad->nombre}} {{$listad->apellido}}</th>
									     <th scope="row"> {{$listad->falla_reportada}} </th>
									     <th scope="row"> {{$listad->estado_soporte}} </th>
									     <th scope="row"> {{$listad->nombre_tecnico}} </th>
                                         <th scope="row">
                                         <a href="{{ route('tramitar.soporte.servicio', $listad->id) }}" class="btn btn-primary btn-xs fa fa-pencil" target="_blank" title="Tramitar"></a>
                                         </th>
                                         <th>
                                            <form action="{{ route('asignar.tecnico.equipo',$listad->id) }}" method="POST">
    @csrf
    @method('PUT')          
                                             <select id="tecnico" class="form-control @error('tecnico') is-invalid @enderror" autocomplete="off" name="tecnico">
    <option value="">Seleccione Tecncio</option>
    @foreach($tecnicos as $key => $value)
        <option value="{{ $key }}" @selected(old('tecnico') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                            <button class="fa fa-save btn btn-warning btn-sm" type="submit">Asignar</button>                        
                                            </form>
                        
                                         </th>
									     @if( auth()->user()->email =="jbolivarr@disajcali.gov.co" )
									      <th scope="row"> <a href="{{ route('tecnico.soporte.editar.registro.ip', $listad->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Editar Registro"></a> </th>

									     @endif
									 </tr>
								@endforeach
							 </tbody>
						@else
						<p>NO HAY REGISTRO DE IP´s HASTA EL MOMENTO</p>
						@endif

				     </table>
				  </div>
				</div>
			 </div>

<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroIp.js"></script>

<script>
 $(function () {


                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });

                 //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })



            });
</script>

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Inventario Digitalizacion",    //Nombre del archivo
});

</script>

@endsection
