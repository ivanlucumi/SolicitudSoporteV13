              
  <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
          <a class="collapsed btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Registro de Visitante
            </a>
          </h4>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a class="collapsed.in btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Registro Empleado
            </a>
          </h4>
        </div>
      </div>
 
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a class="collapsed btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Asignacion Temporal Parqueadero
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
                <p><center><h3> Ingrese los datos de el visitante</h3></center></p>
                
                <div class="form-group">
                    <form action="{{ route('visitante.agendamiento.store') }}" method="POST">
    @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Identificaci&oacute;n:</label>
                                <div class="form-group">
                                    
                                    <input type="number"  name="identificacion" value="{{ old('identificacion')}}" class="form-control" id="nProceso2" placeholder="Ingresa identificaci&oacute;n" required min="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Nombre:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="nombre" value="{{ old('nombre')}}" id="nombreVisitante"  class="form-control" placeholder="Ingresa Nombres" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Apellidos:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="apellidos" value="{{ old('apellidos')}}" id="apellidoVisitante"  class="form-control" placeholder="Ingresa los Apellidos" required>
                                </div>
                            </div>
                            
                    
                        
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Fecha Ingreso:</label>
                                    <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso')}}"  placeholder="Ingresa Fecha de Ingreso" class="form-control" required/>
                            </div>                        
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Hora de Ingreso:</label>
                                    <input type="time" name="hora_ingreso" value="{{ old('hora_ingreso')}}"  class="form-control" required/>
                            </div>                        
                            </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-6" id="divradicado" style="display:block;">
                            <div class="form-group">
                            <label>Radicado:</label>
                                <input type="number" class="form-control" name="radicado" value="{{ old('radicado')}}"   id='nProceso' placeholder="Ingresa los 23 d&iacute;gitos ..."  required/>
                                <div id="cantidad"></div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="uVisitante" value="VISITANTE" required>
    
                        </div>
                
                            <input type="hidden" name="nombre_despacho" value="{{$nombreDespacho}}" required/>
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
    <div class="panel panel-default">
        
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
        <div class="container-fluid">
                <div class="row was-validated">  
                <p><center><h3> Ingrese los datos de el Empleado</h3></center></p>
                
                <div class="form-group">
                    <form action="{{ route('empleado.agendamiento.store') }}" method="POST">
    @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Identificaci&oacute;n:</label>
                                <div class="form-group">
                                    
                                    <input type="number" name="identificacion" value="{{ old('identificacion')}}" class="form-control" id="nProceso3" placeholder="Ingresa identificaci&oacute;n" required min="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Nombre:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="nombre" value="{{ old('nombre')}}" id="nombreEmpleado"  class="form-control" placeholder="Ingresa Nombres" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <label>Apellidos:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="apellidos" value="{{ old('apellidos')}}" id="apellidoEmpleado"  class="form-control" placeholder="Ingresa los Apellidos" required>
                                </div>
                            </div>
                            
                    
                        
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Fecha Ingreso:</label>
                                    <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso')}}"  placeholder="Ingresa Fecha de Ingreso" class="form-control" id="fechaI" required/>
                            </div>                        
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Hasta:</label>
                                    <input type="date" name="fecha_hasta" value="{{ old('fecha_hasta')}}"  placeholder="Ingresa Fecha de Ingreso" class="form-control" id="fechaFinal" required/>
                            </div>   
                            <span>  </span>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <!-- Date -->
                            <div class="form-group">
                                    <label>Hora de Ingreso:</label>
                                    <input type="time" name="hora_ingreso" value="{{ old('hora_ingreso')}}"  class="form-control" required/>
                            </div>                        
                            </div>
    
                            
    
                        </div>
                            <input type="hidden" name="uEmpleado" value="empleado">
                            <input type="hidden" name="nombre_despacho" value="{{$nombreDespacho}}" required/>
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
   <script src="/js/ingreso/ingresoP.js"></script>  
    
 



@push('scripts')
<script src="/js/1configuracion.js"></script>  
<script src="/js/ingreso/ingreso.js"></script>  
    
@endpush
       