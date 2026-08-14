  <!-- MODAl PARA EDITAR EL EVENTO-->

     <div class="modal fade" id="noAutorizado" data-backdrop="static" data-keyboard="false" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" >
                <h4 class="modal-title pull-center"><strong>VEH&Iacute;CULO EN ESPERA DE AUTORIZACI&Oacute;N</strong> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 
                 <span aria-hidden="true">&times;</span></button>                
              </div>

              <div class="modal-body">
               <div class="container-fluid">
                   
                    <div> <input type="hidden" name="id" id="id"> </div>
                    
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="form-group">
                            <label>Identificaci&oacute;n:</label>
                            <input type="text" name="identificacion" value="{{ old('identificacion')}}"  class="form-control" id="identificacion_" style="text-transform:uppercase;" readonly/>
                        </div>                        
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 ">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" value="{{ old('nombre')}}"  class="form-control" id="nombre_" style="text-transform:uppercase;"   readonly/>
                        </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="form-group">
                            <label>Hora Ingreso:</label>
                            <input type="text" name="hora_ingreso" value="{{ old('hora_ingreso')}}"  class="form-control" id="hora_ingreso_" style="text-transform:uppercase;"   readonly/>
                        </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-12 ">
                        <div class="form-group">
                            <label>Despacho que solicit&oacute; ingreso:</label>
                            <input type="text" name="despacho" value="{{ old('despacho')}}"  class="form-control" id="despacho_" style="text-transform:uppercase;"   readonly/>
                        </div>                        
                    </div>
                    
                    <hr>
                    <center><label style="color:red">  <strong> <h1> VEH&Iacute;CULO NO AUTORIZADO </h1></strong> </label></center>
                    <hr>
                    
                    <center><label style="">  <strong> <h2> NO PUEDE INGRESAR POR PARQUEADERO </h2></strong> </label></center>
                  
               
               </div>
              </div>
              <div class="modal-footer">
                <div class="container-fluid">
                  <div class="row">  
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
          


       
