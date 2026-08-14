<!DOCTYPE html>
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
  
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/Adminltefullcalendar/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/Adminltefullcalendar/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/Adminltefullcalendar/bower_components/Ionicons/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="/Adminltefullcalendar/bower_components/fullcalendar/dist/fullcalendar.css">
  <link rel="stylesheet" href="/Adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- Theme style -->
  <link rel="stylesheet" href="/Adminltefullcalendar/dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="/Adminltefullcalendar/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="/Adminltefullcalendar/dist/css/ripples.min.css">
  <link rel="stylesheet" href="/Adminltefullcalendar/dist/css/MaterialAdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 <link rel="stylesheet" href="/Adminltefullcalendar/dist/css/skins/all-md-skins.min.css">
 
 <!-- Select2 -->
  <link rel="stylesheet" href="/Adminltefullcalendar/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/Adminltefullcalendar/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="/Adminltefullcalendar//bower_components/select2/dist/css/select2.min.css">
  <link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet">
  
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-black  fixed sidebar-mini">
<!-- Site wrapper -->
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
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                    </form> 
                </p>
              </li>
              
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header><br><br>

  <!-- =============================================== -->
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree" >
        <!--<li class="header">HEADER</li>
         Optionally, you can add icons to the links -->
        <li class="header" style="color: #fff;"><strong>PANEL DE OPCIONES</strong> </li>
        <li><a href="{!! url('/reservas')!!}" ><i class="fa fa-ticket"></i> <span >Reservas</span></a></li>
         <li><a href="{!! route('reservas_sin_publicar')!!}" ><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span >Reservas Sin Publicar</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-default">
          <div class="container-fluid">
            <div class="col align-self-center">
             <p style="text-align: center;"> <h2> @yield('encabezado')</h2> </p>
            </div>
          </div>

         
          <!-- /.box-body -->
        </div>
        <!-- /.box --> 
      
    </section>

    <!-- Main content -->
    <section class="content">
         <div class="box box-default">
          <div class="container-fluid">
            <br>
             @yield('content')
             
          </div>
          <div class="container-fluid">
                   
                   <div class="row">
                       <div class="col-xs-12 col-md-3">@yield('salas')</div>
                       <div class="col-xs-12 col-md-9">@yield('calendar')</div>
                   </div>
                   
                   <br>
                </div>

         
          <!-- /.box-body -->
        </div>
        <!-- /.box -->     

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>FP-IL</b>
    </div>
   <strong>Copyright &copy; 2018 - 2020 <a href="{!! url('/legal')!!}" target="_blank">SIRIS CALI</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="/Adminltefullcalendar/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/Adminltefullcalendar/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="/Adminltefullcalendar/dist/js/material.min.js"></script>
<script src="/Adminltefullcalendar/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- Select2 -->
<script src="/Adminltefullcalendar/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/Adminltefullcalendar/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="/Adminltefullcalendar/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/Adminltefullcalendar/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/Adminltefullcalendar/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Select2 -->
<script src="/plugins/select2/js/select2.full.min.js"></script>

<!-- fullCalendar -->
<script src="/Adminltefullcalendar/bower_components/moment/moment.js"></script>
<script src="/Adminltefullcalendar/bower_components/fullcalendar/dist/fullcalendar.js"></script>
<script src="/Adminltefullcalendar/bower_components/fullcalendar/dist/locale/es.js"></script>
<!-- Page specific script -->
<!-- Page specific script -->

<script>
  //Initialize Select2 Elements
    $('.select2').select2()
</script>

@stack('scripts')

</body>
</html>
