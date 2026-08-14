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

<style>
    :root {
  --primary-color: #003f75;
  --primary-dark: #002c57;
  --primary-darker: #00204a;
  --primary-light: #0056a3;
  --secondary-color: #f5f7fa;
  --accent-color: #007bff;
  --success-color: #004182;
  --warning-color: #ffc107;
  --danger-color: #dc3545;
  --info-color: #17a2b8;
  --light-color: #f8f9fa;
  --dark-color: #343a40;
  --border-radius: 8px;
  --box-shadow: 0 2px 8px rgba(0, 63, 117, 0.1);
  --box-shadow-lg: 0 4px 16px rgba(0, 63, 117, 0.15);
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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


@if( auth()->user()->email != "servisoft@disajcali.gov.co")
<body class="hold-transition skin-black  sidebar-mini sidebar-collapse ">
@else
<body class="skin-black sidebar-mini sidebar-collapse">
@endif
    
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header" style="background-color:#003f75 !important">

    <!-- Logo -->
    <a href="{{ url()->previous() }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <span class="logo-mini"><b><img src="{{asset('img/icono.png')}}"  width="50px" height="50px" alt=""></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIRIS CALI</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:#003f75 !important">
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
              <span class="hidden-xs" style="color: gray;"><strong>{!!"  ". auth()->user()->name."   ". auth()->user()->lastname!!}</strong></span>
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
  <aside class="main-sidebar" style="background-color:#003f75 !important">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- search form (Optional) -->
     
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color: #fff;"><strong>PANEL DE OPCIONES</strong> </li>
        
        
        <li title="Registro de Actividades"><a href="{!!route('activities.create')!!}"><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i> <span>Actividades</span></a></li>
        
        <li title="Actividades Por Despacho"><a href="{!!route('actividades.index')!!}"><i class="fa fa-bar-chart fa-2x" aria-hidden="true"></i> <span>Actividades Por Despacho</span></a></li>
        
        <!--li><a href="{!!route('normalizacion.registro')!!}"><i class="fa fa-address-book fa-2x"></i> <span>-> NORMALIZACION</span></a></li>
        <li><a href="{!!route('digitalizacion.inicio')!!}"><i class="fa fa-pencil-square fa-2x"></i> <span>->  ASIGNADOS</span></a></li-->
        
        @if( auth()->user()->email != "servisoft@disajcali.gov.co")
        <!-- Optionally, you can add icons to the links -->
        <!--li><a href="{!!route('digitalizacion.inicio')!!}"><i class="fa fa-address-book fa-2x"></i> <span>->  Index Protcolo Uno</span></a></li>
        <li><a href="{!!route('digitalizacion.revisada')!!}"><i class="fa fa-address-book"></i> <span>Dig. Revisada</span></a></li>
        <li ><a href="{!!route('digitalizacion.sin_revisar')!!}"><i class="fa fa-pencil-square" ></i> <span>Dig. Por Revisar</span></a></li>
        <li ><a href="{!!route('supervisor.segundarevision')!!}"><i class="fa fa-pencil-square" ></i> <span>Segunda Revisi&oacute;n</span></a></li-->
        
        
        @else
        <!--li><a href="{!!route('digitalizacion.revisada')!!}"><i class="fa fa-address-book fa-2x"></i> <span>->  Corregir</span></a></li-->
        @endif
        
        <!--li><a href="{!!route('supervisor.registroInventario')!!}"><i class="fa fa-address-book"></i> <span>Inventario Digitalizaci&oacute;n</span></a></li-->
        
        <!--li class="header" style="color: #fff;"><strong>PROTOCOLO DOS</strong> </li>
       
        <li><a href="{!!route('prodos.inicio')!!}"><i class="fa fa-trello fa-2x" aria-hidden="true"></i> <span> ->  Index Protcolo Dos</span></a></li>
        <li><a href="{!!route('supervisor.bestdco.inicio')!!}"><i class="fa fa-server fa-2x" aria-hidden="true"></i> <span> -> Migracion A BestDoc</span></a></li>
        <li><a href="{!!route('prodos.revisada')!!}"><i class="fa fa-address-book"></i> <span>Dig. Revisada Protcolo Dos</span></a></li>
        <li ><a href="{!!route('prodos.sin_revisar')!!}"><i class="fa fa-pencil-square" ></i> <span>Dig. Por Revisar Protcolo Dos</span></a></li>
        <li ><a href="{!!route('supervisor.segundarevision')!!}"><i class="fa fa-pencil-square" ></i> <span>Segunda Revisi&oacute;n Protcolo Dos</span></a></li -->
        @if( auth()->user()->email == "cgilgar@desajcali.gov.co")
        <!--li><a href="{!!route('novedades.registro.bestdoc')!!}"><i class="fa fa-bar-chart fa-2x" aria-hidden="true"></i> <span> -> Novedades Prot. 2</span></a></li>
        <li><a href="{!!route('revision.registro.bestdoc')!!}"><i class="fa fa-line-chart fa-2x" aria-hidden="true"></i> <span> -> Correciones Prot. 2</span></a></li-->
        @endif
        @if( auth()->user()->email == "mmaldonzap@cendoj.ramajudicial.gov.co" ||  auth()->user()->email == "root10@gmail.com" ||  auth()->user()->email == "aolivarc@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =='dachitop@cendoj.ramajudicial.gov.co')
        <!--li><a href="{!!route('normalizacion.registro.todo')!!}"><i class="fa fa-bar-chart fa-2x" aria-hidden="true"></i> <span> -> Ver Expedientes</span></a></li-->
        @endif
        
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

<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>        

<!--        https://cdnjs.com/libraries/bootstrap-datetimepicker-->
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>




<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
</script>

@stack('scripts')



</body>
</html>