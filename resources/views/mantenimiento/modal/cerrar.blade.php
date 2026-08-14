<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_cerrar_reporte">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-center " style="background-color: #004182;">
          <h4 class="modal-title pull-center" style="justify-content: center; color:white"><strong>CERRAR REPORTE DE INCIDENTE</strong> </h4>                
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
              <form action="{{ route('reporte.incidente.update.save') }}" method="POST">
                  <div class="row">
                    <input type="hidden" name="id" class="form-control" id="idc" readonly>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>CATEGOR&Iacute;A:</label>
                          <div class="form-group">                              
                              <input type="text" name="categoria" class="form-control" id="idCategoriac" readonly>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>REPORTE:</label>
                          <div class="form-group">                              
                              <input type="text" name="reporte" class="form-control" id="IdItemc" readonly>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 ">
                          <label>DESCRIPCI&Oacute;N:</label>
                          <div class="form-group">
                            <textarea name="descripcion_" style="height: 10em;width: 100%" id="idDescripcionc"readonly></textarea>
                          </div>
                      </div>
                      
              
                  
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <!-- Date -->
                       <div class="form-group">
                            <label>FECHA REPORTE:</label>
                            <input type="text" name="fecha_reporte" placeholder="Ingresa Fecha de visita" id="IdFechac" class="form-control" readonly required/>
                       </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <!-- Date -->
                       <div class="form-group">
                            <label>ESTADO:</label>
                            <input type="text" class="form-control"  id='IdEstadoc' readonly required/>
                            <input type="hidden" name="estado" value ="CERRADO" class="form-control"  id='IdEstadoc' readonly required/>
                       </div>                        
                    </div>
                
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>OBSERVACIONES:</label>
                            <textarea name="observaciones" id="observaciones" placeholder="Descripcion de la soluciÃ³n" class="form-control" id="Idobservacionec">{{ old('observaciones') }}</textarea>
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>SOLUCION:</label>
                            <textarea name="respuesta_tecnico" id="respuesta_tecnico" placeholder="Describir solucion para cerrar" class="form-control" id="Idrepuesta">{{ old('respuesta_tecnico') }}</textarea>
                        </div>
                        
                    </div>
            </div>
            
          </div>
          </div>
         </div>
         
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="row"> 
               
              <div class="col-xs-12 col-sm-6">                                          
                  <div class="container-buttons">
                    <button type="submit" class="btn btn-success btn-block">CERRAR REQUERIMIENTO</button>
			     
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

  