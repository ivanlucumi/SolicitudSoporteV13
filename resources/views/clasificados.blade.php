
<!DOCTYPE html>
<html lang="zxx">
<!-- Head -->

<head>
	<title>Clasificados</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="Clasificados,siriscali,disajcali">
    <meta name="robots" content="noindex">
	
	<!-- //Meta-Tags -->
	<!-- Index-Page-CSS -->
	 <link rel="stylesheet" href="/css/style1.css">
	<!-- //Custom-Stylesheet-Links -->
	<!--fonts -->
	<link href="//fonts.googleapis.com/css?family=Marcellus+SC" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //fonts -->
    <link rel="shortcut icon" href="{{asset('img/icono.png')}}">
	<!-- Font-Awesome-File-Links -->
	<!-- CSS -->
	 <link rel="stylesheet" href="/css/font-awesome.css">
	 
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- //Font-Awesome-File-Links -->
	
<style>
        .card {
            width: 100%;
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
        
         @media screen and (max-width: 400px) {
            body  {
                padding: 250px;
            }
        }
        
    </style>
    
   
</head>
<!-- //Head -->
<!-- Body -->

<body style="background:#e8ecf0">
    
	<div class="container-fluid" >
	<main role="main" class="container-fluid" style="background:white;width: 80% padding: 10px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;">
    <div class="row" >
      <!--Logo principal index -->
      <div class="col-xs-12  col-md-4">
        <img src="/img/logoLargo.png" class="img-responsive">
      </div>
      <!-- Texto descriptivo del index y juzgadi-->
      <div class="col-xs-12  col-md-5">
        <p style="text-align: center; font-size: 17px; font-weight: bold;">
          <br>Consejo Superior de la Judicatura<br>
          Direcci&oacute;n Ejecutiva Seccional de Administraci&oacute;n Judicial<br>
          Cali - Valle del Cauca
        </p>
      </div>
      <div class="col-xs-12  col-md-3" >
          <h1 class="title-w3layouts"style="color:#004182">
				<span class="fa fa-cart-arrow-down" aria-hidden="true" ></span>Clasificados</h1>
          
      </div>
    </div>
    <div class="row" style="background:#004182;width: 99%">
        <div class="col-xs-12 col-sm-4"></div>
        <div class="col-xs-12 col-sm-4">
             <div class="form-group">
					<label for="bTiempo">SELECCIONE CATEGORIA:</label>
					<select class="form-control @error('categorias') is-invalid @enderror" id="selectCategoria" onchange="filtrarDivs()" name="categorias">
    <option value="">MOSTRAR TODO</option>
    @foreach($categorias as $key => $value)
        <option value="{{ $key }}" @selected(old('categorias') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('categorias')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
        </div>
        <div class="col-xs-12 col-sm-4"></div>
    </div>
   


 </main>
		<div class="banner-layer" style="height:20px;padding: 100px;background:#004182;">
			
		</div>
		
		<hr>	
		@foreach($clasificados as $key => $clasificado)
		<div class="row elemento" style="width: 98%;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);background:#ffffff" data-categoria="{{$clasificado->categoria}}">
		    <div class="col-xs-12 col-sm-3" >
		        <div class="banner-text">¡{{$clasificado->categoria}}!</div>
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
		    <div class="col-xs-12 col-sm-3">
		        <a href="/Clasificados/{{$clasificado->foto_1}}" target="_blank">
		        <img class="banner-img active img-fluid thumbnail"  src="/Clasificados/{{$clasificado->foto_1}}" alt="" style="width:95%;height:400px"  data-toggle="modal" data-target="#myModal" >
		        </a>
		    </div>
		    <div class="col-xs-12 col-sm-3">
		        <a href="/Clasificados/{{$clasificado->foto_2}}" target="_blank">
		        <img class="banner-img active img-fluid thumbnail" target="_blank" src="/Clasificados/{{$clasificado->foto_2}}" alt="" style="width:95%;height:400px" data-toggle="modal" data-target="#myModal">
		        </a>
		    </div>
		    <div class="col-xs-12 col-sm-3">
		        <a href="/Clasificados/{{$clasificado->foto_3}}" target="_blank">
		        <img class="banner-img active img-fluid thumbnail" target="_blank" src="/Clasificados/{{$clasificado->foto_3}}" alt="" style="width:95%;height:400px" data-toggle="modal" data-target="#myModal">
		        </a>
		    </div>
		</div>
		@endforeach
		<hr>
	
		 <footer class="footer" style="height: 50px;  position:fixed;
             left:0px;
             bottom:0px;
             height:30px;
             width:100%;
             background:#004182;">
                  <div class="container-fluid"style="background:#004182;">
                    
                    <div class="row">
                        <div class="col-md-4 ">
                        </div>
            			<div class="col-md-4 ">
            					<div class="card-body d-flex justify-content-between align-items-center" >
            						<span class="text-muted cBlanco" style="color:white">&copy; <a style="color:white" href="{!! url('/legal')!!}">Copyright 2018, Todos los Derechos Reservados - Legal</a></span>
            						
            					</div>
            			</div>
            			<div class="col-md-4 ">
                        </div>
            		</div>
            		
                  </div>
              </footer>

	</div>
	
	<!-- Modal -->
<div class="modal" id="ModlaImagen">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Contenido del Modal -->
            <div class="modal-body">
                <img src="" alt="Imagen en Modal" id="modalImage" class="img-fluid">
            </div>

            <!-- Botón de Cerrar Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>



	<!-- Default-JavaScript -->
	<script src="/js/jquery-2.2.3.js"></script>
	<!-- Custom-JavaScript-File-Links -->
 <script>
    // Captura el clic en la imagen y muestra la imagen en el modal
    $('.thumbnail').on('click', function () {
       
        var imageSrc = $(this).attr('src');
        $('#modalImage').attr('src', imageSrc);
        $('#ModlaImagen').modal('show'); // abrir
    });
</script>

<script>
    function filtrarDivs() {
        var select, filtro, elementos, categoria;
        select = document.getElementById("selectCategoria");
        filtro = select.value.toUpperCase();
        elementos = document.querySelectorAll(".elemento");
//alert(filtro)
        elementos.forEach(function(elemento) {
            categoria = elemento.getAttribute("data-categoria").toUpperCase();
            if (filtro === "" || categoria === filtro) {
                elemento.style.display = "";
            } else {
                elemento.style.display = "none";
            }
        });
    }
</script>
    


</body>
<!-- //Body -->

</html>