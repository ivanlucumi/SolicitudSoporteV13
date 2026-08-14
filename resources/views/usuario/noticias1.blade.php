@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Noticias Siriscali')
@section('cabecera', 'Sección de Noticias')

@section('content') 

<style>
    .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .form-container:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }
        h2 {
            color: #b92d0f; /* Azul para el título */
            text-align: center;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #0056b3;
        }
</style>



<div class="container-fluid"> 

    <div class="row">
          <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <div class="card-body">
                <h2 class="card-title"><strong><center> CALENDARIO N&Oacute;MINA VIGENCIA 2025</center></strong></h2>
                <p class="card-text"><h4>
                </h4></p>
                  <a href="/a/Vee7di" rel="noopener" target="_blank" ><img src="/img/20250710_115729_686ff0f996edd.jpg" class="card-img" width="100%" height="500"></a>
                
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
    </div>
    <br>


@if( auth()->user()->email =="siriscali@cendoj.ramajudicial.gov.co")
<div class="row" style="display:">
    <div class="col-xs-12 col-lg-3" ></div>
    <div class="col-xs-12 col-lg-6" >
    <div class="form-container">
            <h2 class="text-center mb-4"><strong>Registro Datos Empleados Judiciales </strong></h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="#" method="POST" id="registroForm">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="number" name="cedula" id="cedula" class="form-control" min="1" required>
                    @error('cedula')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <input type="text" name="cargo" id="cargo" class="form-control" required>
                    @error('cargo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="correo_institucional" class="form-label">Correo Institucional</label>
                    <input type="email" name="correo_institucional" id="correo_institucional" class="form-control" placeholder="Debe ser del dominio @cendoj.ramajudicial.gov.co" required>
                    <small class="text-muted"></small>
                    @error('correo_institucional')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dependencia" class="form-label">Dependencia</label>
                    <select name="dependencia" id="dependencia" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Administración">Administración</option>
                        <option value="Juzgado">Juzgado</option>
                        <option value="Tribunal">Tribunal</option>
                    </select>
                    @error('dependencia')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </form>
        </div>
        </div>
        <div class="col-xs-12 col-lg-3" ></div>
    </div>
    <br>
    <hr>
@endif
  
  
    <div class="row">
    <h2 class="card-title"><strong><center><a href="https://www.ramajudicial.gov.co/web/correo-electronico-institucional/manuales" rel="noopener" target="_blank">Servicio de Correo Electrónico y Herramientas colaborativas </a> </center></strong></h2>
          <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
             <center> <a href="https://www.ramajudicial.gov.co/web/correo-electronico-institucional/manuales" rel="noopener" target="_blank" ><img class="card-img-top" src="/img/1formatos/HERRAMIENTASRAMA.jpg" alt="Imagen" width="1000px" ></a></center>
              <div class="card-body">
                
                <p class="card-text"><h4>
                 <center>  <h2 class="card-title"><strong><center><a class="btn btn-danger" href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" rel="noopener" target="_blank">HERRAMIENTAS COLABORATIVAS</a> </center></strong></h2> </center>
                </h4></p>
                    
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
    </div>
    
    
  <br>  
  <hr>
    
    <div class="row">
    <h2 class="card-title"><strong><center><a href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" rel="noopener" target="_blank">URL SGDE </a> </center></strong></h2>
          <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <a href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" rel="noopener" target="_blank" ><img class="card-img-top" src="/img/1formatos/SgdeUrl.jpg" alt="Imagen" width="1000px" ></a>
              <div class="card-body">
                
                <p class="card-text"><h4>
                   <h2 class="card-title"><strong><center><a class="btn btn-danger" href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" rel="noopener" target="_blank">CLIC PARA ABRIR SGDE</a> </center></strong></h2> 
                </h4></p>
                    
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
    </div>
    
    
  <br>
    



<!--div class="row">
          <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/logoLargo.png" alt="Formato Referencia Cruzada">
              <div class="card-body">
                <h2 class="card-title"><strong><center> SOLICITUD DE TELETRABAJO</center></strong></h2>
                <p class="card-text"><h4>
                    
                </h4></p>
                    <video src="/img/teletrabajo.webm" width="700" height="500" controls autoplay ></video>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
    </div>
    <br>
    
    
    <hr>
@if( auth()->user()->actualizacion ==0)
<div class="row">
    <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6 form-container" >
            <Center>
                <h2>
                   <strong> Registro de Correos para Ventanilla Judicial Electr&oacute;nica</strong>
                </h2>
            </Center>
            
            <form action="{{ route('usuarios.actualizacion.datos',  auth()->user()->cedula) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-xs-12  " >
                    <label for="telefono">Teléfono:</label>
                    <input type="number" name="telefono" id="telefono" class="form-control"  required>
                </div>
                <div class="col-xs-12  " >
                    <label for="telefono">Ext:</label>
                    <input type="number" name="extension" id="extension" class="form-control" >
                </div>
                <div class="col-xs-12  for" >
                <label for="correo_demanda">Correo de recepci&oacute;n de Demandas:</label>
                <input type="text" name="correo_demanda" id="correo_demanda" class="form-control"  required>
                </div>
                <div class="col-xs-12  " >
                <label for="correo_memoriales">Correo de recepci&oacute;n de Memoriales:</label>
                <input type="text" name="correo_memoriales" id="correo_memoriales" class="form-control"  required>
                </div>
                <div class="col-xs-12 " ><br>
                <button class="btn btn-danger" type="submit">Enviar Información</button>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-lg-3" ></div>
    </div>
    <br>
    <hr>
@endif-->
<!--div class="row">
    <h2 class="card-title"><strong><center><a href="https://www.disajcali.gov.co/usuarios/solicitud/capacitacion/siugj" rel="noopener" >REGISTRO CAPACITACI&Oacute;N PRESENCIAL ESPECIALIDAD LABORAL </a> </center></strong></h2>
          <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <a href="https://www.disajcali.gov.co/usuarios/solicitud/capacitacion/siugj" rel="noopener" ><img class="card-img-top" src="/img/CAPACITACION2.jpg" alt="Imagen" width="1000px" ></a>
              <div class="card-body">
                
                <p class="card-text"><h4>
                   <h2 class="card-title"><strong><center><a class="btn btn-danger" href="https://www.disajcali.gov.co/usuarios/solicitud/capacitacion/siugj" rel="noopener" >REGISTRO CAPACITACI&Oacute;N</a> </center></strong></h2> 
                </h4></p>
                    
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
    </div>
    <br>
    <hr-->

<!--div class="row"  >
    <div class="col-xs-12 col-sm-2"></div>
        
        <div class="col-xs-12 col-sm-8 ">
            <a href="https://gestordocumental.ramajudicial.gov.co/" rel="noopener" target="_blank" ><center><h1>https://gestordocumental.ramajudicial.gov.co/</h1> </center></a>
            <div class="card" style="">
               <a href="https://gestordocumental.ramajudicial.gov.co/" rel="noopener" target="_blank" ><img src="/img/bestdoc.PNG" class="card-img" width="100%" height="500"></a>
              <div class="card-body">
                <a href="" onclick="window.open('/img/1formatos/MANUAL BESTDOC RESUMIDO.pdf','popup', 'width=800px,height=600px')" class="product-title">
            		  <div class="mask flex-center waves-effect waves-light btn btn-primary btn-block">DESCARGAR MANUAL BESTDOC</div>
            		 </a>
                <p class="card-text"></p>
              </div> 
            </div>
        </div>
    <div class="col-xs-12 col-sm-2"></div> 
       
    </div-->
     <br> 
     
<div class="row"  >
    <div class="col-xs-12 col-sm-2"></div>
        
        <div class="col-xs-12 col-sm-8 ">
            <a href="https://etbcsj-my.sharepoint.com/:v:/g/personal/flaraa_deaj_ramajudicial_gov_co/EZgXMljIbQhPgwwu_Zh4E6ABZL_wpWyAWSfxO0jv98KPDQ?e=VxjlVb" rel="noopener" target="_blank" ><center><h1>LINK VIDEO CAPACITACION FIRMA COLEGIADA </h1> </center></a>
            <div class="card" style="">
               <a href="https://etbcsj-my.sharepoint.com/:v:/g/personal/flaraa_deaj_ramajudicial_gov_co/EZgXMljIbQhPgwwu_Zh4E6ABZL_wpWyAWSfxO0jv98KPDQ?e=VxjlVb" rel="noopener" target="_blank" ><img src="/img/1formatos/firma.PNG" class="card-img" width="100%" height="500"></a>
              <div class="card-body">
                  <br>
                <a href="" onclick="window.open('/img/1formatos/MANUAL FIRMA COLEGIADA 2023.pdf','popup', 'width=800px,height=600px')" class="product-title">
            		  <div class="mask flex-center waves-effect waves-light btn btn-primary btn-block">DESCARGAR MANUAL FIRMA COLEGIADA</div>
            		 </a>
                <p class="card-text"></p>
              </div> 
            </div>
        </div>
    <div class="col-xs-12 col-sm-2"></div> 
       
    </div>
     <br> 
     

    <div class="row">
          <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/logoLargo.png" alt="Formato Referencia Cruzada">
              <div class="card-body">
                <h5 class="card-title"><strong>SOLICITUD DE USUARIO MICROSITIO ATENCION AL CIUDADANO</strong></h5>
                <p class="card-text"><h4>
                    Configurar la imagen de PowerPoint con los datos del despacho y guardar como PNG
                </h4></p>
                    <a href="" onclick="window.open('https://www.ramajudicial.gov.co/documents/3196516/72775766/video+-+configurar+pagina+atencion+virtual.mp4/15cfc5e8-27f2-4e72-8f20-4d1955bd86ba','popup', 'width=800px,height=600px')" class="product-title">

            		  <div class="mask flex-center waves-effect waves-light btn btn-primary btn-block">Descargar Instruccion</div>
            		 </a>
            		 <br>
            		 <a href="" onclick="window.open('/img/1formatos/BannerAtencionVirtual.pptx','popup', 'width=800px,height=600px')" class="product-title">

            		  <div class="mask flex-center waves-effect waves-light btn btn-primary btn-block">Descargar Imagen Banner</div>
            		 </a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
    </div>
    <br>
    <hr>

   <div class="row"  >
        
        <div class="col-xs-12 ">
            <div class="card" style="">
              <img class="card-img-top" src="/img/1formatos/mesaAyuda2023.jpeg" alt="Soporte Mesa Ayuda" width="1000" height="1000" style="display: block;margin-left: auto;  margin-right: auto;">
              <div class="card-body">
                <h2 class="card-title"></strog></h2>
                <p class="card-text"></p>
              </div> 
            </div>
        </div>
         
       
    </div>
     <br> 
        <br> 
         <br> 
        <br> 
    
   

   <div class="row" >
        <div class="col-xs-12 col-sm-4" >
            <a href="http://sistemaaudiencias.ramajudicial.gov.co" rel="noopener" target="_blank" ><img src="/img/alerta.gif" class="card-img" width="300em" height="290em"></a>
        </div>
        <div class="col-xs-12 col-sm-8">
            
                      <p class="card-text" ><h2><strong><center style="color:#C0392B">PARA TENER EN CUENTA.</center></strong></h2> </p>
           
                <p class="card-text">
                    <h3>
                     <strong> LAS AUDIENCIAS SE SOLICITAN DIRECTAMENTE A TRAV&Eacute;S DE  
<a href="http://sistemaaudiencias.ramajudicial.gov.co" rel="noopener" target="_blank" >SISTEMA DE AUDIENCIAS</a></h1></strong>
                    </h3>
                </p>
        </div>
        
        
    </div>
    <hr>


   <div class="row" >
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/logoLargo.png" alt="Formato Referencia Cruzada">
              <div class="card-body">
                <h5 class="card-title"><strong>Solicitud Creaci&oacuten Usuario BestDoc</strong></h5>
                <p class="card-text"><h4>Apreciados Servidores Judiciales,
 
Nos permitimos compartir el formato “Solicitud Usuario Gestor Documental”. Recuerde que una vez diligenciado el formato se debe a enviar desde su correo institucional al correo mesadeayuda@deaj.ramajudicial.gov.co en donde uno de los agentes de soporte realizará la respectiva creación de su perfil de usuario y le notificará cuando quede habilitado su acceso a la herramienta “Gestor Documental”.
</h4></p>
                    <a href="" onclick="window.open('/img/DocFormatos/Solicitud Usuario Gestor Documental.docx','popup', 'width=800px,height=600px')" class="product-title">

            		  <div class="mask flex-center waves-effect waves-light btn btn-primary btn-block">Descargar  formato</div>
            		 </a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
        
    </div>
    <hr>
    
      <div class="row" style="display:none">
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/covid.jpg" alt="Reserva de Vacunación" style="display: block;margin-left: auto;  margin-right: auto;  width: 80%;">
              <div class="card-body">
                <h2 class="card-title">Agenda tu Hora de Vacunaci&oacute;n <strog>solo para la ciudad de Cali</strog></h2>
                <p class="card-text">En el siguiente link podrás registrar asistencia para vacunaci&oacute;n de empleados y familiares de trabajadores de la Rama Judicial</p>
                <p class="card-text">La jornada de vacunaci&oacute;n se llevar&aacute; a cabo del 02 al 05 de Mayo 2022 con la disponibilidad de los biol&oacute;gico PFIZER, SINOVAC Y JANSSEN</p>
                <!--<a href="#" class="btn btn-danger btn-block"></a>-->
                <a href="https://disajcali.gov.co/usuarios/formulario/consultar/jornada/vacunacion" class="btn btn-danger btn-block">REGISTRARSE</a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
        
    </div>
    
     <div class="row" style="display:none" >
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/1formatos/formulario.jpg" alt="Encuesta Vacunación" width="300" height="200" style="display: block;margin-left: auto;  margin-right: auto;  width: 50%;">
              <div class="card-body">
                <h2 class="card-title">Encuesta de Esquema de Vacunaci&oacute;n</strog></h2>
                <p class="card-text">En el siguiente link podrás responder la encuesta para conocer el esquema de vacunaci&oacute;n de los funcionarios y empleados de la Rama Judicial</p>
                <a href="https://www.disajcali.gov.co/usuarios/esquema/vacunacion" class="btn btn-danger btn-block">DILIGENCIAR ENCUESTA</a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
         
       
    </div>
     <br> 
        <br> 
         <br> 
        <br> 
    <div class="row"  >
        
        <div class="col-xs-12 ">
            <div class="card" style="display:none">
              <img class="card-img-top" src="/img/1formatos/mesaAyuda.png" alt="Soporte Mesa Ayuda" width="900" height="800" style="display: block;margin-left: auto;  margin-right: auto;  width: 100%;">
              <div class="card-body">
                <h2 class="card-title">Mesa Ayuda</strog></h2>
                <p class="card-text"></p>
              </div> 
            </div>
        </div>
         
       
    </div>
     <br> 
        <br> 
         <br> 
        <br> 
    
   
    
     <div class="row" >
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/logoLargo.png" alt="Protocolo digitalizacion">
              <div class="card-body">
                <h5 class="card-title"><strong>Tablas de Retención Documental</strong></h5>
                <p class="card-text"><h4>El Consejo Superior de la Judicatura, a través del Centro de Documentación Judicial - CENDOJ,
                presenta las tablas de retención documental de la Rama Judicial, instrumento para la administración y control de los documentos
                que producen los despachos judiciales y las dependencias administrativas, como soporte para la preservación del patrimonio documental
                y garantía del derecho de acceso a la información pública.</h4></p>
                <a href="https://www.ramajudicial.gov.co/web/centro-de-documentacion-judicial/tablas-de-retencion-documental" target="_blank" 
                class="btn btn-primary btn-block">Buscar TRD</a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
        
    </div>
    <hr>
    
   
     <div class="row" >
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/logoLargo.png" alt="Protocolo digitalizacion">
              <div class="card-body">
                <h5 class="card-title"><strong>Protocolo digitalizacion Version 2</strong></h5>
                <p class="card-text"><h4>El Consejo Superior de la Judicatura a través del Centro de Documentación Judicial - CENDOJ, presenta la siguiente información 
                con el fin de brindar los parámetros y estándares técnicos y funcionales,
                a funcionarios y empleados de los despachos judiciales, para la producción, gestión 
                y tratamiento estandarizado de los documentos y expedientes electrónicos</h4></p>
                <a href="https://www.ramajudicial.gov.co/documents/3196516/46103054/Protocolo+para+la+gesti%C3%B3n+de+documentos+electronicos.pdf/cb0d98ef-2844-4570-b12a-5907d76bc1a3" target="_blank" 
                class="btn btn-primary btn-block">Visualizar Protocolo</a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
        
    </div>
    <hr>
    
      <div class="row" >
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/logoLargo.png" alt="Formato Referencia Cruzada">
              <div class="card-body">
                <h5 class="card-title"><strong>Formato de Referencia Cruzada</strong></h5>
                <p class="card-text"><h4>En el siguiente link podrás descargar Formato Referencia Cruzada publicado por la Rama Judicial</h4></p>
                    <a href="" onclick="window.open('/formatoExcel/FormatoReferenciaCruzada.xlsx','popup', 'width=800px,height=600px')" class="product-title">

            		  <div class="mask flex-center waves-effect waves-light btn btn-primary btn-block">Descargar  formato</div>
            		 </a>
              </div> 
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
        
        
    </div>
    <hr>
@auth
    @if ( auth()->user()->encuesta == 5 )
    <!--@include('externo.Encuesta.ServicviosJudiciales')-->
    @endif
  @if ( auth()->user()->encuesta == 0 )
  <style>
        .encuesta-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .encuesta-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 1300px;
            max-height: 90vh;
            overflow-y: auto;
        }
        .blocked-page {
            pointer-events: none;
            opacity: 0.5;
            overflow: hidden;
        }
    </style>
<style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
        }
    </style>
    
   
   
   @include('externo.Encuesta.FormEncuentas')
   
   <!-- Fondo oscuro para el modal -->
    <div class="modal-backdrop fade in" style="z-index: 1040;"></div>

    <style>
      /* Estilos adicionales */
      .modal {
        z-index: 1050 !important;
      }
      .modal-lg {
        width: 90%;
        max-width: 1000px;
      }
      .panel-title {
        font-size: 16px;
        font-weight: bold;
      }
      .radio {
        margin-top: 5px;
        margin-bottom: 5px;
      }
      .hidden {
        display: none;
      }
    </style>

    <script>
      // Bloquear el cierre del modal
      $(document).ready(function() {
        $('#encuestaModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        
        // Mostrar el modal
        $('#encuestaModal').modal('show');
        
        // Prevenir el cierre con ESC
        $(document).keydown(function(e) {
          if (e.keyCode == 27) {
            return false;
          }
        });
      });

    </script>
  @endif
@endauth

    
   
    

    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            const correoInstitucional = document.getElementById('correo_institucional').value;
            const regex = /@cendoj\.ramajudicial\.gov\.co$/;
            if (!regex.test(correoInstitucional)) {
                event.preventDefault();
                alert('El correo institucional debe tener el dominio @cendoj.ramajudicial.gov.co');
            }
        });
    </script>

@endsection