@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Reporte Proceso Digitalizaci&oacute;n')
@section('cabecera', 'Formulario Reporte Proceso Digitalizaci&oacute;n')



@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
 
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
                      <p class="card-text" > <h3><center>INVENTARIO DE PROCESOS A DIGITALIZAR</center></h3></p>
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
    <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
    </div> 
    
    <div id="msj-eliminacion" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
    </div> 

    <div class="container-fluid">
        
      
         <div class="row ">
            
        <form id="almacenar_reporte_radicado" action="{{ route('reporte.digitalizacion') }}" method="POST">
    @csrf
            <div class="col-xs-12 col-sm-6 form-group ">
                <label for="radicado">Numero Radicado de Proceso:</label>
                <input class="form-control  @error('radicado') is-invalid @enderror" id="nProceso" autocomplete="off" placeholder="Radicado con 23 d&iacute;gitos" type="number" name="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <div id="cantidad"></div>
            </div>
            
            
            <div class="col-xs-12 col-sm-6 form-group ">
                <label for="demandate">Nombre Demandante : </label>
                <input class="form-control  @error('demandante') is-invalid @enderror" id="demandante" autocomplete="off" placeholder="Nombre Demandante" type="text" name="demandante" value="{{ old('demandante') }}">
@error('demandante')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
            <div class="col-xs-12 col-sm-6 form-group ">
                <label for="demandate">Nombre Demandado : </label>
                <input class="form-control  @error('demandado') is-invalid @enderror" id="demandado" autocomplete="off" placeholder="Nombre Demandado" type="text" name="demandado" value="{{ old('demandado') }}">
@error('demandado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="folios">N&uacute;mero Folios:</label>
                <input class="form-control  @error('folios') is-invalid @enderror" id="folios" min="0" autocomplete="off" placeholder="N&uacute;mero de Folios" type="number" name="folios" value="{{ old('folios') }}">
@error('folios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="cuadernos">N&uacute;mero Cuadernos:</label>
                <input class="form-control  @error('cuadernos') is-invalid @enderror" id="cuadernos" min="0" autocomplete="off" placeholder="Cantidad de cuadernos" type="number" name="cuadernos" value="{{ old('cuadernos') }}">
@error('cuadernos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
             <div class="col-xs-12 col-sm-12 form-group ">

                <label for="tipo_expediente">Seleccione segun tipo de expediente :</label>
                
                        
        
                <div class="row">
        
                    <div class="col-xs-12 col-lg-3">
        
                        <label><input type="radio" id="cbox2" value="FÍSICO" name="tipo_expediente"  required> F&Iacute;SICO</label>
        
                        </div>
        
                        <div class="col-xs-12 col-lg-3">
        
                            <label><input type="radio" id="cbox2" value="DIGITAL" name="tipo_expediente" required> DIGITAL</label>
        
                        </div>
                        <div class="col-xs-12 col-lg-6">
        
                            <label><input type="radio" id="cbox2" value="HIBRIDO" name="tipo_expediente"  required> H&Iacute;BRIDO (ESTÁ COMPUESTO POR EXPEDIENTES FÍSICOS Y DIGITALES)</label>
        
                        </div>
        
                </div>
        
                
        
            </div>
        
        
        </div>
        <div>
             <div class="col-xs-12 col-sm-12 form-group ">
                <label for="observacion">Pequeña Descripci&oacute;n de los otros elementos que van en el expediente :</label>
                <textarea class="form-control  @error('observacion') is-invalid @enderror" id="observacion" min="0" autocomplete="off" placeholder="Cantidad de cuadernos" name="observacion">{{ old('observacion') }}</textarea>
@error('observacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
    
        <div class="row ">
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
           
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>  
        </div>
        
        <div class="row ">
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
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
    
    <hr>
    @if($radicados != null)
    <!--div class="row " style="display:none">
            <div class="col-xs-12 col-sm-3">
        		<div class="row">
        			<div class="col-xs-12 col-sm-12">
        				<br>
        				<form action="{{ route('usuario.descargar.inventario') }}" method="POST">
    @csrf
        				<div class="row">
        					<div class="col-xs-12 col-sm-12">
        						<label for="Descargar mi Registro">Descargar mi Registro</label>
        					</div>
        					<div class="col-xs-12 col-sm-12">
        						<button class="btn btn-warning btn-md" type="submit">Descargar Excel</button>
        						</form>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
         <div class="row " style="display:block">
            <div class="col-xs-12 col-sm-3">
        		<div class="row">
        			<div class="col-xs-12 col-sm-12">
        				<br>
        				<form action="{{ route('usuario.descargar.inventario.pdf') }}" method="POST">
    @csrf
        				<div class="row">
        					<div class="col-xs-12 col-sm-12">
        						<label for="Descargar mi Registro">Descargar mi Registro</label>
        					</div>
        					<div class="col-xs-12 col-sm-12">
        						<button class="btn btn-warning btn-md" type="submit">Descargar Excel</button>
        						</form>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div-->
    <label for="Clic Para Descargar mi Registro">Clic Para Descargar mi Registro</label>
        
    <input type="button" align="right" value="Clic para Actualizar si no borra" onclick="location.reload()" 
        style="font-family:Arial;font-size:10pt;width:200px;height:30px;
        background:#777777;color:#fff444;cursor:pointer; float: right;"/>

    <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>Radicado</td>
                <td>Demandante</td>
                <td>Demandado</td>
                <td># Folios</td>
                <td># Cuadernos</td>
                <td>Tipo Exp.</td>
                <td>Oservaci&oacute;n.</td>
                <td>Acci&oacute;n</td>
                </tr>
            </thead>  
             @foreach($radicados as $radicado)
                <tbody data-id="{!!$radicado->id!!}">
                <tr >
                 <td>{{$radicado->radicado}}</td>
                 <td>{{$radicado->demandante}}</td>
                 <td>{{$radicado->demandado}}</td>
                 <td>{{$radicado->folios}}</td>
                 <td>{{$radicado->cuadernos}}</td>
                 <td>{{$radicado->tipo_expediente}}</td>
                 <td>{{$radicado->observacion}}</td>
                 <td>
                    <a id="eliminarRegistro" class="btn btn-danger bnt-xs fa fa-trash fa-lg eliminarRegistro"></a>
                 </td>
                </tr>
                </tbody>
            @endforeach
             <tbody data-id=""   class="id_pdfs" >
                                        
    		 </tbody>
           
        </table>
     </div>
     @endif
     
     

    
    
    <form id="form-delete-Registro" action="{{ route('registro-delete',':REGISTRO_ID') }}" method="POST">
    @csrf
    @method('DELETE')
    </form>
    
    
 

   
  @push('scripts')
  <script src="/js/jquery.js"></script>
 
  
  <script>
   $(document).ready(function() {
    $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        
       //BORRRAR DATOS DE PDF
        $('.eliminarRegistro').click(function(e) {       
               e.preventDefault();
        
               var row = $(this).parents('tbody')
               
               //alert(row)
               var id = row.data('id');
               var form = $('#form-delete-Registro');
               var url = form.attr('action').replace(':REGISTRO_ID', id);
               var data = form.serialize();
             
             //alert();
               row.fadeOut();
              $.post(url, data, function(result){
                  
                  $("#msj-eliminacion").html("<ul>" + result + "</ul>").fadeIn();
                
                
               });
        
             });
  });
  
    $("#almacenar_registro").click(function (e) {
      e.preventDefault();
      
       var form = $('#almacenar_reporte_radicado');
       var ruta = form.attr('action');
       console.log(ruta);
        
      var radicado = $('#nProceso').val();
      var demandante = $('#demandante').val();
      var demandado = $('#demandado').val();
      var folios = $('#folios').val();
      var cuadernos = $('#cuadernos').val();
      
      var tipoExp = $('input:radio[name=tipo_expediente]:checked').val()
      
      var observacion = $('#observacion').val();
      
      //alert(tipoExp)
      
      
      
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type: "post",
        url: ruta,
        data: {
            radicado: radicado,
            demandante: demandante,
            demandado: demandado,
            folios: folios,
            cuadernos: cuadernos, 
            tipo_expediente : tipoExp,
            observacion: observacion
        }, success: function (msg) {
                console.log(msg);
                document.getElementById("almacenar_reporte_radicado").reset();
                //$('#id_pdfs').setAttribute('data-id',  data[0].id);
                var d = document.getElementsByClassName("id_pdfs");  //   Javascript
                //console.log(d);
                d[0].setAttribute('data-id' , msg.id);
                
                 $('.id_pdfs').append('<tr><td>' + msg.radicado +'</td><td>' + msg.demandante + 
                                           '</td><td>'+ msg.demandado + 
                                           '</td><td>'+ msg.folios + 
                                           '</td><td>'+ msg.cuadernos + 
                                           '</td><td>'+ msg.tipo_expediente + 
                                           '</td><td>'+ msg.observacion + 
                                           '</td><td>'+

                              '<a id="eliminarRegistro" class="btn btn-danger  bnt-xs fa fa-trash fa-lg eliminarRegistro"></a>' 
                            
                     
                        + '</td></tr>');
                        
                $("#nProceso").val("");
                $("#demandante").val("");
                $("#demandado").val("");
                $("#folios").val("");
                $("#cuadernos").val("");
                $("#cantidad").val("");
                $('input:radio[name=tipo_expediente]').attr('checked',false);
                
                $('input[name="tipo_expediente"]').prop('checked', false);
                
                $("#observacion").val("");
                
        },
        error: function(msj) {
                var mensajeError = "";
                $.each(msj.responseJSON.errors, function(i, field) {
                    mensajeError += "<li>" + field + "</li>"
                        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
                    console.log(mensajeError)
                });
                $("#msj-error").html("<ul>" + mensajeError + "</ul>").fadeIn();


            },
      });
      
      
      
  });

$(document).ready(function() {
    
    //solo permitir numeros
    
    let numerico = document.querySelector('#nProceso').addEventListener('keypress', validaNumericos);

    function validaNumericos(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }
    
    
   

     /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })


    //verificar los 23 digitos
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })
    
    
    
    
    
    
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
	fileName: "Registro de Ip",    //Nombre del archivo 
});

</script>
  
   

  
   @endpush
   

@endsection