@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Clasificados')
@section('cabecera', 'Registro de Clasificados')
@section('content') 

<style>
        .card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .banner-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .banner-img {
            width: 100%;
            display: none;
            height:300px;
        }

        .banner-img.active {
            display: block;
        }

        .banner-text {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #B62516;
            color: #fff;
            padding: 8px;
            font-weight: bold;
        }

        .content {
            padding: 16px;
        }
    </style>
    

<center><h1><strong> CLASIFICADOS.<br> SOLO ESTAR&Aacute; DISPONIBLE POR 8 DIAS LA PUBLICACI&Oacute;N </strong></h1></center>
<hr>
 <div class="box-body">
	            	<div class="container-fluid"> 
						<form id="form-clasificados" action="{{ route('usuario.clasificados.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
					            	      		
					            	
    						              <div class="row">
    						                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
    						                  	
    						                         <label for="categoria">Categoria del Producto:</label><br>
    						                         <select class="form-control  @error('categoria') is-invalid @enderror" id="categoria" name="categoria">
    <option value="">Seleccione La Categoria</option>
    @foreach($categorias as $key => $value)
        <option value="{{ $key }}" @selected(old('categoria') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('categoria')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
    						                   
    						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
						                  	
						                         <label for="producto">Nombre Producto:</label><br>
						                         <input placeholder="Registr Nombre Producto" class="form-control  @error('producto') is-invalid @enderror" id="producto" type="text" name="producto" value="{{ old('producto') }}">
@error('producto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-3 form-group hidden" id="modelo-specs">
						                  	
						                         <label for="producto">Modelo:</label><br>
						                         <input placeholder="Registre Nombre Producto" class="form-control  @error('modelo') is-invalid @enderror" id="modelo" type="text" name="modelo" value="{{ old('modelo') }}">
@error('modelo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-3 form-group hidden" id="kilometraje-specs">
						                  	
						                         <label for="producto">Kilometraje:</label><br>
						                         <input placeholder="Registre Nombre Producto" class="form-control  @error('kilometraje') is-invalid @enderror" id="kilometraje" type="text" name="kilometraje" value="{{ old('kilometraje') }}">
@error('kilometraje')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                </div>
						                <div class="row">
						                
						                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
						                  	
						                         <label for="especificaciones">Especificaciones:</label><br>
						                         <textarea placeholder="Registr Nombre Producto" class="form-control  @error('especificaciones') is-invalid @enderror" id="producto" name="especificaciones">{{ old('especificaciones') }}</textarea>
@error('especificaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
						                  	
						                         <label for="caracteristicas">Caracteristicas:</label><br>
						                         <textarea placeholder="Registr Nombre Producto" class="form-control  @error('caracteristicas') is-invalid @enderror" id="producto" name="caracteristicas">{{ old('caracteristicas') }}</textarea>
@error('caracteristicas')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-3 form-group " >
						                  	
						                         <label for="contacto_telefono">Tel&eacute;fono:</label><br>
						                         <input placeholder="Telefono Contacto" class="form-control  @error('contacto_telefono') is-invalid @enderror" id="contacto_telefono" type="text" name="contacto_telefono" value="{{ old('contacto_telefono') }}">
@error('contacto_telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-3 form-group ">
						                  	
						                         <label for="contacto_correo">Correo:</label><br>
						                         <input placeholder="Correo Contacto" class="form-control  @error('contacto_correo') is-invalid @enderror" id="contacto_correo" type="email" name="contacto_correo" value="{{ old('contacto_correo') }}">
@error('contacto_correo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                
						              </div>
						              <div class="row">
						                <div class="col-xs-12 col-md-6 form-group" id="categ" style="">
    						                 <label for="photo-upload">Seleccionar Fotos (máximo 3, solo imágenes):</label>
                                            <input type="file" id="photo-upload" name="photos[]" accept="image/*" multiple>
                                            <small>Seleccione un máximo de 5 fotos.</small>
						                </div>
						              </div>
						              <hr>
						              <div class="row">
                        						<div class="col-xs-6 form-group">
                        							<button class="btn btn-secundary btn-block" type="submit">GUARDAR CLASIFICADO</button>
                        						</div>
                        						<div class="col-xs-6 form-group">
                        							<a href="{{ url()->previous() }}" class="btn btn-primary btn-block">CANCELAR</a>
                        							</form>
                        						</div>
                        						
                        			 </div>
						              
									<hr>
									<center> <h1> <strong>MIS PUBLICACIONES</strong></h1></center>
									<hr>
									<div class="row">
                            		    @foreach($clasificados as $key => $clasificado)
                            			<div class="col-xs-12 col-sm-3">
                            			     
                            									 <div class="card" style="width:95%;height:900px">
                                                                    <div class="banner-container" >
                                                                        <img class="banner-img active" src="/Clasificados/{{$clasificado->foto_1}}" alt=""  >
                                                                        <img class="banner-img " src="/Clasificados/{{$clasificado->foto_2}}" alt=""  >
                                                                        <img class="banner-img " src="/Clasificados/{{$clasificado->foto_3}}" alt=""  >
                                                                        
                                                                        <!-- Agrega más imágenes según sea necesario -->
                                                            
                                                                        <div class="banner-text">¡{{$clasificado->categoria}}!</div>
                                                                        <form action="{{ route('usuario.clasificados.delete', $clasificado->id) }}" method="POST">
    @csrf
    @method('DELETE')
                                                    					<button class="btn btn-danger btn-xs fa fa-remove" title="eliminar usuario" style="background-color: #B62516;color: #fff;" type="submit">ELIMINAR</button>
                                                    					</form>
                                                            
                                                                       
                                                                    </div>
                            
                                                                <div class="content">
                                                                    <h3>{{$clasificado->producto}}</h3>
                                                                    @if($clasificado->modelo)
                                                                    <p><strong>Modelo:</strong> {{$clasificado->modelo}}</p>
                                                                    @endif
                                                                    @if($clasificado->kilometraje)
                                                                    <p><strong>Kilometraje:</strong> {{$clasificado->kilometraje}}</p>
                                                                    @endif
                                                                    <p><strong>Especificaciones:</strong> {{$clasificado->especificaciones}}</p>
                                                                    <p><strong>Caracteristicas:</strong> {{$clasificado->caracteristicas}}</p>
                                                                     @if($clasificado->contacto_telefono)
                                                                    <p><strong>Telefono:</strong> {{$clasificado->contacto_telefono}}</p>
                                                                    @endif
                                                                     @if($clasificado->contacto_correo)
                                                                    <p><strong>Correo:</strong> {{$clasificado->contacto_correo}}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                            			    </div>
                                         @endforeach
                            		</div>
									
								</div>
	            </div>

 

    <script>
        const productCategory = document.getElementById("categoria");
        //const anhosSpecs = document.getElementById("anho-specs");
        const modeloSpecs = document.getElementById("modelo-specs");
        const kilometrajeSpecs = document.getElementById("kilometraje-specs");

        productCategory.addEventListener("change", (event) => {
            //anhosSpecs.classList.add("hidden");
            modeloSpecs.classList.add("hidden");
            kilometrajeSpecs.classList.add("hidden");
            
            //document.getElementById("anho").removeAttribute("required");
            document.getElementById("modelo").removeAttribute("required");
            document.getElementById("kilometraje").removeAttribute("required");
    
        //alert(event.target.value)

            const selectedCategory = event.target.value;

            if (selectedCategory === "VEHICULO") {
                //anhosSpecs.classList.remove("hidden");
                modeloSpecs.classList.remove("hidden");
                kilometrajeSpecs.classList.remove("hidden");
                
                //document.getElementById("anho").setAttribute("required",'True');
                document.getElementById("modelo").setAttribute("required",'True');
                document.getElementById("kilometraje").setAttribute("required",'True');
                
                
            } else if (selectedCategory != "VEHICULO") {
                //anhosSpecs.classList.add("hidden");
                modeloSpecs.classList.add("hidden");
                kilometrajeSpecs.classList.add("hidden");
            } 
        });
    </script>
    <script>
        document.getElementById('form-clasificados').addEventListener('submit', function(event) {
            var input = document.getElementById('photo-upload');
            var files = input.files;

            // Verificar la cantidad máxima de archivos
            if (files.length > 3) {
                alert('Por favor, seleccione un máximo de 5 fotos.');
                event.preventDefault();
            }

            // Verificar que todos los archivos sean imágenes
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileType = file.type.split('/')[0]; // Obtener el tipo de archivo (por ejemplo, 'image')

                if (fileType !== 'image') {
                    alert('Por favor, seleccione solo imágenes.');
                    event.preventDefault();
                    break;
                }
            }
        });
    </script>
    
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            function initializeBanner(bannerContainer) {
                let currentIndex = 0;
                const images = bannerContainer.querySelectorAll('.banner-img');

                function showImage(index) {
                    images.forEach(img => img.classList.remove('active'));
                    images[index].classList.add('active');
                }

                function nextImage() {
                    currentIndex = (currentIndex + 1) % images.length;
                    showImage(currentIndex);
                }

                // Cambia de imagen cada 3 segundos (ajustable según tus preferencias)
                setInterval(nextImage, 3000);
            }

            // Inicializar cada banner
            const banners = document.querySelectorAll('.banner-container');
            banners.forEach(banner => initializeBanner(banner));
        });
    </script>

@endsection