@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes Teletrabajo')
@section('cabecera', 'Formulario Solicitud Teletrabajo')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
    </div> 
    
    <div id="msj-eliminacion" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
    </div>
 
    <div class="container-fluid">
        <dvi class="row">
            <CENTER> <h1><strong>  FORMATOS PARA ADJUNTAR SEG&Uacute;N REQUERIMIENTO DE TELETRABAJO </strong> </h1></CENTER>
            <div class="col-xs-12 col-sm-4">
                <center>
                 <a onClick="window.open('/img/1formatos/2.1 Formato de solicitud de teletrabajo.docx','popup', 'width=800px,height=600px')">
                     <i class="fa fa-file-word-o fa-2x" style="color:blue" aria-hidden="true"></i>
                     2.1 Formato de solicitud de teletrabajo</a>
                </center>
             </div>  
             <div class="col-xs-12 col-sm-4">
                 <center>
                  <a onClick="window.open('/img/1formatos/2.2. Formato de anuencia del nominador para teletrabajar.docx','popup', 'width=800px,height=600px')">
                      <i class="fa fa-file-word-o fa-2x " style="color:blue" aria-hidden="true"></i>
                      2.2. Formato de anuencia del nominador para teletrabajar </a>
                </center>
             </div> 
             <div class="col-xs-12 col-sm-4">
                 <center>
                  <a onClick="window.open('/img/1formatos/2.3. Formalizacion del teletrabajo.docx','popup', 'width=800px,height=600px')">
                      <i class="fa fa-file-word-o fa-2x" style="color:blue" aria-hidden="true"></i>
                 2.3. Formalizacion del teletrabajo </a>
               </center>
             </div> 
        </dvi>
        
        @if(\Carbon\Carbon::now()->toDateString() > "2023-03-31")
         <div>
             <p>
                 <center>
                     <h3>
                         Solo Pueden Ver El Estado De Su Solicitud, Cualquier Duda Comunicarse Con Recursos Humanos<!--SOLO SE PUEDE CARGAR LA ANUENCIA, PUEDE REALIZARLO BUSCANDO EN EL LISTADO  EL N&Uacute;MERO DE C&Eacute;DULA Y DAR CLIC EN EL BOTON ANUENCIA-->
                     </h3>
                 </center>
             </p>
         </div>
        @else
           <div class="row ">
            
        <form enctype="multipart/form-data" id="almacenar_solicitud_remoto" action="{{ route('usuario.save.trabajo.remoto') }}" method="POST">
    @csrf
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="id_funcionario">Identificacion:</label>
                <input id="funcionario_identificacion" class="form-control  @error('funcionario_identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No. Identificacion" type="number" name="funcionario_identificacion" value="{{ old('funcionario_identificacion') }}">
@error('funcionario_identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Nombre(s):</label>
                <input id="funcionario_nombre" class="form-control  @error('funcionario_nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_nombre" value="{{ old('funcionario_nombre') }}">
@error('funcionario_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Apellido(s):</label>
                <input id="funcionario_apellido" class="form-control  @error('funcionario_apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_apellido" value="{{ old('funcionario_apellido') }}">
@error('funcionario_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            @if( auth()->user()->tipo_rol == "SECCIONAL")
                <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Correo Personal Institucional:</label>
                <input id="email_funcionario" class="form-control  @error('email_funcionario') is-invalid @enderror" autocomplete="off" placeholder="Correo Personal Institucional" type="email" name="email_funcionario" value="{{ old('email_funcionario') }}">
@error('email_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            @endif
            <div class="col-xs-12 col-sm-3 ">
                <label for="tipo_solicitud">Tipo Solicitud:</label>
                <select id="select" class="form-control select2 @error('tipo_solicitud') is-invalid @enderror" autocomplete="off" name="tipo_solicitud">
    <option value="">Seleccione tipo Solicitud</option>
    @foreach($tipo_solicitud as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            </div>
            <div class="col-xs-12 col-sm-3 ">
                <label for="tipo_usuario">Tipo Usuario:</label>
                <select id="select" class="form-control select2 @error('tipo_usuario') is-invalid @enderror" autocomplete="off" name="tipo_usuario">
    <option value="">Seleccione tipo Usuario</option>
    @foreach($tipo_usuarios as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_usuario') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_usuario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            </div>
            
             <div class=" col-xs-12 col-md-12" style="display:back" id="id_solicitud">
                <label for="archivo"> Formato de solicitud de teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('solicitud') is-invalid @enderror" id="solicitud" type="file" name="solicitud">
@error('solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            <span style="display:none; color:red" id="info-acta">Para esa soliciud es necesario adjuntar copia del Acta de Posesi&oacute;n o en su defecto la copia de la Resoluci&oacute;n de la asignaci&oacute;n del cargo</span>
            </div>
            <div class=" col-xs-12 col-md-12 mt-3 mb-3" style="display:back" id="id_anuencia">
                <label for="archivo">Formato de anuencia del nominador para teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('anuencia') is-invalid @enderror" id="anuencia" type="file" name="anuencia">
@error('anuencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
             <span style="display:back; color:red" id="info-acta">Puede subir la anuencia sin firmar para realizar el registro, despues quedará habilitado para actualizarla</span>
             
            </div>
            <hr>
            <div class=" col-xs-12 col-md-12 mt-3 mb-3" style="display:none" id="id_formalizacion">
                <label for="archivo">Formalizaci&oacute;n del teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('formalizacion') is-invalid @enderror" id="formalizacion" type="file" name="formalizacion">
@error('formalizacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
        
        <div class="row mt-3 mb-3">
            
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            
            <div class="col-xs-12 col-sm-3  form-group " >
                <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                
                </form>
            
               <!--  <a href="#" class="btn btn-success btn-block almacenar_registro" id="almacenar_registro" title="almacenar informacion"> Guardar datos</a>
                -->  
            </div>
           
            <div class="col-xs-12 col-sm-3 form-group ">
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
             
        </div>
        
    
     
          
    </div>
    
        @endif
        
      
       
    <hr>
    
    
        
    <input type="button" align="right" value="Clic para Actualizar si no borra" onclick="location.reload()" 
        style="font-family:Arial;font-size:10pt;width:200px;height:30px;
        background:#777777;color:#fff444;cursor:pointer; float: right;"/>

    <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>IDENTIFICACI&Oacute;N</td>
                <td>NOMBRE</td>
                <td>TIPO SOLICITUD</td>
                <td>DOCUEMENTOS</td>
                <td>ESTADO</td>
                <td>OBSERVACIONES R.H</td>
                <td>CONCEPTO ARL</td>
                <td style="width:12em">ACCI&Oacute;N</td>
                </tr>
            </thead> 
            @if($solicitudes != null)
             @foreach($solicitudes as $radicado)
             
             
                <tbody data-id="{!!$radicado->id!!}">
                <tr >
                 <td>{{$radicado->funcionario_identificacion}}</td>
                 <td>{{$radicado->funcionario_nombre}} {{$radicado->funcionario_apellido}}</td>
                 <td>{{$radicado->tipo_solicitud}}</td>
                 <td>
                     @if($radicado->solicitud != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->solicitud}}','popup', 'width=800px,height=600px')">SOLICITUD</a><br>
                    @endif
                    @if(empty($radicado->anuencia))
                    <p>
                        Falta Anuencia
                    </p>
                    @else
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->anuencia}}','popup', 'width=800px,height=600px')">ANUENCIA</a><br>
                    
                    @endif
                    
                    @if($radicado->lista != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->lista}}','popup', 'width=800px,height=600px')">LISTA ARL</a>  <br> 
                    @endif
                    
                    @if($radicado->documento_concepto != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->documento_concepto}}','popup', 'width=800px,height=600px')">CONCEPTO ARL</a>  <br>
                    @endif
                    @if($radicado->formalizacion != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->formalizacion}}','popup', 'width=800px,height=600px')">FORMALIZACION</a> <br> 
                    @endif
                     @if($radicado->documento_revocado != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->documento_revocado}}','popup', 'width=800px,height=600px')">REVOCADO</a> <br>  
                    @endif
                 </td>
                 <td>{{$radicado->estado}}</td>
                 <td>{{$radicado->concepto_talento_humano}}</td>
                 <td>{{$radicado->fecha_concepto}}<br>
                 {{$radicado->viabilidad}}<br>
                 {{$radicado->concepto_arl}}</td>
                  <td style="width:12em">
                    @if(\Carbon\Carbon::now()->toDateString() <= "2023-04-30")  
                          @if($radicado->estado != "REVOCADO" && $radicado->estado != "DENEGADO" && $radicado->estado != "FORMATOS RECHAZADOS" && $radicado->estado != "FORMATOS EN ESPERA DE REVISION DE R.H")
                             <div class="row">
                                 @if($radicado->formalizacion != null)
                                 <div class="col-xs-12 mt-1 mb-1" style="display:none">
                                     <a href="{{ route('usuario.solicitud.revocar.trabajo.remoto', $radicado->id) }}" class="btn btn-danger btn-xs btn-block" title="REVOCAR">REVOCAR</a>
                                 </div>
                                 @endif
                                 @if($radicado->estado == "APROBADO"|| $radicado->estado == "APROBADO Y EN ESPERA DE FORMALILZACION")
                                   @if($radicado->formalizacion == null) 
                                     <div class="col-xs-12 mt-1 mb-1">
                                       <!-- <a href="{{ route('usuario.solicitud.formalizacion.trabajo.remoto', $radicado->id) }}" class="btn btn-success btn-xs btn-block" title="CARGAR FORMALIZACION">FORMALIZACION</a>-->
                                     </div>
                                  @endif
                                 @endif
                             </div>
                         @endif
                     @else
                         <button class="disabled btn btn-danger">ESTAPA CERRADA</button>
                     @endif
                     @if(\Carbon\Carbon::now()->toDateString() <= "2023-04-30")
                         @if( $radicado->estado == "FORMATOS EN ESPERA DE REVISION DE R.H")
                         <a href="" data-target="#modal-anuencia-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-primary btn-sm" title="Subir Anuencia">Anuencia</button></a>	
                         @endif
                          @if( $radicado->estado == "FORMATOS RECHAZADOS")
                          <a href="" data-target="#modal-anuencia-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-primary btn-sm" title="Subir Anuencia">Anuencia</button></a>
                          @endif
                        @if(empty($radicado->anuencia))
                             @if(\Carbon\Carbon::now()->toDateString() <= "2023-04-30")
                             <!--a href="" data-target="#modal-delete-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close btn-sm" title="Boton Eliminar Solicitud"></button></a-->	
                             <a href="" data-target="#modal-anuencia-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-primary btn-sm" title="Subir Anuencia">Anuencia</button></a>
                             @endif
                         @endif
                     @endif
                 </td>
                 
                </tr>
                </tbody>
                @include('usuario.solicitudes.bannerEliminar')
                 @include('usuario.solicitudes.bannerAnuencia')
            @endforeach
          @endif 
           
        </table>
     </div>
    
    
     

    
    
    <form id="form-revocar-Registro" action="{{ route('usuario.revocar.trabajo.remoto',':REGISTRO_ID') }}" method="POST">
    @csrf
    @method('PUT')
    </form>
    
  <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterIndexRemoto.js"></script>   
 

   
  @push('scripts')
  
 
  
  <script>
   $(document).ready(function() {
    $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        
       //BORRRAR DATOS DE PDF
        $('.revocarRegistro').click(function(e) {       
               e.preventDefault();
        
               var row = $(this).parents('tbody')
               
               //alert(row)
               var id = row.data('id');
               var form = $('#form-revocar-Registro');
               var url = form.attr('action').replace(':REGISTRO_ID', id);
               var data = form.serialize();
             
             //alert();
               //row.fadeOut();
              $.post(url, data, function(result){
                  
                  $("#msj-eliminacion").html("<ul>" + result + "</ul>").fadeIn();
                
                
               });
        
             });
             
         //EMPLEADO
     
    var verifCedula = document.getElementById('funcionario_identificacion');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            console.log(response.nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('funcionario_nombre').value = response.nameE;
                document.getElementById('funcionario_apellido').value = response.lastnameE;
            } else {
                document.getElementById('funcionario_nombre').value = "";
                document.getElementById('funcionario_apellido').value = "";
            }
            
            
            
        });
    });
    
  });
  

</script>

<!-- Llamar a los complementos javascript-->

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Solicitud al Grupo Soporte",    //Nombre del archivo 
});

</script>
  
   

  
   @endpush
   

@endsection