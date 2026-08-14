@extends('layouts.monitoreo.ingreso')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Ingreso')
@section('cabecera')
   REGISTRO {{ auth()->user()->name}} {{ auth()->user()->lastname}}...
@endsection
@section('content') 

<style>
        #loadingMessage {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            z-index: 1000;
        }
        .sending {
            background-color: #f39c12; /* Cambia el color del botón a un naranja */
            color: white;
        }
        
    </style>

<style>
		@media only screen and (max-width: 700px) {
			video {
				max-width: 100%;
			}
		}
</style>

    <div class="container-fluid">
        
            <div class="col-xs-12 ">
                <div class="row ">
                     <div class="col-xs-12 col-lg-3"></div>
                     <div class="col-xs-12 col-lg-6">
                    {!!Form::open(['route'=>'biometria.registro.save', 'method'=>'GET','enctype'=>"multipart/form-data",'id'=>'biometria.registro.save'])!!}
        			{{csrf_field()}}
        			<div class="col-xs-12 col-lg-6 form-group ">
                    {!!Form::label('semana_regsitro',"IDENTIFICACION:")!!}
                    {!!Form::number('identificacion',null,['id'=>'identificacion','class'=>'form-control autofocus ',old('identificacion'),'shadow','required','autocomplete'=>"off",'placeholder'=>'Ingrese Cedula Del Visitante','autofocus'])!!}
                     </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('p_apellido',"PRIMER APELLIDO:")!!}
                        {!!Form::text('p_apellido',null,['class'=>'form-control ',old('p_apellido'),'shadow','required','autocomplete'=>"off",'placeholder'=>'Primer Apellido'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('s_apellido',"SEGUNDO APELLIDO:")!!}
                        {!!Form::text('s_apellido',null,['class'=>'form-control ',old('s_apellido'),'shadow','autocomplete'=>"off",'placeholder'=>'Segundo Apellido'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('p_nombre',"PRIMER NOMBRE:")!!}
                        {!!Form::text('p_nombre',null,['id'=>'p_nombre','class'=>'form-control ',old('p_nombre'),'shadow','required','autocomplete'=>"off",'placeholder'=>'Primer Nombre'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('s_nombre',"SEGUNDO NOMBRE:")!!}
                        {!!Form::text('s_nombre',null,['id'=>'s_nombre','class'=>'form-control ',old('s_nombre'),'shadow','autocomplete'=>"off",'placeholder'=>'Segundo Nombre'])!!}
                        
                    </div>
                    <br>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        
                        {!!Form::text('sexo',null,['id'=>'sexo','class'=>'form-control ','shadow','autocomplete'=>"off",'style'=>"width : 0px; heigth : 0px"])!!}
                        
                    </div>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        {!!Form::text('f_nacimiento',null,['id'=>'f_nacimiento','class'=>'form-control ','shadow','autocomplete'=>"off",'style'=>"width : 0px; heigth : 0px"])!!}
                        
                    </div>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        {!!Form::text('ti',null,['id'=>'nombre_conductor','class'=>'form-control ','shadow','autocomplete'=>"off",'style'=>"width : 0px; heigth : 0px"])!!}
                        
                    </div>
                    
                     </div>
                     <div class="col-xs-12 col-lg-3"></div>
                    
                    
                </div>  
            </div>
            
       
            
         
        
        <div class="row ">
            <div class="col-xs-12 col-lg-3 form-group ">
            </div>
            <div class="col-xs-12 col-lg-3  form-group ">
                {!!Form::submit('VALIDAR DATOS',['class'=>'btn btn-primary btn-block'])!!}
                
                {!!Form::close()!!}
            </div>
            <div class="col-xs-12 col-lg-3 form-group ">
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-lg-3  form-group ">
            </div>
        </div>
       
    </div>
    <div id="loadingMessage">Validando datos...</div>
    <hr>
    
     
  </div>   
 <script>
     document.getElementById("identificacion").focus();
 </script>
 
 <script>
      //EQUIPO DE SOPORTE
    
     var identif = document.getElementById('identificacion');
        identif.addEventListener('input', function() 
        {
    
    
            $.get("/porteria/ingreso/consulta/" + this.value + "", function(response, juzgado) {
                
                document.getElementById('p_apellido').value = "";
                    document.getElementById('p_nombre').value = "";
                    document.getElementById('s_apellido').value = "";
                    document.getElementById('s_nombre').value = "";
                    
                    
               if (Object.keys(response).length > 0) {
                   console.log(response)
                    document.getElementById('p_apellido').value = response.p_apellido;
                    document.getElementById('p_nombre').value = response.p_nombre;
                    document.getElementById('s_apellido').value = response.s_apellido;
                    document.getElementById('s_nombre').value = response.s_nombre;
                    
                } else {
                   document.getElementById('p_apellido').value = "";
                    document.getElementById('p_nombre').value = "";
                    document.getElementById('s_apellido').value = "";
                    document.getElementById('s_nombre').value = "";
                }
              //  $("#despacho").val(response.cod_despacho);
                
                
            });
        });
    
 </script>
 
 <script>
        const form = document.getElementById('myForm');
        const loadingMessage = document.getElementById('loadingMessage');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío inmediato para simular la validación

            // Mostrar el mensaje de carga
            loadingMessage.style.display = 'block';
            
            // Cambiar el color del botón y el texto a "Enviando..."
            submitButton.classList.add('sending');
            submitButton.textContent = "Enviando...";

            // Mantener el mensaje visible por 5 segundos y luego ocultarlo
            setTimeout(() => {
                loadingMessage.style.display = 'none';

                // Restaurar el estado original del botón
                submitButton.classList.remove('sending');
                submitButton.textContent = "Enviar";

                // Enviar el formulario real después de mostrar el mensaje
                form.submit();
            }, 9000);
        });
    </script>
   

@endsection