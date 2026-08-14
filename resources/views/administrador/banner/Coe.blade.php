@extends('layouts.admin')

@section('title', 'Banner')
@section('cabecera', 'Crear Banner Coe')

@section('content') 
@include('../alerts.request')

<form action="{{ route('baner.coe.store') }}" method="POST" enctype="multipart/form-data" id="formBanner">
    @csrf

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bNombre" class="fa fa-asterisk"> Descripción Noticia:</label>
                <input type="text" name="bNombre" id="bNombre" class="form-control" placeholder="Ingrese la descripción de la noticia" required>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="form-group">
                <label for="bMedia">Archivo (Imagen o Video):</label>
                <input type="file" name="bFoto" id="bMedia" class="form-control" accept=".jpeg,.jpg,.png,.gif,.mp4,.webm">
                <small class="text-muted">Solo imágenes (.jpg, .png, .gif) o videos (.mp4, .webm)</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bLink">URL página:</label>
                <input type="text" name="bLink" id="bLink" class="form-control" placeholder="ej: www.google.com">
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                <label for="bTiempo">Seleccione días para la publicación:</label>
                <select name="bTiempo" id="bTiempo" class="form-control" required>
                    <option value="">Seleccione Cantidad de Días</option>
                    <option value="2">2 Días</option>
                    <option value="3">3 Días</option>
                    <option value="5">5 Días</option>
                    <option value="10">10 Días</option>
                </select>
            </div>
        </div>
         <div class="col-xs-3">
            <div class="form-group">
                <label for="bEstado" class="fa fa-asterisk"> Estado Publicación:</label>
                <select name="bEstado" id="bEstado" class="form-control">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
        </div>
    </div>

       
        
         <input type="hidden" name="bCreador" id="bCreador" class="form-control" value="{{  auth()->user()->name }}" readonly>

   

    <!--div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="documento">Generar Link Documento:</label>
                <input type="file" name="documento" id="documento" class="form-control-file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
                <small class="text-muted">Este campo genera un enlace acortado si no se usa bLink.</small>
            </div>
        </div>
    </div-->

    <div class="row">
        <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block">Guardar Banner</button>
        </div>
        <div class="col-xs-6">
            <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancelar</a>
        </div>
    </div>
</form>

<!--script>
document.getElementById('formBanner').addEventListener('submit', function(e) {
    const media = document.getElementById('bMedia').files[0];
    const doc = document.getElementById('documento').files[0];

    if (media && doc) {
        alert('No puede subir imagen/video junto con un documento. Por favor elija solo uno.');
        e.preventDefault();
    }
});
</script-->

<hr>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>NOMBRE</th>
				<th>IMAGEN</th>
				<th>URL</th>
				<th>CREADO</th>
				<th>TIEMPO</th>
				<th>ESTADO</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($banner != null)
		    @foreach($banner as $bnnr)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$bnnr->bNombre}}</th>
					<th scope="row">
						<img src="/img/{{$bnnr->bFoto}}" alt="" style="width:100px;" loading="lazy">
					</th>									
					<th scope="row" ><div style="word-wrap: break-word;height: auto;width: 90px;">{{$bnnr->bLink}}</div></th>
					<th scope="row" ><div style="word-wrap: break-word;height: auto;width: 90px;">{{$bnnr->created_at}}</div></th>
					<th scope="row">{{$bnnr->bTiempo}}</th>
					@if($bnnr->bEstado == 1)
						<th scope="row">Activo</th>
					@else
						<th scope="row">Inactivo</th>									  
					@endif								
					<th scope="row">{{$bnnr->bCreador}}</th>
					<th scope="row">{{$bnnr->bModificador}}</th>
					<td scope="row">
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ route('banner.edit', $bnnr->id) }}" class="btn btn-primary fa fa-pencil"> </a>
							</div>
							<div class="col-xs-6">
								<!--<form action="{{ route('banner.destroy', $bnnr->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$bnnr->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</td>					     
				</tr>	                
			</tbody>
			@include('administrador.banner.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterOcho.js"></script> 
@endsection
