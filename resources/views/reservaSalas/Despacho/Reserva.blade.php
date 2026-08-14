@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera')
<div class="container-fluid">
    <div class="row text-center fade-in">
        
       @foreach($Ubicaciones  as $ubicacion)
                <div class="col-xs-12 col-sm-3">
                <?php $nombre1= $Ubicaciones[0]->ciudad->nombre_edificio ?>
                @if($nombre1 != $ubicacion->ciudad->nombre_edificio)
                     <h5 class="mt-3 mb-2 text-uppercase" style="color: #2C3E50; font-weight: bold;">{{$ubicacion->ciudad->nombre_edificio}}</h5>
                @else
                     <h5 class="mt-3 mb-2 text-uppercase" style="color: #2C3E50; font-weight: bold;">{{$Ubicaciones[0]->ciudad->nombre_edificio}}</h5>
                @endif
                <a href="{{ route('usuario.reservas.reserva.salas', $ubicacion->id) }}" 
                   class="btn btn-piso fa fa-building">
                    {{ $ubicacion->ubicacion_nombre }}
                </a>
                
               </div> 
            @endforeach  
    </div>
</div>

<h2><strong>REGISTRE SU REQUERIMIENTO EN  {{$edificio->nombre_edificio}} {{$ubicacion->ubicacion_nombre}}  {{$nombre->sala_nombre}}</strong></h2>

@endsection

@section('content')


<div id="msj-warning" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
  <strong>Reserva eliminada</strong>
</div>

@push('style')
<link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">
<link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">
<!-- Include a required theme -->
<link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
<script src="sweetalert2/dist/sweetalert2.min.js"></script>

@endpush

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-lg-offset-5">
      <div id='loading'><i class="fa fa-refresh fa-spin fa-5x"></i>loading...</div>
    </div>
    
  </div>
  <div class="row">
    
    <div class="col-xs-12 col-sm-12">
        <div id="calendar"></div>
    </div>
    
  </div>
  
</div>
<br>


<form id="form" action="{{ route('reservas.store.salas') }}" method="POST">
    @csrf
<div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content" >
              <div class="modal-header" style="background-color:#B3DAB3">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>RESERVE SU ESPACIO </strong> <br> Tenga en cuenta de no sobreponer en otro horario</h4>
              </div>
              <div class="modal-body">

                <div class="container-fluid">
                  <div class="row">
                   <h3> <p style="text-align: center"> RESERVA <strong>{{$nombre->sala_nombre}}</strong> </p></h3>
                      
                    </div>
                    <input [ 'id'="'sala_id', 'class' => 'form-control ','style'=>'width: 100%;','min'=>'1','required'=>'required','autocomplete'=>&quot;off&quot;]" type="hidden" name="sala_id" id="sala_id" value="{{ $salon }}">
                      
                      <div class="row">
                          <div class="col-xs-3 form-group ">           
                                    <label for="fechaI">Fecha Inicio:</label><br>
                                    <input id="fechaI" class="form-control @error('fechaI') is-invalid @enderror" placeholder="Hora inicio" type="text" name="fechaI" value="{{ old('fechaI') }}">
@error('fechaI')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div> 
                                <div class="col-xs-3 form-group " >
                                  <label for="horaI">Hora Inicio:</label>
                                  <input id="horaI" class="form-control  @error('horaI') is-invalid @enderror" placeholder="Nombre encargado" type="text" name="horaI" value="{{ old('horaI') }}">
@error('horaI')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class="col-xs-3 form-group ">           
                                    <label for="fechaF">Fecha Fin:</label><br>
                                    <input id="fechaF" class="form-control @error('fechaF') is-invalid @enderror" placeholder="Hora inicio" type="text" name="fechaF" value="{{ old('fechaF') }}">
@error('fechaF')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div> 
                                <div class="col-xs-3 form-group " >
                                  <label for="horaF">Hora Fin:</label>
                                  <input id="horaF" class="form-control  @error('horaF') is-invalid @enderror" placeholder="Nombre encargado" type="text" name="horaF" value="{{ old('horaF') }}">
@error('horaF')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                      </div>
                  
                      <div class="row">
                               
                               <div class="col-xs-12 form-group ">            
                                    <label for="Radicado">Radicado:</label><br>
                                    <input [ 'id'="'radicacion', 'class' => 'form-control ','style'=>'width: 100%;','min'=>'1','placeholder'=>'Ingrese Radicado Del Proceso (23 Digitos)','required'=>'required','autocomplete'=>&quot;off&quot;]" type="number" name="radicacion" id="radicacion" value="{{ old('radicacion') }}" class="@error('radicacion') is-invalid @enderror">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                     <strong id="valRadicado" style="display: none; color: red">Campo requerido</strong>
                                     <strong id="cantidad"></strong>
                              </div> 
                               <div class="col-xs-12 form-group ">            
                                    <label for="Fiscal">Demandante o Fiscal&iacute;a:</label><br>
                                    <input [ 'id'="'nombre_fiscal', 'class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Registre Nombre Fiscalia','required'=>'required']" type="text" name="nombre_fiscal" id="nombre_fiscal" value="{{ old('nombre_fiscal') }}" class="@error('nombre_fiscal') is-invalid @enderror">
@error('nombre_fiscal')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                     <strong id="valFiscal" style="display: none; color: red">Campo requerido</strong>
                              </div> 
                              <div class="col-xs-12 form-group " >
                                  <label for="Nombre">Demandado o Indiciado:</label>
                                  <input id="nombre_indiciado" class="form-control @error('nombre_indiciado') is-invalid @enderror" placeholder="Nombre Demandado o Indiciado" required="required" type="text" name="nombre_indiciado" value="{{ old('nombre_indiciado') }}">
@error('nombre_indiciado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                  <strong id="valnombre_indiciado" style="display: none; color: red">Campo requerido</strong>
                                </div>   
                             <div class="col-xs-12 form-group" style="height: 160px; width: 100%" >
                                    <label for="descripcion">Descripcion :</label><br>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descripcion Breve de la Reserva." name="description">{{ old('description') }}</textarea>
@error('description')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                    <strong id="valdescripcion" style="display: none; color: red">Campo requerido</strong>
                             </div>
                     
                               
                         </div>                    
                </div>
        

              </div>
              <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-6 ">
                    <a href="#" id="reservar" class="btn bg-black btn-block">Reservar</a>
                  </div>
                  <div class="col-xs-6 ">
                    <a href="#!" class="btn bg-red btn-block" type="button">Cancelar</a>
                  </div>
                  
                </div>                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
          
      </form>  

      <!--script para almacenar evento-->  
   
   
   <!--MODAL PARA MOSTRAR Y ELIMINAR-->  
   <!-- Modal -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#B3DAB3">
        <h2 class="modal-title" id="exampleModalLongTitle"><center> <strong>RESERVA {{$nombre->sala_nombre}}</strong></center></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
           <div class="row">
               <form id="form-eliminar" action="{{ route('eliminar.reservas.salas') }}" method="POST">
    @csrf
               
               <input id="id" class="form-control" placeholder="Hora inicio" type="hidden" name="id" value="{{ '' }}">
                          <div class="col-xs-3 form-group ">           
                                    <label for="fechaI">Fecha Inicio:</label><br>
                                    <input id="_fechaI" class="form-control @error('fechaI') is-invalid @enderror" placeholder="Hora inicio" type="text" name="fechaI" value="{{ old('fechaI') }}">
@error('fechaI')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div> 
                                <div class="col-xs-3 form-group " >
                                  <label for="horaI">Hora Inicio:</label>
                                  <input id="_horaI" class="form-control  @error('horaI') is-invalid @enderror" placeholder="Nombre encargado" type="text" name="horaI" value="{{ old('horaI') }}">
@error('horaI')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class="col-xs-3 form-group ">           
                                    <label for="fechaF">Fecha Fin:</label><br>
                                    <input id="_fechaF" class="form-control @error('fechaF') is-invalid @enderror" placeholder="Hora inicio" type="text" name="fechaF" value="{{ old('fechaF') }}">
@error('fechaF')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div> 
                                <div class="col-xs-3 form-group " >
                                  <label for="horaF">Hora Fin:</label>
                                  <input id="_horaF" class="form-control  @error('horaF') is-invalid @enderror" placeholder="Nombre encargado" type="text" name="horaF" value="{{ old('horaF') }}">
@error('horaF')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                      </div> 
        </div>
        <div class="row">
         
                <div class="col-xs-12 form-group ">            
                    <label for="Radicado">Radicado:</label><br>
                    <input [ 'id'="'_radicacion', 'class' => 'form-control ','style'=>'width: 100%;','min'=>'1','placeholder'=>'Ingrese Radicado Del Proceso (23 Digitos)','required'=>'required','autocomplete'=>&quot;off&quot;,'readonly']" type="number" name="radicacion" id="radicacion" value="{{ old('radicacion') }}" class="@error('radicacion') is-invalid @enderror">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>  
                 <div class="col-xs-12 form-group ">            
                    <label for="Fiscal">Demandante o Fiscal&iacute;a:</label><br>
                    <input [ 'id'="'_nombre_fiscal', 'class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Registre Nombre Fiscalia','required'=>'required','readonly']" type="text" name="nombre_fiscal" id="nombre_fiscal" value="{{ old('nombre_fiscal') }}" class="@error('nombre_fiscal') is-invalid @enderror">
@error('nombre_fiscal')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                 </div>
                 <div class="col-xs-12 form-group " >
                    <label for="Nombre">Demandado o Indiciado:</label>
                    <input id="_nombre_indiciado" class="form-control @error('nombre_indiciado') is-invalid @enderror" placeholder="Nombre Demandado o Indiciado" required="required" type="text" name="nombre_indiciado" value="{{ old('nombre_indiciado') }}">
@error('nombre_indiciado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                 </div> 
        </div>
        <div class="row">
             <div class="col-xs-12 form-group" style="width: 100%;">
                <label for="descripcion">Descripcion :</label><br>
                <textarea id="_description" class="form-control @error('description') is-invalid @enderror" placeholder="Descripcion Breve de la Reserva." name="description">{{ old('description') }}</textarea>
@error('description')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
        </div>
      </div>
      <div class="modal-footer" id="eliminarRe" style="display:none">
         <div class="row">
             <div class="col-xs-6 form-group "> 
             <button type="button"  class="btn btn-primary btn-block" data-dismiss="modal">CERRAR</button>
             </div>
             <div class="col-xs-6 form-group "> 
             <a href="#" id="eliminarEvento" class="btn bg-danger btn-block">ELIMINAR RESERVA</a>
             </form>
             </div>
         </div>
        
        
      </div>
    </div>
  </div>
</div>
   
   <!--MODAL PARA MOSTRAR Y ELIMINAR-->  



@push('scripts')


<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
<!-- fullCalendar -->
<script src="/fullcalendar/moment/moment.js"></script>
<script src="/fullcalendar/fullcalendar/dist/fullcalendar.js"></script>
<script src="/fullcalendar/fullcalendar/dist/locale/es.js"></script>

<script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
  })
    /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('radicacion');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })
   //verificar los 23 digitos
    var input = document.getElementById('radicacion');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })
</script>



<style>

  body {
    margin: 0;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #script-warning {
    display: none;
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    color: black;
  }

  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendar {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 10px;
  }
  .fc-title,.fc-time{
    color: black;
  }

</style>


<script>
  $(function () {
   
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
       
    $('#calendar').fullCalendar({
      height: 758,
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'agendaWeek,agendaDay,listDay'
      },
     
      
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week : 'Semana',
        day  : 'Dia',
        list : 'Horario del Día'
      },
      
      select: function(start,end)
      {
          console.log('entro');
        // leemos las fechas de inicio de evento y hoy
        var check = moment(start).format('YYYY-MM-DD');
        var today = moment(new Date()).format('YYYY-MM-DD');
         
         // si el inicio de evento ocurre hoy o en el futuro mostramos el modal
      if (check >= today) { 
        start = moment(start.format());
        end = moment(end.format());
 
        $('#radicacion').val(" ");
        $('#nombre_fiscal').val(" "); 
        $('#nombre_indiciado').val(" ");  
        $('#description').val(" "); 
        
        $('#fechaI').val(start.format('YYYY-MM-DD '));
        $('#horaI').val(start.format(' HH:mm:ss'));
        $('#fechaF').val(end.format('YYYY-MM-DD '));
        $('#horaF').val(end.format('HH:mm:ss'));
        
        $('#modal').modal('show');
      }
      // si no, mostramos una alerta de error
      else {
          Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: 'No se puede agendar en fechas Pasadas!',
                      footer: ''
                    })
      }
        
      },

        events    : '/usuarios/evento/salas/<?php echo $salon ?>',
       
        
       loading: function(bool) {
        $('#loading').toggle(bool);
      },

      

      eventClick: function(event, jsEvent, view)
          {
              
              console.log(event);
        
            $('#id').val(event.id);            
            $('#_title').val(event.title); 
            $('#_radicacion').val(event.radicacion);
            $('#_nombre_fiscal').val(event.nombre_fiscal); 
            $('#_nombre_indiciado').val(event.nombre_indiciado);
            $('#_description').val(event.description);  
            $('#_fechaI').val(event.start.format('YYYY-MM-DD '));
            $('#_horaI').val(event.start.format(' HH:mm:ss'));
            $('#_fechaF').val(event.end.format('YYYY-MM-DD '));
            $('#_horaF').val(event.end.format('HH:mm:ss'));
            $('#_id').val(event.id);
            var reserva = event.reservado;
            var div2 = document.getElementById('eliminarRe');      
              
             if(event.user_id == <?php echo  auth()->user()->id ?>){
              
              div2.style.display = 'block';                                 
             }else{
              div2.style.display = 'none';  
             };  
                     
            
            $('#modal_eliminar').modal('show');
          },
          selectable: <?php echo $reserva ?>,
          selectHelper: true,
          defaultView: 'agendaWeek',
          dayNames: ['Domingo','Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
          minTime: '07:00',
          maxTime: '23:59',
          editable  : false,
          droppable : false, // this allows things to be dropped onto the calendar !!!
          allDaySlot:false,

      
    })

  })
  
  </script>
  <script>
      $("#reservar").click(function(e){
            e.preventDefault();
            
            
           var asignatura = $('#radicacion').val();
            if(asignatura.length != 23){
              $("#valRadicado").fadeIn(1000);
              $("#valRadicado").fadeOut(5000);
              return;
            }
            var personaAcargo = $('#nombre_fiscal').val();
            if(personaAcargo.length == 0){
              $("#valFiscal").fadeIn(1000);
              $("#valFiscal").fadeOut(5000);
              return;
            }
            var programa = $('#nombre_indiciado').val();
             if(programa.length == 0){
              $("#valnombre_indiciado").fadeIn(1000);
              $("#valnombre_indiciado").fadeOut(5000);
              return;
            }
            /*var descripcion = $('#description').val();
             if(descripcion.length == 0){
              $("#valdescripcion").fadeIn(1000);
              $("#valdescripcion").fadeOut(5000);
              return;
            }*/
            
            var salon = $('#salon').val();
            var fechaI = $('#fechaI').val();
            var horaI = $('#horaI').val();
            var fechaF = $('#fechaF').val();
            var horaF = $('#horaF').val();            
            var token = $('#token').val();
            
           
          
            $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              url: '/usuarios/reservas/salas/store',
              type: 'POST',
              datatype: 'json',
              data: $('#form').serialize(),
              /*data: { 'asignatura': asignatura,
                      'personaAcargo':personaAcargo,
                      'programa': programa,
                      'salon': salon,
                      'fechaI': fechaI,

                    },*/
              success:function(data){
                  $('#modal').modal('hide');
                 
                Swal.fire({
                          title: 'SALA RESERVADA CON EXITO!',
                          text: "<?php echo $nombre->sala_nombre ?> RESERVADA ",
                          icon: 'warning',
                          showCancelButton: false,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'CERRAR'
                        }).then((result) => {
                          if (result.isConfirmed) {
                          window.location.reload();
                          }else{
                              window.location.reload();
                          }
                        })
                
                

              },

               error: function() {
                 Swal.fire({
                      icon: 'error',
                      title: 'Opppss...',
                      text: '<?php echo $nombre->sala_nombre ?>. Error al hacer la reserva!',
                      footer: ''
                    })
              }



                           
            })
          });
          
    $("#eliminarEvento").click(function(e){
            e.preventDefault();
            var token = $('#token').val();
            
            Swal.fire({
                          title: 'SEGURO DE ELIMINAR RESERVA <?php echo $nombre->sala_nombre ?>?',
                          text: "UNA VEZ ELIMINADA, NO SE PUEDE RECUPERAR LA RESERVA",
                          icon: 'danger',
                          showCancelButton: true,
                          confirmButtonColor: '#E26C57',
                          cancelButtonColor: '#3F7BFB',
                          confirmButtonText: 'ELIMINAR RESERVA',
                          cancelButtonText: 'CANCELAR'
                        }).then((result) => {
                          if (result.isConfirmed) {
                          
                          $.ajax({
                                  headers: {'X-CSRF-TOKEN': token},
                                  url: '/usuarios/sala/eliminar',
                                  type: 'POST',
                                  datatype: 'json',
                                  data: $('#form-eliminar').serialize(),
                                 
                                  success:function(data){
                                              $('#modal_eliminar').modal('hide');
                                              $("#msj-warning").fadeIn();
                                              window.location.reload();
                                    
                                  },
                                   error: function() {
                                    alert("Error al eliminar reserva");
                                  }
                                }) 
                                  $('#modal_eliminar').modal('hide');
                                  $("#msj-warning").fadeIn();
                                  window.location.reload();
                                  }else{
                                      $('#modal_eliminar').modal('hide');
                                  }
                                })

          
            
          });

  </script>

@endpush
<style>
/* --- ESTILOS PERSONALIZADOS 2025 --- */

/* Animación general */
.fade-in {
    animation: fadeIn 1s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Botones de pisos con hover moderno */
.btn-piso {
    display: inline-block;
    background: linear-gradient(45deg, #16A085, #138D75);
    color: #fff !important;
    font-weight: bold;
    border-radius: 30px;
    border: none;
    padding: 10px 18px;
    margin-top: 5px;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.btn-piso:hover {
    background: linear-gradient(45deg, #1ABC9C, #117864);
    transform: scale(1.08);
    box-shadow: 0 0 15px rgba(26, 188, 156, 0.7);
    text-decoration: none;
}

/* Tarjetas de salas */
.sala-card-link {
    text-decoration: none;
    color: inherit;
}
.sala-card {
    border-radius: 15px;
    border: 2px solid #A2D9CE;
    background-color: #FAFAFA;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: all 0.4s ease;
    padding: 20px;
    text-align: center;
}
.sala-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    background-color: #E8F8F5;
}

/* Encabezado de la tarjeta */
.sala-header h3 {
    font-weight: bold;
    color: #117864;
    margin-bottom: 10px;
}

/* Cuerpo de la tarjeta */
.sala-body p {
    margin: 5px 0;
    color: #2C3E50;
}

/* Progreso */
.progress {
    height: 10px;
    margin-top: 8px;
    border-radius: 10px;
    background-color: #E5E8E8;
}
.progress-bar {
    background-color: #17A589;
}

/* Ajustes de márgenes */
.mb-3 { margin-bottom: 15px !important; }
.mb-4 { margin-bottom: 25px !important; }
.mt-3 { margin-top: 15px !important; }
.mt-4 { margin-top: 25px !important; }

</style>

@endsection



