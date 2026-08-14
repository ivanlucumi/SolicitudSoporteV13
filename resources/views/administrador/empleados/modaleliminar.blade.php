<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$empleado->id}}" >
	<form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" onsubmit="return confirm('Paso 3/3 (Última Advertencia): La eliminación se hará efectiva de inmediato en la base de datos sin vuelta atrás. ¿Desea ejecutar la eliminación?');">
		@csrf
		@method('DELETE')
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Eliminar Empleado</h4>
			</div>
			<div class="modal-body">
				<p style="text-align: center; font-size: 18px;">Corfirme Elimnar Empleado {{$empleado->nameE}} {{$empleado->lastnameE}}</p>
			</div>
			<div class="modal-footer" id="footer-delete-{{$empleado->id}}">
				<center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				    <button type="button" class="btn btn-warning" onclick="
                        if(confirm('Paso 1/3: ¡ADVERTENCIA! Va a eliminar permanentemente a {{$empleado->nameE}} y denegar todo acceso. ¿Está seguro de iniciar el proceso?')){
                            this.style.display='none'; 
                            document.getElementById('btn-confirm-delete-{{$empleado->id}}').style.display='inline-block';
                        }
                    ">Eliminar</button>
                    <button type="submit" id="btn-confirm-delete-{{$empleado->id}}" class="btn btn-danger" style="display:none;" onclick="return confirm('Paso 2/3: Si confirma, el carnet del empleado será revocado permanentemente y todos sus datos se borrarán ahora. ¿Está absolutamente seguro?');">⚠️ CONFIRMAR DESTRUCCIÓN ⚠️</button>
                </center>
			</div>
		</div>
	</div>
	</form>	
</div>