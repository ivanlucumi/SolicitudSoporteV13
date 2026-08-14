@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Repartos')
@section('cabecera', 'Asignar a Despacho')

@section('content') 

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card-header"><h5>DATOS COMPLETOS PARA ENVIO DE INFORMACION .</h5></div>

                    <div class="row">
                        
                    </div>
                   
                    <form enctype="multipart/form-data" action="{{ route('reparto.cambiar.grupo',$reparto->id) }}" method="POST">
    @csrf
    @method('PUT')
                         <div class="form-group row mt-2 mb-3">
                            
                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">ESPECIALIDAD:</label>
                                  <select class="form-control @error('especialidad') is-invalid @enderror" autocomplete="off" id="espe" name="especialidad">
    <option value="">Seleccione Especialidad</option>
    @foreach($gruposRe as $key => $value)
        <option value="{{ $key }}" @selected(old('especialidad', $reparto->especialidad) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                 <div class=" col-xs-12 col-md-4">
                                  <label for="nombre_grupo">CAMBIO GRUPO:</label>
                                    <select id='nombre_gr' name="nombre_grupo" class="form-control" ,required >
                                        <option >{{$reparto->nombre_grupo}}</option>
                                	</select>
                                        
                                </div>
                                <div class=" col-xs-12 col-md-2">
                                    <br>
                                 <button type="submit" class="btn btn-warning btn-block" >
                                    CAMBIAR GRUPO
                                </button>
                                    </div>
                                <div class=" col-xs-12 col-md-2">
                                  <label for="comuna">COMUNA:</label>
                                  <input class="form-control @error('comuna') is-invalid @enderror" placeholder="VIVE EN " autocomplete="off" type="text" name="comuna" id="comuna" value="{{ old('comuna', $reparto->comuna ?? $reparto->comuna) }}">
@error('comuna')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                        </div> 
                        </form>
                        <form enctype="multipart/form-data" action="{{ route('reparto.enviar.asignacion',$reparto->id) }}" method="POST">
    @csrf
    @method('PUT')
                        <div class="row mb-3 mt-3">
                            <div class="col-xs-12 col-md-5">
                                 <h5><center> DATOS DEL DEMANDANTE</center></h5>
                                 <textarea class="form-control @error('demandante') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height: 90px;" name="demandante" id="demandante">{{ old('demandante', $reparto->demandante ?? $reparto->demandante) }}</textarea>
@error('demandante')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                             <div class="col-xs-12 col-md-5">
                                  <h5><center> DATOS DEL DEMANDADO</center></h5>
                         
                            <textarea class="form-control @error('demandado') is-invalid @enderror" placeholder="Seleccion de Especialidad" autocomplete="off" style="height: 90px;" name="demandado" id="demandado">{{ old('demandado', $reparto->demandado ?? $reparto->demandado) }}</textarea>
@error('demandado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-2">
                                  <h5><center>NOTIFICACION DEMANDADO </center></h5>
                         
                            <textarea class="form-control @error('correo_notif_ddo') is-invalid @enderror" placeholder="" autocomplete="off" style="height: 90px;" name="correo_notif_ddo" id="correo_notif_ddo">{{ old('correo_notif_ddo', $reparto->correo_notif_ddo ?? $reparto->correo_notif_ddo) }}</textarea>
@error('correo_notif_ddo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                        </div>
                           
                          
                          <div class="row mb-3 mt-3">
                            <h5><center> DATOS DEL APODERADO</center></h5>
                         </div>
                         <div class="row">
                             <div class=" col-xs-12 col-md-4">
                                  <label for="cedulaA">CEDULA APODERADO:</label>
                                  <input class="form-control @error('cedulaA') is-invalid @enderror" placeholder="Cedula Apoderado" autocomplete="off" type="number" name="cedulaA" id="cedulaA" value="{{ old('cedulaA', $reparto->cedulaA ?? $reparto->cedulaA) }}">
@error('cedulaA')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                <div class=" col-xs-12 col-md-5">
                                  <label for="nombreA">NOMBRE:</label>
                                  <input class="form-control @error('nombreA') is-invalid @enderror" placeholder="Nombre Completo" autocomplete="off" type="text" name="nombreA" id="nombreA" value="{{ old('nombreA', $reparto->nombreA ?? $reparto->nombreA) }}">
@error('nombreA')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                <div class=" col-xs-12 col-md-3">
                                  <label for="tarjetaP">TARJETA PROFESIONAL:</label>
                                  <input class="form-control @error('tarjetaP') is-invalid @enderror" placeholder="Tarjeta Profesional" autocomplete="off" type="number" name="tarjetaP" id="tarjetaP" value="{{ old('tarjetaP', $reparto->tarjetaP ?? $reparto->tarjetaP) }}">
@error('tarjetaP')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                          </div>
                           <div class="row mb-3 mt-3">
                            <h5><center>INFORMACION DEL DOCUMENTO</center></h5>
                         </div>
                         <div class="row">
                             <div class=" col-xs-12 col-md-2">
                                  <label for="cuaderno">CUADERNO:</label>
                                  <input class="form-control @error('cuaderno') is-invalid @enderror" placeholder="Cantidad cuadernos" autocomplete="off" type="number" name="cuaderno" id="cuaderno" value="{{ old('cuaderno', $reparto->cuaderno ?? $reparto->cuaderno) }}">
@error('cuaderno')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                <div class=" col-xs-12 col-md-3">
                                  <label for="folios">FOLIOS:</label>
                                  <input class="form-control @error('folios') is-invalid @enderror" placeholder="Cantidad de folios" autocomplete="off" type="number" name="folios" id="folios" value="{{ old('folios', $reparto->folios ?? $reparto->folios) }}">
@error('folios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                          </div>
                           <div class="row mb-3 mt-3">
                            <h5><center>ANOTACIONES ESPECIALES (DOCUMENTOS ORIGINALES / FOLIO) / OBSERVACIONES</center></h5>
                         </div>
                         <div class="row">
                             <div class=" col-xs-12 col-md-12">
                                  <textarea class="form-control @error('observaciones') is-invalid @enderror" placeholder="OBSERVACIONES" autocomplete="off" style="height: 90px;" name="observaciones" id="observaciones">{{ old('observaciones', $reparto->observaciones ?? $reparto->observaciones) }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                          </div>
                          <div class="row mb-3 mt-3">
                              <h5><center>TEL&Eacute;FONO DE CONTACTO </center></h5>
                              <div class="col-xs-12 col-sm-4"></div>
                              <div class="col-xs-12 col-sm-4">  <center>
                                  <input class="form-control @error('contacto') is-invalid @enderror" placeholder="Ingrese N&uacute;mero de t&eacute;lefono" autocomplete="off" type="number" name="contacto" id="contacto" value="{{ old('contacto', $reparto->contacto ?? $reparto->contacto) }}">
@error('contacto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </center></div>
                             
                              <div class="col-xs-12 col-sm-4"></div>
                            
                          
                         </div>
                          
                          <div class="row mb-3 mt-3">
                            <h5><center>DOCUMENTOS DOCUMENTOS</center></h5>
                         </div>

                        <div class="form-group row mt-3 mb-3">
                            
                                <div class=" col-xs-12 col-md-4">
                                  <label for="archivo">DEMANDA Y PODER:</label> <br> 
                                  <div>
                                      <a onClick="window.open('/Reparto/{{$reparto->demanda}}','popup', 'width=800px,height=600px')">{{$reparto->demanda}}  </a> 
                                  </div>
                                     
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                    <label for="archivo">ANEXOS:</label> <br>                           
                                    <a href="/Reparto/{{$reparto->anexos}}" download="{{$reparto->anexos}}">{{$reparto->anexos}}</a>    
                                  </div>
                                <div class=" col-xs-12 col-md-4">
                                    <label for="archivo">URL ENLACE:</label>  <br>                          
                                    <input class="form-control @error('url_enlace') is-invalid @enderror" placeholder="Url enlace cuando pesa mas de 20Mb" autocomplete="off" type="text" name="url_enlace" id="url_enlace" value="{{ old('url_enlace', $reparto->url_enlace ?? $reparto->url_enlace) }}">
@error('url_enlace')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror    
                                  </div>
                                  
                                    
                        </div> 
                        <div class="form-group row mt-3 mb-3">
                        <div class=" col-xs-12 col-md-4 mt-3 mb-3">
                                    <label for="actaReparto">Seleccione Acta de Reparto:</label>                            
                                    <input accept=".pdf" class="form-control-file form-group @error('acta_reparto') is-invalid @enderror" type="file" name="acta_reparto" id="acta_reparto">
@error('acta_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                          
                         </div>
                          <div class=" col-xs-12 col-md-4">
                                  <label for="despacho">SELECCIONE DESPACHO:</label>
                                  <select class="form-control select2 @error('reparto_asignado_a') is-invalid @enderror" autocomplete="off" name="reparto_asignado_a" id="reparto_asignado_a">
    <option value="">Seleccionar Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('reparto_asignado_a') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('reparto_asignado_a')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                         </div>
                        
                          
                
        </div>
        
    </div>
    
    </div>
    <br>
    <div class=" row mb-3 mt-3" style="background-color:">
        <div class="col-md-4">
             <button type="submit" class="btn btn-lg btn-success btn-block" >
                     ENVIAR PROCESO
                     </form>
            </button>
        </div>
         
        <div class="col-md-4"></div>
        @if( auth()->user()->rol == 15)
       <div class="col-md-4">
            <button type="button" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#Trasladar">
              TRASLADAR
           </button>
            <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#Rechazar">
              RECHAZAR
           </button>
       </div>
       @endif
    </div>
  @include('usuario.reparto.ModalRechazar')
  @include('usuario.reparto.ModalTrasladar')  
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/indexUsuarios.js"></script>        

<script>
    var select = document.getElementById('espe');
select.addEventListener('change',
  function(){
    var selectedOption = this.options[select.selectedIndex];
    //console.log(selectedOption.value + ': ' + selectedOption.text);
    $.get("/formulario/reparto/grupo/" + selectedOption.value + "", function(response) {
            
            if (Object.keys(response).length > 0) {
                
                    $("#nombre_gr").empty();
                     $("#nombre_gr").append("<option value=''>Seleccione Grupo</option>");

                    for(i=0; i<response.length; i++){

                    $("#nombre_gr").append("<option value="+"("+response[i].codigo+") "+" "+response[i].nombre_grupo+"'>"+"("+response[i].codigo+") "+response[i].nombre_grupo+"</option>");

                     }
                
                
            } else {
               
            }
        });
  });
  
</script>
@endsection