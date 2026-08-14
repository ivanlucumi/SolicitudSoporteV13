<!-- Modal -->
<div class="modal fade" id="Inscribir_funcionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #004182;color:white">
        <h3 class="modal-title" id="exampleModalLongTitle"><center>INSCRIBIR FUNCIONARIO</center></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{ route('escalafon.listado.save.inscripcion') }}" method="POST">
    @csrf
      <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>TIPO NOMBRAMIENTO:</label>
                                        <div class="form-group">
                                            <select class="form-control" name="tipo_nombramiento" >
                                              <option value="" selected>SELECCIONE OPCION</option>
                                              <option value="PROPIEDAD" >PROPIEDAD</option>
                                              <option value="PROVISIONALIDAD">PROVISIONALIDAD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>IDENTIFICACI&Oacute;N:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-cedula_m" class="form-control" name="cedula"  placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>NOMBRE:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-nombre_m" class="form-control" name="nombres" placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>APELLIDO:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-nombre_m" class="form-control" name="apellido" placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>GENERO:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-cedula_m" class="form-control" name="genero" placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>NOVEDAD ESCALAFON:</label>
                                        <div class="form-group">
                                            <input type="text" value="INSCRIPCION"  id="datos-cedula_m" name="novedad_escalafon_propiedad" class="form-control"  placeholder="Ingresa identificaci&oacute;n" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>TIPO DE ACTO:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-cedula_m" class="form-control" name="tipo_acto" placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>NUMERO ACTO:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-cedula_m" name="num" class="form-control"  placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>FECHA ACTO:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-cedula_m" class="form-control" name="fecha" placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>FECHA POSECION:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-fecha_m" name="fecha_posecion" class="form-control"  placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <label>NUMERO RESOLUCION:</label>
                                        <div class="form-group">
                                            <input type="text"  id="datos-nombramiento_m" name="num_resolucion" class="form-control"  placeholder="Ingresa identificaci&oacute;n" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                         <label>RESOLUCION:</label>
                                        <div class="form-group">
                        	        	    <input class="form-control-file form-group @error('anexos') is-invalid @enderror" id="file_anexo" accept="application/pdf" type="file" name="anexos">
@error('anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                                        </div>
                                   </div> 
                  
              </div>
              
          </div>
       
      </div>
      <div class="modal-footer">
          <div class="row">
              
                  <div class="col-xs-12 col-sm-6">
                <button type="submit" class="btn btn-lg btn-success btn-block" >GUARDAR</button>
                </div>
                  <div class="col-xs-12 col-sm-6">
                <button type="button" class="btn btn-lg btn-secundary btn-block" data-dismiss="modal">CERRAR</button>
                 </div>
         
          </div>
        </form>
      </div>
    </div>
  </div>
</div>