<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_cerrar_reporte_operario">
    <div class="modal-dialog modal-lg">
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
              <form action="{{ route('operario.reporte.incidente.save') }}" method="POST">
    @csrf
                  <div class="row">
                    <input type="hidden" name="id" class="form-control" id="idc" readonly>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>CATEGOR&Iacute;A:</label>
                          <div class="form-group">                              
                              <input type="text" name="categoria_" class="form-control" id="idCategoriac" readonly>
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
                            <input type="hidden" name="estado" value ="REALIZADO" class="form-control"  id='IdEstadoc' readonly required/>
                            <input type="hidden" name="fecha_cerrado" value ="{{\Carbon\Carbon::now()}}" class="form-control"  readonly required/>
                       </div>                        
                    </div>
                
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>OBSERVACIONES:</label>
                            <textarea placeholder="Descripcion de la solucion" class="form-control @error('observaciones') is-invalid @enderror" id="Idobservacionec" style="height: 10em;width: 100%" name="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>SOLUCION:</label>
                            <textarea placeholder="Describir solucion para cerrar" class="form-control @error('respuesta_tecnico') is-invalid @enderror" id="Idrepuesta" style="height: 10em;width: 100%" name="respuesta_tecnico">{{ old('respuesta_tecnico') }}</textarea>
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
                  <div class="container-buttons">
                    <button class="btn btn-success btn-block" type="submit">Cerrar Requerimiento</button>
			     
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

  