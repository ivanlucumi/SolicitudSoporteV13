@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Empleados del Despacho')
@section('cabecera', 'Confirmar Empleados del Despacho')

@section('content') 


 
@include('alerts.success')

@if($empleados->isEmpty())

<div class="container-fluid">
    <div class="row">
        <center>
            <h2>
                No tiene asignado empleados.
            </h2>
        </center>
    </div>
    
</div>
@else
	
	<form action="{{ route('confirmar.empleados') }}" method="POST">
    @csrf
	<div class="row">
	    <div class="col-xs-12 col-sm-4">
	        <label for="nombre">Cedula del Nominador :</label>
            <input class="form-control @error('haceFormato') is-invalid @enderror" required="required" id="creaFormato" autocomplete="off" type="text" name="haceFormato" value="{{ old('haceFormato') }}">
@error('haceFormato')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
	    </div>
	    <div class="col-xs-12 col-sm-4">
	        <label>
	            Nombre :
	        </label><br>
	        
	        <input class="form-control @error('nombre') is-invalid @enderror" required="required" id="nombreC" readonly="readonly" type="text" name="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
	    </div>
	    <div class="col-xs-12 col-sm-4">
	        <label>
	            Apellidos:
	        </label><br>
	        
	        <input class="form-control @error('apellido') is-invalid @enderror" required="required" id="apellidoC" readonly="readonly" type="text" name="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
	    </div>
	</div>
	
		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						  	  <th>CEDULA</th>
						      <th>NOMBRE</th>
						      <th>APELLIDOS</th>	
						      <th>DESC ESTADO CARGO</th>
						      <th>ACTIVO</th>	
						      <th>LICENCIA</th>
						     				      
					      </tr>
						</thead>
                        
			             
			             <input type="hidden" name="despacho" id="despacho" value="{{  auth()->user()->cedula }}">
			             
						@if($empleados != null)
                          @foreach($empleados as $empleado)
                        
							 <tbody class="buscar">
									 <tr class="table-light">
										 <th scope="row"><input type="text" value="{{$empleado->cedula}}"  readonly disabled> 
										 <input type="hidden" name="cedEmpleado[]" id="cedEmpleado[]" value="{{ $empleado->cedula }}">
                                   
                                   </th>
									     <th scope="row">{{$empleado->nombre}}</th>
									     <th scope="row">{{$empleado->apellidos}}</th>
									     <input type="hidden" name="desCargo[]" id="desCargo[]" value="{{ $empleado->descripcion_cargo }}">
									     <th scope="row">{{$empleado->estado_cargo}}</th>
                                         <th scope="row"> <input type="radio" id="{{$empleado->cedula}}.activo" class="mostrar" name="{{$empleado->cedula}}{{$empleado->cargo_id}}[]" value="activo" required onClick="ocultar({{$empleado->cedula}}{{$empleado->cargo_id}}); ">
                                            <label for="male"></label><br> </th>
                                         <th scope="row"> <input type="radio" id="{{$empleado->cedula}}.licencia" name="{{$empleado->cedula}}{{$empleado->cargo_id}}[]" value="inactivo" required onClick="desocultar({{$empleado->cedula}}{{$empleado->cargo_id}});" >
                                            <label for="male"></label><br> </th>									     
															     
									 </tr>       
                             </tbody>
                                 
                            @endforeach	 
							 @else
							 
							 @endif
							            
				     </table>
				  </div>
				</div>
             </div>
<br>

 @if($empleados != null)
    
        @foreach($empleados as $empleado)
            <div class="card" style=" display: none; background-color: #004182;" id="{{$empleado->cedula}}{{$empleado->cargo_id}}">
              <div class="card-header" >
                <center> <h3> Llenar Campos Reemplazo: </h3></center>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong> <center> {{$empleado->nombre}} {{$empleado->apellidos}} REEMPLAZADO POR:</center> </strong></li>
                <div class="container-fluid" style=" background-color: #ceeadc;">
                    <div class="row">
                        
                            <div class="col-xs-6 " >
                                   <label for="cedula">Cedula de la persona que hace el reemplazo :</label>
        						   <input class="form-control @error('cedulaReemplazo[]') is-invalid @enderror" id="{{$empleado->cargo_id}}{{$empleado->cedula}}1" autocomplete="off" type="number" name="cedulaReemplazo[]" value="{{ old('cedulaReemplazo[]') }}">
@error('cedulaReemplazo[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                   
                               </div> 
                               <div class="col-xs-6" style="display: none" >
                                   <label for="nombre">Nombre :</label>
        						   <input class="form-control @error('nombreEmpleado[]') is-invalid @enderror" display="true" id="{{$empleado->cedula}}{{$empleado->cedula}}{{$empleado->cargo_id}}" type="text" name="nombreEmpleado[]" value="{{ old('nombreEmpleado[]') }}">
@error('nombreEmpleado[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                   
                               </div>
                          
                    </div>
                     <div class="row" style="display: none"> 
                         <div class="col-xs-6 " >
                               <label for="Apellidos">Apellidos :</label>
        					   <input class="form-control @error('apellidoEmpleado[]') is-invalid @enderror" display="true" id="{{$empleado->cedula}}{{$empleado->cedula}}" type="text" name="apellidoEmpleado[]" value="{{ old('apellidoEmpleado[]') }}">
@error('apellidoEmpleado[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                               
                           </div> 
                           <div class="col-xs-6 " >
                               <label for="Cargo">Cargo :</label>
        					   <input class="form-control @error('cargoReemplazo[]') is-invalid @enderror" display="true" type="text" name="cargoReemplazo[]" id="cargoReemplazo[]" value="{{ old('cargoReemplazo[]') }}">
@error('cargoReemplazo[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                               
                           </div>
                        
                    </div>
                    <br>
                </div>
              </ul>
            </div>
   
        @endforeach
    
    

<button class="btn btn-success btn-block" type="submit">Almacenar y Generar PDF</button>
</form>
			<!-- /.box-body -->	
<script src="/js/jquery.js"></script>


<script>
      function ocultar(id){
          //console.log(id)
            div = document.getElementById(id);
            
           if( $('#'.id).is(":visible") ){
                div.style.display = 'none';
                document.getElementById(id).value = "";
            }else{
                
                div.style.display = 'none';
                document.getElementById(id).value = "";
            }

        } 
        
     function desocultar(id){
          //console.log(id)
            div = document.getElementById(id);
            
            
           if( $('#'.id).is(":visible") ){
                div.style.display = 'block';
                
            }else{
                //alert('holades2')
                div.style.display = 'block';
               
            }
            
            

        } 
     //EMPLEADO
     
    var verifCedula = document.getElementById('creaFormato');
    verifCedula.addEventListener('input', function() {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombreC').value = response.nombre;
                document.getElementById('apellidoC').value = response.apellidos;
            } else {
                document.getElementById('nombreC').value = "";
                document.getElementById('apellidoC').value = "";
            }
        });

    });
     
    @endif


</script>



@endif

@endsection