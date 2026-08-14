
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong> PRESTAR EXPEDIENTE</strong> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form-almacenar-detenido" action="{{ route('expediente.registrar.prestamo') }}" method="POST">
    @csrf
          <div class="container-fluid">
            <div class="col-xs-12 col-xs-8">
                    <label for="fechaA">RADICACI&Oacute;N:</label><br>
                    <input class="form-control form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" id="radicado" type="number" name="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <input class="form-control form-group mr-sm-2 shadow" placeholder="id" autocomplete="off" id="id" type="hidden" name="id" value="{{ '' }}">
            </div>
            <div class="col-xs-12 col-xs-4">
                    <label for="fechaA">NI:</label><br>
                    <input class="form-control form-group mr-sm-2 shadow @error('ni') is-invalid @enderror" placeholder="NI" autocomplete="off" id="ni" type="number" name="ni" value="{{ old('ni') }}">
@error('ni')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
              <div class="col-xs-12 col-xs-8">
                    <label for="fechaA">PROCESADO:</label><br>
                    <input class="form-control form-group mr-sm-2 shadow @error('nombre_procesado') is-invalid @enderror" placeholder="Procesado" autocomplete="off" id="nombre_procesado" type="text" name="nombre_procesado" value="{{ old('nombre_procesado') }}">
@error('nombre_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-xs-4">
                    <label for="fechaA">CC PROCESADO:</label><br>
                    <input class="form-control form-group mr-sm-2 shadow @error('cedula_procesado') is-invalid @enderror" placeholder="Identificacion procesado" autocomplete="off" id="cedula_procesado" type="number" name="cedula_procesado" value="{{ old('cedula_procesado') }}">
@error('cedula_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-xs-12">
                    <label for="fechaA">SEDE:</label><br>
                    <input class="form-control form-group mr-sm-2 shadow @error('sede') is-invalid @enderror" placeholder="Sede" autocomplete="off" id="sede" type="text" name="sede" value="{{ old('sede') }}">
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
            <div class="col-xs-12 col-xs-6">
                <label for="fechaA">CEDULA:</label><br>
                <input class="form-control form-group mr-sm-2 shadow @error('prestado_a_cedula') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="number" name="prestado_a_cedula" id="prestado_a_cedula" value="{{ old('prestado_a_cedula') }}">
@error('prestado_a_cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
             </div>
             <div class="col-xs-12 col-xs-6">
                 <label for="fechaA">NOMBRE:</label><br>
                 <input class="form-control form-group mr-sm-2 shadow @error('prestado_a_nombre') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="text" name="prestado_a_nombre" id="prestado_a_nombre" value="{{ old('prestado_a_nombre') }}">
@error('prestado_a_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              </div>
              <div class="col-xs-12 col-sm-12">
				    <label for="id_despacho">JUZGADOS:</label><br>
					<select class="form-control select2 @error('prestado_a_despacho') is-invalid @enderror" style="width:100%" name="prestado_a_despacho" id="prestado_a_despacho">
    <option value="">Seleccione Despacho para busqueda</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('prestado_a_despacho', old('prestado_a_despacho')) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('prestado_a_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
					</div>
            <div class="col-xs-12 col-sm-12">
                <hr>
                <label for="observaciones">OBSERVACIONES:</label>
                <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
         <div class="row">
            <div class="col-xs-6">
                <button type="button" class="btn btn-secondary btn-block " data-dismiss="modal">CERRAR</button>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-warning  btn-block" style="background-color: #004182; color: #fff;" type="submit">REGISTRAR PRESTAMO</button>
                </div>
         </div>
           </form>
        </div>
      </div>
    </div>
  </div>
