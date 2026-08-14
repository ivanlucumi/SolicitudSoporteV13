@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera')
<div class="container-fluid">
    <div class="row">
        
       @foreach($Ubicaciones  as $ubicacion)
                <div class="col-xs-12 col-sm-4">
                <?php $nombre1= $Ubicaciones[0]->ciudad->nombre_edificio ?>
                @if($nombre1 != $ubicacion->ciudad->nombre_edificio)
                     <h5 class="mt-3 px-2 mb-2" style="color: black" >{{$ubicacion->ciudad->nombre_edificio}}</h5>
                @else
                     <h5 class="mt-3 px-2 mb-2" style="color: black" >{{$Ubicaciones[0]->ciudad->nombre_edificio}}</h5>
                @endif
                
                <a href="{{ route('usuario.reservas.reserva.salas', $ubicacion->id) }}" class="btn btn-danger btn-sm  fa fa-building" title="">{{ ' '.$ubicacion->ubicacion_nombre }}</a>
               </div> 
            @endforeach  
    </div>
</div>
<h2><strong>RESERVA SALAS</strong></h2><br>


@endsection
@section('content')


            


@push('scripts')
<link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">
<link rel="stylesheet" href="/fullcalendar/fullcalendar/dist/fullcalendar.css">

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
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>RESERVE SU ESPACIO</strong> <br> Tenga en cuenta de no sobreponer en otro horario</h4>
              </div>
              <div class="modal-body">

                <div class="container-fluid">
                  <div class="row">
                   <h3> <p style="text-align: center"> Reserva del Sal&oacute;n <strong></strong> </p></h3>
                      
                    </div>
                    
                  
                      <div class="row">
                               <div class="col-xs-12 form-group ">            
                                    <label for="Asignatura">Asignatura:</label><br>
                                    <input [ 'id'="'asignatura', 'class' => 'form-control select2','style'=>'width: 100%;','placeholder'=>'Seleccione asignatura','required'=>'required']" type="text" name="asignatura" id="asignatura" value="{{ old('asignatura') }}" class="@error('asignatura') is-invalid @enderror">
@error('asignatura')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                     <strong id="valAsignatura" style="display: none; color: red">Campo requerido</strong>
                              </div> 
                              <div class=" form-group" style="display: none;">
                               <label for="tema">Nombre sal&oacute;n:</label><br>
                                <input [ 'id'="'salon', 'class' => 'form-control','style'=>'width: 100%;','readonly','required']" type="text" name="salon" id="salon" value="{{ old('salon') }}" class="@error('salon') is-invalid @enderror">
@error('salon')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                          </div>                
                      </div>
                      <div class="row">
                         <div class="col-xs-7 form-group " >
                                  <label for="Nombre">Encargado:</label>
                                  <input id="personaAcargo" class="form-control @error('personaAcargo') is-invalid @enderror" placeholder="Nombre encargado" required="required" type="text" name="personaAcargo" value="{{ old('personaAcargo') }}">
@error('personaAcargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                  <strong id="valpersonaAcargo" style="display: none; color: red">Campo requerido</strong>
                                </div>
                          <div class="col-xs-5  form-group ">
                               <label for="programa">Programa:</label><br>
                               <input [ 'id'="'programa','class' => 'form-control select2','style'=>'width: 100%;','placeholder'=>'Seleccione programa','required']" type="text" name="programa" id="programa" value="{{ old('programa') }}" class="@error('programa') is-invalid @enderror">
@error('programa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                               <strong id="valprograma" style="display: none; color: red">Campo requerido</strong>
                          </div>
                          
                      </div>
                      <div class="row">
                        <div class="col-xs-12 form-group" style="height: 100px; width: 100%" >
                                    <label for="descripcion">Descripcion :</label><br>
                                    <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Describa de que se trata la reserva." name="descripcion">{{ old('descripcion') }}</textarea>
@error('descripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                    <strong id="valdescripcion" style="display: none; color: red">Campo requerido</strong>
                                
                        </div>
                        
                      </div>
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
                </div>
        

              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-xs-6 ">
                    <a href="#!" class="btn bg-red btn-block" type="button">Cancelar</a>
                  </div>
                  <div class="col-xs-6 ">
                    <a href="#" id="reservar" class="btn bg-black btn-block">Reservar</a>
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
   



@push('scripts')

<!-- fullCalendar -->
<script src="/fullcalendar/moment/moment.js"></script>
<script src="/fullcalendar/fullcalendar/dist/fullcalendar.js"></script>
<script src="/fullcalendar/fullcalendar/dist/locale/es.js"></script>



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
        right : 'month,agendaWeek,agendaDay,listDay'
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
        start = moment(start.format());
        end = moment(end.format());

        $('#_asignatura').val(" "); 
        $('#_semestre').val(" ");
        $('#_encargado').val(" "); 
        $('#_programa').val(" ");  
        $('#_salon').val(" "); 
        $('#_descripcion').val(" ");  
        
        $('#fechaI').val(start.format('YYYY-MM-DD '));
        $('#horaI').val(start.format(' HH:mm:ss'));
        $('#fechaF').val(end.format('YYYY-MM-DD '));
        $('#horaF').val(end.format('HH:mm:ss'));
        
        $('#modal').modal('show');
        
      },

        events    : '/administracion/reservas/historial/',
       
        
       loading: function(bool) {
        $('#loading').toggle(bool);
      },

      

      eventClick: function(event, jsEvent, view)
          {
              
              console.log('hola');
        
                        
            $('#_asignatura').val(event.asignatura_nombre); 
            $('#_semestre').val(event.semestre);
            $('#_encargado').val(event.persona_a_cargo); 
            $('#_programa').val(event.programa);  
            $('#_salon').val(event.salon); 
            $('#_descripcion').val(event.description);  
            $('#_fechaI').val(event.start.format('YYYY-MM-DD '));
            $('#_horaI').val(event.start.format(' HH:mm:ss'));
            $('#_fechaF').val(event.end.format('YYYY-MM-DD '));
            $('#_horaF').val(event.end.format('HH:mm:ss'));
            $('#_id').val(event.id);
            var reserva = event.reservado;
            var div2 = document.getElementById('eliminar');      
              
             if(reserva == true){
              
              div2.style.display = 'block';                                 
             };  
             if(reserva == false){
              
              div2.style.display = 'none';                                 
             };          
            
            $('#modal_editar').modal('show');
          },
          selectable: false,
          selectHelper: true,
          defaultView: 'listDay',
          dayNames: ['Domingo','Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
          minTime: '07:00',
          maxTime: '22:00',
          editable  : false,
          droppable : false, // this allows things to be dropped onto the calendar !!!
          allDaySlot:false,

      
    })

  })
  
  </script>

@endpush


@endsection



