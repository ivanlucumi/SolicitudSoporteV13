@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'ESCALAFON DESPACHO')
@section('cabecera', 'ESCALAFON DESPACHO')

@section('content')

	  
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12">
                

                    <div class="row">
                        <center><h2><strong> DATOS COMPLETO DESPACHO Y CARGO </strong></h2></center>
                    </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-xs-12 col-md-2">
                                 <h5><center>CODIGO DESPACHO JUDICIAL UDAE</center></h5>
                                 <input class="form-control @error('codigo_despacho') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="codigo_despacho" id="codigo_despacho" value="{{ old('codigo_despacho', $escalafonDespacho->codigo_despacho) }}">
@error('codigo_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                             <div class="col-xs-12 col-md-4">
                                  <h5><center>DESPACHO JUDICIAL</center></h5>
                                 <input class="form-control @error('despacho_judicial') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="despacho_judicial" id="despacho_judicial" value="{{ old('despacho_judicial', $escalafonDespacho->despacho_judicial) }}">
@error('despacho_judicial')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-1">
                                  <h5><center>ORDEN</center></h5>
                                 <input class="form-control @error('orden') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="orden" id="orden" value="{{ old('orden', $escalafonDespacho->orden) }}">
@error('orden')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-2">
                                  <h5><center>ESTADO NOMINA CODIGO CARGO</center></h5>
                            <input class="form-control @error('estado_nomina') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="estado_nomina" id="estado_nomina" value="{{ old('estado_nomina', $escalafonDespacho->estado_nomina) }}">
@error('estado_nomina')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>ESTADO ACTUAL CORPORACION</center></h5>
                            <input class="form-control @error('estado_actual_corporacion') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="estado_actual_corporacion" id="estado_actual_corporacion" value="{{ old('estado_actual_corporacion', $escalafonDespacho->estado_actual_corporacion) }}">
@error('estado_actual_corporacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                        </div>
                         <div class="row mb-3 mt-3">
                            <div class="col-xs-12 col-md-3">
                                 <h5><center>ESTADO ACTUAL CORPORACION - OBSERVACION</center></h5>
                                 <textarea class="form-control @error('Corporacion_observacion') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" name="Corporacion_observacion" id="Corporacion_observacion">{{ old('Corporacion_observacion', $escalafonDespacho->Corporacion_observacion) }}</textarea>
@error('Corporacion_observacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                             
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>LISTA</center></h5>
                            <textarea class="form-control @error('lista') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" name="lista" id="lista">{{ old('lista', $escalafonDespacho->lista) }}</textarea>
@error('lista')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>SOLICITUD ACTUALIZACION ESCALAFON</center></h5>
                            <textarea class="form-control @error('solicitud_actualizacion') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" name="solicitud_actualizacion" id="solicitud_actualizacion">{{ old('solicitud_actualizacion', $escalafonDespacho->solicitud_actualizacion) }}</textarea>
@error('solicitud_actualizacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>CODIGO CARGO NOMINA</center></h5>
                            <input class="form-control @error('codigo_cargo') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="codigo_cargo" id="codigo_cargo" value="{{ old('codigo_cargo', $escalafonDespacho->codigo_cargo) }}">
@error('codigo_cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>CODIGO REGISTRO ELEGIBLES</center></h5>
                            <input class="form-control @error('codigo_registro_elegibles') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="codigo_registro_elegibles" id="codigo_registro_elegibles" value="{{ old('codigo_registro_elegibles', $escalafonDespacho->codigo_registro_elegibles) }}">
@error('codigo_registro_elegibles')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>CARGO</center></h5>
                            <input class="form-control @error('cargo') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="cargo" id="cargo" value="{{ old('cargo', $escalafonDespacho->cargo) }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>GRADO</center></h5>
                            <input class="form-control @error('grado') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="grado" id="grado" value="{{ old('grado', $escalafonDespacho->grado) }}">
@error('grado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>ACOGIDO</center></h5>
                            <input class="form-control @error('acogido') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="acogido" id="acogido" value="{{ old('acogido', $escalafonDespacho->acogido) }}">
@error('acogido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>ANTES ERA ASISTENTE SOCIAL 2</center></h5>
                            <input class="form-control @error('antes_asistente_social') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="antes_asistente_social" id="antes_asistente_social" value="{{ old('antes_asistente_social', $escalafonDespacho->antes_asistente_social) }}">
@error('antes_asistente_social')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>FECHA INICIAL DE VINCULACION</center></h5>
                            <input class="form-control @error('fecha_vinculacion') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="fecha_vinculacion" id="fecha_vinculacion" value="{{ old('fecha_vinculacion', $escalafonDespacho->fecha_vinculacion) }}">
@error('fecha_vinculacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                        </div>
                        <hr> 
                        <center><h2>PROPIEDAD</h2></center>
                        @if(!empty($escalafonDespacho->Carrera->id))
                        <form action="{{ route('escalafon.listado.put.propiedad',$escalafonDespacho->Carrera->id,'enctype'=>&quot;multipart/form-data&quot;) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                        @else
                        <form action="{{ route('escalafon.listado.post.propiedad') }}" method="POST">
    @csrf
                        @endif
                        <div class="row mb-3 mt-3">
                            <div class="col-xs-12 col-md-2">
                                 <h5><center>GENERO</center></h5>
                                 <input class="form-control @error('genero_propiedad') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="genero_propiedad" id="genero_propiedad" value="{{ old('genero_propiedad', $escalafonDespacho->Carrera->genero_propiedad ?? $escalafonDespacho->Carrera->genero_propiedad) }}">
@error('genero_propiedad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                             <div class="col-xs-12 col-md-2">
                                  <h5><center>CEDULA</center></h5>
                                 <input class="form-control @error('cedula_propiedad') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="cedula_propiedad" id="cedula_propiedad" value="{{ old('cedula_propiedad', $escalafonDespacho->Carrera->cedula_propiedad ?? $escalafonDespacho->Carrera->cedula_propiedad) }}">
@error('cedula_propiedad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-4">
                                  <h5><center>APELLIDOS</center></h5>
                                 <input class="form-control @error('apellido_propiedad') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="apellido_propiedad" id="apellido_propiedad" value="{{ old('apellido_propiedad', $escalafonDespacho->Carrera->apellido_propiedad ?? $escalafonDespacho->Carrera->apellido_propiedad) }}">
@error('apellido_propiedad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-4">
                                  <h5><center>NOMBRES</center></h5>
                            <input class="form-control @error('nombres_propiedad') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="nombres_propiedad" id="nombres_propiedad" value="{{ old('nombres_propiedad', $escalafonDespacho->Carrera->nombres_propiedad ?? $escalafonDespacho->Carrera->nombres_propiedad) }}">
@error('nombres_propiedad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>NOVEDAD ESCALAFON</center></h5>
                            <input class="form-control @error('novedad_escalafon_propiedad') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="novedad_escalafon_propiedad" id="novedad_escalafon_propiedad" value="{{ old('novedad_escalafon_propiedad', $escalafonDespacho->Carrera->novedad_escalafon_propiedad ?? $escalafonDespacho->Carrera->novedad_escalafon_propiedad) }}">
@error('novedad_escalafon_propiedad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>TIPO ACTO ADTIVO DEL CIRCUITO</center></h5>
                            <input class="form-control @error('tipo_acto') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="tipo_acto" id="tipo_acto" value="{{ old('tipo_acto', $escalafonDespacho->Carrera->tipo_acto ?? $escalafonDespacho->Carrera->tipo_acto) }}">
@error('tipo_acto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>NO.</center></h5>
                            <input class="form-control @error('num') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="num" id="num" value="{{ old('num', $escalafonDespacho->Carrera->num ?? $escalafonDespacho->Carrera->num) }}">
@error('num')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>FECHA</center></h5>
                            <input class="form-control @error('fecha') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="fecha" id="fecha" value="{{ old('fecha', $escalafonDespacho->Carrera->fecha ?? $escalafonDespacho->Carrera->fecha) }}">
@error('fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>ENTIDAD</center></h5>
                            <input class="form-control @error('entidad') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="entidad" id="entidad" value="{{ old('entidad', $escalafonDespacho->Carrera->entidad ?? $escalafonDespacho->Carrera->entidad) }}">
@error('entidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>CONCURSO CONVOCATORIA</center></h5>
                            <input class="form-control @error('concurso_convocatoria') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="concurso_convocatoria" id="concurso_convocatoria" value="{{ old('concurso_convocatoria', $escalafonDespacho->Carrera->concurso_convocatoria ?? $escalafonDespacho->Carrera->concurso_convocatoria) }}">
@error('concurso_convocatoria')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>TIPO NOMBRAMIENTO</center></h5>
                            <input class="form-control @error('tipo_nombramiento') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="tipo_nombramiento" id="tipo_nombramiento" value="{{ old('tipo_nombramiento', $escalafonDespacho->Carrera->tipo_nombramiento ?? $escalafonDespacho->Carrera->tipo_nombramiento) }}">
@error('tipo_nombramiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>TIPO ACTO ADMINISTRATIVO</center></h5>
                            <input class="form-control @error('tipo_acto_administrativo') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="tipo_acto_administrativo" id="tipo_acto_administrativo" value="{{ old('tipo_acto_administrativo', $escalafonDespacho->Carrera->tipo_acto_administrativo ?? $escalafonDespacho->Carrera->tipo_acto_administrativo) }}">
@error('tipo_acto_administrativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>No. ACTO ADTIVO DE NOMBRAMIENTO</center></h5>
                            <input class="form-control @error('num_acto_administrativo') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="num_acto_administrativo" id="num_acto_administrativo" value="{{ old('num_acto_administrativo', $escalafonDespacho->Carrera->num_acto_administrativo ?? $escalafonDespacho->Carrera->num_acto_administrativo) }}">
@error('num_acto_administrativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>FECHA</center></h5>
                            <input class="form-control @error('fecha_administrativo') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="fecha_administrativo" id="fecha_administrativo" value="{{ old('fecha_administrativo', $escalafonDespacho->Carrera->fecha_administrativo ?? $escalafonDespacho->Carrera->fecha_administrativo) }}">
@error('fecha_administrativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>FECHA DE POSECION</center></h5>
                            <input class="form-control @error('fecha_posecion') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="fecha_posecion" id="fecha_posecion" value="{{ old('fecha_posecion', $escalafonDespacho->Carrera->fecha_posecion ?? $escalafonDespacho->Carrera->fecha_posecion) }}">
@error('fecha_posecion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>ESTADO ACTUAL CORPORACION</center></h5>
                            <input class="form-control @error('num_resolucion') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="num_resolucion" id="num_resolucion" value="{{ old('num_resolucion', $escalafonDespacho->Carrera->num_resolucion ?? $escalafonDespacho->Carrera->num_resolucion) }}">
@error('num_resolucion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>FECHA DE LICENCIA</center></h5>
                            <input class="form-control @error('fecha_licencia') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="fecha_licencia" id="fecha_licencia" value="{{ old('fecha_licencia', $escalafonDespacho->Carrera->fecha_licencia ?? $escalafonDespacho->Carrera->fecha_licencia) }}">
@error('fecha_licencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>TIEMPO DE LICENCIA</center></h5>
                            <input class="form-control @error('tiempo_licencia') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="tiempo_licencia" id="tiempo_licencia" value="{{ old('tiempo_licencia', $escalafonDespacho->Carrera->tiempo_licencia ?? $escalafonDespacho->Carrera->tiempo_licencia) }}">
@error('tiempo_licencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <hr>
                            <div class="col-xs-12 col-md-12 mt-3 mb-3 p-3">
                                <br>
                                  <center><button class="btn btn-primary btn-md" type="submit">GUARDAR DATOS PROPIEDAD</button></center>
                                  </form>
                            </div>
                            
                        </div>
                <hr> 
                        <center><h2>PROVISIONALIDAD</h2></center>
                        @if(!empty($escalafonDespacho->Carrera->id))
                        <form action="{{ route('escalafon.listado.put.propiedad',$escalafonDespacho->Provisionalidad->id,'enctype'=>&quot;multipart/form-data&quot;) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                        @else
                        <form action="{{ route('escalafon.listado.post.provisionalidad') }}" method="POST">
    @csrf
                        @endif
                        <div class="row mb-3 mt-3">
                            <div class="col-xs-12 col-md-2">
                                 <h5><center>GENERO</center></h5>
                                 <input class="form-control @error('genero') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="genero" id="genero" value="{{ old('genero', $escalafonDespacho->Provisionalidad->genero ?? $escalafonDespacho->Provisionalidad->genero_provisionalidad) }}">
@error('genero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                             <div class="col-xs-12 col-md-2">
                                  <h5><center>CEDULA</center></h5>
                                 <input class="form-control @error('cedula') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="cedula" id="cedula" value="{{ old('cedula', $escalafonDespacho->Provisionalidad->cedula ?? $escalafonDespacho->Provisionalidad->cedula_provisionalidad) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-4">
                                  <h5><center>APELLIDOS</center></h5>
                                 <input class="form-control @error('apellido') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="apellido" id="apellido" value="{{ old('apellido', $escalafonDespacho->Provisionalidad->apellido ?? $escalafonDespacho->Provisionalidad->apellido_provisionalidad) }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-4">
                                  <h5><center>NOMBRES</center></h5>
                            <input class="form-control @error('nombre') is-invalid @enderror" placeholder="" autocomplete="off" style="height:;" type="text" name="nombre" id="nombre" value="{{ old('nombre', $escalafonDespacho->Provisionalidad->nombre ?? $escalafonDespacho->Provisionalidad->nombre_provisionalidad) }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-3">
                                  <h5><center>FECHA POSECION</center></h5>
                            <input class="form-control @error('fecha_posecion') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="fecha_posecion" id="fecha_posecion" value="{{ old('fecha_posecion', $escalafonDespacho->Provisionalidad->fecha_posecion ?? $escalafonDespacho->Provisionalidad->fecha_posecion_provisionalidad) }}">
@error('fecha_posecion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-9">
                                  <h5><center>OBSERVACIONES</center></h5>
                            <input class="form-control @error('observaciones') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height:;" type="text" name="observaciones" id="observaciones" value="{{ old('observaciones', $escalafonDespacho->Provisionalidad->observaciones ?? $escalafonDespacho->Provisionalidad->observaciones_provisionalidad) }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <hr>
                            <div class="col-xs-12 col-md-12 mt-3 mb-3 p-3">
                                <br>
                                  <center><button class="btn btn-primary btn-md" type="submit">GUARDAR DATOS PROVISIONALIDAD</button></center>
                                  </form>
                            </div>
                        </div>
    </div>
    
    </div>

</div>

@endsection



