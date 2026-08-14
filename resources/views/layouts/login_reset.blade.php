<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/dashboardcj/vendors/bootstrap/dist/css/bootstrap.min.css">  
        <link rel="stylesheet" href="/login_reset/css/style.css">
        <link rel="stylesheet" href="/css/brand-colors.css">

	</head>
	<body>
        <section class="ftco-section">
            <div class="container">
                <!-- Metodo para cambio de idioma es - en -->                
                @yield('content')                
            </div>
        </section>

        <!-- jQuery -->
        <script src="/login_reset/js/jquery.min.js"></script>
        <script src="/login_reset/js/popper.js"></script>
        <script src="/login_reset/js/bootstrap.min.js"></script>
        <script src="/login_reset/js/main.js"></script>

	</body>
</html>

