@extends('layouts.Almacen.Almacen')
<!--ponerle titulo a la paginga-->
@section('title', 'Almacen Noticias')
@section('cabecera', 'Historico de Solicitudes')



@section('content') 

<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="container">
                <h3>Cargar Inventario desde Excel</h3>
            
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            
                <form action="{{ route('almacen.inventario.importar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="archivo">Seleccione archivo Excel:</label>
                        <input type="file" name="archivo" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Importar Inventario</button>
                </form>
            </div>
        </div>
    </div>
    
</div>


<div id="response-message" class="alert alert-info" style="display: none;"></div>
<div class="table-responsive">
    <table id="table9" class="table  table-hover table-condensed table-bordered">
        <thead style="background-color: #AFAFAF; color: #fff;">
            <tr>
                <th>CODIGO</th>
                <th>ELEMENTO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        @if($elementos != null)
       
            @foreach($elementos as $elemento)
            
            <tbody class="buscar">
                <tr class="table-light">
                    <th scope="row">{{$elemento->inventario_id}}</th>
                    <th scope="row">{{$elemento->descripcion}}</th>
                    <th scope="row">
                        <button class="btn btn-sm btn-toggle-status @if ($elemento->status == 'Disponible') btn-success @else btn-danger @endif"  data-id="{{$elemento->id}}" data-status="{{$elemento->status}}">
                            {{$elemento->status == 'Disponible' ? 'Disponible' : 'No_Disponible'}}
                        </button>
                    </th>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
</div>

    <hr>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Almacen4.js"></script> 


<script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>


<script>
    $(document).ready(function() {
        $('.btn-toggle-status').click(function() {
            var button = $(this);
            var elementoId = button.data('id');
            var currentStatus = button.data('status');
            var newStatus = currentStatus == 'Disponible' ? 'No_Disponible' : 'Disponible';

            $.ajax({
                url: '/almacen/cambiar-estado-elemento',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: elementoId,
                    estado: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        button.data('status', newStatus);
                        button.text(newStatus == 'Disponible' ? 'No_Disponible' : 'Disponible');
                        
                        button.removeClass('btn-success btn-danger'); // Eliminar clases anteriores
                        button.addClass(newStatus == 'Disponible' ? 'btn-success' : 'btn-danger');
                        
                        $('#response-message').text('Estado actualizado correctamente').show().delay(3000).fadeOut();
                    } else {
                        $('#response-message').text('Error al actualizar el estado').show().delay(3000).fadeOut();
                    }
                },
                error: function() {
                    $('#response-message').text('Error en la solicitud').show().delay(3000).fadeOut();
                }
            });
        });
    });
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
 });
</script>
 
  @push('scripts')
 
   

   @endpush
   

@endsection