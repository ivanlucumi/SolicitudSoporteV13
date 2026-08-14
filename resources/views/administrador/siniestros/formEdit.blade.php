<div class="row">
    <div class="col-xs-12 col-sm-3"><a class="btn btn-danger" href="javascript: history.go(-1)">Volver atrás</a></div>
    <div class="col-xs-12 col-sm-3"></div>
    <div class="col-xs-12 col-sm-3"> 
        @if( auth()->user()->rol == 1 &&  !empty($siniestro->informe_onsite) && !empty($siniestro->reporte_tecnico) && empty($siniestro->aprobado))
            <a href="{{ route('administrador.siniestro.denegar', $siniestro->id) }}" class="btn btn-warning btn-lg btn-block fa fa-check mb-2" title="Aporbar Siniestro">NEGAR SINIESTRO</a> 
            @endif
            @if( auth()->user()->rol == 17 &&  auth()->user()->tipo_rol == "COORDINADOR" &&  !empty($siniestro->informe_onsite) && !empty($siniestro->reporte_tecnico) && empty($siniestro->fecha_envio_admon) )
            <a href="{{ route('tecnico.siniestro.denegar', $siniestro->id) }}" class="btn btn-warning btn-lg btn-block fa fa-check mb-2" title="Aporbar Siniestro">NEGAR SINIESTRO</a> 
            @endif
    </div>
    <div class="col-xs-12 col-sm-3">
        @if( auth()->user()->rol == 1 &&  !empty($siniestro->informe_onsite) && !empty($siniestro->reporte_tecnico) && empty($siniestro->aprobado))
        <a href="{{ route('administrador.siniestro.aprobar', $siniestro->id) }}" class="btn btn-success btn-lg btn-block fa fa-check mb-2" title="Aporbar Siniestro">APROBAR SINIESTRO</a> 
        @endif
        @if( auth()->user()->rol == 17 &&  auth()->user()->tipo_rol == "COORDINADOR" &&  !empty($siniestro->informe_onsite) && !empty($siniestro->reporte_tecnico) && empty($siniestro->fecha_envio_admon) )
        <a href="{{ route('tecnico.siniestro.aprobar', $siniestro->id) }}" class="btn btn-success btn-lg btn-block fa fa-check mb-2" title="Aporbar Siniestro">APROBAR SINIESTRO</a> 
        @endif
        </div>
    
</div>
<div class="card-header"><h3><center>REPORTE DE SINIESTRO</center></h3></div>
     <form enctype="multipart/form-data" action="{{ route('administrador.siniestro.update',$siniestro->id) }}" method="POST">
    @csrf
    @method('PUT')
                    <div class="row">
                            <p class=""><h5><center>Informaci&oacute;n del Siniestro</center></h5></p>
                            <hr>
                        </div>
                      
                        <div class="row">
                        <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">N&uacute;mero de Caso :</label>
        					<input class="form-control @error('num_caso') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="num_caso" id="num_caso" value="{{ old('num_caso', $siniestro->num_caso ?? $siniestro->num_caso) }}">
@error('num_caso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">Fecha Recibido:</label>
        					<input class="form-control @error('fecha_reporte') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="fecha_reporte" id="fecha_reporte" value="{{ old('fecha_reporte', $siniestro->fecha_reporte ?? $siniestro->fecha_reporte) }}">
@error('fecha_reporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">Despacho :</label>
        					<input class="form-control @error('despacho') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="despacho" id="despacho" value="{{ old('despacho', $siniestro->despacho ?? $siniestro->despacho) }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">Usuario :</label>
        					<input class="form-control @error('nombre_usuario') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="nombre_usuario" id="nombre_usuario" value="{{ old('nombre_usuario', $siniestro->nombre_usuario ?? $siniestro->nombre_usuario) }}">
@error('nombre_usuario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">placa :</label>
        					<input class="form-control @error('placa') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="placa" id="placa" value="{{ old('placa', $siniestro->placa ?? $siniestro->placa) }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">serial_equipo :</label>
        					<input class="form-control @error('serial_equipo') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="serial_equipo" id="serial_equipo" value="{{ old('serial_equipo', $siniestro->serial_equipo ?? $siniestro->serial_equipo) }}">
@error('serial_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">marca_equipo :</label>
        					<input class="form-control @error('marca_equipo') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="marca_equipo" id="marca_equipo" value="{{ old('marca_equipo', $siniestro->marca_equipo ?? $siniestro->marca_equipo) }}">
@error('marca_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    <div class="form-group col-xs-12 col-sm-3">
        					<label for="N&uacute;mero de Caso">modelo_equipo :</label>
        					<input class="form-control @error('modelo_equipo') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="modelo_equipo" id="modelo_equipo" value="{{ old('modelo_equipo', $siniestro->modelo_equipo ?? $siniestro->modelo_equipo) }}">
@error('modelo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    <div class="form-group col-xs-12 col-sm-6">
        					<label for="N&uacute;mero de Caso">falla_reportada :</label>
        					<textarea class="form-control @error('falla_reportada') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" name="falla_reportada" id="falla_reportada">{{ old('falla_reportada', $siniestro->falla_reportada ?? $siniestro->falla_reportada) }}</textarea>
@error('falla_reportada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    <div class="form-group col-xs-12 col-sm-6">
        					<label for="N&uacute;mero de Caso">diagnostico :</label>
        					<textarea class="form-control @error('diagnostico') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" name="diagnostico" id="diagnostico">{{ old('diagnostico', $siniestro->diagnostico ?? $siniestro->diagnostico) }}</textarea>
@error('diagnostico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    </div>
                    
                        <div class="row">
    				    @if(empty($siniestro->informe_onsite ))
    				    <div class="form-group col-xs-12 col-sm-2">
        					<label for="N&uacute;mero de Caso">informe_onsite :</label>
        					<input type="file" name="informe_onsite" id="informe_onsite" class="@error('informe_onsite') is-invalid @enderror">
@error('informe_onsite')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    @else
    				        <div class="form-group col-xs-12 col-sm-2">
    				            <label for="N&uacute;mero de Caso">informe_onsite :</label><br>
    				        <a onClick="window.open('/Siniestros/{{$siniestro->informe_onsite}}','popup', 'width=800px,height=600px')">VER INFORME ONSITE</a>
    				        </div>
    				    @endif
    				    
    				     @if(empty($siniestro->reporte_tecnico ))
    				    <div class="form-group col-xs-12 col-sm-2">
        					<label for="N&uacute;mero de Caso">reporte_tecnico :</label>
        					<input type="file" name="reporte_tecnico" id="reporte_tecnico" class="@error('reporte_tecnico') is-invalid @enderror">
@error('reporte_tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    @else
    				        <div class="form-group col-xs-12 col-sm-2">
    				            <label for="N&uacute;mero de Caso">reporte_tecnico :</label><br>
    				        <a onClick="window.open('/Siniestros/{{$siniestro->reporte_tecnico}}','popup', 'width=800px,height=600px')">VER REPORTE TECNICO</a>
    				        </div>
    				    @endif
    				    
    				    @if( auth()->user()->rol != 17)
    				    
            				     @if(empty($siniestro->reporte_aseguradora ))
            				    <div class="form-group col-xs-12 col-sm-2">
                					<label for="N&uacute;mero de Caso">reporte_aseguradora :</label>
                					<input type="file" name="reporte_aseguradora" id="reporte_aseguradora" class="@error('reporte_aseguradora') is-invalid @enderror">
@error('reporte_aseguradora')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
            				    </div>
            				    @else
            				        <div class="form-group col-xs-12 col-sm-2">
            				            <label for="N&uacute;mero de Caso">reporte_aseguradora :</label><br>
            				        <a onClick="window.open('/Siniestros/{{$siniestro->reporte_aseguradora}}','popup', 'width=800px,height=600px')">VER REPORTE ASEGURADORA</a>
            				        </div>
            				    @endif
            				    
            				    @if(empty($siniestro->liquidacion_siniestro ))
            				    <div class="form-group col-xs-12 col-sm-2">
                					<label for="N&uacute;mero de Caso">liquidacion_siniestro :</label>
                					<input type="file" name="reporte_aseguradora" id="reporte_aseguradora" class="@error('reporte_aseguradora') is-invalid @enderror">
@error('reporte_aseguradora')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
            				    </div>
            				    @else
            				        <div class="form-group col-xs-12 col-sm-2">
            				            <label for="N&uacute;mero de Caso">liquidacion_siniestro :</label><br>
            				        <a onClick="window.open('/Siniestros/{{$siniestro->liquidacion_siniestro}}','popup', 'width=800px,height=600px')">VER REPORTE ASEGURADORA</a>
            				        </div>
            				    @endif
            				    
            				    @if(empty($siniestro->ingreso_almacen ))
            				    <div class="form-group col-xs-12 col-sm-2">
                					<label for="N&uacute;mero de Caso">ingreso_almacen :</label>
                					<input type="file" name="ingreso_almacen" id="ingreso_almacen" class="@error('ingreso_almacen') is-invalid @enderror">
@error('ingreso_almacen')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
            				    </div>
            				    @else
            				        <div class="form-group col-xs-12 col-sm-2">
            				            <label for="N&uacute;mero de Caso">ingreso_almacen :</label><br>
            				        <a onClick="window.open('/Siniestros/{{$siniestro->ingreso_almacen}}','popup', 'width=800px,height=600px')">VER REPORTE ASEGURADORA</a>
            				        </div>
            				    @endif
    				    <div class="form-group col-xs-12 col-sm-4">
        					<label for="N&uacute;mero de Caso">num_siniestro_aseguradora :</label>
        					<input class="form-control @error('num_siniestro_aseguradora') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="text" name="num_siniestro_aseguradora" id="num_siniestro_aseguradora" value="{{ old('num_siniestro_aseguradora', $siniestro->num_siniestro_aseguradora ?? $siniestro->num_siniestro_aseguradora) }}">
@error('num_siniestro_aseguradora')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div>
    				    <div class="form-group col-xs-12 col-sm-4">
        					<label for="N&uacute;mero de Caso">fecha_de_pago_aseguradora:</label>
        					<input class="form-control @error('fecha_de_pago_aseguradora') is-invalid @enderror" placeholder="Numero de caso" autocomplete="off" type="date" name="fecha_de_pago_aseguradora" id="fecha_de_pago_aseguradora" value="{{ old('fecha_de_pago_aseguradora', $siniestro->fecha_de_pago_aseguradora ?? $siniestro->fecha_de_pago_aseguradora) }}">
@error('fecha_de_pago_aseguradora')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				    </div> 
    				@endif
                  </div>
                  <div class="row">
                      <hr>
                       @if( auth()->user()->rol == 17 &&  empty($siniestro->informe_onsite) && empty($siniestro->reporte_tecnico))
                          <div class="col-xs-12 col-sm-4"></div>
                              <div class="col-xs-12 col-sm-4">
                                        <button  type="submit" class="btn btn-success btn-block btn-lg" >
                                            REGISTRAR INFORMACI&Oacute;N
                                        </button>
                              </div>
                          <div class="col-xs-12 col-sm-4"></div>
                      @endif
                      
                       @if( auth()->user()->rol == 1 &&   auth()->user()->tipo_rol == "ADMINISTRACION")
                          <div class="col-xs-12 col-sm-4"></div>
                              <div class="col-xs-12 col-sm-4">
                                        <button  type="submit" class="btn btn-success btn-block btn-lg" >
                                            REGISTRAR INFORMACI&Oacute;N
                                        </button>
                              </div>
                          <div class="col-xs-12 col-sm-4"></div>
                      @endif
                  </div>
 </form>
