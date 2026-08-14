
<div class="modal fade bd-example-modal-lg" id="ModalExpediente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong> REGISTRAR EXPEDIENTE</strong> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form-almacenar-detenido" action="{{ route('expediente.save.expediente') }}" method="POST">
    @csrf
          <div class="container-fluid">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                        <label for="fechaA">RADICACI&Oacute;N : </label> <label id="cantidad"></label> <br>
                        <input class="form-control form-group  shadow @error('radicado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" id="nProceso" type="number" name="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        <div id="cantidad"></div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="fechaA">NI:</label><br>
                    <input class="form-control form-group  shadow @error('ni') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="number" name="ni" id="ni" value="{{ old('ni') }}">
@error('ni')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                 </div>
                 <div class="col-xs-12 col-sm-6">
                     <label for="fechaA">CEDULA PROCESADO:</label><br>
                     <input class="form-control form-group  shadow @error('cedula_procesado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="text" name="cedula_procesado" id="cedula_procesado" value="{{ old('cedula_procesado') }}">
@error('cedula_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                 <div class="col-xs-12 col-sm-6">
                    <label for="quienSolicita">NOMBRE PROCESADO:</label><br>
                    <input placeholder="Seleccione Despacho" class="form-control form-group  shadow  @error('nombre_procesado') is-invalid @enderror" aria-required="true" type="text" name="nombre_procesado" id="nombre_procesado" value="{{ old('nombre_procesado') }}">
@error('nombre_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    			 </div>
                 <div class="col-xs-12 col-sm-6">
                    <label for="fechaA">DELITO:</label><br>
                    <input class="form-control form-group  shadow @error('delito') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="text" name="delito" id="delito" value="{{ old('delito') }}">
@error('delito')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="fechaA">N. CUADERNO:</label><br>
                        <input class="form-control form-group  shadow @error('cuadernos') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="number" name="cuadernos" id="cuadernos" value="{{ old('cuadernos') }}">
@error('cuadernos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label for="fechaA">NUMERO DE FOLIOS:</label><br>
                            <input class="form-control form-group  shadow @error('folios') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="number" name="folios" id="folios" value="{{ old('folios') }}">
@error('folios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-6">
                        <label for="quienSolicita">SEDE:</label><br>
                        <select class="form-control select2 @error('sede') is-invalid @enderror" aria-required="true" style="width:100%" name="sede" id="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedes as $key => $value)
        <option value="{{ $key }}" @selected(old('sede') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                     </div>
                 </div>
                 <div class="row">
                 <div class="col-xs-12 col-sm-6">
                    <label for="quienSolicita">TIPO EMPAQUE:</label><br>
                    <select class="form-control select2 @error('almacenado_en') is-invalid @enderror" aria-required="true" style="width:100%" name="almacenado_en" id="almacenado_en">
    <option value="">Seleccione Tipo Empaque</option>
    @foreach($empaque as $key => $value)
        <option value="{{ $key }}" @selected(old('almacenado_en') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('almacenado_en')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                 </div>
                 <div class="col-xs-12 col-sm-6">
                    <label for="quienSolicita">NUMERO DE CAJA:</label><br>
                    <input placeholder="Registre No. de Caja" class="form-control @error('no_caja') is-invalid @enderror" aria-required="true" style="width:100%" type="number" name="no_caja" id="no_caja" value="{{ old('no_caja') }}">
@error('no_caja')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                 </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="quienSolicita">TIPO PROCESO:</label><br>
                        <select class="form-control select2 @error('tipo_expediente') is-invalid @enderror" aria-required="true" style="width:100%" name="tipo_expediente" id="tipo_expediente">
    <option value="">Seleccione Tipo Proceso</option>
    @foreach($tproceso as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_expediente') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_expediente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                     </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="fechaA">FECHA DIGITALIZACION:</label><br>
                        <input class="form-control form-group  shadow @error('fecha_digitalizado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="date" name="fecha_digitalizado" id="fecha_digitalizado" value="{{ old('fecha_digitalizado') }}">
@error('fecha_digitalizado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label for="quienSolicita">ASUNTO ARCHIVO:</label><br>
                            <select class="form-control select2 @error('asunto_archivo') is-invalid @enderror" aria-required="true" style="width:100%" name="asunto_archivo" id="asunto_archivo">
    <option value="">Seleccione Asunto Archivo</option>
    @foreach($asuntarchivo as $key => $value)
        <option value="{{ $key }}" @selected(old('asunto_archivo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('asunto_archivo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                         </div>
                         <div class="col-xs-12 col-sm-6">
                        <label for="fechaA">FECHA ARCHIVO:</label><br>
                        <input class="form-control form-group  shadow @error('fecha_archivo') is-invalid @enderror" autocomplete="off" type="date" name="fecha_archivo" id="fecha_archivo" value="{{ old('fecha_archivo') }}">
@error('fecha_archivo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <label for="fechaA">OBSERVACIONES:</label><br>
                            <textarea class="form-control form-group  shadow @error('observaciones') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
             </div>            
          </div>
        </div>
        <div class="modal-footer">
         <div class="row">
            <div class="col-xs-6">
                <button type="button" class="btn btn-secondary btn-block " data-dismiss="modal">CERRAR</button>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-warning  btn-block" style="background-color: #004182; color: #fff;" type="submit">REGISTRAR EXPEDIENTE</button>
                </div>
         </div>
           </form>
        </div>
      </div>
    </div>
  </div>
