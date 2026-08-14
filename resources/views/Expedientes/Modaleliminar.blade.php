<div class="modal fade" id="modal-eliminar-radicado" >
    <form id="form-eliminar-radicado" action="{{ route('delete.registro.expediente') }}" method="POST">
    @csrf
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<center>
				<h3 class="modal-title">ELIMINAR RADICADO<br> <strong> <span id="expediente">.</strong> </span></h3> 
				</center>
			</div>
			<div class="modal-body">
				<input class="form-control" placeholder="Ingresa email" required="required" id="id_expediente" type="hidden" name="id" value="{{ '' }}">
				
			</div>
			<div class="modal-footer">
				<center><button type="submit" class="btn btn-primary">Confirmar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
			</div>
		</div>
	</div>
	</form>
</div>