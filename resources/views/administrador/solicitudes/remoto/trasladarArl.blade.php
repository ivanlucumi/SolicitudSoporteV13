@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Trasladar Solicitud Teletrabajo a ARL')
@section('cabecera', 'Trasladar Solicitud Teletrabajo a ARL')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

  <div class="container-fluid">
      <div class="row ">
          
            <form action="{{ route('admin.save.estado.teletrabajo',$solicitud->id,'enctype'=>&quot;multipart/form-data&quot;) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
            <div class="col-xs-12 col-sm-4 form-group ">
                <label for="id_funcionario">Identificacion:</label>
                <input id="funcionario_identificacion" class="form-control  @error('funcionario_identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No. Identificacion" type="number" name="funcionario_identificacion" value="{{ old('funcionario_identificacion', $solicitud->funcionario_identificacion ?? $solicitud->funcionario_identificacion) }}">
@error('funcionario_identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-4 form-group ">
                <label for="funcionario">Nombre(s):</label>
                <input id="funcionario_nombre" class="form-control  @error('funcionario_nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_nombre" value="{{ old('funcionario_nombre', $solicitud->funcionario_nombre ?? $solicitud->funcionario_nombre) }}">
@error('funcionario_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            <div class="col-xs-12 col-sm-4 form-group ">
                <label for="funcionario">Apellido(s):</label>
                <input id="funcionario_apellido" class="form-control  @error('funcionario_apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_apellido" value="{{ old('funcionario_apellido', $solicitud->funcionario_apellido ?? $solicitud->funcionario_apellido) }}">
@error('funcionario_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
             
                <input id="select" class="form-control" placeholder="Seleccione Viabilidad" autocomplete="off" type="hidden" name="pasar_arl" value="{{ 'NO' }}"> 
            
            <div class="col-xs-12 form-group ">
                <label for="concepto_talento_humano">Concepto de Rechazo : </label>
                <textarea class="form-control  @error('concepto_talento_humano') is-invalid @enderror" id="demandante" autocomplete="off" placeholder="Describa Motivos para Rechazo Formato" name="concepto_talento_humano">{{ old('concepto_talento_humano', $solicitud->concepto_talento_humano ?? $solicitud->concepto_talento_humano) }}</textarea>
@error('concepto_talento_humano')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
          </div>  
            
           
        <div class="row ">
            <br>
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
                <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                
                </form>
            
               <!--  <a href="#" class="btn btn-success btn-block almacenar_registro" id="almacenar_registro" title="almacenar informacion"> Guardar datos</a>
                -->  
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                 <a href="{!! route('admin.solicitud.trabajo.remoto')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
        </div>
    
     
          
    </div>
  </div>  
         
    
    <hr>
    

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
  
   

@endsection