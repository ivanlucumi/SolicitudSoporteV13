<div class="modal fade" id="modal_editar_torre">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-center" style="justify-content: center"><strong>EDITAR DATOS DE LA TORRE DEL JUZGADO</strong> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>                          
      </div>
      <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
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
              <div class="col-xs-12 col-md-12 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                <label for="t_nombre">Nombre Torre:</label>
                <input id="nombre_torre" class="form-control @error('t_nombre') is-invalid @enderror" placeholder="Ingrese el nombre del evento" type="text" name="t_nombre" value="{{ old('t_nombre') }}">
@error('t_nombre')
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
              <a href="#" class="btn btn-primary  elevation-3 btn-block boton_update_torre">Actualizar Torre</a>                        
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



