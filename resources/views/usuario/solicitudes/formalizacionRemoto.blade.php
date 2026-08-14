@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Revocar Trabajo Remoto')
@section('cabecera', 'Revocar Trabajo Remoto')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

 
    <div class="container-fluid">
        <dvi class="row">
            <CENTER> <h3>  FORMATOS PARA ADJUNTAR SEG&Uacute;N REQUERIMIENTO  </h3></CENTER>
            <div class="col-xs-12 col-sm-4">
                 <a onClick="window.open('/img/1formatos/2.1 Formato de solicitud de teletrabajo.docx','popup', 'width=800px,height=600px')">
                     <i class="fa fa-file-word-o fa-2x" style="color:blue" aria-hidden="true"></i>
                     2.1 Formato de solicitud de teletrabajo</a>
                
             </div>  
             <div class="col-xs-12 col-sm-4">
                  <a onClick="window.open('/img/1formatos/2.2. Formato de anuencia del nominador para teletrabajar.docx','popup', 'width=800px,height=600px')">
                      <i class="fa fa-file-word-o fa-2x " style="color:blue" aria-hidden="true"></i>
                      2.2. Formato de anuencia del nominador para teletrabajar </a>
                
             </div> 
             <div class="col-xs-12 col-sm-4">
                  <a onClick="window.open('/img/1formatos/2.3. Formalizacion del teletrabajo.docx','popup', 'width=800px,height=600px')">
                      <i class="fa fa-file-word-o fa-2x" style="color:blue" aria-hidden="true"></i>
                 2.3. Formalizacion del teletrabajo </a>
               
             </div> 
        </dvi>
        
      
         <div class="row ">
             
            <form action="{{ route('usuario.subir.formalizacion.trabajo.remoto',$solicitud->id,'enctype'=>&quot;multipart/form-data&quot;) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="id_funcionario">Identificacion:</label>
                <input id="funcionario_identificacion" class="form-control  @error('funcionario_identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No. Identificacion" type="number" name="funcionario_identificacion" value="{{ old('funcionario_identificacion', $solicitud->funcionario_identificacion ?? $solicitud->funcionario_identificacion) }}">
@error('funcionario_identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Nombre(s):</label>
                <input id="funcionario_nombre" class="form-control  @error('funcionario_nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_nombre" value="{{ old('funcionario_nombre', $solicitud->funcionario_nombre ?? $solicitud->funcionario_nombre) }}">
@error('funcionario_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                <label for="funcionario">Apellido(s):</label>
                <input id="funcionario_apellido" class="form-control  @error('funcionario_apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="funcionario_apellido" value="{{ old('funcionario_apellido', $solicitud->funcionario_apellido ?? $solicitud->funcionario_apellido) }}">
@error('funcionario_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
               
            </div>
            <div class="col-xs-12 col-sm-3 ">
                <label for="tipo_solicitud">Tipo Solicitud:</label>
                <select id="select" class="form-control select2 @error('tipo_solicitud') is-invalid @enderror" autocomplete="off" name="tipo_solicitud">
    <option value="">Seleccione tipo Solicitud</option>
    @foreach($tipo_solicitud as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud', $solicitud->tipo_solicitud) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            </div>
            
             <div class=" col-xs-12 col-md-12" style="display:none" id="id_solicitud">
                <label for="archivo"> Formato de solicitud de teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('solicitud') is-invalid @enderror" id="solicitud" type="file" name="solicitud">
@error('solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class=" col-xs-12 col-md-12" style="display:none" id="id_anuencia">
                <label for="archivo">Formato de anuencia del nominador para teletrabajar:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('anuencia') is-invalid @enderror" id="anuencia" type="file" name="anuencia">
@error('anuencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class=" col-xs-12 col-md-12" style="display:back" id="id_formalizacion">
                <label for="formalizacion">Formalizaci&oacute;n Teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('formalizacion') is-invalid @enderror" id="formalizacion" type="file" name="formalizacion">
@error('formalizacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
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
    
  
   


@endsection