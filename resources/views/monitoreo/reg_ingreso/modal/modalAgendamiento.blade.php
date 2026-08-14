<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_agendar_visita">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-center " style="background-color: #004182;">
          <h4 class="modal-title pull-center" style="justify-content: center; color:white"><strong>DATOS DEL VISITANTE</strong> </h4>                
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">                 
           <span aria-hidden="true">&times;</span></button>                             
        </div>
        <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
            <strong id="msj"></strong>
          </div> 
          <div class="card-body">
            <div class="container-fluid">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
              <form action="{{ route('usuario.agendamiento.store') }}" method="POST">
    @csrf
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>Identificaci&oacute;n:</label>
                          <div class="form-group">
                              
                              <input type="number" name="identificacion" class="form-control" id="nProceso2" placeholder="Ingresa identificaci&oacute;n" required min="1">
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>Nombre:</label>
                          <div class="form-group">
                              
                              <input type="text" name="nombre" class="form-control" placeholder="Ingresa Nombres" required>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>Apellidos:</label>
                          <div class="form-group">
                              
                              <input type="text" name="apellidos" class="form-control" placeholder="Ingresa los Apellidos" required>
                            </div>
                      </div>
                      
              
                  
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <!-- Date -->
                       <div class="form-group">
                            <label>Fecha Visita:</label>
                            <input type="date" name="fecha_ingreso" placeholder="Ingresa Fecha de visita" class="form-control" required/>
                       </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <!-- Date -->
                       <div class="form-group">
                            <label>Hora de Ingreso:</label>
                            <input type="time" name="hora_ingreso" class="form-control" required/>
                       </div>                        
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label>Radicado:</label>
                        <input type="number" class="form-control" name="radicado" id='nProceso' placeholder="Ingresa los 23 dígitos ..." required/>
                        <div id="cantidad"></div>
                    </div>
                    
                </div>
            </div>
            
              <input type="hidden" name="nombre_despacho" value="{{$nombreDespacho->nombreDespacho}}" required/>
          </div>
          </div>
         </div>
         
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="row"> 
               
              <div class="col-xs-12 col-sm-6">                                          
                  <div class="container-buttons">
                    <button class="btn btn-success btn-block" type="submit">Agendar</button>
			     
                  </div>
               </form>             
              </div>
              <div class="col-xs-12 col-sm-6">
                <a class="btn bg-elegant btn-warning btn-block " data-dismiss="modal">CANCELAR</a>                         
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
  </div>

  