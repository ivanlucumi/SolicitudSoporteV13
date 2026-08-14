@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Formulario Levantamiento')


@section('cabecera', 'FORMULARIO LEVANTAMIENTO SGDE')

@section('content') 

<style>
    /* Estilos para el contenedor */
    .contenedor {
        
        background-color: #ffffff; /* Color de fondo */
        border-radius: 10px; /* Radio de borde para un aspecto redondeado */
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5); /* Definici¨®n de la sombra */
    }
</style>

<div class="container-fluid">
    <div class="card ">
      <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-2"></div>
                <div class="col-md-8 contenedor">
             
                
                   @if(empty($registro))
                    <div class="card-header" style="background-color: #004182;color:white"> <p><center><h3><br>Plan Implementaci&oacute;n Sistema de Gesti&oacute;n Documental Electr&oacute;nica  SGDE.</h3></center> <br>
                    <p class="mb-3"><center>A continuaci&oacute;n encontrar&aacute; preguntas cuyas respuestas permitir&aacute;n identificar los escenarios operativos por cada grupo de inter&eacute;s en el plan de implementaci&oacute;n hacia el Sistema de Gesti&oacute;n Documental Electr&oacute;nica - SGDE definitivo. </center></p>
                     <br>  </div>
            
                   <hr>
                   
                    <form enctype="multipart/form-data" class="was-validated" action="{{ route('usuario.levantamineto.store') }}" method="POST">
    @csrf 
                  @else
                    <div class="card-header" style="background-color: #004182;color:white"><center><h3>RESPUESTAS DADAS POR EL DESPACHO SON:</h3> </center></div>
                    <hr>
                  @endif
        
        <div class="row">
            
            <div class="col-xs-12 col-sm-1"></div>
            <div class="col-xs-12 col-sm-10">
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> N&Uacute;MERO DE PROCESOS ACTIVOS SIN SENTENCIA:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                       <input class="form-control contenedor  @error('procesos_act_sin_sentencia') is-invalid @enderror" id="nProceso" min="0" placeholder="Ingrese Procesos Activos" autocomplete="off" type="number" name="procesos_act_sin_sentencia" value="{{ old('procesos_act_sin_sentencia', $Consulta->procesos_act_sin_sentencia) }}">
@error('procesos_act_sin_sentencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> N&Uacute;MERO DE PROCESOS CON TR&Aacute;MITE POSTERIOR:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control contenedor @error('procesos_act_con_tramite_post') is-invalid @enderror" min="0" placeholder="Ingrese Procesos con tramite Posterior " autocomplete="off" type="number" name="procesos_act_con_tramite_post" id="procesos_act_con_tramite_post" value="{{ old('procesos_act_con_tramite_post', $Consulta->procesos_act_con_tramite_post) }}">
@error('procesos_act_con_tramite_post')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> N&Uacute;MERO DE PROCESOS CON CUMPLIMIENTO DE PENA:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control contenedor @error('cantidas_exp_cumplimiento_pena') is-invalid @enderror" min="0" placeholder="Ingrese Procesos con Cumplimiento de Pena" autocomplete="off" type="number" name="cantidas_exp_cumplimiento_pena" id="cantidas_exp_cumplimiento_pena" value="{{ old('cantidas_exp_cumplimiento_pena', $Consulta->cantidas_exp_cumplimiento_pena) }}">
@error('cantidas_exp_cumplimiento_pena')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                
                
                
                <div class="row">
                   <H3><center><strong> PLATAFORMA DONDE EST&Aacute;N ALMACENADOS LOS EXPEDIENTES RELACIONADOS ANTERIORMENTE </strong></center></H3> 
                </div>
                <hr>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CANTIDAD DE EXPEDIENTES ALMACENADOS EN ONEDRIVE CON PROTOCOLO VERSION 1:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	         <input class="form-control contenedor @error('cantidad_onedrive_ver_uno') is-invalid @enderror" min="0" placeholder="Protocolo Version 1" autocomplete="off" type="number" name="cantidad_onedrive_ver_uno" id="cantidad_onedrive_ver_uno" value="{{ old('cantidad_onedrive_ver_uno', $Consulta->cantidad_onedrive_ver_uno) }}">
@error('cantidad_onedrive_ver_uno')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   <br>	
                   </div> 
                </div><br>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CANTIDAD DE EXPEDIENTES ALMACENADOS EN ONEDRIVE CON PROTOCOLO VERSION 2:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	         <input class="form-control contenedor  @error('cantidad_onedrive_ver_dos') is-invalid @enderror" min="0" placeholder="Protocolo Version 2" autocomplete="off" type="number" name="cantidad_onedrive_ver_dos" id="cantidad_onedrive_ver_dos" value="{{ old('cantidad_onedrive_ver_dos', $Consulta->cantidad_onedrive_ver_dos) }}">
@error('cantidad_onedrive_ver_dos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        	         <br>	
                   </div> 
                </div><br>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CANTIDAD DE EXPEDIENTES ALMACENADOS EN BESTDOC:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	         <input class="form-control contenedor  @error('cantidad_bestdoc') is-invalid @enderror" min="0" placeholder="Cantidad en BestDoc" autocomplete="off" type="number" name="cantidad_bestdoc" id="cantidad_bestdoc" value="{{ old('cantidad_bestdoc', $Consulta->cantidad_bestdoc) }}">
@error('cantidad_bestdoc')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        	         <br>	
                   </div> 
                </div><br>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CANTIDAD DE EXPEDIENTES ALMACENADOS EN SAMAI:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	         <input class="form-control contenedor @error('cantidad_samai') is-invalid @enderror" min="0" placeholder="Cantidad en Samai" autocomplete="off" type="number" name="cantidad_samai" id="cantidad_samai" value="{{ old('cantidad_samai', $Consulta->cantidad_samai) }}">
@error('cantidad_samai')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        	         <br>	
                   </div> 
                </div><br>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CANTIDAD DE EXPEDIENTES EN JUSTICIA XXI WEB:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	         <input class="form-control contenedor @error('cantidad_just_xxi_web') is-invalid @enderror" min="0" placeholder="Cantidad Justucia xxi web" autocomplete="off" type="number" name="cantidad_just_xxi_web" id="cantidad_just_xxi_web" value="{{ old('cantidad_just_xxi_web', $Consulta->cantidad_just_xxi_web) }}">
@error('cantidad_just_xxi_web')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        	         <br>	
                   </div> 
                </div><br>
                
                 <hr>
                 @if(empty($registro))
                 <div align="center" class="col-xs-12">
                            <button id="btsubmit" class="btn btn-success btn-block" style="text-align: center; background-color: #004182; color: #fff;" onclick="miFunc()" type="submit">REGISTRAR INFORMACION</button>
                            </form>
                            <div id="console" style="display:none">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                                  <span class="sr-only">ESPERANDO RESPUESTA......</span>
                                  
                                </div>
                            </div>
                            
                            <br>
                        </div>    
                @else
                    <div align="center" class="col-xs-12">
                            <button class="btn btn-danger btn-block" style="text-align: center; color: #fff;" disabled>ESTA ENCUENTA YA HA SIDO RESPONDIDA</button>
                            <div id="console" style="display:none">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                                  <span class="sr-only">ESPERANDO RESPUESTA......</span>
                                  
                                </div>
                            </div>
                            
                            <br>
                        </div>   
                @endif
    
  
        
    </div>
    <div class="col-xs-12 col-sm-1"></div>
    
</div>

                    
                
        </div>
            <div class="col-md-2"></div>
    </div>
      </div>
    </div>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Seguimiento.js"></script>  

@endsection