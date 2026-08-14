<!-- Modal -->
<div class="modal fade" id="Rechazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #004182;color:white">
        <h3 class="modal-title" id="exampleModalLongTitle"><center>RECHAZAR DEMANDA</center></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('reparto.rechazar.demanda',$reparto->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="modal-body">
        <textarea class="form-control @error('rechazo') is-invalid @enderror" placeholder="Motivo del Rechazo" autocomplete="off" style="height: 90px;" name="rechazo" id="rechazo">{{ old('rechazo', $reparto->rechazo ?? '') }}</textarea>
@error('rechazo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-lg btn-succes">RECHAZAR</button>
        </form>
      </div>
    </div>
  </div>
</div>