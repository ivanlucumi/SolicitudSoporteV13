@extends('layouts.monitoreo.ingreso')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Ingreso')
@section('cabecera')
   REGISTRO {{ auth()->user()->name}} {{ auth()->user()->lastname}}
@endsection
@section('content') 

<style>
		@media only screen and (max-width: 700px) {
			video {
				max-width: 100%;
			}
		}
</style>

    <div class="container-fluid">
        
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                
                    <form enctype="multipart/form-data" id="biometria.registro.save" action="{{ route('biometria.registro.save.foto') }}" method="POST">
    @csrf
        			<div class="col-xs-12 col-sm-6 form-group ">
                    <label for="semana_regsitro">IDENTIFICACION:</label>
                    <input id="conductor" class="form-control  @error('identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Cedula Del Visitante" type="number" name="identificacion" value="{{ old('identificacion', $verificacion->identificacion) }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                     </div>
                    <div class="col-xs-12 col-sm-6 form-group ">
                        <label for="p_apellido">PRIMER APELLIDO:</label>
                        <input class="form-control  @error('p_apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Kilometraje" type="text" name="p_apellido" id="p_apellido" value="{{ old('p_apellido', $verificacion->p_apellido) }}">
@error('p_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group ">
                        <label for="s_apellido">SEGUNDO APELLIDO:</label>
                        <input class="form-control  @error('s_apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Kilometraje" type="text" name="s_apellido" id="s_apellido" value="{{ old('s_apellido', $verificacion->s_apellido) }}">
@error('s_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group ">
                        <label for="p_nombre">PRIMER NOMBRE:</label>
                        <input id="p_nombre" class="form-control  @error('p_nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Cedula Conductor" type="text" name="p_nombre" value="{{ old('p_nombre', $verificacion->p_nombre) }}">
@error('p_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group ">
                        <label for="s_nombre">SEGUNDO NOMBRE:</label>
                        <input id="s_nombre" class="form-control  @error('s_nombre') is-invalid @enderror" autocomplete="off" placeholder="Nombre Conductor" type="text" name="s_nombre" value="{{ old('s_nombre', $verificacion->s_nombre) }}">
@error('s_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group ">
                        <label for="tipo">TIPO INGRESO:</label>
                        <input id="s_nombre" class="form-control  @error('tipo') is-invalid @enderror" autocomplete="off" placeholder="Visitante o Funcionario" type="text" name="tipo" value="{{ old('tipo', $verificacion->tipo) }}">
@error('tipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 mt-3 mb-3 ">
                        <hr>
                         <br>
                        <div class="col-xs-12 col-sm-2 form-group ">
                        </div>
                        <div class="col-xs-12 col-sm-4  form-group ">
                            <button class="btn btn-primary btn-block" type="submit">REGISTRAR INGRESO</button>
                            
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-4 form-group ">
                             <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
                        </div>
                        <div class="col-xs-12 col-sm-2  form-group ">
                        </div>
                    </div>
                    
            </div>
            
            <div class="col-xs-12 col-sm-6">
                <img 
                  src="{{$verificacion->foto}}" 
                  alt="Foto de verificación" 
                  loading="lazy" 
                  style="
                    display: block;
                    max-width: 100%; 
                    height: auto; 
                    border-left: solid #fff 5px;
                    border-bottom: solid #fff 2px;
                    border-right: solid #fff 10px;
                    padding: 0;
                    margin: 0 auto;
                  ">

            </div>
            
        </div>
        
            
       <hr>
            
         
        
        
       
    </div>
    
    <hr>
    
     
  </div>   

   
@endsection