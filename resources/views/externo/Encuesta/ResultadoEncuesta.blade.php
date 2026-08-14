<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio teléfonico disajcali"/>
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <title>Encuesta Satisfaccion</title>
  <!-- NO INDEXAR PAGINA POR ROBOTS -->
<meta name="robots" content="noindex, nofollow">
  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

<style type="text/css">
		/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  margin-bottom: 60px; /* Margin bottom by footer height */
}
.footer {
  position: absolute;
  bottom: -60px;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 30px; /* Vertically center the text there */
  background-color: #004182;
  color: #ffffff;
}

ul li:hover {background: #ffffff52;}

.cBlanco{
	color: #ffffff;
}

.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
  background-color: #a2a2a2b3;
}

.dropdown-menu > li > a:hover{
  background-color: #a2a2a2b3;
}
/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
        .question {
            margin-bottom: 20px;
        }
    </style>

<link rel="stylesheet" href="/toastr/toastr.min.css">
<script src="/toastr/toastr.min.js"></script>

<!-- JavaScript -->

<!-- JavaScript -->


<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    @stack('style')


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- NAVIDAD
<marquee style="position: absolute; z-index: 100"><img src="img/Navidad.gif"></marquee>
-->
   

<body style="background: #fff;" >
  <main role="main" class="container">
    <div class="row">
      <!--Logo principal index -->
      <div class="col-xs-12  col-md-5">
        <img src="/img/logoLargo.png" class="img-responsive">
      </div>
      <!-- Texto descriptivo del index y juzgadi-->
      <div class="col-xs-12  col-md-7">
        <p style="text-align: center; font-size: 17px; font-weight: bold;">
          <br>Consejo Superior de la Judicatura <br>
          Direcci&oacute;n Seccional de Administraci&oacute;n Judicial
          Cali - Valle del Cauca
          <br>
          "Fortaleciendo la justicia, promoviendo el bienestar de todos"
        </p>
      </div>
      
    </div>

        <div class="container-fluid">
            <canvas id="graficaClasificada"></canvas>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="container mt-5">
        <h1 class="mb-4">Resultados de la Encuesta - Año 2025</h1> 
        <div class="text-right" style="margin-bottom: 15px;">
            <a href="{{ route('exportar.encuesta.detallada') }}" class="btn btn-success">
                <i class="fa fa-file-excel-o"></i> Descargar Excel
            </a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Categoría</th>
                    <th>Muy Satisfactoria</th>
                    <th>Satisfactoria</th>
                    <th>Normal</th>
                    <th>Poco Satisfactoria</th>
                    <th>No Satisfactoria</th>
                    <th>No Aplica</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultados as $resultado)
                <tr>
                    <td>{{ $resultado->categoria }}</td>
                    <td>{{ $resultado->muy_satisfactorio }}</td>
                    <td>{{ $resultado->satisfactorio }}</td>
                    <td>{{ $resultado->normal }}</td>
                    <td>{{ $resultado->poco_satisfactorio }}</td>
                    <td>{{ $resultado->no_satisfactorio }}</td>
                    <td>{{ $resultado->no_aplica }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            </div>
        </div>
    <hr>
    <br>
<script>
  fetch('/datos-clasificados')
    .then(response => response.json())
    .then(data => {
        const categorias = data.map(item => item.categoria);

         const valoresMuySatisfactorio = data.map(item => item.muy_satisfactorio);
        const valoresSatisfactorio = data.map(item => item.satisfactorio);
        const valoresNormal = data.map(item => item.normal);
        const valoresPocoSatisfactorio = data.map(item => item.poco_satisfactorio);
        const valoresNoSatisfactorio = data.map(item => item.no_satisfactorio);
        const valoresNoAplica = data.map(item => item.no_aplica);

        // Calcular el total de votos por categoría
       const totalesPorCategoria = data.map(item => 
            // Sumar los valores asegurándose de convertirlos a enteros
            parseInt(item.muy_satisfactorio) +
            parseInt(item.satisfactorio) +
            parseInt(item.normal) +
            parseInt(item.poco_satisfactorio) +
            parseInt(item.no_satisfactorio) +
            parseInt(item.no_aplica)
        );

        // Mostrar el total por categoría en consola o manipularlo según sea necesario
        console.log('Totales por Categoría:', totalesPorCategoria);

        // Crear el título de la gráfica con los totales
        const tituloGrafica = categorias.map((categoria, index) => 
            `${categoria}: ${totalesPorCategoria[index]} votos`
        ).join(' | ');

        const ctx = document.getElementById('graficaClasificada').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [
                    {
                        label: 'Muy Satisfactorio',
                        data: valoresMuySatisfactorio,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Satisfactorio',
                        data: valoresSatisfactorio,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Normal',
                        data: valoresNormal,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Poco Satisfactorio',
                        data: valoresPocoSatisfactorio,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'No Satisfactorio',
                        data: valoresNoSatisfactorio,
                        backgroundColor: 'rgba(39,76,247, 0.2)',
                        borderColor: 'rgba(39,76,247, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'No Aplica',
                        data: valoresNoAplica,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: `Totales por Categoría: ${tituloGrafica}`
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error al obtener los datos:', error);
    });

</script>
    
        

@stack('scripts')
</body>

</html>


