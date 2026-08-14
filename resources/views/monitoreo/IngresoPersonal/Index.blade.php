@extends('layouts.monitoreo.parqueadero')
<!--ponerle titulo a la paginga-->
@section('title', 'Control Ingreso Parqueadero')
@section('cabecera', 'Control Ingreso Parqueadero')

@section('content') 
    <!--CONTAR USUARIOS -->
    <style> 
        #value {
    width:150px;
    float:right;
    text-align:right;
    padding:10px;
    background-color:#dadada;
    font-size:36px;
}
body {
  //padding: 50px;
}

.opcion-radio {
  display: inline-block;
  margin-right: 18px;
}

.opcion-radio input {
  margin-right: 5px;
}


.opcion-radio input[type=radio] {
    position: absolute;
    opacity: 0;
}
.opcion-radio input[type=radio] + label:before {
    content: '';
    background: #F4F5F8;
    border-radius: 100%;
    border: 1px solid #a6aec6;
    display: inline-block;
    width: 1.4em;
    height: 1.4em;
    position: relative;
    top: -.2em;
    margin-right: .5em;
    vertical-align: top;
    cursor: pointer;
    text-align: center;
    -webkit-transition: all 250ms ease;
    transition: all 250ms ease;
    display: inline-block;
    vertical-align: middle;
}
.opcion-radio input[type=radio]:checked + label:before {
    background-color: red;
    box-shadow: inset 0 0 0 4px #F4F5F8;
}
.opcion-radio label {
    display: inline-block;
    vertical-align: middle;
    line-height: 32px;
}
input:focus {
  color: red;
}
    </style>
    
    <div>
        <center>
            <p>
                <h1>
                    <strong>
                        {!! auth()->user()->name!!}
                    </strong>
                </h1>
            </p>
        </center>
    </div>
 


<div class="row">
    <div class="col-xs-12 col-sm-3">
        <div class="container">
        <div class="" style="text-align: left;">
            <nav class="navbar navbar-light bg-light">
                <!--CONSULTA Y REGISTRAR INGRESO-->
                <form id="form-consulta-ingreso" action="{{ route('consulta.registro.ingreso.personal',':CEDULA_ID') }}" method="POST">
    @csrf

                <div class="opciones-radio">
                  <div class="form-group">
                    <span class="opcion-radio">
                      <input type="radio" id="INGRESO" name="registro" value="INGRESO" required>
                      <label for="INGRESO" style="color:red;font-size: 250%">INGRESO</label>
                    </span>
                    
                    <span class="opcion-radio">
                      <input type="radio" id="SALIDA" name="registro" value="SALIDA" required>
                      <label for="SALIDA" style="color:red; font-size: 250%">SALIDA</label>
                    </span>
                  </div>
                </div>
               <input class="form-group mr-sm-2 shadow input-lg BcedulaIngreso" name="cedula" type="number" min=1 placeholder="Buscar por Cedula" aria-label="Search" id="cedulaIngreso" required autofocus>
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 0px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 0px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 0px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 0px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 0px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 0px">
                <a href="#" class="btn btn-success btn-lg 
                                    fa fa-plus-square" id="BcedulaIngreso" title="Consultar C&eacute;dula"> Buscar</a>
              </form>
            </nav>
          </div>
          
        </div>
    </div>
 
</div>
<hr>


<div class="row">
    <div class="col-xs-12 col-sm-3">
				<br>
				<form action="{{ route('parqueadero.descarga.ingreso') }}" method="POST">
    @csrf
				
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Registro Ingreso Diario">Registro Ingreso Diario</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Descargar Registro</button>
						</form>
					</div>
				</div>
			</div>
</div>


<div class="table-responsive">
<table id="table9" class="table  table-hover table-condensed table-bordered ">

</div>	
    <thead style="background-color: #004182; color: #fff;">
        <tr>
            <th>IDENTIFICACI&Oacute;N</th>
            <th>NOMBRE</th>
            <th>CARGO</th>
            <th>EMPRESA</th>
            <th>FECHA DE INGRESO</th>
            <th>H. QUE INGRESA</th>
            <th>SALIDA</th>
            <th>ESTADO INGRESO</th>
            
        </tr>
    </thead>
@if($ingresos != null)
        
        <tbody class="buscar" id="fila1" >
            @foreach($ingresos as $ingreso)
            <tr class="table-light" data-id="{!!$ingreso->id!!}" style = "@if($ingreso->ingreso != null && $ingreso->salida != null )
            background-color: #F5A9A9;@endif
            @if($ingreso->ingreso != null && $ingreso->salida == null )
            background-color:#BFFCC0 ;@endif">
                <th scope="row">{{$ingreso->Empleado->cedula}}</th>	
                <th scope="row">{{$ingreso->Empleado->nombre}}</th>	
                <th scope="row">{{$ingreso->Empleado->cargo}}</th>	
                <th scope="row">{{$ingreso->Empleado->empresa}}</th>	
                <th scope="row">{{$ingreso->fecha_ingreso}}</th>	
                <th scope="row">{{$ingreso->registro}} {{$ingreso->hora_evento}}</th>	
                
                
            </tr>
            <tr id="fila1"></tr>
            @endforeach
        </tbody>
        
        
    @else
    <tr class="table-light">
        <p class="lead">Actualmente esta seccion no cuenta con informacion disponible, lo invitamos a seguir navegando en las demas pestaÃ±as.</p3>
    </tr>
@endif
</table>
</div>




<!--CONSULTA Y REGISTRAR INGRESO-->
<form id="form-consulta-ingreso" action="{{ route('consulta.registro.ingreso.personal',':CEDULA_ID') }}" method="POST">
    @csrf
</form>




<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>


@push('scripts')


<script>
         //VERIFICAR PLACA DE VEHICULO PROVEEDOR
                
                $('#BcedulaIngreso').click(function(e) {
                    e.preventDefault();
                    
                      //let seleccion = document.querySelectorAll('input[name=registro]');
                      document.getElementById("cedulaIngreso").focus();
                      
                      
                      var value = $("input[type=radio][name=registro]:checked").val();
                      var cedula =document.getElementById("cedulaIngreso").value;
                      
                        // Verificar si los campos est«¡n vac«¿os
                        if (!value || !cedula) {
                            toastr.error('<strong><h3>COMPLETA LOS CAMPOS VACIOS </h3> </strong>');
                             document.getElementById("cedulaIngreso").value = "";
                            return; // Salir de la funci«Ñn si alg«ân campo est«¡ vac«¿o
                        }
                    
                    //alert(value)
                    var cedulaIng = $('#cedulaIngreso').val();
                    console.log(cedulaIng);
                     //console.log('1');
                    var form = $('#form-consulta-ingreso');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
                    var data = form.serialize();
        
       // alert(url)
                    $.get(url, data)
                                .done(function(result) {
                        console.log($.isEmptyObject(result));
                        
                        if($.isEmptyObject(result)){
                            
                              toastr.error('<strong> <h2> La persona y/o funcionario identificada con:'+cedulaIng +'<br />  </h2><h1>NO TIENE ACCESO </h1> </strong>'); 
                              
                        }else{
                            
                            if(result.registro === "INGRESO"){
                               toastr.success('<strong> <h2> La persona y/o funcionario '+result.nombre+' identificada con: '+cedulaIng +'<br />  </h2><h1> DE LA EMPRESA '+result.empresa+' SE REGISTRO EL INGRESO </h1> </strong>'); 
                             
                            }else{
                               toastr.warning('<strong> <h2> La persona y/o funcionario '+result.nombre+' identificada con: '+cedulaIng +'<br />  </h2><h1> DE LA EMPRESA '+result.empresa+' SE REGISTRO LA SALIDA </h1> </strong>'); 
                              
                            }
                            
                            
                            

                        }
        
                   //autofocus
                   document.getElementById("cedulaIngreso").focus();
                   document.getElementById("cedulaIngreso").value = "";
                   $("input[type=radio][name=registro]").prop('checked', false);
                   document.getElementById("cedulaIngreso").focus();
                    }).fail(function(xhr, status, error) {
                        // Manejo de errores de la solicitud AJAX
                        console.error('Error:', error);
                        toastr.error('<strong> <h2> La persona y/o funcionario identificado con: '+cedulaIng +'<br />  </h2><h1> NO SE ENCUENTRA REGISTRADO </h1> </strong>'); 
                        document.getElementById("cedulaIngreso").focus();
                       document.getElementById("cedulaIngreso").value = "";
                       $("input[type=radio][name=registro]").prop('checked', false);
                       document.getElementById("cedulaIngreso").focus();
                                   
                                    });
                      // Llamar a la funci«Ñn recargarFila al cargar la p«¡gina
                     recargarFila();
       
            
                    });
                    
                 function recargarFila() {
                    // Realizar una solicitud AJAX para obtener los datos actualizados de la fila
                    $.get('/parqueadero/consula/ingreso/lista', function(data) {
                        // Actualizar el contenido de la fila con los nuevos datos
                        data='<tr><th scope="row">'+data.cedula+'</th><th scope="row">'+data.nombre+'</th><th scope="row">'+data.cargo+'</th><th scope="row">'+data.empresa+'</th> <th scope="row">'+data.fecha_ingreso+'</th><th scope="row">'+data.registro+'</th></tr>'	
                        $('#fila1').append(data);
                    });
                }
   var intervalo;
    window.onload = function (){
       initIntervalo();// funcion que inicia el intervalo
       
    }
    function initIntervalo(){
      intervalo = window.setInterval(myFunction,9000);
        //Recorda que recibe como parametro los milisegundos. 
    //Entonces si quieres que se ejecute cada 1 milisegundo debes idicarle 1 no 100 como pusiste.
    }
     function myFunction (){
          document.getElementById("cedulaIngreso").focus();
        }
                
</script>

@endpush
    

 
 
@endsection

