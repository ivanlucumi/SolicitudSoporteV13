<!-- Modal -->
<div class="modal fade" id="Trasladar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #004182;color:white">
        <h3 class="modal-title" id="exampleModalLongTitle"><center>TRASLADAR DEMANDA</center></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('reparto.trasladar.grupo',$reparto->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <label for="despacho">SELECCIONE OFICINA REPARTO:</label> 
                  </div>
                  <div class="col-xs-12 col-sm-12">
                      <select class="form-control  @error('oficinaReparto') is-invalid @enderror" autocomplete="off" name="oficinaReparto" id="oficinaReparto">
    <option value="">Seleccionar Oficina</option>
    @foreach($oficinas as $key => $value)
        <option value="{{ $key }}" @selected(old('oficinaReparto') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('oficinaReparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                     <br> 
                  </div>
                  
              </div>
              
          </div>
       
        <div class="row">
          <div class=" col-xs-12 col-md-12">
            <textarea class="form-control @error('traslado') is-invalid @enderror" placeholder="Motivo Traslado" autocomplete="off" style="height: 90px;" name="traslado" id="traslado">{{ old('traslado', $reparto->traslado ?? '') }}</textarea>
@error('traslado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-lg btn-success" ">Trasladar</button>
        </form>
      </div>
    </div>
  </div>
</div>