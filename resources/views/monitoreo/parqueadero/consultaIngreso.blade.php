  <!-- MODAl PARA EDITAR EL EVENTO-->

     <div class="modal fade" id="ResultadoConsulta" data-backdrop="static" data-keyboard="false" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: rgb(0 125 110)">
                <h2 class="modal-title pull-center"><strong><center> AUTORIZAR INGRESO DE VEH&Iacute;CULO</center></strong> </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 
                 <span aria-hidden="true">&times;</span></button>                
              </div>

              <div class="modal-body">
               <div class="container-fluid">
                   
                    <div> <input type="hidden" name="id" id="id"> </div>
                    
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="form-group">
                            <label>Identificaci&oacute;n:</label>
                            <input type="text" name="identificacion" value="{{ old('identificacion')}}"  class="form-control" id="identificacion" style="text-transform:uppercase;" readonly/>
                        </div>                        
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 ">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" value="{{ old('nombre')}}"  class="form-control" id="nombre" style="text-transform:uppercase;"   readonly/>
                        </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="form-group">
                            <label>Hora Ingreso:</label>
                            <input type="text" name="hora_ingreso" value="{{ old('hora_ingreso')}}"  class="form-control" id="hora_ingreso" style="text-transform:uppercase;"   readonly/>
                        </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-12 ">
                        <div class="form-group">
                            <label>Despacho que solicit&oacute; ingreso:</label>
                            <input type="text" name="despacho" value="{{ old('despacho')}}"  class="form-control" id="despacho" style="text-transform:uppercase;"   readonly/>
                        </div>                        
                    </div>
                    
                    <hr>
                    <center><label style="color:green">  <strong> <h2> VEH&Iacute;CULO AUTORIZADO </h2></strong> </label></center>
                    <hr>
                    
                   <div class="col-xs-12 col-sm-6 ">
                        <div class="form-group" style="background: warning">
                            <label>Placa:</label>
                            <input type="text" name="placa" value="{{ old('placa')}}"  class="form-control" id="placa" style="text-transform:uppercase;"  readonly/>
                        </div>                        
                    </div>
                        
                    <div class="col-xs-12 col-sm-6  ">
                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" name="tipo" value="{{ old('tipo')}}"  class="form-control" id="tipo" readonly />
                        </div>                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-6  ">
                            <div class="form-group">
                            <label>Marca:</label>
                                <input type="text" name="marca" value="{{ old('marca')}}"  class="form-control" id="marca"  readonly/>
                            </div>                        
                        </div>
                        <div class="col-xs-12 col-sm-6  ">
                            <div class="form-group">
                            <label>Color:</label>
                                <input type="text" name="color" class="form-control" id="color" readonly />
                            </div>                        
                        </div>
               
                
               
               </div>
              </div>
              <div class="modal-footer">
                <div class="container-fluid">
                  <div class="row">  
                    <div class="col-xs-12 col-sm-6">
                     
                      <a href="#" id="BotonRegistrarIngreso" class="btn btn-success btn-block fa fa-check btn-lg">REGISTRAR INGRESO</a>
                      
                    </div>
                     <div class="col-xs-12 col-sm-6">
                      <a type="button" class="btn btn-danger btn-block btn-lg" data-dismiss="modal">CANCELAR</a>
                      
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
          


       
