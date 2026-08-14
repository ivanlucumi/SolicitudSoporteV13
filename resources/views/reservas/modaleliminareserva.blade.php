<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$rsa->id}}" >
	<form action="{{ route('reservas-delete',$rsa->id) }}" method="POST">
    @csrf
    @method('DELETE')
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Deshabilitar Reserva Sala</h4>
			</div>
			<div class="modal-body">
				<p style="text-align: center; font-size: 18px;">Corfirme Deshailitar reserva  {{$rsa->rs_numero_radicado}} del piso xxxxxx y de la Torre: xxxxx</p>
			</div>
			<div class="modal-footer">				
				<center><button type="submit" class="btn btn-primary">Confirmar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
			</div>
		</div>
	</div>
	</form>	
</div>