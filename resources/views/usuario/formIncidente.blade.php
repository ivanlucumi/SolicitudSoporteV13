<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_Revisar_reporte">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-center " style="background-color: #004182;">
          <h4 class="modal-title pull-center" style="justify-content: center; color:white"><strong>VER Y ASIGNAR REPORTE DE INCIDENTE</strong> </h4>                
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
              
                  <div class="row">
                    <input type="hidden" name="id" class="form-control" id="id" readonly>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>CATEGOR&Iacute;A:</label>
                          <div class="form-group">                              
                              <input type="text" name="categoria" class="form-control" id="idCategoria" readonly>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>REPORTE:</label>
                          <div class="form-group">                              
                              <input type="text" name="reporte" class="form-control" id="IdItem" readonly>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 ">
                          <label>DESCRIPCI&Oacute;N:</label>
                          <div class="form-group">
                            <textarea name="descripcion_" style="height: 10em;width: 100%" id="idDescripcion"readonly></textarea>
                          </div>
                      </div>
                      
              
                  
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <!-- Date -->
                       <div class="form-group">
                            <label>FECHA REPORTE:</label>
                            <input type="text" name="fecha_reporte" placeholder="Ingresa Fecha de visita" id="IdFecha" class="form-control" readonly required/>
                       </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <!-- Date -->
                       <div class="form-group">
                            <label>ESTADO:</label>
                            <input type="text" class="form-control" name="radicado" id='IdEstado' readonly required/>
                       </div>                        
                    </div>
                    
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      
                        <label for="asignado">ASIGNAR A:</label><br>
                        
                    </div>
                    
                </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>OBSERVACIONES:</label>
                            <textarea placeholder="Descripcion de la solucion" class="form-control @error('observaciones') is-invalid @enderror" id="Idobservaciones" style="height: 10em;width: 100%" name="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>RESPUESTA TECNICO:</label>
                            <textarea placeholder="OBSERVACION TECNICO" class="form-control @error('respuesta_tecnico') is-invalid @enderror" id="IdRespTecnico" style="height: 10em;width: 100%" name="respuesta_tecnico">{{ old('respuesta_tecnico') }}</textarea>
@error('respuesta_tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
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
                <a class="btn bg-elegant btn-warning btn-block " data-dismiss="modal">CERRAR</a>                         
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

  