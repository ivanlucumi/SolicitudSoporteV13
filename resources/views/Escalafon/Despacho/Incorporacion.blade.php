@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios')
@section('cabecera')
 INCORPORACI&Oacute;N
@endsection

@section('content') 
<style>
        .texto-grande {
            font-size: 24px; /* Cambia el tamaño según lo necesites */
        }

        .texto-mediano {
            font-size: 16px; /* Cambia el tamaño según lo necesites */
        }

        .texto-pequeño {
            font-size: 12px; /* Cambia el tamaño según lo necesites */
        }
        
         .texto-justificado {
            text-align: justify;
        }
          .dynamic-input {
            border: none;
            border-bottom: 2px solid #000;
            outline: none;
            padding: 8px;
            font-size: 16px;
            width: auto;
            min-width: 25ch;
            max-width: 100%;
        }
         input {
            width: auto; /* Ancho automático */
            min-width: 25ch; /* Ancho mínimo para evitar inputs muy pequeños */
            max-width: 100%; /* Ancho máximo para evitar que se desborde */
            border: none;
            border-bottom: 2px solid #000;
            outline: none;
            padding: 8px;
            font-size: 16px;
        }

        /* Estilo adicional para el borde inferior al enfocar */
        input:focus {
            border-bottom-color: #007BFF; /* Cambia el color del borde al enfocarse */
        }
    </style>
<div class="row">
    <div class="col-xs-12 col-sm-2">
        
    </div>
    <div class="col-xs-12 col-sm-8">
        <div class="row">
           <center>
                <strong class="texto-grande">
                    RESOLUCI&Oacute;N No. CSJVAR24-  DE MAYO DE 2024
                </strong>
            </center> 
        </div>
        <div class="row">
           <center>
            <strong>
               <p class="texto-mediano">
                  “Por la cual se incorpora en el archivo Seccional de Escalafón de Carrera Judicial del Consejo Seccional de la Judicatura del Valle del Cauca a un empleado” 
               </p>
            </strong>
        </center> 
        </div>
        <div class="row">
             
               <p class="texto-mediano">
                  <strong>EL CONSEJO SECCIONAL DE LA JUDICATURA DEL VALLE DEL CAUCA</strong>, en uso de las facultades legales que le confiere el artículo 256 de la Constitución Política, la Ley 270 de 1.996, “Estatutaria de la Administración de Justicia” y el Acuerdo No. 724 del 2000, emanado del Consejo Superior de la Judicatura.
               </p>
            
        </div>
        <div class="row">
           <center>
                <strong class="texto-grande">
                    CONSIDERANDO:
                </strong>
            </center> 
        </div>
        <form id="MiFormulario" enctype="multipart/form-data" class="was-validated" action="{{ route('usuario.escalafon.save.Incorporacion') }}" method="POST">
    @csrf 
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                 Que en virtud de lo dispuesto en el Acuerdo No. PCSJA17-10643 del 14 de febrero de 2017, expedido por el Consejo Superior de la Judicatura, mediante Acuerdos Nos. CSJVAA17-71 del 06 de octubre de 2017, 
                 CSJVAA17-73 del 11 de octubre de 2017 y CSJVAA17-76 del 23 de octubre de 2017, el Consejo Seccional de la Judicatura del Valle del Cauca, 
                 convocó al concurso de méritos destinado a la conformación del Registro Seccional de Elegibles para la provisión de los cargos de Empleados de Carrera de Tribunales,
                 Juzgados y Centros de Servicios de los Distritos Judiciales de Cali y Buga, y Administrativo del Valle del Cauca.
               </p>
            
        </div>
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                 Que, el señor <input type="text" class="dynamic-input" id="Input_servidor_judicial" name="servidor_judicial" placeholder="Introduce Nombre Completo" oninput="copyValueToServidorJ()" required>,
                 identificado con cédula de ciudadanía número <input type="identificacion" id="Input_identificacion" name="identificacion" placeholder="Introduce la identificacion" oninput="copyValueToIdentificacion()" required>,
                 se inscribió y superó las etapas del mencionado Concurso, y fue incluido en el Registro de Elegibles y, posteriormente, en la lista de candidatos para el cargo de 
                 <select id="sourceSelect" name="cargo" onchange="copyValueToAll()" required>
                    @foreach($listaCargos as $lcargo)
                    <option value="{{$lcargo}}" required selected="selected">{{$lcargo}}</option>
                    @endforeach
                </select>,
                 del {{ auth()->user()->name}} {{ auth()->user()->lastname}}, en la cual ocupo el <input type="number" id="puesto_en_lista" name="puesto_en_lista" placeholder="No. Puesto en la Lista" required> lugar.
               </p>
            
        </div>
        
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                 Que, esta Corporación remitió mediante oficio No. <input type="text" id="puesto_en_lista" name="oficio_csjvo" placeholder="Oficio_CSJVO" required> del <input type="date" id="fecha_oficio" name="fecha_oficio" placeholder="FECHA_Of" required>,
                 al {{ auth()->user()->name}} {{ auth()->user()->lastname}}, 
                 la Resolución No. <input type="text" id="lista" name="lista" placeholder="lista" required> del  <input type="date" id="fecha_Res" name="fecha_Res" placeholder="fecha_Res" required>, 
                 por medio de la cual se formuló la lista de candidatos para proveer el cargo de <select class="targetSelect"> <option value="{{$lcargo}}" required selected="selected">{{$lcargo}}</option></select>,
                 para el {{ auth()->user()->name}} {{ auth()->user()->lastname}}.
               </p>
            
        </div>
        
         <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                 Que, el doctor <input type="text" id="dr" name="dr" placeholder="Nombre" required> Juez {{ auth()->user()->name}} {{ auth()->user()->lastname}}, mediante Resolución No. <input type="text" id="resolucion" name="resolucion" placeholder="Resolucion" required> del <input type="date" id="fecha_resolucion" name="fecha_resolucion" placeholder="FECHA RESOLUCION" required>,
                 nombró en propiedad al señor  <input type="text" class="dynamic-input" id="servidor_judicial4" name="servidor_judicial" > en el cargo de <select class="targetSelect"> <option value="{{$lcargo}}" required selected="selected">{{$lcargo}}</option></select> de ese despacho judicial,
                 con base en la lista de candidatos remitida por esta Corporación.
               </p>
            
        </div>
         <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                 El señor <input type="text" class="dynamic-input" id="servidor_judicial1" name="servidor_judicial" >,
                 tomó posesión del cargo de <select class="targetSelect" required><option value="{{$lcargo}}" required selected="selected">{{$lcargo}}</option> </select> del {{ auth()->user()->name}} {{ auth()->user()->lastname}}, en propiedad, el día <input type="date" id="fecha_acta" name="fecha_acta" placeholder="FECHA DEL ACTA" required>.
               </p>
            
        </div>
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                Que, el reparto al Magistrado Sustanciador, de las novedades administrativas,
                frente al Escalafón de Carrera Judicial fue realizado mediante acta No. <input type="text" id="acta_administrativa" name="acta_administrativa" placeholder="Acta Administrativa" required>
                </p>
            
        </div>
        
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                Que, el <input type="text" id="" name="NO_SE_QrEGSITRA" placeholder="no se quien registra" required> , mediante email se allegó copia a la Secretaría de esta Corporación de los actos administrativos 
                correspondientes al nombramiento y posesión en propiedad del señor  <input type="text" class="dynamic-input" id="servidor_judicial2" name="servidor_judicial" required >.
                </p>
            
        </div>
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                Con base en lo expuesto, el trámite que corresponde es la INCORPORACIÓN en el Archivo Seccional del Escalafón de la Carrera Judicial del señor <input type="text" class="dynamic-input" id="servidor_judicial3" name="servidor_judicial" required>,
                identificado con cédula de ciudadanía número <input type="identificacion" id="identificacion1" name="identificacion" placeholder="Introduce la identificacion" required>,
                en el cargo de <select class="targetSelect" required><option value="{{$lcargo}}" required selected="selected">{{$lcargo}}</option> </select>, del {{ auth()->user()->name}} {{ auth()->user()->lastname}}, y a ello se procederá,
                </p>
            
        </div>
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                   En consecuencia, el Consejo Seccional de la Judicatura del Valle del Cauca,
                </p>
            
        </div>
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                   <center>
                       <strong>
                           RESUELVE:<input type="hidden" name="id" value="{{$id}}" required>
                       </strong>
                   </center>
                </p>
            
        </div>
        <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                ART&Iacute;CULO 1º: INCORPORAR en el Archivo Seccional del Escalaf&oacute;n de Carrera Judicial Empleados,
                al señor <input type="text" class="dynamic-input" id="servidor_judicial3" name="servidor_judicial" required>, 
                identificado con cédula de ciudadanía número <input type="identificacion" id="identificacion2" name="identificacion" placeholder="Introduce la identificacion" required>,
                en el cargo de <select class="targetSelect" required><option value="{{$lcargo}}" required selected="selected">{{$lcargo}}</option> </select>,
                del {{ auth()->user()->name}} {{ auth()->user()->lastname}}, conforme a lo expuesto en la parte motiva del presente acto administrativo.
                </p>
            
        </div>
         <div class="row">
             
               <p class="texto-mediano texto-justificado" >
                ART&Iacute;CULO 2°: Env&iacute;ese copia de esta Resoluci&oacute;n a la Unidad de Administraci&oacute;n de la Carrera Judicial del Consejo Superior de la Judicatura,
                para que se lleve a cabo la correspondiente anotaci&oacute;n en el Registro Nacional del Escalaf&oacute;n de Carrera en la Rama Judicial y
                a la Direcci&oacute;n Seccional de Administración Judicial para que repose en la hoja de vida del Servidor Judicial.
                </p>
            
        </div>
        
        
        <div class="row">
            
        </div>
    </div>
    <hr>
    <div class="row mt-3 mb-3">
                      <div class="form-group">
                        <div id="mensaje-container">
                            <p id="mensaje"></p>
                        </div>
                        <div align="center" class="col-xs-12">
                            <center class="">
                                <button id="btsubmit" class="btn btn-success btn-lg" style="text-align: center; background-color: #004182; color: #fff;" onclick="enviarFormulario()" type="submit">GUARDAR SOLICITUD</button>
                            </form>
                            </center>
                            <div id="console" style="display:none">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                                  <span class="sr-only">ESPERANDO RESPUESTA......</span>
                                  
                                </div>
                            </div>
                            
                            <br>
                        </div>
                        
                    </div>
                   
         </div> 
    
    
</div>

<script>
        function copyValueToServidorJ() {
            // Obtener el valor del input fuente
            var sourceValue = document.getElementById('Input_servidor_judicial').value;
            
            // Obtener todos los inputs destino
            var targetInputs = document.querySelectorAll('[id^="servidor_judicial"]');
            
            // Copiar el valor del input fuente a todos los inputs destino
            targetInputs.forEach(function(input) {
                input.value = sourceValue;
            });
        }
        
         function copyValueToIdentificacion() {
            // Obtener el valor del input fuente
            var identificacion = document.getElementById('Input_identificacion').value;
            
            // Obtener todos los inputs destino
            var targetInputsI = document.querySelectorAll('[id^="identificacion"]');
            
            // Copiar el valor del input fuente a todos los inputs destino
            targetInputsI.forEach(function(input) {
                input.value = identificacion;
            });
        }
        
    </script>

  <script>
        // Función que copia el valor de un select a varios otros selects
        function copyValueToAll() {
            var sourceSelect = document.getElementById("sourceSelect");
            var targetSelects = document.getElementsByClassName("targetSelect");

            // Obtiene el valor seleccionado en el primer select
            var selectedValue = sourceSelect.value;

            // Itera sobre todos los selects de destino
            for (var i = 0; i < targetSelects.length; i++) {
                var targetSelect = targetSelects[i];

                // Limpia las opciones previas del select de destino
                targetSelect.innerHTML = "";

                // Agrega la opción seleccionada al select de destino
                var option = document.createElement("option");
                option.value = selectedValue;
                option.text = selectedValue;
                targetSelect.add(option);
            }
        }
    </script>


 <script>
        function adjustWidth(input) {
            // Establece el ancho basado en el contenido, agregando un pequeño buffer
            input.style.width = input.value.length + "ch";
        }
    </script>


@endsection