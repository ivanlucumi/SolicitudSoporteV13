@extends('layouts.monitoreo.coordinador')
<!--ponerle titulo a la paginga-->
@section('title', 'Agendamiento de Ingresos')
@section('cabecera', 'Agenda la cita para permitir ingreso')

@section('content') 
<div class="card-body">
      <div class="container-fluid">
        <P><center><h2>SELECCIONA EL TIPO DE USUARIO QUE INGRESA PARA DILIGENCIAR SOLICITUD</h2> </center></P><hr>
       </div>  
</div>
              
  <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
          <a class="collapsed btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Registro de Visitante
            </a>
          </h4>
        </div>
      </div>

     

      <div class="col-xs-12 col-sm-4">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a class="collapsed btn btn-warning"  data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Registro Proveedor
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
                                <input type="number" class="form-control" name="radicado" value="{{ old('radicado')}}"   id='nProceso' placeholder="Ingresa los 23 d¨ªgitos ..."  required/>
                                <div id="cantidad"></div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="uVisitante" value="vistante" required>
    
                        </div>
                
                            <input type="hidden" name="nombre_despacho" value="{{$nombreDespacho}}" required/>
                    </div>
    
                    
    
    
                        <hr>
    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                        <button class="btn btn-success btn-block" type="submit">AGENDAR</button>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                        <a href="{{ route('cooringreso.vehiculos_oficiales.index') }}" class="btn btn-warning btn-block">CANCELAR</a>
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
                <p><center><h3> Ingrese los datos de el Proveedor</h3></center></p>
                
                <div class="form-group">
                    <form action="{{ route('proveedor.agendamiento.store') }}" method="POST">
    @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Identificaci&oacute;n:</label>
                                <div class="form-group">
                                    
                                    <input type="number" name="identificacion" value="{{ old('identificacion')}}" class="form-control" id="nProceso4" placeholder="Ingresa identificaci&oacute;n" required min="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Nombre:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="nombre" value="{{ old('nombre')}}" id="nombreProveedor"  class="form-control" placeholder="Ingresa Nombres" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 ">
                                <label>Apellidos:</label>
                                <div class="form-group">
                                    
                                    <input type="text" name="apellidos" value="{{ old('apellidos')}}" id="apellidoProveedor"  class="form-control" placeholder="Ingresa los Apellidos" required>
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
                        
                        
                        </div>
                            <input type="hidden" name="uProveedor" value="proveedor">
                            <input type="hidden" name="nombre_despacho" value="{{$nombreDespacho}}" required/>
                    </div>
    
                        <div class="row" id="idcheckvehiculo" >
                        <div class="col-xs-12 col-sm-6 form-check">                          
                                <label class="form-check-label" for="exampleCheck1">Ingreso con vehiculo</label>
                                <input type="checkbox" name="vehiculoProveedor" value="convehiculo"  class="form-check-input" id="check_vehiculo_proveedor">
                            </div>
                        
                        </div>
    
                    <div class="row" id="divvehiculoProveedor" style="display:none;">
                        <div class="col-xs-12 col-sm-6 col-md-2 ">
                        <div class="form-group">
                            <label>Placa:</label>
                            <input type="text" name="placa" value=""  class="form-control" id="placaP" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese Placa"autocomplete="off"/>
                        </div>                        
                        </div>
                    <div class="col-xs-12 col-sm-6 col-md-2 ">
                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" name="tipo" value="{{ old('tipo')}}"  class="form-control" id="tipoP" placeholder="Tipo Carro, Moto, CamiÃ³n ...." defaultUnchecked autocomplete="off"/>
                        </div>                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-4 ">
                            <div class="form-group">
                            <label>Marca:</label>
                                <input type="text" name="marca" value="{{ old('marca')}}"  class="form-control" id="marcaP" placeholder="Ingreso la Marca" autocomplete="off"/>
                            </div>                        
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 ">
                            <div class="form-group">
                            <label>Color:</label>
                                <input type="text" name="color" class="form-control" id="colorP" placeholder="Ingreso el Color" autocomplete="off" />
                            </div>                        
                        </div>
                        @if( auth()->user()->rol == 10)
                        <div class="col-xs-12 ">
	                	<label for="hora">Parqueadero Disponible:</label><br>
	                	<select class="form-control @error('parqueadero') is-invalid @enderror" name="parqueadero" id="parqueadero">
    <option value="">Seleccione Parqueadero</option>
    @foreach($parqueadero as $key => $value)
        <option value="{{ $key }}" @selected(old('parqueadero') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('parqueadero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	                  
                        </div>
                        @endif
                    
                    </div>
    
                        <hr>
    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                        <button class="btn btn-success btn-block" type="submit">AGENDAR</button>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                        <a href="{{ route('cooringreso.vehiculos_oficiales.index') }}" class="btn btn-warning btn-block">CANCELAR</a>
                        </div>
                    </form>   
                    </div>
    
            </div>
        </div>
        </div>
        </div>
    </div>




@push('scripts')
<script src="/js/1configuracion.js"></script>  
<script src="/js/ingreso/ingreso.js"></script>  
<script src="/js/ingreso/ingresoP.js"></script>  
  
    
@endpush
       

@endsection