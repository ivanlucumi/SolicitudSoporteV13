<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$sla->id}}" >
	<form action="{{ route('salas-delete',$sla->id) }}" method="POST">
    @csrf
    @method('DELETE')
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Eliminar Sala</h4>
			</div>
			<div class="modal-body">
				<p style="text-align: center; font-size: 18px;">Corfirme Elimnar  {{$sla->s_nombre}} del piso {{$sla->s_pisos}} y de la Torre: {{$sla->torre}}</p>
			</div>
			<div class="modal-footer">				
				<center><button type="submit" class="btn btn-primary">Confirmar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
			</div>
		</div>
	</div>
	</form>	
</div>