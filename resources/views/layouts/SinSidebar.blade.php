<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIRIS CALI')</title>
    
    <link rel="shortcut icon" href="{{ asset('img/icono.png') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('/adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="{{ asset('/adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    {{-- AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/skins/skin-black.css') }}">
    {{-- Otros estilos existentes --}}
    <link rel="stylesheet" href="{{ asset('/css/sticky-footer.css') }}">
    <link href="/gallery/galeria/animate.css" rel="stylesheet">
    <link href="/gallery/galeria/light-gallery/css/lightgallery.css" rel="stylesheet">

    @stack('style')

    <style>
        /* =========================================================
           VARIABLES
        ========================================================= */
        :root {
            --primary: #002147;
            --primary-light: #063568;
            --secondary: #007d6e;
            --secondary-light: #009b89;
            --background: #f4f7fb;
            --surface: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 10px 30px rgba(0, 33, 71, .08);
            --radius: 14px;
        }

        /* =========================================================
           BASE
        ========================================================= */
        html {
            min-height: 100%;
            position: relative;
        }
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Inter', 'Source Sans Pro', Arial, sans-serif;
            background: linear-gradient(135deg, #f7f9fc 0%, #eef3f8 100%);
            color: var(--text);
            padding-bottom: 72px;
        }

        /* =========================================================
           ELIMINAR ESTILOS ANTIGUOS DE ADMINLTE
        ========================================================= */
        .navbar, .main-sidebar, .left-side, .control-sidebar, .skin-black .main-header { display: none !important; }
        .content-wrapper { margin-left: 0 !important; min-height: auto !important; background: transparent; }
        .content-header { display: none; } /* Ocultar migas de pan viejas de adminlte si quedan */

        /* =========================================================
           HEADER
        ========================================================= */
        .modern-header {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            padding: 18px 25px;
            box-shadow: 0 5px 20px rgba(0, 33, 71, .15);
            position: relative;
            z-index: 10;
        }
        .modern-header-inner {
            max-width: 1500px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        /* =========================================================
           BRAND
        ========================================================= */
        .brand-container {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }
        .brand-logo {
            height: 58px;
            width: auto;
            max-width: 220px;
            object-fit: contain;
            background: rgba(255,255,255,.08);
            padding: 7px;
            border-radius: 10px;
        }
        .brand-info {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }
        .brand-title {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.3px;
            margin: 0;
            text-align: center;
        }
        .brand-subtitle {
            font-size: 14px;
            font-weight: bold;
            color: rgba(255,255,255,.78);
            margin-top: 3px;
            text-align: center;
        }

        /* =========================================================
           USER AREA
        ========================================================= */
        .user-panel-modern {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            padding: 8px 14px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }
        .user-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.15);
            font-size: 16px;
        }
        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        .user-name {
            font-size: 13px;
            font-weight: 700;
        }
        .user-status {
            font-size: 11px;
            color: #b8f5e9;
        }
        .logout-button {
            border: none;
            background: rgba(255,255,255,.10);
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 9px;
            transition: .2s ease;
        }
        .logout-button:hover {
            background: rgba(255,255,255,.22);
            transform: translateY(-1px);
        }

        /* =========================================================
           PAGE CONTAINER
        ========================================================= */
        .page-container {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 30px 25px 40px;
        }

        /* =========================================================
           PAGE CARD
        ========================================================= */
        .modern-content {
            background: var(--surface);
            border: 1px solid rgba(0,0,0,.04);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px;
            min-height: 300px;
            transition: box-shadow .25s ease;
            animation: pageFade .35s ease;
        }
        .modern-content:hover {
            box-shadow: 0 15px 40px rgba(0,33,71,.10);
        }

        /* =========================================================
           ALERTS
        ========================================================= */
        .alert {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,.05);
        }

        /* =========================================================
           BUTTONS & FORMS
        ========================================================= */
        .btn {
            border-radius: 8px;
            transition: all .2s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(0,0,0,.08);
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #dfe4ea;
            box-shadow: none;
            min-height: 40px;
            transition: .2s ease;
        }
        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(0,125,110,.10);
        }
        label {
            font-weight: 600;
            color: #374151;
        }

        /* =========================================================
           FOOTER
        ========================================================= */
        .modern-footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            min-height: 58px;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid var(--border);
            box-shadow: 0 -5px 20px rgba(0,0,0,.04);
            z-index: 1000;
        }
        .footer-inner {
            max-width: 1500px;
            margin: auto;
            min-height: 58px;
            padding: 0 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }
        .footer-left { color: var(--muted); font-size: 12px; }
        .footer-left a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .footer-stats { display: flex; gap: 10px; }
        .stat-box {
            background: #f7f9fc;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 11px;
            color: var(--muted);
        }
        .stat-box strong { color: var(--primary); margin-left: 3px; }

        /* =========================================================
           SITELOCK
        ========================================================= */
        .sitelock-float {
            position: fixed;
            right: 18px;
            bottom: 70px;
            z-index: 1001;
            opacity: .85;
            transition: .2s ease;
        }
        .sitelock-float:hover { opacity: 1; transform: scale(1.03); }
        .sitelock-float img { max-width: 90px; height: auto; }

        /* =========================================================
           MOBILE
        ========================================================= */
        @media(max-width: 768px) {
            .modern-header { padding: 14px 15px; }
            .modern-header-inner { align-items: flex-start; }
            .brand-logo { height: 45px; max-width: 150px; }
            .brand-title { font-size: 14px; }
            .brand-subtitle { font-size: 10px; }
            .user-panel-modern { padding: 6px; }
            .user-info, .footer-stats, .sitelock-float { display: none; }
            .page-container { padding: 15px 10px 30px; }
            .modern-content { padding: 18px; border-radius: 10px; }
            .footer-inner { padding: 0 12px; }
        }

        @keyframes pageFade {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

@guest
    @if(!request()->routeIs('login'))
        @php redirect()->route('login')->send(); @endphp
    @endif
@endguest

{{-- HEADER MODERNO --}}
<header class="modern-header">
    <div class="modern-header-inner">
        <div class="brand-container">
            <img src="{{ asset('Logo/LogoRama.png') }}" class="brand-logo" alt="Rama Judicial">
            <div class="brand-info">
                <div class="brand-title">
                    Consejo Superior de la Judicatura<br>
                    Dirección Seccional de Administración Judicial<br>
                    Cali - Valle del Cauca
                </div>
                <div class="brand-subtitle">
                    "Fortaleciendo la justicia, promoviendo el bienestar de todos"
                </div>
            </div>
        </div>

        @auth
            <div class="user-panel-modern">
                <div class="user-icon"><i class="fa fa-user"></i></div>
                <div class="user-info">
                    <span class="user-name">{{ auth()->user()->name ?? auth()->user()->email }}</span>
                    <span class="user-status"><i class="fa fa-circle"></i> Sesión activa</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-button" title="Cerrar sesión">
                        <i class="fa fa-sign-out"></i>
                    </button>
                </form>
            </div>
        @endauth
    </div>
</header>

{{-- CONTENIDO --}}
<main class="page-container">
    @include('alerts.flash-message')

    <section class="modern-content">
        @yield('content')
    </section>
</main>

{{-- FOOTER --}}
<footer class="modern-footer">
    <div class="footer-inner">
        <div class="footer-left">
            &copy; {{ now()->year }} Todos los Derechos Reservados - <a href="{{ url('/legal') }}">Legal</a>
        </div>
        <div class="footer-stats">
            <div class="stat-box">Visitas hoy: <strong id="diaria">{{ isset($diaria) ? $diaria->visitas : '' }}</strong></div>
            <div class="stat-box">Total: <strong id="global">{{ isset($global) ? $global->visitas : '' }}</strong></div>
        </div>
    </div>
</footer>

<a href="#" class="sitelock-float" onclick="window.open('https://www.sitelock.com/verify.php?site=disajcali.gov.co', 'SiteLock', 'width=100,height=100,left=60,top=70'); return false;">
    <img class="img-fluid" alt="SiteLock" title="SiteLock" src="https://shield.sitelock.com/shield/disajcali.gov.co">
</a>

{{-- JAVASCRIPT --}}
<!-- Solo un jQuery para evitar conflictos -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/gallery/galeria/light-gallery/js/lightgallery-all.js') }}"></script>
<script src="{{ asset('/gallery/galeria/image-gallery.js') }}"></script>

<!-- Scripts esenciales para Siniestros (SweetAlert y Select2) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

@stack('scripts')

<script>
    $(function () {
        if ($('#searchtable').length) {
            $('#searchtable').DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });
        }
        
        // Inicializar Select2 genérico si existe
        if ($.fn.select2) {
            $('.select2').select2();
        }
    });
</script>

</body>
</html>
