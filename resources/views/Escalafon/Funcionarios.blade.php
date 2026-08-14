@extends('layouts.usuarios')
@section('title', 'ESCALAFON DESPACHOS')
@section('cabecera', 'ESCALAFON DESPACHOS')

@section('content')

              
  <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
          <a class="collapsed btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Inscripcion
            </a>
          </h4>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a class="collapsed.in btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Actualizacion
            </a>
          </h4>
        </div>
      </div>
 
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a class="collapsed btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Exclusion
            </a>
          </h4>
        </div>
      </div>
 
  </div>




  <br>

  <div class="container-fluid">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
            <div class="container-fluid">
                <div class="row was-validated">  
                    <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>IDENTIFICACI&Oacute;N EMPLEADO:</label>
                                            <div class="form-group">
                                                <input type="number"  id="datos-cedula-empleado" min="1" class="form-control"  placeholder="Ingresa identificaci&oacute;n" >
                                            </div>
                                        </div>
                                 <div class="col-xs-12 col-sm-12 col-md-8 ">
                                    <label for="despacho">SELECCIONE CARGO:</label>
                                    <div class="form-group">
                                        <select class="form-control @error('cargo') is-invalid @enderror" autocomplete="off" id="Inscripcion" name="cargo">
    <option value="">Seleccionar Cargo</option>
    @foreach($cargos as $key => $value)
        <option value="{{ $key }}" @selected(old('cargo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xs-12"  id="datos-container" style="display:none">
                                    <p><center><strong>DATOS DE LA PROPIEDAD</strong></center> </p>
                                        <div class="col-xs-12 col-sm-12 col-md-6 ">
                                            <label>NOMBRE:</label>
                                            <div class="form-group">
                                                <input type="text"  id="datos-nombre" class="form-control"  placeholder="Ingresa identificaci&oacute;n"  readonly> 
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 ">
                                            <label>IDENTIFICACI&Oacute;N:</label>
                                            <div class="form-group">
                                                <input type="text"  id="datos-cedula" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly >
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>FECHA POSECION:</label>
                                            <div class="form-group">
                                                <input type="text"  id="datos-fecha" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>NOMBRAMIENTO:</label>
                                            <div class="form-group">
                                                <input type="text"  id="datos-nombramiento" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>LICENCIA:</label>
                                            <div class="form-group">
                                                <input type="text"  id="datos-licencia" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                            </div>
                                        </div>
                                </div>
                                <hr>
                                <div class="col-xs-12" id="datos-container-provi" style="display:none">
                                    <p><center><strong>DATOS DE LA PROVISIONALIDAD</strong></center> </p>
                                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>NOMBRE:</label>
                                            <div class="form-group">
                                                <input type="text"  id="provi-nombre" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>IDENTIFICACI&Oacute;N:</label>
                                            <div class="form-group">
                                                <input type="text"  id="provi-cedula" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                            <label>FECHA POSECION:</label>
                                            <div class="form-group">
                                                <input type="text"  id="provi-fecha" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                </div>
                
            </div>
            </div>
            </div>
        </div>
 
    
    <div class="panel panel-default">
        
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
        <div class="container-fluid">
            <div class="row was-validated">  
                <p><center><h3>EMPLEADOS EN PROPIEDAD</h3></center></p>
                 <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>CEDULA</th>
						      <th>NOMBRE</th>
						      <th>CARGO</th>
						      <th>NOMBRAMIENTO</th>
						      <th>FECHA POSESION</th>
						      <th>TIPO NOMBRAMIENTO</th>
						      <th>FECHA Y TIEMPO LICENCIA</th>
						      <th>OBSERVACIONES</th>
						      <th>ACCION</th>
						      
						     				      
					      </tr>
						</thead>


						@if($propiedad != null)
							@foreach($propiedad as $solicitud)
							
									<tbody class="buscar">
											<tr class="table-light">
												
												<th scope="row"> {{$solicitud->cedula_propiedad}} </th>
												<th scope="row"> {{$solicitud->nombres_propiedad}} {{$solicitud->apellido_propiedad}} </th>
												<th scope="row">  </th>
												<th scope="row"> {{$solicitud->tipo_nombramiento}}</th>
												<th scope="row"> {{$solicitud->fecha_posecion}}</th>
												<th scope="row"> {{$solicitud->tipo_nombramiento}}</th>
												<th scope="row"> {{$solicitud->fecha_licencia}} {{$solicitud->tiempo_licencia}}</th>
												<th scope="row"> {{$solicitud->observaciones}} </th>
											    <th scope="row"><a href="{{ route('escalafon.listado.show', $solicitud->id) }}" class="btn btn-warning btn-sm btn-block fa fa-eye" title="VER"></a> </th>
											</tr>								 	                
									</tbody>
							@endforeach	  
					    @else
							 
					    @endif					
							
							            
				     </table>
				  </div>
				</div>
			 </div>
		<!-- /.box-body -->	
		
    
            </div>
        </div>
        </div>
        </div>
    </div>
    
  
    <div class="panel panel-default">
        
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body">
        <div class="container-fluid">
            <div class="row was-validated">  
                <p><center><h3> {{strtoupper ('Ingresar los datos asignacion temporal parqueadero')}}</h3></center></p>
                <hr>
                
                <div class="form-group">
                    <form action="{{ route('parqueadero.temporal.agendamiento.store') }}" method="POST">
    @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                        <label>IDENTIFICACI&Oacute;N EMPLEADO:</label>
                                        <div class="form-group">
                                            <input type="number"  id="datos-cedula-empleado" min="1" class="form-control"  placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                             <div class="col-xs-12 col-sm-12 col-md-8 ">
                                <label for="despacho">SELECCIONE CARGO:</label>
                                <div class="form-group">
                                    <select class="form-control @error('cargo') is-invalid @enderror" autocomplete="off" id="Inscripcion" name="cargo">
    <option value="">Seleccionar Cargo</option>
    @foreach($cargos as $key => $value)
        <option value="{{ $key }}" @selected(old('cargo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                            </div>
                            <hr>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label for="despacho">SELECCIONE DESPACHO:</label>
                                <div class="form-group">
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Identificaci&oacute;n de la persona a cargo:</label>
                                <div class="form-group">
                                    
                                    <input type="number" name="identificacion" value="{{ old('identificacion')}}" class="form-control" id="nProceso5" placeholder="Ingresa identificaci&oacute;n" required min="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Nombre:</label>
                                <div class="form-group">
                                    <input type="text" name="nombreJ" value="{{ old('nombreJ')}}" id="nombreJ"  class="form-control" placeholder="Ingresa Nombres" required readonly>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Apellidos:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="apellidosJ" value="{{ old('apellidosJ')}}" id="apellidoJ"  class="form-control" placeholder="Ingresa los Apellidos" required readonly>
                                </div>
                            </div>
                            
                            
                                <div class="col-xs-12 col-sm-6 col-md-2 ">
                                    <div class="form-group">
                                        <label>Parqueadero:</label>
                                        <input type="text" name="no_parqueaderoJ" value="{{ old('no_parqueaderoJ')}}"   class="form-control" id="no_parqueaderoJ" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="No. parqueadero"autocomplete="off" readonly required/>
                                    </div>                        
                                </div>
                                
                                <div class="col-xs-12 col-sm-6 col-md-2 ">
                                <div class="form-group">
                                    <label>Placa:</label>
                                    <input type="text" name="placaJ" value="{{ old('placaJ')}}"   class="form-control" id="placaJ" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese Placa"autocomplete="off" readonly required/>
                                </div>                        
                                </div>
                            <div class="col-xs-12 col-sm-6 col-md-2 ">
                                <div class="form-group">
                                    <label>Tipo:</label>
                                    <input type="text" name="tipoJ" value="{{ old('tipoJ')}}"  class="form-control" id="tipoJ" placeholder="Tipo Carro, Moto, Cami&oacute;n ...." defaultUnchecked autocomplete="off" readonly required/>
                                </div>                        
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 ">
                                    <div class="form-group">
                                    <label>Caracteristicas:</label>
                                        <input type="text" name="marcaJ" value="{{ old('marcaJ')}}"  class="form-control" id="marcaJ" placeholder="Ingrese la marca, color y caracteristicas" autocomplete="off" readonly required/>
                                    </div>                        
                                </div>
                                
                            <div class="col-xs-12">
                                <p><center><h3> Datos Funcionario que va a ingresar</h3></center></p>
                            </div>
                            
                            
                    
                        
                           
                        
                        
                        </div>
                            
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Identificaci&oacute;n:</label>
                                <div class="form-group">
                                    
                                    <input type="number" name="identificacionF" value="{{ old('identificacionF')}}" class="form-control" id="nProceso6" placeholder="Ingresa identificaci&oacute;n" required min="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Nombre:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="nombreF" value="{{ old('nombreF')}}" id="nombreF"  class="form-control" style="text-transform:uppercase;" placeholder="Ingresa Nombres" required readonly>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Apellidos:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="apellidosF" value="{{ old('apellidosF')}}" id="apellidoF"  class="form-control" placeholder="Ingresa los Apellidos" required readonly>
                                </div>
                            </div>
                        
                         <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Fecha Ingreso:</label>
                                    <input type="date" name="fecha_ingresoF" value="{{ old('fecha_ingresoF')}}"  placeholder="Ingresa Fecha de Ingreso" class="form-control" required/>
                            </div>                        
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Ingreso Hasta:</label>
                                    <input type="date" name="fecha_finalizacionF" value="{{ old('fecha_finalizacionF')}}"  placeholder="Ingresa Fecha de Ingreso" class="form-control" required/>
                            </div>                        
                            </div>
                            
                    </div>
    
                     
                    <div class="row" >
                        <div class="col-xs-12 col-sm-6 col-md-2 ">
                        <div class="form-group">
                            <label>Placa:</label>
                            <input type="text" name="placaF" value="{{ old('placaF')}}"  class="form-control" id="placaF" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese Placa"autocomplete="off" required/>
                        </div>                        
                        </div>
                    <div class="col-xs-12 col-sm-6 col-md-2 ">
                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" name="tipoF" value="{{ old('tipoF')}}"  class="form-control" id="tipoF" placeholder="Tipo veh&iacute;culo ...." style="text-transform:uppercase;" defaultUnchecked autocomplete="off" required/>
                        </div>                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-8 ">
                            <div class="form-group">
                            <label>Caracteristicas:</label>
                                <input type="text" name="marcaF" value="{{ old('marcaF')}}"  class="form-control" id="marcaF" style="text-transform:uppercase;" placeholder="Ingrese la marca, color y caracteristicas" autocomplete="off" required/>
                            </div>                        
                        </div>
                    
                    </div>
    
                        <hr>
    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                        <button class="btn btn-success btn-block" type="submit">AGENDAR</button>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                        <a href="{{ route('usuario.ingreso') }}" class="btn btn-warning btn-block">CANCELAR</a>
                        </div>
                    </form>   
                    </div>
    
            </div>
        </div>
        </div>
        </div>
    </div>

       

	   <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>ESTADO NOMINA</th>
						      <th>CARGO</th>
						      <th>ACOGIGO</th>
						      <th>CEDULA</th>
						      <th>PROPIEDAD</th>
						      <th>TIPO NOMBRAMIENTO</th>
						      <th>LICENCIA</th>
						      <th>FECHA VINCULACION</th>
						      <th>PROVISIONALIDAD</th>
						      <th>FECHA POSECION</th>
						      <th>ACCION</th>
						      
						     				      
					      </tr>
						</thead>


						@if($escalafonDespacho != null)
							@foreach($escalafonDespacho as $solicitud)
							
									<tbody class="buscar">
											<tr class="table-light">
												
												<th scope="row"> {{$solicitud->estado_nomina}} </th>
												<th scope="row"> {{$solicitud->cargo}} </th>
												<th scope="row"> {{$solicitud->acogido}} </th>
												<th scope="row"> {{$solicitud->Carrera->cedula_propiedad}}</th>
												<th scope="row"> {{$solicitud->Carrera->nombres_propiedad}} {{$solicitud->Carrera->apellido_propiedad}}</th>
												<th scope="row"> {{$solicitud->Carrera->tipo_nombramiento}}</th>
												<th scope="row"> {{$solicitud->Carrera->tiempo_licencia}}</th>
												<th scope="row"> {{$solicitud->fecha_vinculacion}} </th>
												<th scope="row">@if(!empty($solicitud->Provisionalidad->cedula_provisionalidad)){{ $solicitud->Provisionalidad->cedula_provisionalidad}}@endif
												@if(!empty($solicitud->Provisionalidad->nombre_provisionalidad)){{ $solicitud->Provisionalidad->nombre_provisionalidad}}@endif 
												@if(!empty($solicitud->Provisionalidad->apellido_provisionalidad)){{ $solicitud->Provisionalidad->apellido_provisionalidad}}@endif</th>
												<th scope="row"> @if(!empty($solicitud->Provisionalidad->fecha_posecion_provisionalidad)){{ $solicitud->Provisionalidad->fecha_posecion_provisionalidad}}@endif </th>
											    <th scope="row"><a href="{{ route('escalafon.listado.show', $solicitud->id) }}" class="btn btn-warning btn-sm btn-block fa fa-eye" title="VER"></a> </th>
											</tr>								 	                
									</tbody>
							@endforeach	  
					    @else
							 
					    @endif					
							
							            
				     </table>
				  </div>
				</div>
			 </div>
		<!-- /.box-body -->	
		

@include('Escalafon.ModalInscribir')

<script>
var select = document.getElementById('Inscripcion');

select.addEventListener('change',
  function(){
      
    var cedEmpleado =document.getElementById("datos-cedula-empleado").value;
    console.log(cedEmpleado)
    var despacho = <?php echo  auth()->user()->cedula; ?>;
    var selectedOption = this.options[select.selectedIndex];
    console.log(despacho)
    console.log(selectedOption)
    //console.log(selectedOption.value + ': ' + selectedOption.text);
   $.get("/usuarios/escalafon/funcionarios/consulta?cargo=" + encodeURIComponent(selectedOption.value) + "&despacho="+encodeURIComponent(despacho)+ "&cedulaemp="+encodeURIComponent(cedEmpleado), function(response) {
            
            if (Object.keys(response).length > 0) {
                
                
                propie =response[0][0].carrera
                Provi= response[0][0].provisionalidad
               // console.log(propie)
                
                // Seleccionar el div con el ID "datos-container" -provi
                var divDatos = document.getElementById('datos-container');
                
                var divDatosProvi = document.getElementById('datos-container-provi');
                
                document.getElementById('datos-container').style.display = '';
                document.getElementById('datos-container-provi').style.display = '';
                
                document.getElementById('datos-nombre').value = propie.nombres_propiedad +" "+propie.apellido_propiedad;
                document.getElementById('datos-cedula').value = propie.cedula_propiedad ;
                document.getElementById('datos-fecha').value = propie.fecha_posecion;
                document.getElementById('datos-nombramiento').value = propie.tipo_nombramiento;
                document.getElementById('datos-licencia').value = propie.tiempo_licencia;
                
                
                document.getElementById('provi-nombre').value = Provi.nombre_provisionalidad +" "+Provi.apellido_provisionalidad;
                document.getElementById('provi-cedula').value = Provi.cedula_provisionalidad ;
                document.getElementById('provi-fecha').value = Provi.fecha_posecion_provisionalidad;
                //    
                
                console.log(response[1])
                if(response[1].mensaje==0){
                    
                    if(cedEmpleado){
                    $('#Inscribir_funcionario').modal('show'); 
                    }else{
                        alert('Debe ingresar cedula para verificar funcionario')
                       
                    }
                    
                }else{
                    
                    alert('EL EMPLEADO '+response[1].funcionario+ " TIENE TIPO DE NOMBRAMIENTO EN "+response[1].tipo_nombramiento+' NO SE PUEDE INSCRIBIR YA QUE ESTA OCUPANDO CARGO')
                }
                
                
            } else {
               
            }
        });
  });
  
</script>
@endsection



