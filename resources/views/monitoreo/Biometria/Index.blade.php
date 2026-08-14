@extends('layouts.monitoreo.parqueadero')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Ingreso1')
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
                    <form enctype="multipart/form-data" id="biometria.registro.save" action="{{ route('biometria.parqueadero.registro.save') }}" method="POST">
    @csrf
        			<div class="col-xs-12 col-lg-6 form-group ">
                    <label for="semana_regsitro">IDENTIFICACION:</label>
                    <input id="identificacion" class="form-control autofocus  @error('identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Cedula Del Visitante" min="1" type="number" name="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                     </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="p_apellido">PRIMER APELLIDO:</label>
                        <input class="form-control  @error('p_apellido') is-invalid @enderror" autocomplete="off" placeholder="Primer Apellido" type="text" name="p_apellido" id="p_apellido" value="{{ old('p_apellido') }}">
@error('p_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="s_apellido">SEGUNDO APELLIDO:</label>
                        <input class="form-control  @error('s_apellido') is-invalid @enderror" autocomplete="off" placeholder="Segundo Apellido" type="text" name="s_apellido" id="s_apellido" value="{{ old('s_apellido') }}">
@error('s_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="p_nombre">PRIMER NOMBRE:</label>
                        <input id="p_nombre" class="form-control  @error('p_nombre') is-invalid @enderror" autocomplete="off" placeholder="Primer Nombre" type="text" name="p_nombre" value="{{ old('p_nombre') }}">
@error('p_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="s_nombre">SEGUNDO NOMBRE:</label>
                        <input id="s_nombre" class="form-control  @error('s_nombre') is-invalid @enderror" autocomplete="off" placeholder="Segundo Nombre" type="text" name="s_nombre" value="{{ old('s_nombre') }}">
@error('s_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <br>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        
                        <input id="sexo" class="form-control  @error('sexo') is-invalid @enderror" autocomplete="off" style="width : 0px; heigth : 0px" type="text" name="sexo" value="{{ old('sexo') }}">
@error('sexo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        <input id="f_nacimiento" class="form-control  @error('f_nacimiento') is-invalid @enderror" autocomplete="off" style="width : 0px; heigth : 0px" type="text" name="f_nacimiento" value="{{ old('f_nacimiento') }}">
@error('f_nacimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        <input id="nombre_conductor" class="form-control  @error('ti') is-invalid @enderror" autocomplete="off" style="width : 0px; heigth : 0px" type="text" name="ti" value="{{ old('ti') }}">
@error('ti')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    
                     </div>
                     <div class="col-xs-12 col-lg-3"></div>
                    
                    
                </div>  
            </div>
            
       
            
         
        
        <div class="row ">
            <div class="col-xs-12 col-lg-3 form-group ">
            </div>
            <div class="col-xs-12 col-lg-3  form-group ">
                <button class="btn btn-primary btn-block" type="submit">VALIDAR DATOS</button>
                
                </form>
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
    
    
            $.get("/parqueadero/consulta/" + this.value + "", function(response, juzgado) {
                
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
    
    <script>
document.getElementById('identificacion').addEventListener('input', function () {
    // Si comienza con ceros → se los quita automáticamente
    this.value = this.value.replace(/^0+/, '');
});
</script>
   

@endsection