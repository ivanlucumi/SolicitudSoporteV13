@extends('layouts.Ficha.Ficha')
<!--ponerle titulo a la paginga-->
@section('title', 'Ficha Remision')
@section('cabecera', 'Ficha Preliminar')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<form action="{{ route('adminfichas.reporte.remitirSolicitud',$ficha->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="col-xs-12 col-sm-12">
                <div class="row">
                   <div class="col-xs-12 col-sm-4">
                   <label for="especialidad">RADICACI&Oacute;N (23 D&iacute;gitos):</label>
                       <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" min="1" autocomplete="off" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso', $ficha->numero_radicado_proceso ?? $ficha->numero_radicado_proceso) }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <span id="cantidad"> </span>
                   </div> 
                   <div class="col-xs-12 col-sm-4">
                        <label for="especialidad">PROCESADO:</label>
                      	<input class="form-control @error('procesado') is-invalid @enderror" autocomplete="off" type="text" name="procesado" id="procesado" value="{{ old('procesado', $ficha->procesado ?? $ficha->procesado) }}">
@error('procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   </div>
                   <div class="col-xs-12 col-sm-4">
                       <label for="especialidad">TIPO SOLICITUD:</label>
                      	<select class="form-control @error('tipo_solicitud') is-invalid @enderror" autocomplete="off" name="tipo_solicitud" id="tipo_solicitud">
    @foreach($tipoAudiencia as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud', $ficha->tipo_solicitud) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-4">
                       <label for="especialidad">URL PARA ANEXOS:</label><br>
                       <a href="{{$ficha->url_expediente}}" target="_blank">{{$ficha->url_expediente}}</a>
                   </div> 
                   <div class="col-xs-12 col-sm-4">
                       <label for="especialidad">DOCUMENTO SOLICITUD:</label><br>
                       <a onClick="window.open('/fichaPreliminar/{{$ficha->anexos}}','popup', 'width=800px,height=600px')">VER DOCUMENTO ANEXO</a>	
                   </div> 
                   <div class="col-xs-12 col-sm-4">
                       <label for="especialidad">C&Eacute;DULA DE QUIEN SOLICITA:</label>
                      	<input class="form-control @error('cedula_quien_solicita') is-invalid @enderror" autocomplete="off" min="1000" type="number" name="cedula_quien_solicita" id="cedula_quien_solicita" value="{{ old('cedula_quien_solicita', $ficha->cedula_quien_solicita ?? $ficha->cedula_quien_solicita) }}">
@error('cedula_quien_solicita')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-4">
                   <label for="especialidad">NOMBRE DE QUIEN SOLICITA:</label>
                      	<input class="form-control @error('quien_solicita') is-invalid @enderror" autocomplete="off" type="text" name="quien_solicita" id="quien_solicita" value="{{ old('quien_solicita', $ficha->quien_solicita ?? $ficha->quien_solicita) }}">
@error('quien_solicita')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   </div> 
                   <div class="col-xs-12 col-sm-4">
                   <label for="especialidad">NOTIFICACI&Oacute;N:</label>
                      	<input class="form-control @error('email_notificacion') is-invalid @enderror" autocomplete="off" type="email" name="email_notificacion" id="email_notificacion" value="{{ old('email_notificacion', $ficha->email_notificacion ?? $ficha->email_notificacion) }}">
@error('email_notificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   </div> 
                   <div class="col-xs-12 col-sm-4">
                   <label for="especialidad">TEL&Eacute;FONO:</label>
                      	<input class="form-control @error('telefono') is-invalid @enderror" autocomplete="off" type="text" name="telefono" id="telefono" value="{{ old('telefono', $ficha->telefono ?? $ficha->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                   </div>
                </div>
                <hr>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                        <label for="especialidad">ACTA DE REPARTO:</label>
        	        	<input class="form-control-file form-group @error('acta_reparto') is-invalid @enderror" id="acta_reparto" accept="application/pdf" type="file" name="acta_reparto">
@error('acta_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                   </div> 
                    <div class="col-xs-12 col-sm-6">
                        <label for="especialidad">DESPACHO PARA REPARTO:</label>
        	        	<select class="form-control select2 @error('despacho_reparto') is-invalid @enderror" autocomplete="off" name="despacho_reparto" id="despacho_reparto">
    <option value="">Seleccione Despacho para Reparto</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho_reparto') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-12">
                        <label for="especialidad">OBSERVACIONES REPARTO:</label>
        	        	<textarea class="form-control @error('observaciones_reparto') is-invalid @enderror" id="observaciones_reparto" name="observaciones_reparto">{{ old('observaciones_reparto', $ficha->observaciones_reparto ?? '') }}</textarea>
@error('observaciones_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                   </div> 
                </div>
                
                 <hr>
                 <div class="row">
                      <div class="form-group">
                        <div align="center" class="col-xs-12">
                            <button id="btsubmit" class="btn btn-success btn-block" style="text-align: center; background-color: #004182; color: #fff;" type="submit">REALIZAR SOLICITUD</button>
                            </form>
                            
                        </div>
                        
                    </div>
                   
         </div>     
    
  
        
    </div>

   
 @push('scripts')
 @endpush
   

@endsection