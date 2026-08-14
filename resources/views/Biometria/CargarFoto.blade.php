@extends('layouts.monitoreo.ingreso')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Ingreso')
@section('cabecera')
   REGISTRO {{ auth()->user()->name}} {{ auth()->user()->lastname}}
@endsection
@section('content') 

    <script>
        // La inicializacion de la vista movil vs pc ahora está en el script principal inferior.
    </script>
<style>
		@media only screen and (max-width: 700px) {
			video {
				max-width: 100%;
			}
		}

        /* ── Animación original (usada por otras partes de la vista) ── */
        @keyframes latidoRojo {
            0%   { transform: scale(1);   box-shadow: 0 0 0 0 rgba(225, 29, 72, 0.7); }
            50%  { transform: scale(1.02); box-shadow: 0 0 15px 10px rgba(225, 29, 72, 0); }
            100% { transform: scale(1);   box-shadow: 0 0 0 0 rgba(225, 29, 72, 0); }
        }

        .alerta-latido { animation: latidoRojo 1.5s infinite; border: 2px solid #e11d48 !important; }
        .foto-latido   { animation: latidoRojo 1.5s infinite; border: 5px solid #e11d48 !important; }

        /* ── Alerta de Novedad (estilo mejorado) ── */
        @keyframes latido {
            0%   { transform: scale(1);   box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.6); }
            30%  { transform: scale(1.03); box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); }
            60%  { transform: scale(1);   box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
            100% { transform: scale(1);   box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
        }

        .alerta-novedad {
            background: linear-gradient(135deg, #fff1f2, #ffe4e6);
            border: 2px solid #dc2626;
            border-left: 8px solid #dc2626;
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 20px;
            color: #7f1d1d;
            animation: latido 1.4s ease-in-out infinite;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.3);
        }

        .alerta-novedad .titulo-novedad {
            font-weight: 800; font-size: 15px;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 8px; color: #991b1b;
            text-transform: uppercase; letter-spacing: .4px;
        }

        .alerta-novedad .titulo-novedad i {
            font-size: 26px; color: #dc2626;
            animation: latido 0.9s ease-in-out infinite;
        }

        .alerta-novedad .texto-novedad {
            font-size: 15px; font-weight: 600;
            margin-left: 34px; line-height: 1.5; color: #7f1d1d;
        }
</style>

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

    <div class="container-fluid">
        
        <div class="row">
            <form action="{{ route('biometria.registro.cargar.foto') }}" method="POST" enctype="multipart/form-data" id="biometria.registro.save">
            <div class="col-xs-12 col-lg-6">
            
            @if(!empty($verificacion->novedades))
                <div class="alerta-novedad">
                    <div class="titulo-novedad">
                        <i class="fa fa-exclamation-triangle"></i>
                        &#9888;&#65039; NOVEDAD REGISTRADA POR COORDINACIÓN:
                    </div>
                    <div class="texto-novedad">{{ $verificacion->novedades }}</div>
                </div>
            @endif
                
             <div class="col-xs-12 col-lg-12">
                    <div class="col-xs-12 col-lg-2 form-group ">
                        <label for="tipo_doc">T.IDENT:</label>
                        <input type="text" name="tipo_doc" value="{{ old('tipo_doc', $verificacion->tipo_doc) }}" id="tipo_doc" class="form-control shadow" required autocomplete="off" placeholder="Tipo de Documento" readonly>
                    </div>
        			<div class="col-xs-12 col-lg-4 form-group ">
                        <label for="identificacion">IDENTIFICACION:</label>
                        <input type="number" name="identificacion" value="{{ old('identificacion', $verificacion->identificacion) }}" id="identificacion" class="form-control shadow" required autocomplete="off" placeholder="Ingrese Cedula Del Visitante" readonly>
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="p_apellido">PRIMER APELLIDO:</label>
                        <input type="text" name="p_apellido" value="{{ old('p_apellido', $verificacion->p_apellido) }}" id="p_apellido" class="form-control shadow" required autocomplete="off" placeholder="Primer Apellido" readonly>
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="s_apellido">SEGUNDO APELLIDO:</label>
                        <input type="text" name="s_apellido" value="{{ old('s_apellido', $verificacion->s_apellido) }}" id="s_apellido" class="form-control shadow" autocomplete="off" placeholder="Segundo Apellido" readonly>
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="p_nombre">PRIMER NOMBRE:</label>
                        <input type="text" name="p_nombre" value="{{ old('p_nombre', $verificacion->p_nombre) }}" id="p_nombre" class="form-control shadow" required autocomplete="off" placeholder="Primer Nombre" readonly>
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="s_nombre">SEGUNDO NOMBRE:</label>
                        <input type="text" name="s_nombre" value="{{ old('s_nombre', $verificacion->s_nombre) }}" id="s_nombre" class="form-control shadow" autocomplete="off" placeholder="Segundo Nombre" readonly>
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="tipo">TIPO INGRESO:</label>
                        <input type="text" name="tipo" value="{{ old('tipo', $verificacion->tipo) }}" id="tipo" class="form-control shadow" autocomplete="off" placeholder="Visitante o Funcionario" readonly>
                    </div>
                    <!-- El campo de observaciones ha sido trasladado al Coordinador Ingreso -->
                    <div class="col-xs-12 col-lg-12" id="opcionesComputadora2">
                           <img id="capturedImage" style="display: none;" alt="Captured Image" name="foto" width="100%" height="100%" value="" required>
                           <!-- Campo oculto para la imagen Base64 -->
                            <input type="hidden" id="imageInput" name="imagen_base64" value=""required>
                       </div>
                        <div class="col-xs-12 col-lg-12" id="opcionesMovil" style="display:none;" >
                         <input type="file" accept="image/*" capture="camera" name="camera_imagen_base64">1
                         
                         </div> 
             </div>

              
            </div>
            <div class="col-xs-12 col-lg-6 ">
             <div class="row" id="opcionesComputadora" style="display:none;">
               <div class="col-xs-12 col-lg-8">
                  <video muted="muted" id="video" width="100%" height="100%"></video>
        	      <canvas id="canvas" style="display: none;" width="100%" height="100%"></canvas> 
        	      <hr>
        	      <select class='form-control' name="listaDeDispositivos" id="listaDeDispositivos"></select>
        	      <br>
            		<button class="btn btn-danger btn-block shadow" id="boton">Tomar foto</button>
            		<p id="estado"></p>
               </div> 
               
            </div>  
            </div>
        </div>
       
            
        <hr>
        <br>
        
        <div class="row ">
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
                <button type="submit" class="btn btn-primary btn-block">REGISTRAR INGRESO</button>
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
        </div>
        </form>
       
    </div>
    
    
    <div id="loadingMessage">ALMACENANDO RESGISTRO ESPERA UN MOMENTO...</div>
    <hr>
    
     
  </div>   
  <form id="form-registro-vehiculo" action="{{ route('regsitro.vehiculo.show', ':VEHICULO_ID') }}" method="GET"></form>

  @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Inicializar vistas (movil vs pc):
        const esDispositivoMovil = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (esDispositivoMovil) {
            document.getElementById('opcionesMovil').style.display = 'block';
        } else {
            document.getElementById('opcionesComputadora').style.display = 'block';
            document.getElementById('opcionesComputadora2').style.display = 'block';
        }

        const $video = document.querySelector("#video");
        const $canvas = document.querySelector("#canvas");
        const $estado = document.querySelector("#estado");
        const $boton = document.querySelector("#boton");
        const $listaDeDispositivos = document.querySelector("#listaDeDispositivos");
        const capturedImage = document.getElementById('capturedImage');
        const imageInput = document.getElementById('imageInput');

        let stream;

        const limpiarSelect = () => {
            while ($listaDeDispositivos.options.length > 0) {
                $listaDeDispositivos.remove(0);
            }
        };

        const llenarSelectConDispositivosDisponibles = () => {
            if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) return;
            limpiarSelect();
            navigator.mediaDevices.enumerateDevices().then(dispositivos => {
                const dispositivosDeVideo = dispositivos.filter(dispositivo => dispositivo.kind === "videoinput");
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label || `Cámara ${$listaDeDispositivos.options.length + 1}`;
                    $listaDeDispositivos.appendChild(option);
                });
            });
        };

        const mostrarStream = (idDeDispositivo, p_esMovil = false) => {
             // Fallback basico webkit / moz
            const userMedia = navigator.mediaDevices?.getUserMedia ? 
                (c) => navigator.mediaDevices.getUserMedia(c) : 
                (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia) ? 
                (c) => new Promise((resolve, reject) => {
                    (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia).call(navigator, c, resolve, reject);
                }) : null;

            if (!userMedia) {
                $estado.innerHTML = "Tu navegador no soporta acceso a la cámara o requiere HTTPS.";
                return;
            }

            const constraints = {
                video: idDeDispositivo ? { deviceId: { exact: idDeDispositivo } } : { facingMode: p_esMovil ? "environment" : "user" }
            };

            userMedia(constraints)
                .then(streamObtenido => {
                    llenarSelectConDispositivosDisponibles();
                    
                    $listaDeDispositivos.onchange = () => {
                        if (stream) {
                            stream.getTracks().forEach(track => track.stop());
                        }
                        mostrarStream($listaDeDispositivos.value, p_esMovil);
                    };

                    stream = streamObtenido;
                    $video.srcObject = stream;
                    $video.play();

                    $boton.onclick = (event) => {
                        event.preventDefault();
                        $video.pause();
                        const contexto = $canvas.getContext("2d");
                        $canvas.width = $video.videoWidth || 640;
                        $canvas.height = $video.videoHeight || 480;
                        contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
                        capturedImage.src = $canvas.toDataURL('image/png');
                        capturedImage.style.display = 'block';
                        imageInput.value = capturedImage.src;
                        $video.play();
                    };
                })
                .catch(error => {
                    console.error("Permiso denegado o error de cámara: ", error);
                    $estado.innerHTML = "Error: no se detecta la cámara o no se dieron permisos.";
                });
        };

        if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
            navigator.mediaDevices.enumerateDevices().then(dispositivos => {
                const dispositivosDeVideo = dispositivos.filter(d => d.kind === "videoinput");
                if (dispositivosDeVideo.length > 0) {
                    mostrarStream(dispositivosDeVideo[0].deviceId, esDispositivoMovil);
                } else {
                    $estado.innerHTML = "No se detecta ninguna cámara conectada.";
                }
            }).catch(e => {
                mostrarStream(null, esDispositivoMovil); 
            });
        } else {
             // Fallback agresivo si no hay enumerateDevices
             mostrarStream(null, esDispositivoMovil); 
        }
    });
</script>

 <script>
        const form = document.getElementById('biometria.registro.save');
        const loadingMessage = document.getElementById('loadingMessage');
        
        if (form) {
            const submitButton = form.querySelector('button[type="submit"]');
            form.addEventListener('submit', function() {
                loadingMessage.style.display = 'block';
                
                if (submitButton) {
                    submitButton.classList.add('sending');
                    submitButton.textContent = "Enviando...";
                    
                    setTimeout(() => {
                        loadingMessage.style.display = 'none';
                        submitButton.classList.remove('sending');
                        submitButton.textContent = "Enviar";
                    }, 5000);
                }
            });
        }
    </script>
 
  
<!--script>
    /*
    Tomar una fotografía y guardarla en un archivo v3
    @date 2018-10-22
    @author parzibyte
    @web parzibyte.me/blog
*/
const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $estado = document.querySelector("#estado"),
    $boton = document.querySelector("#boton"),
    $listaDeDispositivos = document.querySelector("#listaDeDispositivos");
let capturedImage = document.getElementById('capturedImage');

const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
        $listaDeDispositivos.remove(x);
};
const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

// La función que es llamada después de que ya se dieron los permisos
// Lo que hace es llenar el select con los dispositivos obtenidos
const llenarSelectConDispositivosDisponibles = () => {

    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = [];
            dispositivos.forEach(dispositivo => {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            if (dispositivosDeVideo.length > 0) {
                // Llenar el select
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
}

(function() {
    // Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
        return;
    }
    //Aquí guardaremos el stream globalmente
    let stream;


    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });



    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
                video: {
                    // Justo aquí indicamos cuál dispositivo usar
                    deviceId: idDeDispositivo,
                }
            },
            (streamObtenido) => {
                // Aquí ya tenemos permisos, ahora sí llenamos el select,
                // pues si no, no nos daría el nombre de los dispositivos
                llenarSelectConDispositivosDisponibles();

                // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                $listaDeDispositivos.onchange = () => {
                    // Detener el stream
                    if (stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                    }
                    // Mostrar el nuevo stream con el dispositivo seleccionado
                    mostrarStream($listaDeDispositivos.value);
                }

                // Simple asignación
                stream = streamObtenido;

                // Mandamos el stream de la cámara al elemento de vídeo
                $video.srcObject = stream;
                $video.play();

                //Escuchar el click del botón para tomar la foto
                //Escuchar el click del botón para tomar la foto
                $boton.addEventListener("click", function() {
                    event.preventDefault();
                    //Pausar reproducción
                    $video.pause();

                    //Obtener contexto del canvas y dibujar sobre él
                    let contexto = $canvas.getContext("2d");
                    $canvas.width = $video.videoWidth;
                    $canvas.height = $video.videoHeight;
                    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

                    let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
                    //$estado.innerHTML = "Enviando foto. Por favor, espera...";
                    var dataUrl = canvas.toDataURL();
                    console.log(dataUrl);
                    //alert(dataUrl);
                    // Mostrar la imagen capturada en la etiqueta <img>
                    capturedImage.src = canvas.toDataURL('image/png');
                    capturedImage.style.display = 'block';
                    // Establecer el valor Base64 en el campo oculto
                    imageInput.value = capturedImage.src;
                    //Reanudar reproducción
                    $video.play();
                });
            }, (error) => {
                console.log("Permiso denegado o error: ", error);
                $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
            });
    }
})();
</script--> 
 


  
   @endpush
   

@endsection