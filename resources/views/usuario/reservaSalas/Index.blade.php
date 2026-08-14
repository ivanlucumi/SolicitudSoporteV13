@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera', 'REGISTRE SU REQUERIMIENTO')

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

        events    : '/evento/<?php echo $salon ?>',
       
        
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
          selectable: <?php echo $reserva ?>,
          selectHelper: true,
          defaultView: 'agendaWeek',
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



