@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Carga de Informacion Teletrabajo')
@section('cabecera', 'Carga de Informacion Teletrabajo')
@section('content') 
<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
    </div> 
    
    <div id="msj-eliminacion" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
    </div>
 
    <div class="container-fluid">
        <div class="row ">
            <p>
                <center>
                    <strong>
                        ES IMPORTANTE TENER EN CUENTA QUE, PARA REALIZAR ESTE PROCESO DEBE DE CONTAR CON EL DOCUMENTO GENRADO EN TELETRABAJO. DE LO CONTRARIO, NO PODRA REALIZAR EL CARGUE DEL DOCUMENTO
                    </strong>
                </center>
            </p>
        </div>
      
      <div class="row ">
            
        <form enctype="multipart/form-data" id="almacenar_solicitud_remoto" action="{{ route('usuario.save.doc.teletrabajo') }}" method="POST">
    @csrf
            <div class="col-xs-12 col-sm-12 form-group ">
                <label for="id_funcionario">Identificacion Para Consultar:</label>
                <input id="funcionario_identificacion" class="form-control  @error('funcionario_identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No. Cedula para validar datos" type="number" name="funcionario_identificacion" value="{{ old('funcionario_identificacion') }}">
@error('funcionario_identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <span style="color:red">
                    Si despu&eacute;s de ingresar la c&eacute;dula no se encuentran resultados, debe comunicarse con Recursos Humanos para validar el motivo.
                </span>
            </div>
      </div>
      <div class="row" style="display:none" id="miDiv">
            <input id="id_" class="form-control " type="hidden" name="id" value="{{ '' }}">
               
             <div class="col-xs-12 col-md-4 form-group ">
                <label for="funcionario">Nombre(s):</label>
                <input id="nombre" class="form-control  @error('funcionario_nombre') is-invalid @enderror" type="text" name="funcionario_nombre" value="{{ old('funcionario_nombre') }}">
@error('funcionario_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>   
            <div class="col-xs-12 col-md-4 form-group ">
                <label for="funcionario">Cargo:</label>
                <input id="cargo" class="form-control  @error('cargo') is-invalid @enderror" type="text" name="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div> 
            <div class="col-xs-12 col-md-4 form-group ">
                <label for="funcionario">Estado:</label>
                <input id="estado_solicitud" class="form-control  @error('estado_solicitud') is-invalid @enderror" type="text" name="estado_solicitud" value="{{ old('estado_solicitud') }}">
@error('estado_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            
            
            <div class="col-xs-12 col-md-12 form-group ">
                <label for="funcionario">Despacho Donde Hizo el Reporte:</label>
                <input id="despacho" class="form-control  @error('despacho') is-invalid @enderror" type="text" name="despacho" value="{{ old('despacho') }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div> 
            <div class="col-xs-12 col-md-12 form-group ">
                <label for="funcionario">Despacho Donde Hizo el Reporte:</label>
                <textarea id="observaciones_arl" class="form-control  @error('observaciones_arl') is-invalid @enderror" name="observaciones_arl">{{ old('observaciones_arl') }}</textarea>
@error('observaciones_arl')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div> 
             <div class="col-xs-12  form-group ">
                 <center>
                     <strong>MARQUE LOS D&Iacute;AS DE LA SEMANA QUE TIENE TELETRABAJO</strong><hr>
                 </center>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-2 form-group ">
                        <label>
                          <input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="LUNES"  /> LUNES
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-2 form-group ">
                        <label>
                          <input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="MARTES" /> MARTES
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-2 form-group ">
                        <label>
                          <input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="MIERCOLES" /> MIERCOLES
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-2 form-group ">
                        <label>
                          <input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="JUEVES" /> JUEVES
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-2 form-group ">
                        <label>
                          <input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="VIERNES" /> VIERNES
                        </label>
                    </div>
                </div>
            </div>
            <div class=" col-xs-12 col-md-12" >
                <label for="archivo"> Formato Recibido Teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('documento') is-invalid @enderror" type="file" name="documento" id="documento">
@error('documento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
            <hr>
             <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            
            <div class="col-xs-12 col-sm-3  form-group " >
                <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                
                </form>
            
            </div>
           
            <div class="col-xs-12 col-sm-3 form-group ">
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
      </div>
            
        
        <div class="row mt-3 mb-3">
            
           
          
        </div>
 <hr>
 
 <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>IDENTIFICACI&Oacute;N</td>
                <td>NOMBRE</td>
                <td>ESTADO</td>
                <td>DOCUEMENTO</td>
                </tr>
            </thead> 
            @if($empleados != null)
             @foreach($empleados as $empleado)
             
             
                <tbody data-id="{!!$empleado->id!!}">
                <tr >
                 <td>{{$empleado->cedula}}</td>
                 <td>{{$empleado->nombre}} </td>
                 <td>{{$empleado->estado_solicitud}}</td>
                 <td>
                     @if($empleado->documento != null)
                    <a onClick="window.open('/Teletrabajo{{$empleado->documento}}','popup', 'width=800px,height=600px')">VER DOCUMENTO CARGADO</a><br>
                    @endif
                   
                 </td>
                </tr>
                </tbody>
            @endforeach
          @endif 
           
        </table>
     </div>

    
  <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterIndexRemoto.js"></script>   
 

   
  @push('scripts')
  
 
  
  <script>
   $(document).ready(function() {
    $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        
    //EMPLEADO
    var verifCedula = document.getElementById('funcionario_identificacion');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/formalizacion/" + this.value + "", function(response, juzgado) {

            console.log(response.nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('id_').value = response.id;
                document.getElementById('nombre').value = response.nombre;
                document.getElementById('cargo').value = response.cargo;
                document.getElementById('despacho').value = response.despacho;
                document.getElementById('estado_solicitud').value = response.estado_solicitud;
                document.getElementById('observaciones_arl').value = response.observaciones_arl;
                // Obtenemos el div por su ID
                var div = document.getElementById("miDiv");
                // Mostramos el div cambiando su estilo de display a "block"
                div.style.display = "block";
            } else {
                document.getElementById('id_').value = "";
                document.getElementById('nombre').value = "";
                document.getElementById('cargo').value = "";
                document.getElementById('despacho').value = "";
                document.getElementById('estado_solicitud').value = "";
                document.getElementById('observaciones_arl').value = "";
                var div = document.getElementById("miDiv");
                // Mostramos el div cambiando su estilo de display a "block"
                div.style.display = "none";
            }
            
            
            
        });
    });
    
  });
  

</script>


  
   

  
   @endpush
   

@endsection