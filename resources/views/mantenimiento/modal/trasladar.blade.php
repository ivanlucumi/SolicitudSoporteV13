<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_trasladar_reporte">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-center " style="background-color: #004182;">
          <h4 class="modal-title pull-center" style="justify-content: center; color:white"><strong>TRASLADAR REPORTE DE INCIDENTE</strong> </h4>                
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
                    <input type="hidden" name="id" class="form-control" id="idt" readonly>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>CATEGOR&Iacute;A:</label>
                          <div class="form-group">                              
                              <input type="text" name="categoria" class="form-control" id="idCategoriat" readonly>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <label>REPORTE:</label>
                          <div class="form-group">                              
                              <input type="text" name="reporte" class="form-control" id="IdItemt" readonly>
                            </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 ">
                          <label>DESCRIPCI&Oacute;N:</label>
                          <div class="form-group">
                            <textarea name="textarea" style="height: 10em;width: 100%" id="idDescripciont"readonly></textarea>
                          </div>
                      </div>
                      
              
                  
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <!-- Date -->
                       <div class="form-group">
                            <label>FECHA REPORTE:</label>
                            <input type="text" name="fecha_ingreso" placeholder="Ingresa Fecha de visita" id="IdFechat" class="form-control" readonly required/>
                       </div>                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                          <!-- Date -->
                       <div class="form-group">
                            <label>ESTADO:</label>
                            <input type="text" class="form-control" name="radicado" id='IdEstadot' readonly required/>
                       </div>                        
                    </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="trasladado"> TRASLADAR A::</label><br>
                        <select name="trasladado_a" id="trasladado_a" placeholder="Seleccione Jefe mantenimiento" class="form-control">
@foreach($mantenimiento as $key => $value)
    <option value="{{ $key }}" @selected(old('trasladado_a', null) == $key)>{{ $value }}</option>
@endforeach
</select><br>
                        
                      </div>
                      
                  </div>
                  
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label>OBSERVACIONES:</label>
                            <textarea name="observaciones" id="observaciones" placeholder="Descripcion de la soluciÃ³n" class="form-control" id="Idobservacionet">{{ old('observaciones') }}</textarea>
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
                    <button type="submit" class="btn btn-success btn-block">TRASLADAR</button>
			     
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

  