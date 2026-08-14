
{{$reserva}}
 

<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <strong>Horario Reservado</strong>
</div>

<div id="msj-warning" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
  <strong>Reserva eliminada</strong>
</div>

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

<form id="form" action="{{ route('agendar.store') }}" method="POST">
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
                   <h3> <p style="text-align: center"> Reserva del Sal&oacute;n <strong>{{$salon}}</strong> </p></h3>
                      
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
      

     <!-- MODAl PARA EDITAR EL EVENTO-->

     <div class="modal fade" id="modal_editar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>DETALLES DE LA RESERVA</strong> </h4>
              </div>
              <div class="modal-body">

               <div class="container-fluid">
                    
        
                      <div class="row">
                          <div class="col-xs-6 form-group " >
                                  <label for="radicado">Radicado:</label>
                                  <input class="form-control @error('radicado') is-invalid @enderror" type="text" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                                  
                          </div>
                          <div class="col-xs-6 form-group " >
                                  <label for="indiciado">Indiciado :</label>
                                  <input class="form-control @error('indiciado') is-invalid @enderror" type="text" name="indiciado" id="indiciado" value="{{ old('indiciado') }}">
@error('indiciado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                                  
                          </div>
                          <div class="col-xs-12 form-group " >
                                  <label for="despacho">Despacho :</label>
                                  <input class="form-control @error('despacho') is-invalid @enderror" type="text" name="despacho" id="despacho" value="{{ old('despacho') }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                                  
                          </div>
                      </div>
                     
                      <div class="row">
                               <div class="col-xs-3 form-group ">           
                                    <label for="fecha">Fecha Inicio:</label><br>
                                    <input class="form-control @error('fecha') is-invalid @enderror" placeholder="Hora inicio" disabled="disabled" type="text" name="fecha" id="fecha" value="{{ old('fecha') }}">
@error('fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div> 
                                <div class="col-xs-3 form-group ">
                                  <label for="horaini">Hora Inicio:</label>
                                  <input class="form-control  @error('horaini') is-invalid @enderror" placeholder="Nombre encargado" disabled="disabled" type="text" name="horaini" id="horaini" value="{{ old('horaini') }}">
@error('horaini')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class="col-xs-3 form-group ">           
                                    <label for="fechafin">Fecha Fin:</label><br>
                                    <input class="form-control @error('fechafin') is-invalid @enderror" placeholder="Hora inicio" disabled="disabled" type="text" name="fechafin" id="fechafin" value="{{ old('fechafin') }}">
@error('fechafin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div> 
                                <div class="col-xs-3 form-group " >
                                  <label for="horafin">Hora Fin:</label>
                                  <input class="form-control  @error('horafin') is-invalid @enderror" placeholder="Nombre encargado" disabled="disabled" type="text" name="horafin" id="horafin" value="{{ old('horafin') }}">
@error('horafin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                                      
                      </div> 
                      <!-- Formulario eliminacion-->
                      <div class="container-fluid">
                        <div id='oculto' >  
                            <div class="row">
                            
                              <form id="form-eliminar" action="{{ route('agendar.destroy') }}" method="POST">
    @csrf

                                <div class="form-group" style="display: none;">
                                  <label for="id">ID:</label>           
                                  <input class="form-control @error('id') is-invalid @enderror" placeholder="Hora inicio" type="text" name="id" id="id" value="{{ old('id') }}">
@error('id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                 

                                <div class="form-group" style="height: 100px; width: 100%">
                                  <label for="eliminacion">Descripcion del motivo de la eliminaci&oacute;n:</label>
                                  <textarea class="form-control @error('eliminacion evento') is-invalid @enderror" placeholder="Describa el motivo" name="eliminacion evento" id="eliminacion evento">{{ old('eliminacion evento') }}</textarea>
@error('eliminacion evento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                               
                            </div>   
                            <div class="row">
                               <div class="col-xs-12 col-md-6">
                                 <button type="button" class="btn bg-orange btn-block" data-dismiss="modal" onclick="resetearVisibilidad()">Cancelar</button>
                               </div>
                               
                              <div class="col-xs-12 col-md-6">
                                  <a href="#" id="eliminarEvento" class="btn bg-black btn-block">Eliminar</a>
                                  </form>
                                  
                               </div>  
                                 
                            </div>          
                        </div> 
                      </div> 
                      <!-- /Formulario eliminacion-->             
                </div>
                 

              </div>
              <div class="modal-footer">
                <div class="container-fluid">
                  <div class="row">  
                    <div class="col-xs-12 " id="eliminar" style="display:none;">
                    
                      <input class="btn bg-red btn-block" type="button" value="eliminar" onclick="cambiaVisibilidad()">
                      
                    </div>
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


<script>

     function mostrar(){
document.getElementById('oculto').style.display = 'block';
};
  function cambiaVisibilidad() {
       var div1 = document.getElementById('oculto');
       var div2 = document.getElementById('eliminar');
     
       if(div2.style.display == 'block'){
           div2.style.display = 'none';
           div1.style.display = 'block';
           
       }
   }
    function resetearVisibilidad() {
       var div1 = document.getElementById('oculto');
       var div2 = document.getElementById('eliminar');
       

       
       if(div2.style.display == 'none'){
           div2.style.display = 'block';
           div1.style.display = 'none';
           
       }
   }
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
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
  }
  .fc-title,.fc-time{
    color: black;
  }

</style>
 @push('scripts')
<script>
  $(function () {
      //Initialize Select2 Elements
    $('.select2').select2()
   
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

        events    : '/reservas/evento/<?php echo $salon ?>',
       
        
       loading: function(bool) {
        $('#loading').toggle(bool);
      },

      

      eventClick: function(event, jsEvent, view)
          {
            
                        
            $('#radicado').val(event.radicado); 
            $('#indiciado').val(event.indiciado);
            $('#despacho').val(event.despacho); 
            
            $('#fecha').val(event.fecha);
            $('#horaini').val(event.horaini);
            $('#fechafin').val(event.fecha);
            $('#horafin').val(event.horafin);
            $('#id').val(event.id);
            var reserva = event.reservado;
            var div2 = document.getElementById('eliminar');      
              
             if(reserva == true){
              
              div2.style.display = 'block';                                 
             };  
             if(reserva == false){
              
              div2.style.display = 'true';                                 
             };          
            
            $('#modal_editar').modal('show');
          },
          selectable: <?php echo $reserva ?>,
          selectHelper: true,
          defaultView: 'agendaWeek',
          dayNames: ['Domingo','Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
          minTime: '00:00',
          maxTime: '23:59',
          editable  : false,
          droppable : false, // this allows things to be dropped onto the calendar !!!
          allDaySlot:false,

      
    })

  })
  

   $("#reservar").click(function(e){
            e.preventDefault();
            
            var asignatura = $('#asignatura').val();
            if(asignatura.length == 0){
              $("#valAsignatura").fadeIn(1000);
              $("#valAsignatura").fadeOut(3000);
              return;
            }
            var personaAcargo = $('#personaAcargo').val();
            if(personaAcargo.length == 0){
              $("#valpersonaAcargo").fadeIn(1000);
              $("#valpersonaAcargo").fadeOut(3000);
              return;
            }
            var programa = $('#programa').val();
             if(programa.length == 0){
              $("#valprograma").fadeIn(1000);
              $("#valprograma").fadeOut(3000);
              return;
            }
            var descripcion = $('#descripcion').val();
             if(descripcion.length == 0){
              $("#valdescripcion").fadeIn(1000);
              $("#valdescripcion").fadeOut(3000);
              return;
            }
            
            var salon = $('#salon').val();
            var fechaI = $('#fechaI').val();
            var horaI = $('#horaI').val();
            var fechaF = $('#fechaF').val();
            var horaF = $('#horaF').val();            
            var token = $('#token').val();
            
           
          
            $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              url: '/evento/store',
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
                alert(data);
                $('#modal').modal('hide');
                $("#msj-success").fadeIn();
                window.location.reload();
                $("#msj-success").fadeIn();

              },

               error: function() {
                alert("Error al hacer la reserva");
              }



                           
            })
          });



 $("#eliminarEvento").click(function(e){
            e.preventDefault();
            var token = $('#token').val();


          
            $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              url: 'horario/destroy/',
              type: 'POST',
              datatype: 'json',
              data: $('#form-eliminar').serialize(),
             
              success:function(data){

                $('#modal_editar').modal('hide');
                $("#msj-warning").fadeIn();
                window.location.reload();
              },

               error: function() {
                alert("Error al eliminar reserva");
              }



                           
            })
          });


  </script>

@endpush

