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
    
    <div class="col-xs-12 col-md-6">
         <center>
              <h2>
                 <strong>SOLICITUD DE {{ $Solicitudes[0]->NomDespacho->nombreDespacho }} <br>C&Oacute;DIGO DESPACHO {{$Solicitudes[0]->id_despacho}}</strong>
              </h2>
          </center> 
    </div>
    
     <div class="col-xs-12 col-md-6">
         <p>
             <h3>
                 <strong>
                     NUMERO SEGUIMIENTO:  {{$Solicitudes[0]->num_seguimiento}}<br>
                     TITULAR DESPACHO: {{$Solicitudes[0]->nombre}} {{$Solicitudes[0]->apellido}}
                     <br> CEDULA: {{$Solicitudes[0]->cedula}} <br>
                 </strong>
             </h3>
             
         </p>
        
    </div>
    
 
    
</div>
<form method="POST" action="{{ route('almacen.Elementos.Notificacion') }}" id="form-entrega">

 @csrf
 
<div id="response-message" class="alert alert-info" style="display: none;"></div>
<div class="table-responsive">
    <table id="table9" class="table  table-hover table-condensed table-bordered">
        <thead style="background-color: #AFAFAF; color: #fff;">
            <tr>
                <th>ID ELEMENTO.</th>
                <th>ELEMENTO</th>
                <th>CANTIDAD SOLICITADA</th>
                <th>FECHA SOLICITUD</th>
                <th>OBSERVACIONES</th>
                <th>CANTIDAD ENTREGADA</th> <!-- Nueva columna --> 
                @if( auth()->user()->circuito_almacen != "CALI")
                <th>CANTIDAD DISPONIBLE</th>
                @endif
            </tr>
        </thead>
        @if($Solicitudes != null)
            <a href="{{ route('generate.csv.solicitud', ['num_seguimiento' => $Solicitudes[0]->num_seguimiento]) }}" class="btn btn-primary btn-sm">GENERAR CSV</a>
            @foreach($Solicitudes as $solicitud)
            
            <tbody class="buscar">
                <tr class="table-light">
                    <input type="hidden" class="form-control cantidad-entregada" name="id" value="{{$solicitud->num_seguimiento}}">
                    <input type="hidden" name="despacho_id" value="{{$solicitud->id_despacho}}">
                    <th scope="row">{{$solicitud->id_elemento}}</th>
                    <th scope="row">{{$solicitud->elemento}}</th>
                    <th scope="row">{{$solicitud->cantidad}}</th>
                    <th scope="row">{{$solicitud->fecha_solicitud}}</th>
                    <th scope="row">{{$solicitud->observaciones}}</th>
                    <th>
                        <input type="number" class="form-control cantidad-entregada" data-id="{{$solicitud->id}}" min="0" value="{{$solicitud->cantidad_entregada ?? ''}}" required>
                    </th> <!-- Campo de entrada -->
                    @if( auth()->user()->circuito_almacen != "CALI")
                    <th scope="row">{{ $solicitud->disponible ?? 'N/A' }}</th>
                    @endif
                </tr>
            </tbody>
            
            
            @endforeach
        @endif
    </table>
</div>

    <hr>

 <div class="col-xs-12 col-sm-12">
     
<!-- Botón de descarga CSV (fuera de la tabla) -->

         
           <div class="col-md-6 col-md-offset-3 mt-3 mb-3 sombra" id="seguimientoForm" style="display: ;">
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
            
            <br>
    <hr>
    <div class="col-md-6 col-md-offset-4 mt-3 mb-3 ">
                     <a class="btn btn-warning btn-lg" href="{{ route('almacen.Solicitudes') }}">
                        CANCELAR
                        </a>
    </div>
    </div>
    
       
    </div>


  
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
                        responseMessage.innerText = data.message;
                        responseMessage.classList.remove('alert-danger');
                        responseMessage.classList.add('alert-info');
                    } else {
                        responseMessage.innerText = data.message;
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
                    }, 5000);
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

<script>
$(document).ready(function(){
    // Función para verificar si todos los campos de cantidad entregada están llenos
    function checkFields() {
        let allFilled = true;
        // Solo selecciona los inputs que son de tipo number para evitar los hidden
        $('.table-responsive input.cantidad-entregada[type="number"]').each(function(){
            if($(this).val() === "" || $(this).val() === null){
                allFilled = false;
                return false; // Sale del each
            }
        });
        if(allFilled) {
            $('#download-btn').show();
        } else {
            $('#download-btn').hide();
        }
    }

    // Verificar al cargar la página en caso de que ya haya datos precargados
    checkFields();

    // Monitorear cambios en los inputs de cantidad entregada
    $(document).on('input', '.table-responsive input.cantidad-entregada[type="number"]', function(){
        checkFields();
    });

    // Acción al hacer clic en el botón de descarga
    $('#download-btn').click(function(){
        // Redirige a la ruta de descarga
    });
});
</script>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Almacen4.js"></script> 
 
  @push('scripts')
 
   

   @endpush
   

@endsection