<div class="modal fade" id="modal_crear_torre">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title pull-center" style="justify-content: center"><strong>CREAR NUEVA TORRE</strong> </h4>                
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">                 
        <span aria-hidden="true">&times;</span></button>                             
      </div>

      <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
        <strong id="msj"></strong>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <form id="form-almacenar-torre" action="{{ route('torres-store') }}" method="POST">
    @csrf
          <div class="container-fluid">            
            <div class="row">
              <div class="col-xs-12 col-sm-12 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                <label for="t_nombre">Nombre Torre Juzgado:</label>
                <input class="form-control @error('t_nombre') is-invalid @enderror" placeholder="Ingrese el nombre de la torre del juzgado" type="text" name="t_nombre" id="t_nombre" value="{{ old('t_nombre') }}">
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
            <div class="col-xs-12 col-md-6 form-group">                                          
              <a href="#" class="btn btn-primary   elevation-3 btn-block boton_almacenar_torre">Crear Torre</a>                        
              </form>              
            </div>
            <div class="col-xs-12 col-md-6 form-group">
              <a class="btn btn-danger btn-block " data-dismiss="modal">Cancelar</a>                      
            </div>
          </div>
        </div>  
      </div>

    </div>
  </div>
</div>