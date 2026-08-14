<!-- MODAl PARA EDITAR-->  
<div class="modal fade" id="modal_crear_solicitud_virtual">
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
             <form id="form-solicitar-audiencia-" action="{{ route('$url') }}" method="POST">
    @csrf 
              <div class="row was-validated">
                  
                      <div class="col-xs-12 col-md-12 form-group"><!-- fORMULARIO PARA LA SOLICITUD DE AUDIENCIAS-->
                        <div class="form-group">
                            <label for="Email" class="fa fa-asterisk">Email :</label>
                            <input class="form-control @error('email') is-invalid @enderror" placeholder="Ingresa email" required="required" type="email" name="email" id="email" value="{{ old('email') }}">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
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
                    <button class="btn btn-danger btn-block" type="submit">Consultar</button>
			     
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