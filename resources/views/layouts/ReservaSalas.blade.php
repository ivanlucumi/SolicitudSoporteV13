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
  <title>@yield('title')</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

  

  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('style')
  
 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GQV5YWSC6Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GQV5YWSC6Y');
</script> 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      font-family: 'Roboto', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.5;
      font-weight: 400;
      font-size: 16px;
      color: #333333; /* Color estándar para legibilidad */
    }

    h1 { font-size: 2rem; font-weight: 500; }
    h2 { font-size: 1.75rem; font-weight: 500; }
    h3 { font-size: 1.5rem; font-weight: 500; }
    body { margin: 0; padding: 0; }
    
    /* Contraste adecuado para accesibilidad */
    .form-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #424242;
    }
    
    /* Texto en campos de formulario */
    input, textarea, select {
      font-family: inherit;
      font-size: 1rem;
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
<body class="hold-transition skin-black  sidebar-mini ">
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
              <!-- The user image in the navbar-->
              <img src="/img/cerrar.png" href class="user-image" alt="User Image">

              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{!!"  ". auth()->user()->name."   ". auth()->user()->lastname!!}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li >
                <p >
                <a class="btn btn-danger btn-block " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesion
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form> 
                </p>
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
        <li class="header" style="color: #fff;"><strong>PANEL DE OPCIONES1</strong> </li>
        <!-- Optionally, you can add icons to the links -->
        <li @if (Request::url() == route('reservas.reserva.index')) class="active" @endif><a href="{!! route('reservas.reserva.index')!!}" ><i class="fa fa-home fa-2x"></i> <span class="mt-3 px-2 mb-2" >&nbsp;&nbsp;&nbsp;INDEX</span></a></li>
        
        <li @if (Request::url() == route('reservas.hoy.salas')) class="active" @endif><a href="{!! route('reservas.hoy.salas')!!}" ><i class="fa fa-calendar-check-o fa-2x"></i> <span class="mt-3 px-2 mb-2" >&nbsp;&nbsp;&nbsp;RESERVAS HOY</span></a></li>
        
        @foreach($Ubicaciones  as $ubicacion)
            <li>
                <?php $nombre1= $Ubicaciones[0]->ciudad->nombre_edificio ?>
                @if($nombre1 != $ubicacion->ciudad->nombre_edificio)
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i> <span class="mt-3 px-2 mb-2" >&nbsp;{{$ubicacion->ciudad->nombre_edificio}}</span>
                @else
                     &nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i> <span class="mt-3 px-2 mb-2" >&nbsp;{{$Ubicaciones[0]->ciudad->nombre_edificio}}</span>
                @endif
                
                <a href="{{ route('reservas.reserva.salas', $ubicacion->id) }}" class="fa fa-building" title="">{{ ' '.$ubicacion->ubicacion_nombre }}</a>
            </li>
        @endforeach
        
      
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
                @include('../alerts.success')
                @include('../alerts.request')
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


<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>

@stack('scripts')

  
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@include('layouts.script')

</body>
</html>