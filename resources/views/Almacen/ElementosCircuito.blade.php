@extends('layouts.Almacen.Almacen')
<!--ponerle titulo a la paginga-->
@section('title', 'Elementos Circuitos')
@section('cabecera', 'Elementos disponibles En el Circuito')

@section('content')

@if( auth()->user()->email == "root10@gmail.com")
<div class="container">
    <h3>Registrar Inventario en Circuito</h3>

    <form method="POST" action="{{ route('inventarios_circuitos.save') }}">
        @csrf

        <div class="form-group">
            <label for="inventario_general_id">Seleccione Elemento del Almac&eacute;n:</label>
            <select name="inventario_general_id" id="inventario_general_id" class="form-control select2" required>
                <option value="">-- Seleccione --</option>
                @foreach($inventarios as $inv)
                    <option value="{{ $inv->inventario_id }}"> {{ $inv->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div id="nuevoElemento" style="display: none;">
            <div class="form-group">
                <label for="nuevo_codigo">C&oacute;digo Interno:</label>
                <input type="text" class="form-control" name="nuevo_codigo" id="nuevo_codigo">
            </div>
            <div class="form-group">
                <label for="nueva_descripcion">Descripci&oacute;n:</label>
                <input type="text" class="form-control" name="nueva_descripcion" id="nueva_descripcion">
            </div>
        </div>

        <div class="form-group">
            <label for="cantidad_disponible">Cantidad Disponible:</label>
            <input type="number" class="form-control" name="cantidad_disponible" required>
        </div>

        

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<form action="{{ route('inventario.importarExcel.Circuito') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="archivo_excel">Cargar archivo Excel</label>
        <input type="file" name="archivo_excel" id="archivo_excel" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Importar Elementos</button>
</form>


@endif
<hr>

<div id="response-message" class="alert alert-info" style="display: none;"></div>
<div class="table-responsive">
    <table id="table9" class="table  table-hover table-condensed table-bordered">
        <thead style="background-color: #AFAFAF; color: #fff;">
            <tr>
                <th>CODIGO</th>
                <th>ELEMENTO</th>
                <th>REGISTRADO</th>
                <th>DISPONIBLE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        @if($elementos != null)
       
            @foreach($elementos as $elemento)
            
            
            
            <tbody class="buscar">
                <tr class="table-light">
                    <th scope="row">{{$elemento->inventario->inventario_id}}</th>
                    <th scope="row">{{$elemento->inventario->descripcion}}</th>
                    <th scope="row">{{$elemento->cantidad_disponible}}</th>
                    <th scope="row">{{$elemento->disponible}}</th>
                    <th scope="row">
                        @if($elemento->cantidad_disponible > 0)
                         <button class="btn btn-sm btn-toggle-status btn-success">
                            Disponible
                        </button>
                        @else
                         <button class="btn btn-sm btn-toggle-status btn-danger">
                           No_Disponible
                        </button>
                        @endif
                        <!--button class="btn btn-sm btn-toggle-status @if ($elemento->status == 'Disponible') btn-success @else btn-danger @endif"  data-id="{{$elemento->id}}" data-status="{{$elemento->status}}">
                            {{$elemento->status == 'Disponible' ? 'Disponible' : 'No_Disponible'}}
                        </button-->
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


<!--script>
    $(document).ready(function() {
        $('.btn-toggle-status').click(function() {
            var button = $(this);
            var elementoId = button.data('id');
            var currentStatus = button.data('status');
            var newStatus = currentStatus == 'Disponible' ? 'No_Disponible' : 'Disponible';

            $.ajax({
                url: '/almacen/cambiar-estado-elemento/circuito',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: elementoId,
                    estado: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        button.data('status', newStatus);
                        button.text(newStatus == 'Disponible' ? 'Disponible' : 'No_Disponible');
                        
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
</script-->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
 });
</script>
 
<hr>

<script>
    $(document).ready(function () {
        $('#inventario_general_id').select2();

        $('#inventario_general_id').on('select2:select', function (e) {
            const nuevo = document.getElementById('nuevoElemento');
            const valorSeleccionado = e.params.data.id;
            
            if (valorSeleccionado === '1000000') {
                nuevo.style.display = 'block';
            } else {
                nuevo.style.display = 'none';
            }
        });
    });
</script>

@endsection
 