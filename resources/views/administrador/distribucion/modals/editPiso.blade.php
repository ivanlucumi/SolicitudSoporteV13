<div class="modal fade" id="modal_editar_pisos">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-center" style="justify-content: center"><strong>EDITAR DATOS DEL PISO DEL JUZGADO</strong> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>                          
      </div>
      <div id="msj-error-piso" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
        <strong id="msj"></strong>
      </div>    
              
      <div class="modal-body">
        <div class="container-fluid">
              
          <div class="container-fluid">
            <div class="row">
              <div style="display: none;">
                <label for="id">id </label>
                <input id="idE" class="form-control @error('id') is-invalid @enderror" placeholder="id para enviar al update" type="text" name="id" value="{{ old('id') }}">
@error('id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              </div>              
              <div class="col-xs-12 col-md-12 form-group">
                <label for="p_torre">Seleccionar Torre:</label>
                <select ['id'="'id_torre','class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Seleccione torre juzgado','required']" name="p_torre" id="p_torre" class="@error('p_torre') is-invalid @enderror">
    @foreach($torres as $key => $value)
        <option value="{{ $key }}" @selected(old('p_torre') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('p_torre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-md-12 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                <label for="p_nombre">Nombre Torre:</label>
                <input id="nombre_piso" class="form-control @error('p_nombre') is-invalid @enderror" placeholder="Ingrese el piso del juzgado" style="text-transform:uppercase;" type="text" name="p_nombre" value="{{ old('p_nombre') }}">
@error('p_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              </div>  
            </div>
                          
          </div>               
        </div>
      </div>
              
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="row-group">              
            <div class="col-xs-12 col-sm-12 btn-group"> 
              <a href="#" class="btn btn-primary  elevation-3 btn-block boton_update_pisos">Actualizar Piso Juzgado</a>                        
              </form> <br>                    
            </div>
          </div> <br><br>
          <div class="row-group"> 
            <div class="col-xs-12 col-md-12 btn-group">
              <a class="btn btn-danger btn-block " data-dismiss="modal">Cancelar</a>                         
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>  
</div>



