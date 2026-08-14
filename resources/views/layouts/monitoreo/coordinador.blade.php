<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio teléfonico disajcali"/>
  <meta name="author" content="">
  <title>@yield('title')</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">


  

  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">

  <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/css/style.css">
  
  <!-- mensajes toastr -->
  <link rel="stylesheet" href="/toastr/toastr.min.css">

  @stack('style')
  
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #003f75;
      --primary-dark: #002b50;
      --accent: #ffc107;
    }

    body {
      font-family: 'Outfit', sans-serif !important;
    }

    /* Modern Header */
    .main-header .navbar {
      background-color: var(--primary) !important;
      box-shadow: 0 4px 15px rgba(77, 168, 248, 0.36);
      border: none !important;
    }

    .main-header .logo {
      background-color: var(--primary-dark) !important;
      color: white !important;
      border: none !important;
    }

    .main-header .navbar .sidebar-toggle:hover {
      background-color: var(--primary-dark) !important;
    }

    /* Premium Sidebar */
    .main-sidebar, .sidebar {
      background-color: #ffffff !important;
      box-shadow: 2px 0 20px rgba(0, 0, 0, 0.05) !important;
      border-right: 1px solid #f1f5f9;
    }

    .sidebar-menu {
      background-color: #ffffff !important;
    }

    .treeview-menu {
      background-color: #ffffff !important;
      padding-left: 5px;
    }

    .sidebar-menu>li>a, .treeview-menu>li>a {
      border-left: 3px solid transparent;
      margin: 4px 10px;
      border-radius: 12px;
      transition: all 0.3s ease;
      color: #64748b !important;
      font-weight: 500;
    }

    .sidebar-menu>li:hover>a,
    .sidebar-menu>li.active>a,
    .treeview-menu>li:hover>a,
    .treeview-menu>li.active>a {
      background-color: #f1f5f9 !important;
      color: var(--primary-dark) !important;
      border-left-color: var(--accent) !important;
    }

    .sidebar-menu>li.active>a {
      font-weight: 700;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .sidebar-menu .header {
      background: transparent !important;
      color: #94a3b8 !important;
      font-size: 11px;
      letter-spacing: 1px;
      padding-top: 25px;
      padding-bottom: 10px;
    }

    .sidebar-menu i {
      margin-right: 10px;
      font-size: 16px;
      transition: transform 0.3s ease;
    }

    .sidebar-menu li:hover i {
      transform: scale(1.2);
      color: var(--primary);
    }

    /* Content Area */
    .content-header {
      padding: 25px 15px 0 15px !important;
    }

    .breadcrumb {
      background: white !important;
      border-radius: 50px !important;
      padding: 8px 20px !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      font-weight: 600;
    }

    .wrapper,
    .content-wrapper {
      background-color: #f8fafc !important;
    }

    /* Premium Pagination & Table Filters */
    .premium-pagination .pagination {
        margin: 10px 0;
        display: inline-block;
    }
    .premium-pagination .pagination li a, 
    .premium-pagination .pagination li span {
        border-radius: 8px !important;
        margin: 0 3px;
        color: var(--primary) !important;
        border: 1px solid #dee2e6;
        padding: 6px 12px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .premium-pagination .pagination li.active span {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
    }
    .premium-pagination .pagination li a:hover {
        background-color: #f1f5f9;
        color: var(--primary-dark);
        transform: translateY(-1px);
    }

    .table-header-filter {
        background-color: #f1f5f9 !important;
    }
    .table-header-filter input, 
    .table-header-filter select {
        height: 30px !important;
        padding: 4px 8px !important;
        font-size: 12px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        width: 100%;
        background-color: white;
    }
    .table-header-filter input:focus,
    .table-header-filter select:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 2px rgba(0, 63, 117, 0.1) !important;
        outline: none;
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-black  sidebar-mini  ">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url()->previous() }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <span class="logo-mini"><b><img src="{{asset('img/icono.png')}}"  width="50px" height="50px" alt=""></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIRIS CALI</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
         
          <!-- Tasks Menu -->
         
          <!-- User Account Menu -->
         <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user-circle-o" style="font-size: 20px; vertical-align: middle;"></i>
              <span class="hidden-xs" style="font-weight: 600; margin-left: 5px;">{!!  auth()->user()->name !!}</span>
            </a>
            <ul class="dropdown-menu" style="border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: none;">
              <!-- The user image in the menu -->
              <li class="user-header" style="background-color: var(--primary); height: auto; padding: 20px;">
                <p style="color: white; margin: 0;">
                  {{  auth()->user()->name }} {{  auth()->user()->lastname }}
                  <small style="opacity: 0.8;">{{  auth()->user()->email }}</small>
                </p>
              </li>
              <li class="user-footer" style="padding: 15px;">
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-flat" style="border-radius: 10px;">
                    Cerrar Sesión
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- search form (Optional) -->
     
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color: #fff;"><strong>PANEL DE OPCIONES</strong> </li>
        <!-- Optionally, you can add icons to the links 
        <li><a href="{!! route('coordinador.control.ingreso')!!}"><i class="fa fa-at"></i> <span>Solicitudes de  Ingreso</span></a></li>-->
        <li><a href="{!!route('coordinador.ingreso')!!}"><i class="fa fa-pencil-square"></i> <span>Registrar Solicitud Ingreso</span></a></li>
        
        @if( auth()->user()->rol == 10)
        <li class="treeview {{ request()->is('coordinador/ingresos/bitacora/*') || request()->is('coordinador/ingresos/admin-parqueadero/*') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-building" aria-hidden="true"></i> <span>Parqueadero</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! route('cooringreso.parqueadero.index')!!}"><i class="fa fa-building"></i> <span>Gestionar Puestos</span></a></li>
            <li><a href="{!! route('cooringreso.funcionarios.index')!!}"><i class="fa fa-id-card"></i> <span>Gestionar Funcionarios</span></a></li>
            <li><a href="{!! route('cooringreso.temporales.index')!!}"><i class="fa fa-clock-o"></i> <span>Gestión de Temporales</span></a></li>
            <li><a href="{!! route('cooringreso.parqueadero.assignments')!!}"><i class="fa fa-users"></i> <span>Ver Asignaciones</span></a></li>
            <li class="{{ request()->routeIs('cooringreso.permisos.*') ? 'active' : '' }}">
                <a href="{!! route('cooringreso.permisos.index') !!}">
                    <i class="fa fa-calendar-check-o"></i> <span>Permisos Fin de Semana</span>
                </a>
            </li>
            <li><a href="{!!route('cooringreso.bitacora.index')!!}"><i class="fa fa-history"></i> <span>Bitácora Parqueadero</span></a></li>
          </ul>
        </li> 
        <li class="treeview {{ request()->is('coordinador/ingresos/vehiculos-oficiales*') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-car" aria-hidden="true"></i> <span>Vehículos Oficiales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('cooringreso.vehiculos_oficiales.index') ? 'active' : '' }}">
                <a href="{!! route('cooringreso.vehiculos_oficiales.index') !!}"><i class="fa fa-list"></i> <span>Listado y Asignación</span></a>
            </li>
            <li class="{{ request()->routeIs('cooringreso.vehiculos_oficiales.historial_global') ? 'active' : '' }}">
                <a href="{!! route('cooringreso.vehiculos_oficiales.historial_global') !!}"><i class="fa fa-folder-open"></i> <span>Todos los Reportes</span></a>
            </li>
          </ul>
        </li>
        @endif

        <li><a href="{!!route('coordinador.control.consulta')!!}"><i class="fa fa-pencil-square"></i> <span>Consultar Ing Externo</span></a></li>
        
       <li class="treeview {{ request()->is('coordinador/ingresos/informe/*') || request()->is('coordinador/ingresos/gestion/*') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-building" aria-hidden="true"></i> <span>Ingreso Contratistas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ request()->routeIs('coordinador.ingresos') ? 'active' : '' }}">
                <a href="{!! route('coordinador.ingresos') !!}"><i class="fa fa-users"></i> <span>Coordinacion Acceso Contratista</span></a>
            </li>
            <li class="{{ request()->routeIs('coordinador.informe') ? 'active' : '' }}">
                <a href="{!! route('coordinador.informe') !!}"><i class="fa fa-file-text-o"></i> <span>Informe Ingresos</span></a>
            </li>
          </ul>
        </li>  
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> @yield('cabecera')</li>
        </ol>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
              <div class="container-fluid">
                @include('alerts.flash-message')
                @include('alerts.sweetalert')
                 @yield('content')
                 <br>
              </div>
               <br>
           </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      FP-IL
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="{!! url('/legal')!!}" target="_blank">SIRIS CALI</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->

<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<script src="/js/adminlte-layout.js"></script>


<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>

<!-- mensajes toastr -->
  <script src="/toastr/toastr.min.js"></script>

@stack('scripts')
<script src="/js/sweetalert2.all.js"></script>

<script>
  $(document).ready(function() {
    // Restringir campos de placa para que solo acepten letras y números
    $(document).on('input', 'input[name*="placa"], input[id*="placa"]', function() {
      this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
    });
  });
</script>
  
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@include('layouts.script')

</body>
</html>