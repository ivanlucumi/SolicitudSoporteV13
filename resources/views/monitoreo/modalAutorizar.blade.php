  <!-- MODAl PARA EDITAR EL EVENTO-->

     <div class="modal fade" id="modal_autorizar" data-backdrop="static" data-keyboard="false" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title pull-center"><strong>AUTORIZAR INGRESO DE VEH&Iacute;CULO</strong> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 
                 <span aria-hidden="true">&times;</span></button>                
              </div>

              <div class="modal-body">
               <div class="container-fluid">
                   
                    <div> <input type="hidden" name="id" id="id"> </div>
                    
                   <div class="col-xs-12 col-sm-3 ">
                        <div class="form-group">
                            <label>Placa:</label>
                            <input type="text" name="placa" value="{{ old('placa')}}"  class="form-control" id="placa" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese Placa"autocomplete="off" readonly/>
                        </div>                        
                        </div>
                        
                    <div class="col-xs-12 col-sm-3  ">
                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" name="tipo" value="{{ old('tipo')}}"  class="form-control" id="tipo" placeholder="Tipo Carro, Moto, Cami&oacute;n"autocomplete="off" readonly />
                        </div>                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-6  ">
                            <div class="form-group">
                            <label>Marca:</label>
                                <input type="text" name="marca" value="{{ old('marca')}}"  class="form-control" id="marca" placeholder="Ingrese Marca"autocomplete="off" readonly/>
                            </div>                        
                        </div>
                        <div class="col-xs-12 col-sm-6  ">
                            <div class="form-group">
                            <label>Color:</label>
                                <input type="text" name="color" class="form-control" id="color" placeholder="Ingrese Color"autocomplete="off" readonly />
                            </div>                        
                        </div>
                        <div class="col-xs-12 col-sm-6  ">
                         @if(isset($parqueadero))   
	                	<label for="hora">Parqueadero Disponible:</label><br>
	                	<select class="form-control @error('parqueadero') is-invalid @enderror" name="parqueadero" id="parqueadero">
    <option value="">Seleccione Parqueadero</option>
    @foreach($parqueadero as $key => $value)
        <option value="{{ $key }}" @selected(old('parqueadero') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('parqueadero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	                    @endif
                        </div>
               
                
               
               </div>
              </div>
              <div class="modal-footer">
                <div class="container-fluid">
                  <div class="row">  
                    <div class="col-xs-12 col-sm-6">
                     
                      <a href="#" id="BotonAutorizar" class="btn btn-success btn-block fa fa-check">  AUTORIZAR</a>
                      
                    </div>
                     <div class="col-xs-12 col-sm-6">
                       <a href="#" id="BotonDenegar" class="btn btn-danger btn-block fa fa-times">  DENEGAR</a>
                      
                      
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
          


       
