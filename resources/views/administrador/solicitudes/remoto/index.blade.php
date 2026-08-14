@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Servicios')
@section('cabecera', 'Solicitudes Funcionarios1')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

 <div class="row">
     <div class="col-xs-2">
         <p> <strong> SILICITUDES:</strong> {{$solicitudesP}}</p>
     </div>
      <div class="col-xs-2">
          <p><strong>ESPERA R.H :</strong> {{$esperarh}}</p>
     </div>
      <div class="col-xs-2">
          <p><strong>ARL: </strong> {{ $esperaArl}}</p>
     </div>
      <div class="col-xs-3">
          <p><strong>RECHAZADOS:</strong> {{$rechazados}}</p>
     </div>
     <div class="col-xs-3">
          <p><strong>CON CONCEPTO ARL:</strong> {{$formalizacion}}</p>
     </div>
     
 </div>
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
                <td>SERVIDOR</td>
                <td>DESPACHO</td>
                <td>FECHA SOLICITUD</td>
                <td>DOCUMENTOS</td>
                <td>ESTADO</td>
                <td>RESPUESTA</td>
                <td>OBSERVACIONES R.H</td>
                <td>ARL</td>
                <td>REVOCAR</td>
                <td>ACCI&Oacute;N</td>
                </tr>
            </thead> 
            @if($solicitudes != null)
             @foreach($solicitudes as $radicado)
                <tbody data-id="{!!$radicado->id!!}">
                <tr >
                 <td>{{$radicado->funcionario_identificacion}}</td>
                 <td>{{$radicado->funcionario_nombre}} {{$radicado->funcionario_apellido}}</td>
                 <td>{{$radicado->tipo_usuario}}</td>
                 <td>{{$radicado->despacho}}</td>
                 <td>{{$radicado->fecha_solicitud}}</td>
                 <td>
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->solicitud}}','popup', 'width=800px,height=600px')">SOLICITUD</a><br>
                    @if(empty($radicado->anuencia))
                    <p>
                        Falta Anuencia
                    </p>
                    @else
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->anuencia}}','popup', 'width=800px,height=600px')">ANUENCIA</a><br>
                    
                    @endif
                    @if($radicado->formalizacion != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->formalizacion}}','popup', 'width=800px,height=600px')">FORMALIZACION</a> <br>
                    @endif
                    @if($radicado->documento_revocado != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->documento_revocado}}','popup', 'width=800px,height=600px')">DOCUMENTO REVOCADO</a> 
                    @endif
                    @if($radicado->lista != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->lista}}','popup', 'width=800px,height=600px')">LISTA ARL</a>  <br> 
                    @endif
                    
                    @if($radicado->documento_concepto != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->documento_concepto}}','popup', 'width=800px,height=600px')">CONCEPTO ARL</a>  
                    @endif
                 </td>
                 <td>{{$radicado->estado}}</td>
                 <td>{{$radicado->observaciones}}</td>
                 <td>{{$radicado->concepto_talento_humano}}</td>
                 <td>{{$radicado->fecha_concepto}}<br>
                 {{$radicado->viabilidad}}<br>
                 
                 {{$radicado->concepto_arl}}</td>
                 <td>{{$radicado->observaciones_revocado}}</td>
                 @if( auth()->user()->email !='consultatt@disajcali.gov.co')
                     <td COLSPAN="3">
                        @if($radicado->estado == "EN ESPERA CONCEPTO ARL" )
                            <a href="{{ route('admin.correo.aprobar.formatos', $radicado->id) }}" class="btn btn-danger btn-xs btn-block" title="REENVIAR CORREO">CORREO</a>
                        @endif
                         @if($radicado->estado == "FORMATOS EN ESPERA DE REVISION DE R.H" )
                            <div class="col-xs-12 mt-3 mb-3 pb-3" style="display: ;">
                                         <a href="{{ route('admin.definir.estado.teletrabajo', $radicado->id) }}" class="btn btn-warning btn-xs btn-block" style="margin-bottom: 0.5em;" title="RECHAZAR SOLICITUD">RECHAZAR</a>
                                     </div><br>
                                     <div class="col-xs-12 mt-3 mb-3" style="display:">
                                         <a href="{{ route('admin.save.aprobar.formatos', $radicado->id) }}" class="btn btn-success btn-xs btn-block" title="PASAR A ARL">PASAR A ARL</a>
                                     </div>
                         @endif
                     </td>
                 @endif
                </tr>
                </tbody>
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
  <script src="/js/filterRemoto.js"></script> 

   
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
  });
  
 
 document.getElementById('select').addEventListener('change', function() {
     var x = document.getElementById("anexos");
     var xx = document.getElementById("acta");
     var info = document.getElementById("info-acta");
     
     console.log(this.value);
        
            if(this.value === 'CREACION USUARIO BESTDOC'  || this.value==='VPN (USUARIO REMOTO)' || this.value==='CREACION USUARIO DOMINIO' || this.value==='TYBA (JUSTICIA XXI WEB)') //si la opcion seleccionada es activoCREACION USUARIO DOMINIO
            {
            var x = document.getElementById("anexos");
                if (x.style.display === "none") {
                   x.style.display = "block";
                   info.style.display = "none";
                   $("#file_anexo").attr("required", true);
                   $("#file_anexo").setAtributte('required',true);
                } else {
                    x.style.display = "block";
                    info.style.display = "none";
                    $("#file_anexo").attr("required", true);
                    $("#file_anexo").setAtributte('required',true);
                }
            }else{
                x.style.display = "none";
                xx.style.display = "none";
                info.style.display = "none";
                $('#file_anexo').removeAttr('required', false);
                $('#file_acta').removeAttr('required', false);
            }
            
             if( this.value==='CREACION CORREO ELECTRONICO') //si la opcion seleccionada es activoCREACION USUARIO DOMINIO
            {
            var x = document.getElementById("anexos");
                if (x.style.display === "none") {
                   x.style.display = "block";
                   info.style.display = "block";
                   $("#file_anexo").attr("required", true);
                   $("#file_anexo").setAtributte('required',true);
                } else {
                    x.style.display = "block";
                    info.style.display = "block";
                    $("#file_anexo").attr("required", true);
                    $("#file_anexo").setAtributte('required',true);
                }
            }else{
                x.style.display = "none";
                xx.style.display = "none";
                info.style.display = "none";
                $('#file_anexo').removeAttr('required', false);
                $('#file_acta').removeAttr('required', false);
            }
            
            //SOLICITUD FIRMA ELECTRONICA
             if(this.value === 'SOLICITUD FIRMA ELECTRONICA') //si la opcion seleccionada es activo
            {
            
                if (xx.style.display === "none") {
                   xx.style.display = "block";
                   x.style.display = "block";
                   $("#file_acta").attr("required", true);
                   $("#file_anexo").attr("required", true);
                   $("#file_anexo").setAtributte('required',true);
                   $("#file_acta").setAtributte('required',true);
                } else {
                    x.style.display = "block";
                    xx.style.display = "block";
                    $("#file_acta").attr("required", true);
                    $("#file_anexo").attr("required", true);
                    $("#file_anexo").setAtributte('required',true);
                    $("#file_acta").setAtributte('required',true);
                }
            }else{
                xx.style.display = "none";
                $('#file_anexo').removeAttr('required', false);
                $('#file_acta').removeAttr('required', false);
            }
            
            if(this.value === 'CREACION CORREO ELECTRONICO') //si la opcion seleccionada es activo
            {
            
                if (info.style.display === "none") {
                   info.style.display = "block";
                 
                  
                } else {
                    info.style.display = "block";
                }
            }else{
                info.style.display = "none";
            }
            
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