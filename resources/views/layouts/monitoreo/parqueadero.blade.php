<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - SIRIS</title>

    <!-- Google Fonts: Inter & Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/toastr/toastr.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --bg-main: #f8fafc;
            --sidebar-bg: #0f172a;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: #1e293b;
        }

        .main-header {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
        }

        .main-sidebar {
            background-color: var(--sidebar-bg) !important;
            box-shadow: 4px 0 24px rgba(0,0,0,0.05);
        }

        .sidebar-menu > li > a {
            padding: 12px 20px;
            font-weight: 500;
            color: #94a3b8;
            border-left: 3px solid transparent;
            transition: var(--transition);
        }

        .sidebar-menu > li.active > a, .sidebar-menu > li:hover > a {
            background: rgba(255,255,255,0.05) !important;
            color: #fff !important;
            border-left-color: var(--primary);
        }

        .content-wrapper {
            background-color: var(--bg-main);
        }

        .box {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
        }

        .box-header {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .box-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            color: #0f172a;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 16px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* Status Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-adentro { background: #dce8f5; color: #004182; }
        .badge-finalizado { background: #f1f5f9; color: #475569; }

        /* Animations */
        .fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    @stack('style')
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
    <header class="main-header">
        <a href="{!! route('paqueadero.ingreso')!!}" class="logo" style="background: transparent; color: #0f172a;">
            <span class="logo-mini"><img src="{{asset('img/icono.png')}}" width="30"></span>
            <span class="logo-lg"><b style="font-family: 'Outfit">SIRIS</b> PARQUEADERO</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="color: #64748b">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="user-menu">
                        <a href="#" style="color: #475569; font-weight: 500">
                            <i class="fa fa-user-circle-o"></i> {!!  auth()->user()->name !!}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Cerrar Sesión" style="color: #ef4444">
                            <i class="fa fa-sign-out"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header" style="color: #475569; letter-spacing: 1px">OPERACI&Oacute;N</li>
                @if( auth()->user()->rol != 27)
                <li class="{{ request()->is('parqueadero') ? 'active' : '' }}">
                    <a href="{!! route('paqueadero.ingreso')!!}"><i class="fa fa-car"></i> <span>Dashboard Monitor</span></a>
                </li>
                <li><a href="{!! route('biometria.Parqueadero.inicio')!!}"><i class="fa fa-users"></i> <span>Ingreso Personal</span></a></li>
                <li class="{{ request()->routeIs('porteria.contratistas.index') ? 'active' : '' }}">
                    <a href="{!! route('porteria.contratistas.index')!!}"><i class="fa fa-briefcase"></i> <span>Ingreso Contratistas</span></a>
                </li>
                @endif
                @if( auth()->user()->rol == 27 || auth()->user()->rol == 10)
                <li class="{{ request()->routeIs('conductores.*') ? 'active' : '' }}">
                    <a href="{{ route('conductores.index') }}"><i class="fa fa-car"></i> <span>Conductores / Inspección</span></a>
                </li>
                @endif
                @if( auth()->user()->rol == 10)
                <li class="header" style="color: #475569; letter-spacing: 1px">ADMINISTRACIÓN</li>
                <li><a href="{!! route('cooringreso.parqueadero.index')!!}"><i class="fa fa-sliders"></i> <span>Gestión Puestos</span></a></li>
                <li><a href="{!! route('cooringreso.parqueadero.assignments')!!}"><i class="fa fa-id-card-o"></i> <span>Asignaciones</span></a></li>
                <li><a href="{!! route('cooringreso.vehiculos_oficiales.index')!!}"><i class="fa fa-car"></i> <span>Vehículos Oficiales</span></a></li>
                @endif
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content container-fluid">
            <div class="fade-in">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer" style="background: transparent; border: none; padding: 20px 0;">
        <div class="container-fluid text-center text-muted">
            <small>&copy; {{ date('Y') }} SIRIS CALI - Sistema de Gestión de Parqueaderos</small>
        </div>
    </footer>
</div>

<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<script src="/js/adminlte-layout.js"></script>
<script src="/toastr/toastr.min.js"></script>
<script src="/js/sweetalert2.all.js"></script>

@stack('scripts')
@include('layouts.script')
</body>
</html>