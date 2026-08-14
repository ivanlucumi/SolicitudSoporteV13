@extends('layouts.Almacen.Almacen')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes')
@section('cabecera', 'Solicitudes')



@section('content') 


<style>
    .sombra {
  /* Add a relief effect */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  /* Add a shadow effect */
  filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.5));
  /* Add some depth with a pseudo-element */
  position: relative;
}

.sombra::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
  z-index: -1;
}

table {
  /* Add a border to the table */
  border-collapse: collapse;
  border: 1px solid #ccc;
}

th, td {
  /* Add a border to each cell */
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
  /* Add rounded borders to each cell */
  border-radius: 10px;
}

/* Add stripes to the table */
tbody tr:nth-child(even) {
  background-color: #D5F5E3;
}

tbody tr:nth-child(odd) {
  background-color: #fff;
}
</style>


<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="" style="text-align: ">
	      
            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('almacen.Solicitudes') }}" method="POST">
    @csrf
               <div class="col-xs-12 col-md-6 ">
                        <label for="despacho">Seleccione Despacho:</label>
                        <select class="form-control select2 @error('despacho') is-invalid @enderror" autocomplete="off" name="despacho" id="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho', $despacho) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div><br>
                <button class="form-group btn btn-success btn-md my-2 my-sm-0 shadow" type="submit">BUSCAR DESPACHO</button>
                <a href="{!! route('almacen.Solicitudes')!!}" class="btn btn-warning btn-md">VER TODOS</a> 
              </form>
            </nav>
          </div>

    </div>
    <div class="col-xs-12 col-sm-6">
        <br>
                <a href="{!! route('almacen.solicitudelemento.excel')!!}" class="btn btn-danger btn-md">DESCARGAR TODO</a> 
                <hr>
        
    </div>
    <div class="col-xs-12 col-sm-12">
         <!--div class="" style="text-align: ">
	      
            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('almacen.Elementos.Notificacion') }}" method="POST">
    @csrf
              @csrf
               <div class="col-xs-12 col-md-12 ">
                        <label for="despacho">Seleccione Despacho Para cerrar Solicitud:</label>
                        <select class="form-control select2 @error('despacho') is-invalid @enderror" autocomplete="off" id="despachoSelect" style="width:450px" name="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                    </div><br>
                 
              
            </nav>
          </div-->
           <div class="col-md-6 col-md-offset-3 mt-3 mb-3 sombra" id="seguimientoForm" style="display: none;">
            <h2 id="formTitle"></h2>
                
                <input type="hidden" name="despacho" id="despachoHidden">
    
                <div class="form-group">
                    <label for="seguimiento"># Salida o Acta de Entrega</label>
                    <input type="text" class="form-control" id="seguimiento" name="seguimiento" required autocomplete="off">
                </div>
    
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3" required></textarea>
                </div>
                
                <div class="col-md-offset-4 mt-3 mb-3">
                     <button class="form-group btn btn-success btn-lg my-2 my-sm-0 shadow" type="submit">CERRAR SOLICITUD</button>
                </div>
    
               
                </form>
            </form>
    </div>
       
    </div>
    
</div>

<div id="response-message" class="alert alert-info" style="display: none;"></div>
<div class="table-responsive">
    <table id="table9" class="table  table-hover table-condensed table-bordered">
        <thead style="background-color: #AFAFAF; color: #fff;">
            <tr>
                <th>VER SOLICITUD</th>
                <th>CODIGO DESPACHO</th>
                <th>FECHA SOLICITUD</th>
                <th>DESPACHO</th>
                <th>ELEMENTOS SOLICITADOS</th>
                <th>TOTAL</th>
                <th>OBSERVACIONES</th> <!-- Nueva columna -->
            </tr>
        </thead>
        @if($Solicitudes != null)
            @foreach($Solicitudes as $solicitud)
            <tbody class="buscar">
                    <tr class="table-light" @if($solicitud->id_quien_atendio ==  auth()->user()->id)
                        <?php echo 'style="background-color: #C3F8BC"'; ?>
                        @endif
                        @if($solicitud->id_quien_atendio == null)                 
                        <?php echo 'style="background-color: #"'; ?>
                        @endif
                        @if($solicitud->id_quien_atendio !=  auth()->user()->id)
                        <?php echo 'style="background-color: #FBBAB4"'; ?>
                        @endif>
                        <th scope="row">
                                @if(!empty($solicitud->num_seguimiento))
                                 @if($solicitud->id_quien_atendio == null || $solicitud->id_quien_atendio ==  auth()->user()->id) 
                                    <a class="btn btn-warning" href="{{ route('almacen.solicitudelemento.despacho', $solicitud->num_seguimiento) }}">
                                        VER SOLICITUD
                                    </a>
                                 @else
                                  <button class="btn btn-danger"  disabled>
                                      EN TRAMITE
                                  </button>
                                 @endif
                                @endif
                            </th>
                            <th scope="row">
                                {{$solicitud->id_despacho}}
                            </th>
                            <th scope="row">{{ $solicitud->fecha_solicitud }}</th>
                            <th scope="row">{{ $solicitud->NomDespacho?->nombreDespacho ?? 'Error De Despacho, Informar a Sistemas' }}</th>
                            <th scope="row">{{$solicitud->total_elementos}}</th>
                            <th scope="row">{{$solicitud->total_cantidad}}</th>
                            <th scope="row">{{$solicitud->observaciones_combinadas}}</th>
                        
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
  
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.cantidad-entregada');
        const responseMessage = document.getElementById('response-message');
        
        inputs.forEach(input => {
            input.addEventListener('change', function () {
                const id = this.getAttribute('data-id');
                const cantidad_entregada = this.value;
                
                fetch('{{ route('almacen.updateCantidad') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id,
                        cantidad_entregada: cantidad_entregada
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        responseMessage.innerText = 'Cantidad entregada actualizada con éxito';
                        responseMessage.classList.remove('alert-danger');
                        responseMessage.classList.add('alert-info');
                    } else {
                        responseMessage.innerText = 'Hubo un error al actualizar la cantidad entregada';
                        responseMessage.classList.remove('alert-info');
                        responseMessage.classList.add('alert-danger');
                    }
                    responseMessage.style.display = 'block';
                    setTimeout(() => {
                        responseMessage.style.display = 'none';
                    }, 3000);
                })
                .catch(error => {
                    responseMessage.innerText = 'Error: ' + error.message;
                    responseMessage.classList.remove('alert-info');
                    responseMessage.classList.add('alert-danger');
                    responseMessage.style.display = 'block';
                    setTimeout(() => {
                        responseMessage.style.display = 'none';
                    }, 3000);
                });
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#despachoSelect').change(function() {
            var despacho = $(this).val();
            var select = document.getElementById('despachoSelect');
            var selectedOption = this.options[select.selectedIndex];
            if (despacho) {
                $('#seguimientoForm').show();
                $('#formTitle').text('FORMULARIO DE CIERRE  '+selectedOption.text);
                $('#despachoHidden').val(despacho);
            } else {
                $('#seguimientoForm').hide();
            }
        });
    });
</script>
 
  @push('scripts')
 
   

   @endpush
   

@endsection