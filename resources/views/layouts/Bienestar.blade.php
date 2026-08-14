<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIRIS CALI')</title>

    <link rel="shortcut icon" href="{{ asset('img/icono.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    {{-- Estilos externos --}}
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">
    <link rel="stylesheet" href="/css/sticky-footer.css">
    <link href="/gallery/galeria/animate.css" rel="stylesheet" />
    <link href="/gallery/galeria/light-gallery/css/lightgallery.css" rel="stylesheet">

    {{-- Estilos personalizados --}}
    <style>
        body {
            background: #fff;
            margin-bottom: 60px;
        }

        .header-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .logo-img {
            max-height: 60px;
            width: auto;
        }

        .header-text {
            font-size: 15px;
            font-weight: 500;
            text-align: center;
            line-height: 1.3;
        }

        .translate-box {
            text-align: center;
            margin-top: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: auto;
            background-color: #004182;
            color: white;
            padding: 5px 0;
            z-index: 999;
        }

        .footer .card {
            background: transparent;
            border: none;
        }

        .cBlanco {
            color: #ffffff;
        }

        ul li:hover {
            background: #ffffff52;
        }
        
        .header-text {
    text-align: center;
    font-size: 17px;
    font-weight: bold;
    line-height: 1.4;
    margin: 10px 0;
}

/* Responsivo para tablets y celulares */
@media (max-width: 768px) {
    .header-text {
        font-size: 10px;
    }
    .footer-text {
        font-size: 8px;
    }
}

@media (max-width: 480px) {
    .header-text {
        font-size: 8px;
    }
    .footer-text {
        font-size: 6px;
    }
}
    </style>

    @stack('style')
</head>
<body>
    <main role="main" class="container-fluid" style="width: 90%">
        <div class="row header-section">
            <div class="col-xs-3 text-center">
                <img src="/img/logoLargo.png" alt="Logo Rama" class="logo-img img-responsive">
            </div>
            <div class="col-xs-9">
                <p class="header-text">
                    
                    Consejo Superior de la Judicatura<br>
                    Direcci&oacute;n Seccional de Administraci&oacute;n Judicial<br>
                    Cali - Valle del Cauca<br>
                    "Fortaleciendo la justicia, promoviendo el bienestar de todos"
                </p>
            </div>
            
        </div>

        @include('alerts.flash-message')
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-xs-5 footer-text">
                    &copy; {{ now()->year }} Todos los Derechos Reservados - 
                    <a href="{{ url('/legal') }}" class="cBlanco">Legal</a>
                </div>
                <div class="col-xs-3 footer-text">
                    Visitas Hoy: <strong><span id="diaria">{{ $diaria->visitas ?? '' }}</span></strong>
                </div>
                <div class="col-xs-4 footer-text">
                    Total Visitas: <strong><span id="global">{{ $global->visitas ?? '' }}</span></strong>
                </div>
            </div>
        </div>
        
             <style>
                .sitelock-float {
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    z-index: 9999;
                }
            </style>
          
         <a href="#" class="sitelock-float" onclick="window.open('https://www.sitelock.com/verify.php?site=disajcali.gov.co','SiteLock','width=100,height=100,left=60,top=70');">
            <img class="img-fluid" alt="SiteLock" title="SiteLock" src="https://shield.sitelock.com/shield/disajcali.gov.co" />
        </a>
        
    </footer>

    {{-- Scripts --}}
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
<script src="/js/adminlte-layout.js"></script>
    <script src="/gallery/galeria/light-gallery/js/lightgallery-all.js"></script>
    <script src="/gallery/galeria/image-gallery.js"></script>

    <script>
        $(function () {
            $('#searchtable').DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });
        });
    </script>

    {{-- Google Translate --}}
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @stack('scripts')
</body>
</html>
