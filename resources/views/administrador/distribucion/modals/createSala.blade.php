<div class="modal fade" id="modal_crear_salas">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title pull-center" style="justify-content: center"><strong>CREAR NUEVA SALA</strong> </h4>                
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">                 
        <span aria-hidden="true">&times;</span></button>                             
      </div>

      <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
        <strong id="msj"></strong>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <form id="form-almacenar-salas" action="{{ route('salas-store') }}" method="POST">
    @csrf
          <div class="container-fluid">

            <div class="row">
              <div class="col-xs-12 col-md-12 form-group">
                <label for="s_pisos">Seleccionar Piso:</label>
                <select ['id'="'responsables','class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Seleccione piso juzgado','required']" name="s_pisos" id="s_pisos" class="@error('s_pisos') is-invalid @enderror">
    @foreach($salasp as $key => $value)
        <option value="{{ $key }}" @selected(old('s_pisos') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('s_pisos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-12 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                <label for="s_nombre">#Número Sala:</label>
                <input class="form-control @error('s_nombre') is-invalid @enderror" placeholder="Ingrese el nombre de la sala del juzgado ej: SALA 1" style="text-transform:uppercase;" type="text" name="s_nombre" id="s_nombre" value="{{ old('s_nombre') }}">
@error('s_nombre')
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
            <div class="col-xs-12 col-md-12 form-group">                                          
              <a href="#" class="btn btn-primary   elevation-3 btn-block boton_almacenar_salas">Crear Sala</a>                        
              </form>              
            </div>
            <div class="col-xs-12 col-md-12 form-group">
              <a class="btn btn-danger btn-block " data-dismiss="modal">Cancelar</a>                      
            </div>
          </div>
        </div>  
      </div>

    </div>
  </div>
</div>