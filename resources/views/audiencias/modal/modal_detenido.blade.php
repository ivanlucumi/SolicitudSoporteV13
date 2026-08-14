<!-- MODAl PARA EDITAR-->  
     <div class="modal fade" id="modal_crear_detenido">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header text-center " style="background-color: #004182;">
                <h4 class="modal-title pull-center" style="justify-content: center; color:white"><strong>DATOS DEL DETENIDO</strong> </h4>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">                 
                 <span aria-hidden="true">&times;</span></button>                             
              </div>
              <div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
                  <strong id="msj"></strong>
                </div> 
              
               <div class="modal-body">
                 <div class="container-fluid">
                   <form id="form-almacenar-detenido" action="{{ route('$url') }}" method="POST">
    @csrf 
                  <input class="form-control" type="hidden" name="solicitud_audiencias_id" id="solicitud_audiencias_id" value="{{ $solicitudAudiencia->id }}">
                    <div class="row was-validated">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group"><!-- Formulario para la creaci¨®n o modificaci¨®n de nuestras tareas-->
                                <label>Nombre</label>
                                <input type="text" name="nombre_interno" value="" class="form-control" autocomplete="off" required>
                                
                                <label>Ciudad</label>
                                <input name="ciudad" type="text" class="form-control" autocomplete="off" required>
            
                                <label>Nombre establecimiento penitenciario</label>
                                <input name="nombre_estalecimiento" type="text" class="form-control" autocomplete="off" required>
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
                            <a href="#" class="btn btn-primary  btn-block boton_guardar_detenido mt-1 p-1 pb-1" id="boton_guardar_detenido">REGISTRAR DETENIDO</a>  
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