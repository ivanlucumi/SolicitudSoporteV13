<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $despacho->codigoDespacho }}">
	<form action="{{ route('despachos.destroy', $despacho->codigoDespacho) }}" method="POST">
		@csrf
		@method('DELETE')
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #337ab7; color: white;">
					<button type="button" class="close" data-dismiss="modal" aria-label="close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">
						<i class="fa fa-power-off"></i> Inactivar Despacho
					</h4>
				</div>
				<div class="modal-body text-center" style="padding: 2rem;">
					<p class="lead" style="margin-bottom: 0;">
						<i class="fa fa-exclamation-circle text-warning" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
						&iquest;Est&aacute; seguro de <strong class="text-danger">inactivar</strong> el despacho<br>
						<strong>{{ $despacho->nombreDespacho }}</strong>?
					</p>
					<p class="text-muted" style="margin-top: 1rem;">
						El despacho no se eliminar&aacute;, solo cambiar&aacute; su estado a <strong class="text-danger">Inactivo</strong>.
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="fa fa-power-off"></i> Confirmar Inactivaci&oacute;n
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
