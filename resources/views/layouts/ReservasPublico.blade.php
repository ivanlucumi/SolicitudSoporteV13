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
  <meta name="author" content="ICLG">
  <meta name="robots" content="noindex">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">


  <!-- mensajes swetalert2 -->
  <script src="/js/sweetalert2.all.js"></script>

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

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
<body class="hold-transition skin-black  sidebar-mini sidebar-collapse ">
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
              <span class="hidden-xs"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li >
                <p >
               
              </li>
              
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>

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
                <div id="principalPanel">
                    @yield('content')
                  </div>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@stack('scripts')

  
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@include('layouts.script')

</body>
</html>