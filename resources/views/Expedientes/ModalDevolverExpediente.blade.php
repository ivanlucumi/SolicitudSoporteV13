<!-- MODAl PARA EDITAR EL EVENTO-->

<div class="modal fade" id="modal_devolver_expediente">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><strong>DETALLES DEL EXPEDIENTE</strong> </h4>
        </div>
        <div class="modal-body">
         <form action="{{ route('soltar.prestamo') }}" method="POST" enctype="multipart/form-data">
    @csrf
         <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control @error('id_expediente') is-invalid @enderror" id="expediente" type="text" name="id_expediente" value="{{ old('id_expediente') }}">
@error('id_expediente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" id="id_expediente" type="hidden" name="id" value="{{ '' }}">
                    <label for="fechaA">PROCESADO:</label>
                    <input class="form-control @error('procesado') is-invalid @enderror" id="procesado" type="text" name="procesado" value="{{ old('procesado') }}">
@error('procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="fechaA">PRESTAMO A:</label>
                    <input class="form-control @error('prestado_a_cedula') is-invalid @enderror" id="prestado_a_cedula" type="text" name="prestado_a_cedula" value="{{ old('prestado_a_cedula') }}">
@error('prestado_a_cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="fechaA">DESPACHO:</label>
                    <input class="form-control @error('prestado_a_despacho') is-invalid @enderror" id="prestado_a_despacho" type="text" name="prestado_a_despacho" value="{{ old('prestado_a_despacho') }}">
@error('prestado_a_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-sm-12">
                    <label for="observaciones">OBSERVACIONES:</label>
                    <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>

          </div>


        </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="row">
            <center>
                <button type="submit" class="btn btn-success btn-block">DEVOLVER EXPEDIENTE</button>
                <button type="button" class="btn btn-warning  btn-block" data-dismiss="modal">CERRAR</button>
            </center>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
