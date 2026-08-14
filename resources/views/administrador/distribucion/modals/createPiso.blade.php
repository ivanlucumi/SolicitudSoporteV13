<div class="modal fade" id="modal_crear_pisos">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title pull-center" style="justify-content: center"><strong>CREAR NUEVO PISO</strong> </h4>                
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">                 
        <span aria-hidden="true">&times;</span></button>                             
      </div>

      <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
        <strong id="msj"></strong>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <form id="form-almacenar-pisos" action="{{ route('pisos-store') }}" method="POST">
    @csrf
          <div class="container-fluid">

            <div class="row">
              <div class="col-xs-12 col-md-12 form-group">
                <label for="p_torre">Seleccionar Torre:</label>
                <select ['id'="'responsables','class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Seleccione torre juzgado','required']" name="p_torre" id="p_torre" class="@error('p_torre') is-invalid @enderror">
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
              <div class="col-xs-12 col-sm-12 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                <label for="p_nombre">#Numero Piso:</label>
                <input class="form-control @error('p_nombre') is-invalid @enderror" placeholder="Ingrese el nombre del piso del juzgado ej: PISO 1" style="text-transform:uppercase;" type="text" name="p_nombre" id="p_nombre" value="{{ old('p_nombre') }}">
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
            <div class="col-xs-12 col-md-12 form-group">                                          
              <a href="#" class="btn btn-primary   elevation-3 btn-block boton_almacenar_pisos">Crear Piso</a>                        
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