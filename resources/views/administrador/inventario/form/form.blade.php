     <div class="row">
            <div class="col-xs-12 col-sm-4">
                   <div class="form-group">
                         <label for="Elementos" class="fa fa-asterisk"> Elemento:</label><br>
                         <select class="form-control @error('codigoElemento') is-invalid @enderror" name="codigoElemento" id="codigoElemento">
    <option value="">Selecione Elemento</option>
    @foreach($elementos as $key => $value)
        <option value="{{ $key }}" @selected(old('codigoElemento') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('codigoElemento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
                   </div>  
                    
            </div>
            <div class="col-xs-12 col-sm-4">
                  
                    <div class="form-group">
                         <label for="Despachos" class="fa fa-asterisk">Despacho:</label><br>
                         <select class="form-control custom-select @error('codigoJuzgado') is-invalid @enderror" name="codigoJuzgado" id="codigoJuzgado">
    <option value="">Selecione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('codigoJuzgado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('codigoJuzgado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
                   </div> 
            </div>
            <div class="col-xs-12 col-sm-4">
                  
                    <div class="form-group">
                         <label for="Placa" class="fa fa-asterisk">Placa Inventario :</label>
                         <input class="form-control @error('placaInventario') is-invalid @enderror" placeholder="Ingresa Numero de la placa" type="text" name="placaInventario" id="placaInventario" value="{{ old('placaInventario') }}">
@error('placaInventario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                   </div> 
            </div>
                      
      </div>
      <div class="row">
            <div class="col-xs-12 col-sm-4">
                 <div class="form-group">
                         <label for="Marca" class="fa fa-asterisk">Marca :</label>
                         <input class="form-control @error('marca') is-invalid @enderror" placeholder="Ingresa Marca" type="text" name="marca" id="marca" value="{{ old('marca') }}">
@error('marca')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                  </div>     
                    
            </div>
            <div class="col-xs-12 col-sm-4">
                 <div class="form-group">
                         <label for="Modelo" class="fa fa-asterisk">Modelo :</label>
                         <input class="form-control @error('modelo') is-invalid @enderror" placeholder="Ingresa Marca" type="text" name="modelo" id="modelo" value="{{ old('modelo') }}">
@error('modelo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                  </div> 
                   
            </div>
            <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                         <label for="Serial" class="fa fa-asterisk">Serial :</label>
                         <input class="form-control @error('serial') is-invalid @enderror" placeholder="Ingresa Marca" type="text" name="serial" id="serial" value="{{ old('serial') }}">
@error('serial')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                  </div>
                   
            </div>
                      
      </div>
      <div class="row">
            <div class="col-xs-12 col-sm-4">
                 <div class="form-group">
                         <label for="Valor" class="fa fa-asterisk">Valor :</label>
                         <input class="form-control @error('valorArticulo') is-invalid @enderror" placeholder="Ingresa Marca" type="text" name="valorArticulo" id="valorArticulo" value="{{ old('valorArticulo') }}">
@error('valorArticulo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                  </div>     
                    
            </div>
            <div class="col-xs-10 col-sm-4">
                 <div class="form-group">
                         <label for="Fecha" class="fa fa-asterisk">Fecha Asignacion :</label>
                         <input class="form-control @error('fechaAsignacion') is-invalid @enderror" placeholder="Ingresa Marca" type="date" name="fechaAsignacion" id="fechaAsignacion" value="{{ old('fechaAsignacion') }}">
@error('fechaAsignacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                  </div> 
                   
            </div>
            <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                  <label for="Estado" class="fa fa-asterisk">Estado:</label><br>
                  <select class="form-control custom-select @error('estadoPlaca') is-invalid @enderror" name="estadoPlaca" id="estadoPlaca">
    <option value="">Selecione Estado</option>
    @foreach(['1'       => 'ACTIVOS',
                                                     '0'       => 'INACTIVOS'] as $key => $value)
        <option value="{{ $key }}" @selected(old('estadoPlaca') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('estadoPlaca')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror       
                  </div>                        
            </div>
                      
      </div>
      <div class="row">
            <div class="col-xs-12 col-sm-12">
                 <div class="form-group">
                         <label for="Observaciones" class="fa fa-asterisk">Observaciones :</label>
                         <textarea class="form-control @error('observacionPlaca') is-invalid @enderror" placeholder="Ingresa Observaciones" name="observacionPlaca" id="observacionPlaca">{{ old('observacionPlaca') }}</textarea>
@error('observacionPlaca')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                  </div>     
                    
            </div>
                                 
      </div>