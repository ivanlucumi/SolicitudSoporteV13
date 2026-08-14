<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $despacho->codigoDespacho }}">
	<form action="{{ route('despachos.destroy', $despacho->codigoDespacho) }}" method="POST">
		@csrf
		@method('DELETE')
		<div class="modal-dialog">
			<div class="modal-content" style="border-radius: 1rem; border: 1px solid rgba(0,63,117,0.10); box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
				<div class="modal-header" style="background: linear-gradient(135deg, #003f75 0%, #0056a3 100%); border-radius: 1rem 1rem 0 0;">
					<button type="button" class="close" data-dismiss="modal" aria-label="close" style="color: #fff; opacity: 0.8;">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" style="color: #fff; font-weight: 500;">
						<i class="fa fa-power-off"></i> Inactivar Despacho
					</h4>
				</div>
				<div class="modal-body" style="padding: 2rem;">
					<p style="text-align: center; font-size: 1.1rem; color: #495057;">
						<i class="fa fa-exclamation-circle" style="color: #f0ad4e; font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
						¿Está seguro de <strong style="color: #dc3545;">inactivar</strong> el despacho<br>
						<strong style="color: #003f75;">{{ $despacho->nombreDespacho }}</strong>?
					</p>
					<p style="text-align: center; font-size: 0.85rem; color: #6c757d; margin-top: 0.8rem;">
						El despacho no se eliminará, solo cambiará su estado a <span style="color: #dc3545; font-weight: 600;">Inactivo</span>.
					</p>
				</div>
				<div class="modal-footer" style="border-top: none; padding: 1rem 2rem 2rem; text-align: center;">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 0.6rem; padding: 0.6rem 1.5rem;">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="submit" class="btn btn-danger" style="border-radius: 0.6rem; padding: 0.6rem 1.5rem; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border: none;">
						<i class="fa fa-power-off"></i> Confirmar Inactivación
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
