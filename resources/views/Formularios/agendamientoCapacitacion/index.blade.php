@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Capacitacion Mercurio')
@section('cabecera', 'Agendamiento Capacitacion Mercurio')



@section('content') 

 
	<div class="row justify-content-md-center">
	    
      <div class="row">
          <div class="col-xs-1">

          </div>
          <div class="col-xs-10">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-4">
                   <center> <img src="/img/LOGO FORMULARIO.jfif" class="card-img" width="210em" height="190em"></center>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <p class="card-text"><h2><strong><center>AGENDAMIENTO CAPACITACION PLATAFORMA MERCURIO.</center></strong></h2> </p>
                      <p  align="justify"><h4>Por favor registrar los datos solicitados para agendar su solicitud de capacitacion,
                      esta inscripci&oacute;n tiene un aforo de 18 personas para asistencia presencial, la inscripci&oacute;n para capacitacion virtual no tiene l&iacute;mite </h4></p>
                      <br>
                     </div>
                  </div>
                </div>
              </div>
          </div> 
          <div class="col-xs-1">

          </div>       
      </div>
	</div>
    <hr>

    <div class="container-fluid">
        <form action="{{ route('usuario.save.encuesta') }}" method="POST">
    @csrf
       @include('Formularios.agendamientoCapacitacion.form')    
        
       <button class="btn btn-danger" type="submit">Reservar Capacitaci&oacute;n</button>
       </form>
    </div>
    
    <hr>

    <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>CEDULA</th>
		        <th>NOMBRE</th>
				<th>APELLIDO</th>
		        <th>ESQUEMA</th>
		        <th>VACUNA</th>
		        <th>ESTADO</th>
				<th>ACCIONES</th>
				
		    </tr>
	    </thead>
	    
		    @foreach($agendado as $agendad)
		    
			<tbody data-id="{!!$uVacunado->id!!}" class="buscar">
				<tr class="table-light" >
				    <th scope="row">{{$agendad->cedula}}</th>	
				    <th scope="row">{{strlen($agendad->nombre)}}</th>	
					
					<th scope="row">{{strlen($agendad->apellido)}}</th>									
					<th scope="row">{{$uVacunado->despacho}}</th>									
					<th scope="row">{{$uVacunado->cargo}}</th>
					<th scope="row">{{$uVacunado->tipo_asistencia}}</th>
					<th scope="row">
					    <a href="{{ route('usuario.vacunacion.editar', [$agendad->id]) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Revisar"></a>
					</th>
					
				</tr>	                
			</tbody>
			@endforeach
	</table>
</div>
 

   
  @push('scripts')
  <script src="/js/jquery.js"></script>
    <script src="/js/1configuracion.js"></script>  
   <script src="/js/detenido.js"></script> 
   <script src="/js/horaMilitar/combodate.js"></script> 
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>        

<!--        https://cdnjs.com/libraries/bootstrap-datetimepicker-->
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


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
                
              
                
            });    
function condetenido(){
          //console.log(id)
        //div = document.getElementById(id);
            
       var det = document.getElementById('sinDetenido'); 
        det.style.display = 'none';
        
        var sindet = document.getElementById('Detenido'); 
        sindet.style.display = 'block';
        } 
function sindetenido(){
         var det = document.getElementById('sinDetenido'); 
        det.style.display = 'block';
        
        var sindet = document.getElementById('Detenido'); 
        sindet.style.display = 'none';
        } 
        
</script>
  
   @endpush
   

@endsection