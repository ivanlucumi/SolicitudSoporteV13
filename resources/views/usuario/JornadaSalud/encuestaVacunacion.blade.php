@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro de Esquema de Vacunacion empleados')
@section('cabecera', 'Esquema  de Vacunaci&oacute;n')

@section('content') 

	<div class="row justify-content-md-center">
	    
      <div class="row">
          <div class="col-xs-1">

          </div>
          <div class="col-xs-10">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-12">
                    <div class="card-body">
                       <p class="card-text"><h2><strong><center>ENCUESTA ESQUEMA VACUNACI&Oacute;N FUNCIONARIO Y EMPLEADOS</center></strong></h2> </p>
                      
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
  

<form action="{{ route('esquema.vacunacion.save') }}" method="POST">
    @csrf  
<div class="row ">
    <div class="col-xs-12 col-sm-4 form-group ">
    <label for="nRadicacion">Número de cedula:</label>
    
    <input class="form-control @error('cedula') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-sm-4  form-group " >

        <label for="nombre">Nombre Completo:</label>

        <input class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre Completo" autocomplete="off" id="identFamiliar" type="text" name="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="cargo">Cargo:</label>

        <input class="form-control @error('cargo') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Cargo" type="text" name="cargo" id="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
</div>

<div class="row ">
    
    
     <div class="col-xs-12 col-md-6 form-group ">

        <label for="dosis">Seleccione Dosis:</label>

        <div class="row">
             <div class="col-xs-6 col-sm-3">

                <label><input type="radio" id="cbox2" value="SIN_VACUNA" onClick="oculto()" name="dosis"  > SIN VACUNA</label>

                </div>

            <div class="col-xs-6 col-sm-3">

                <label><input type="radio" id="cbox2" value="PRIMERA" onClick="visible()" name="dosis"  > PRIMERA</label>

                </div>

                <div class="col-xs-6 col-sm-3">

                    <label><input type="radio" id="cbox2" value="SEGUNDA" onClick="visible()" name="dosis" > SEGUNDA</label>

                </div>
                <div class="col-xs-6 col-sm-3">

                    <label><input type="radio" id="cbox2" value="REFUERZO" onClick="visible()" name="dosis" > REFUERZO</label>

                </div>
        

        </div>

</div>
<div class="col-xs-12 col-sm-6 col-md-6 form-group " style= "display:block" id="vacuna">

        <label for="hora">Seleccione Vacuna Aplicada:</label><br>
		<select class="form-control @error('vacuna') is-invalid @enderror" name="vacuna" id="vacuna">
    <option value="">Seleccione Vacuna</option>
    @foreach($vacunas as $key => $value)
        <option value="{{ $key }}" @selected(old('vacuna') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('vacuna')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>

 <br> 
 </div>
 <div class="row">
    <div class="col-xs-12 col-sm-4"></div>
    
    <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">GUARDAR</button>
        
    </div>
    
    <div class="col-xs-12 col-sm-4"></div>                
</div>   
</form> 

 
 <hr>
 
<div class="row">
  <div class="col-xs-1">

  </div>
  <div class="col-xs-10">
    <div class="card mb-3" >
        <div class="row no-gutters">
          
          <div class="col-md-12">
            <div class="card-body">
              <p class="card-text"><h2><strong><center>ESQUEMA DE VACUNACI&Oacute;N FUNCIONARIOS DEL DESPACHO</center></strong></h2> </p>
              <br>
              
             </div>
          </div>
        </div>
      </div>
  </div> 
  <div class="col-xs-1">

  </div>       
</div>

<div class="row">
        <div class="box-body">
          <div class="row">
            <div class="table-responsive">
                <table id="table9" class="table table-bordered table-striped" >
                  <thead class="shadow" style="background-color: #004182; color: #fff;">
                    <tr>
                        <th>NOMBRE</th>
                        <th>CARGO</th>
                        <th>DOSIS</th>	
                        <th>VACUNA</th>
                        <th>ACCION</th>
                        
                                              
                    </tr>
                  </thead>


                  @if($esquema != null)
                      @foreach($esquema as $solicitud)
                              <tbody class="buscar">
                                      <tr class="table-light">
                                          <th scope="row"> {{$solicitud->nombre}} </th>
                                          <th scope="row"> {{$solicitud->cargo}}  </th>
                                          <th scope="row"> {{$solicitud->dosis}} </th>
                                          <th scope="row"> {{$solicitud->vacuna}} </th>
                                          <th scope="row"> <form action="{{ route('esquema.delete', $solicitud->id) }}" method="POST">
    @csrf
    @method('DELETE')
                                          <button class="btn btn-danger btn-xs fa fa-remove" title="Eliminar Solicitud" type="submit">Eliminar</button>
                                          </form> </th>
                                          
                                          
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

 <script>
     
function oculto(){
          //console.log(id)
        //div = document.getElementById(id);
            
       var det = document.getElementById('vacuna'); 
        det.style.display = 'none';
        
       /* var sindet = document.getElementById('estado_vac'); 
        sindet.style.display = 'block';*/
        
        } 
function visible(){
         var det = document.getElementById('vacuna'); 
        det.style.display = 'block';
        
        // Uncheck
document.getElementById("cboxvac").checked = false;
        
       /* var sindet = document.getElementById('estado_vac'); 
        sindet.style.display = 'none';*/
        } 
        
</script>


    
 

   
  @push('scripts')
  <script src="/js/jquery.js"></script>
    
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

        
</script>
  
   @endpush
   



@endsection