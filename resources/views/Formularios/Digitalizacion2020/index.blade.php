@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Proceso Digitalizaci&oacute;n')
@section('cabecera', 'Formulario Proceso Digitalizaci&oacute;n')



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
                      <p class="card-text"><h1><strong><center>DIGITALIZACI&Oacute;N DE EXPEDIENTES 2020-2022.</center></strong></h1> </p>
                      <p class="card-text" > <h3><center>Con el prop&oacute;sito de establecer la cantidad de expedientes a digitalizar por cada Despacho Judicial, les solicitamos el diligenciamiento del siguiente cuestionario</center></h3></p>
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
       @include('Formularios.Digitalizacion2020.form',['solicitudAudiencia'=> $solicitudAudiencia,
                'url'=> 'confirmar.digitalizacion', 'method'=>'POST'])     
    </div>
 

   
  @push('scripts')
  <script src="/js/jquery.js"></script>
  
   


 <script>
            
function sumar() {

  var total = 0;

  $(".monto1").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total += 0;

    } else {

      total += parseFloat($(this).val());

    }

  });

  //alert(total);
  document.getElementById('spTotal1').innerHTML = total;

}
    
function sumar2() {

  var total = 0;

  $(".monto2").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total += 0;

    } else {

      total += parseFloat($(this).val());

    }

  });

  //console.log(total);
  document.getElementById('spTotal2').innerHTML = total;

}





function sumar3() {

  var total = 0;

  $(".monto3").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total += 0;

    } else {

      total += parseFloat($(this).val());

    }

  });

  //alert(total);
  document.getElementById('spTotal3').innerHTML = total;
  total3 = document.getElementById('spTotal3');
  totalExp = document.getElementById('spTotal1');
  
 

}

function comprobartotal(){
    tatlaV=$('#sinsen').val();
    tatlaV1=$('#consen').val();
    totalProc=parseInt(tatlaV)+parseInt(tatlaV);
    
    segval =$('#porcesosdespacho').val();
    tercerval =$('#procesossecretaria').val();
    totalProc2=parseInt(segval)+parseInt(tercerval);
    
    if(totalProc != totalProc2 ){
       document.getElementById('compa10').innerHTML = '</span><span style="color: red" >Valores no Concuerdan</span>';  
       document.querySelector('input[name="autorizadigitalizacion"]:checked').checked = false;
       document.getElementById('spTotal2').style.color = 'red';
    }else{
        document.getElementById('spTotal2').style.color = 'green';
        document.getElementById('compa10').innerHTML = ' '; 
    }
    
    cuartoval =$('#procesosactivos').val();
    quintoval =$('#procesosinactivos').val();
    totalProc3=parseInt(cuartoval)+parseInt(quintoval);
    
    if(totalProc != totalProc3 ){
       document.getElementById('compa11').innerHTML = '</span><span style="color: red" >Valores no Concuerdan</span>';  
       document.querySelector('input[name="autorizadigitalizacion"]:checked').checked = false;
       document.getElementById('spTotal3').style.color = 'red';
    }else{
        document.getElementById('spTotal3').style.color = 'green';
        document.getElementById('compa11').innerHTML = ' ';
    }
    
    
}
</script>
  
   @endpush
   

@endsection