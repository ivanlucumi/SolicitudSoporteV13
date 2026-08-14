@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Jornada de Salud')
@section('cabecera', 'Formulario para Registro de Salud')

@section('content') 

	<div class="row justify-content-md-center">
	    
      <div class="row">
          <div class="col-xs-1">

          </div>
          <div class="col-xs-10">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-12">
                   <center> <img src="/img/jornadaSalud.PNG" class="card-img" width="610em" height="230em"></center>
                  </div>
                  <div class="col-md-12">
                    <div class="card-body"> <!--FORMULARIO PARA REGISTRO JORNADA VACUNACI&Oacute;N PARA LOS BIOL&Oacute;GICOS PFIZER, SINOVAC, JANSSEN, MODERNA Y ASTRAZENECA. -->
                      <p class="card-text"><h2><strong><center>FORMULARIO PARA REGISTRO JORNADA SALUD</center></strong></h2> </p> 
                      <p class="card-text"><h3><strong><center>LA JORNADA DE SALUD SE LLEVARÁ A CABO EL D&Iacute;A 25 DE ABRIL DE 20200</center></strong></h3> </p>
                      <p  align="justify"><h4><center>Por favor diligenciar los datos solicitados para registrar asistencia a Jornada de SAlud (s&oacute;lo para CALI). <br></center></h4>
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
       @include('usuario.JornadaSalud.form',['vacunacion'=> $vacunacion,
                'url'=> 'confirmar.usuario.salud.horario', 'method'=>'POST'])     
    </div>
  

    
 

   
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

//mostrar nombre  vacuna
function nomVacunaM() {
    var x = document.getElementById("dosisDos");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }
}
        
</script>
  
   @endpush
   



@endsection