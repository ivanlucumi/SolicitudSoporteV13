<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$tre->id}}" >
	<form action="{{ route('torres-delete',$tre->id) }}" method="POST">
    @csrf
    @method('DELETE')
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Eliminar Torre</h4>
			</div>
			<div class="modal-body">
				<p style="text-align: center; font-size: 18px;">Corfirme Elimnar  {{$tre->t_nombre}}</p>
			</div>
			<div class="modal-footer">				
				<center><button type="submit" class="btn btn-primary">Confirmar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
			</div>
		</div>
	</div>
	</form>	
</div>