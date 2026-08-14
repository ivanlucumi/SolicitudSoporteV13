<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_revisar_solicitud">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center " style="background-color: #004182;">
          <h4 class="modal-title pull-center" style="justify-content: center; color:white"><strong>DATOSDE LA SOLICITUD</strong> </h4>                
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">                 
           <span aria-hidden="true">&times;</span></button>                             
        </div>
        <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
          </div> 
        
         <div class="modal-body">
           <div class="container-fluid">
             <form id="form-almacenar-detenido" action="{{ route('$url') }}" method="POST">
    @csrf 
            <input class="form-control" id="idsoli" type="hidden" name="solicitud_audiencias_id" value="{{ '' }}">
            <div class="row was-validated">
                <div class="col-xs-12 col-sm-4 form-group ">
                    <label for="fechaA">Programar Fecha:</label>
                    <input class="form-control @error('fecha_prgramada') is-invalid @enderror" id="fecha_prgramada" type="text" name="fecha_prgramada" value="{{ old('fecha_prgramada') }}">
@error('fecha_prgramada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-6 col-lg-4 form-group ">
                    <label for="horaI">Hora Inicio:</label>
                    <input class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" step="0000" type="time" name="hora_inicio" value="{{ old('hora_inicio') }}">
@error('hora_inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-6 col-lg-4  form-group ">
                    <label for="horaF">Hora Finalización:</label>
                    <input class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" type="time" name="hora_fin" value="{{ old('hora_fin') }}">
@error('hora_fin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-6 col-lg-6 form-group ">
                    <label for="email">Correo:</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Correo del despacho que solicita" type="email" name="email" value="{{ old('email') }}">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-6 col-lg-6  form-group ">
                    <label for="nombre_entidad">Nombre Entidad:</label>
                    <input class="form-control @error('nombre_entidad') is-invalid @enderror" id="nombre_entidad" placeholder="Nombre" type="text" name="nombre_entidad" value="{{ old('nombre_entidad') }}">
@error('nombre_entidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-6  form-group ">
                    <label for="ciudad">Ciudad destino de la audiencia:</label>
                    <input class="form-control @error('ciudad_destino') is-invalid @enderror" id="ciudad_destino" placeholder="Inresa Ciudad de la Audiencia" type="text" name="ciudad_destino" value="{{ old('ciudad_destino') }}">
@error('ciudad_destino')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-6 form-group ">
                    <label for="entidadDest">Entidad Destino de la Audiencia:</label>
                    <input class="form-control @error('entidad_destino') is-invalid @enderror" id="entidad_destino" placeholder="Ingresa entidad destino de la audicencia" type="text" name="entidad_destino" value="{{ old('entidad_destino') }}">
@error('entidad_destino')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>
            <div class="row was-validated">                
              
                <div class="col-xs-12 col-sm-6  form-group ">
                    <label for="nRadicacion">Numero de Radicacion del proceso:</label>
                    <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="numero_radicado_proceso" onkeyup="validarcantidad(this)" min="1" placeholder="Ingresa número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso') }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <div id="cantidad"></div>
                </div>
                <div class="col-xs-12 col-sm-6  form-group ">
                    <label for="decoindi">Declarante o Indiciado?:</label>
                    <input class="form-control @error('declarante_indiciado') is-invalid @enderror" id="declarante_indiciado" placeholder="Ingresa nombre del declarante o indiciado" type="text" name="declarante_indiciado" value="{{ old('declarante_indiciado') }}">
@error('declarante_indiciado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>
            <div class="row was-validated">
                
                <div class="col-xs-12 col-sm-6  form-group ">
                    <label for="direccion">Dirección:</label>
                    <input class="form-control @error('direccion') is-invalid @enderror" id="direccion" placeholder="Ingresa la dirección" type="text" name="direccion" value="{{ old('direccion') }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-6  form-group ">
                    <label for="telefono">Teléfono del Solicitante:</label>
                    <input class="form-control @error('telefono') is-invalid @enderror" id="telefono" min="1" placeholder="Ingresa número de telefono" type="number" name="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>
            <div class="row was-validated">
                
                <div class="col-xs-12 col-sm-6  form-group ">
                    <label for="auprivada">La Audiencia es Privada ?</label>
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox1" value="1" name="audiencia_privada" > SI</label>
                            </div>
                            <div class="col-xs-12 col-lg-6">
                                <label><input type="radio" id="cbox2" value="0" name="audiencia_privada" > NO</label>
                            </div>
                    </div>
                    
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 form-group ">
                    <label for="detenido">AUDIENCIA CON DETENIDO(S) A CARGO DEL INPEC ?</label>
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                        <label><input type="radio" id="cbox3" value="1" name="detenido"  > SI</label>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox4" value="0" name="detenido" > NO</label>
                        </div>
                    </div>
                    
                </div>
            </div>                   
            </div>
          </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="row"> 
               
              <div class="col-xs-12 col-sm-6">                                          
                  <div class="container-buttons">
                      <a href="#" class="btn btn-primary  btn-block boton_guardar_detenido mt-1 p-1 pb-1" id="boton_guardar_detenido">REGISTRAR DETENIDO</a>  
                  </div>
               </form>             
              </div>
              <div class="col-xs-12 col-sm-6">
                <a class="btn bg-elegant btn-warning btn-block " data-dismiss="modal">CANCELAR</a>                         
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->