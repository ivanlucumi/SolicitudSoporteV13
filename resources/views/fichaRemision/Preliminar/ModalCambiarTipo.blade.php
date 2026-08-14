<div class="modal fade" id="modal-cambiar-tipo" >
	<form id="form-cambiar-tipo" action="{{ route('adminfichas.cambiar.tipo') }}" method="POST">
    @csrf
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<center>
				<h3 class="modal-title">CAMBIAR TIPO SOLICITUD DEL EXPEDIENTE<br> <strong> <span id="expediente">.</strong> </span></h3> 
				</center>
			</div>
			<div class="modal-body">
				<input class="form-control" placeholder="Ingresa email" required="required" id="id" type="hidden" name="id" value="{{ '' }}">
				<div class="container-fluid">
				    <div class="row">
                       <div class="col-xs-12 col-sm-4">
                           <h5><strong> TIPO SOLICITUD:</strong></h5>
                       </div> 
                       <div class="col-xs-12 col-sm-8">
                          	<select class="form-control @error('tipo_solicitud') is-invalid @enderror" autocomplete="off" name="tipo_solicitud" id="tipo_solicitud">
    <option value="">Seleccione Tipo Solicitud</option>
    @foreach($tipoAudiencia as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                       </div> 
                    </div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-12">
                           <h5><strong> OBSERVACIONES:</strong></h5>
                       </div> 
                       <div class="col-xs-12 col-sm-12">
                          	<textarea class="form-control @error('observaciones') is-invalid @enderror" placeholder="Observacion " autocomplete="off" height="20em" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                       </div> 
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<center><button type="submit" class="btn btn-primary">Confirmar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
			</div>
		</div>
	</div>
	</form>
</div>
