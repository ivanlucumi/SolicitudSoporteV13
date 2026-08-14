<div class="modal fade" id="modal-entregar" >
	<form id="form-solicitar-audiencia-" action="{{ route('soltar.prestamo') }}" method="POST">
    @csrf
    <input class="form-control @error('text') is-invalid @enderror" placeholder="Ingresa email" required="required" id="id_expediente" type="email" name="text" value="{{ old('text') }}">
@error('text')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Entregar Expediente</h4>
			</div>
			<div class="modal-body">
				<p style="text-align: center; font-size: 18px;">Corfirme Entrega de Expediente  ##### del piso xxxxxx y de la Torre: xxxxx</p>
			</div>
			<div class="modal-footer">
				<center><button type="submit" class="btn btn-primary">Confirmar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
			</div>
		</div>
	</div>
	</form>
</div>
