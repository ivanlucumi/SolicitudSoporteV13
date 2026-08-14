@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud Audiencia')
@section('cabecera', 'Registra La Solicitud de Audiencia')



@section('content') 

 
	<div class="row justify-content-md-center">
	    
      <div class="row">
          <div class="col-xs-1">

          </div>
          <div class="col-xs-10">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-4">
                   <center> <a href="http://sistemaaudiencias.ramajudicial.gov.co" rel="noopener" target="_blank" ><img src="/img/alerta.gif" class="card-img" width="300em" height="290em"></a></center>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <p class="card-text"><h2><strong><center>SOLICITUD AUDIENCIA VIRTUAL DEL VALLE DEL CAUCA.</center></strong></h2> </p>
                      <p  align="justify">
                          <h2>Se informa que, a partir del 1 de diciembre de 2022 las solicitudes de audiencias deben de registrarse directamente en la plataforma de <a href="http://sistemaaudiencias.ramajudicial.gov.co" rel="noopener" target="_blank" >SISTEMA DE AUDIENCIAS</a>.
                      Las solicitudes de audiencia que se hayan realizado serán atendidos, por lo cual, no será necesario registrarlos o agendarlos nuevamente

                    </h2>
                          <h4><!--Por favor registrar los datos solicitados para agendar su solicitud de audiencia virtual, este registro esta sujeto a la disponibilidad de los equipos para la conexi&oacute;n, la cual ser&aacute; confirmada mediante correo electr&oacutenico.-->
                      </h4></p>
                      <br>
                      @if($disponible != null)
                      <p>
                        <h4> <spam style="color:red">La persona disponible esta semana despues de la 6 pm es:</spam>  <br>
                         Nombre: <strong> {!!$disponible->nombre !!}</strong><br>
                         Email: <strong>{!!$disponible->email !!}</strong> <br>
                         Telefono: <strong>{!!$disponible->telefono !!}</strong>
                         </h4>
                          
                      </p>
                      @endif
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
       @include('audiencias.form.form_audiencia',['solicitudAudiencia'=> $solicitudAudiencia,
                'url'=> 'virtual.audiencia', 'method'=>'POST'])  
        

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