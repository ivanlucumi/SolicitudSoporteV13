<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-formalizacion-{{$radicado->id}}" >
	<form enctype="multipart/form-data" action="{{ route('admin.subir.formalizacion.teletrabajo.remoto',$radicado->id) }}" method="POST">
    @csrf
    @method('PUT')
	
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">SUBIR FORMALIZACION</h4>
			</div>
			<div class="modal-body">
				<p class="text-danger" style="text-align: center; font-size: 18px; text-danger"  COLOR="red"><h2 class="text-danger">{{$radicado->funcionario_nombre}} {{$radicado->funcionario_apellido}} identificado (a) {{$radicado->funcionario_identificacion}}</h2></p>
				<hr>
				 <div class=" col-xs-12 col-md-12" style="display:back" id="id_anuencia">
                <label for="archivo">Formato de solicitud para teletrabajo:</label>  <br>                          
                <input accept=".pdf" class="form-control-file form-group @error('formalizacion') is-invalid @enderror" id="formalizacion" type="file" name="formalizacion">
@error('formalizacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
			</div>
			<div class="modal-footer">
				<center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button></center>
			</div>
		</div>
	</div>
	</form>	
</div>