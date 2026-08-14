@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Directorio')
@section('cabecera', 'Directorio de los Juzgados')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
					<a href="{!! url('/administrador/directorio/create')!!}" class="btn btn-warning">Crear Item Directorio</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-10">
				<div class="input-group" > <span class="input-group-addon " style="background-color: #F2F4F4">Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
        			<input id="filtrar" type="text" class="form-control" placeholder="Ingresa el item del directorio que deseas Buscar...">
				</div>
			</div>
		</div>
            <hr>


            <!-- /.box-header -->
           <div class="box-body">
				 <div class="table-responsive">
					 <table id="searchtable" class="table table-bordered table-striped">
						<thead>
						    <tr>
						      <th>DESPACHO</th>
						      <th>CIUDAD</th>
						      <th>DIRECCION</th>
						      <th>CREADOR</th>
						      <th>MODIFICADOR</th>
						      <th>ACCIONES</th>				      
					        </tr>
						</thead>
						@foreach($directorio as $dirto)
							<tbody class="buscar">
								<tr class="table-light">
						            <th scope="row">{{$dirto->dDespacho	}}</th>									
									<th scope="row">{{$dirto->dCiudad}}</th>
									<th scope="row">{{$dirto->dDireccion}}</th>
									<th scope="row">{{$dirto->dCreador}}</th>
									<th scope="row">{{$dirto->dModificador}}</th>
									<td>
									    <div class="row">
									      	<div class="col-xs-4">
									      		<a href="{{ route('directorio.edit', $dirto->id) }}" class="btn btn-primary fa fa-pencil"> </a>
									      	</div>
									      	<div class="col-xs-4">
									      		<a href="{{ route('directorio.show', $dirto->id) }}" class="btn btn-primary fa fa-eye"></a>
									      	</div>
									      	<div class="col-xs-4">
									      		<!--<form action="{{ route('directorio.destroy', $dirto->id) }}" method="POST">
    @csrf
    @method('DELETE')
												<button class="btn btn-danger fa fa-close" type="submit">X</button>
												</form>	-->
												<a href="" data-target="#modal-delete-{{$dirto->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
									      	</div>
									    </div>
									</td>					     
								</tr>	                
							</tbody>
						@include('administrador.directorio.modaleliminar')
						@endforeach		               
				     </table>
				  </div>
			 </div>
			<!-- /.box-body -->
			<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>

	<script type="text/javascript">
        $(document).ready(function () {

            (function ($) {

                $('#filtrar').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
      </script> 
@endsection