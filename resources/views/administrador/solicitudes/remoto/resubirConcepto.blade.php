@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Concepto ARL')
@section('cabecera', 'Concepto ARL')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

  <div class="container-fluid">
      <div class="row ">
          
            <form action="{{ route('admin.recarga.trabajo.remoto.concepto',$solicitud->id,'enctype'=>&quot;multipart/form-data&quot;) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
            <input class="form-control " autocomplete="off" type="hidden" name="id_despacho" id="id_despacho" value="{{  auth()->user()->cedula }}">
            <input class="form-control " autocomplete="off" type="hidden" name="despacho" id="despacho" value="{{  auth()->user()->name. auth()->user()->lastname }}">

            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="id_funcionario">Identificacion:</label>
                <input id="funcionario_identificacion" class="form-control  @error('funcionario_identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No. Identificacion" type="number" name="funcionario_identificacion" value="{{ old('funcionario_identificacion', $solicitud->funcionario_identificacion ?? '') }}">
@error('funcionario_identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Nombre(s):</label>
                <input id="funcionario_nombre" class="form-control  @error('funcionario_nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_nombre" value="{{ old('funcionario_nombre', $solicitud->funcionario_nombre ?? '') }}">
@error('funcionario_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Apellido(s):</label>
                <input id="funcionario_apellido" class="form-control  @error('funcionario_apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_apellido" value="{{ old('funcionario_apellido', $solicitud->funcionario_apellido ?? '') }}">
@error('funcionario_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
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
            
            <div class="col-xs-12 col-sm-4 ">
                <label for="tipo_solicitud">FECHA DE CONCEPTO:</label>
                
                <input class="form-control @error('fecha_concepto') is-invalid @enderror" autocomplete="off" type="date" name="fecha_concepto" id="fecha_concepto" value="{{ old('fecha_concepto', $solicitud->fecha_concepto ?? NULL) }}">
@error('fecha_concepto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            </div>
             <div class="col-xs-12 col-sm-4 ">
                <label for="concepto_arl">Seleccione Viabilidad:</label>
                <select id="select" class="form-control select2 @error('viabilidad') is-invalid @enderror" autocomplete="off" name="viabilidad">
    <option value="">Seleccione Viabilidad</option>
    @foreach($viabilidad as $key => $value)
        <option value="{{ $key }}" @selected(old('viabilidad') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('viabilidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            </div>
            <div class="col-xs-12 form-group ">
                <label for="concepto_arl">Descripci&oacute;n : </label>
                <textarea class="form-control  @error('concepto_arl') is-invalid @enderror" id="demandante" autocomplete="off" placeholder="Describa Motivos para Revocar Teletrabajo" name="concepto_arl">{{ old('concepto_arl', $solicitud->concepto_arl ?? '') }}</textarea>
@error('concepto_arl')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
              <div class=" col-xs-12 col-md-12" style="display:back" id="id_anuencia">
                <label for="archivo">Lista:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('lista') is-invalid @enderror" id="lista" type="file" name="lista">
@error('lista')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class=" col-xs-12 col-md-12" id="id_formalizacion">
                <label for="archivo">Concepto:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('documento_concepto') is-invalid @enderror" id="documento_concepto" type="file" name="documento_concepto">
@error('documento_concepto')
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
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
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