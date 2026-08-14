
<div class="modal fade" id="desistimiento-banner" >
	<form enctype="multipart/form-data" action="{{ route('admin.subir.desistimiento.teletrabajo.remoto',$radicado->id) }}" method="POST">
    @csrf
    @method('PUT')
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<center>
				<h3 class="modal-title">CAMBIAR TIPO SOLICITUD DEL EXPEDIENTE<br> <strong> <span id="expediente">.</strong> </span> <span id="nombre">.</strong> </span>  </h3> 
				</center>
			</div>
			<div class="modal-body">
				<input class="form-control" placeholder="Ingresa email" required="required" id="id" type="hidden" name="id" value="{{ '' }}">
				<div class="container-fluid">
				    <div class="row">
                       <div class="col-xs-12 col-sm-4">
                           <h5><strong> SUBIR EL DESISTIMIENTO:</strong></h5>
                       </div> 
                       <div class="col-xs-12 col-sm-8">                         
                           <input accept=".pdf" class="form-control-file form-group @error('desistimiento') is-invalid @enderror" id="desistimiento" type="file" name="desistimiento">
@error('desistimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
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
