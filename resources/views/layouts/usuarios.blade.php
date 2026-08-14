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
      font-size: 0.975rem;
      font-weight: 500;
      color: #424242;
    }
    
    /* Texto en campos de formulario */
    input, textarea, select {
      font-family: inherit;
      font-size: 2rem;
    }
  </style>

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

  

  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">
  <link rel="stylesheet" href="/css/style.css">
  
  <style>
      .latido {
    animation: latido 1.5s infinite ease-in-out;
}

@keyframes latido {
    0%, 100% {
        transform: scale(1);
        background-color: #3498db; /* Azul */
    }
    50% {
        transform: scale(1.2);
        background-color: #daf8ea; /* Amarillo */
    }
}
  </style>

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
    <a href="{{ url()->previous() }}" class="logo" style="background-color: #274a8a">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <span class="logo-mini"><b><img src="{{asset('img/icono.png')}}"  width="50px" height="50px" alt=""></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="color: #fff;"><b>SIRIS CALI</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #274a8a">
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
  <aside class="main-sidebar" style="background-color: #274a8a">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- search form (Optional) -->
     
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree" style="background-color: #274a8a">
          
        <li class="header" style="color: #fff;background-color: #274a8a !important"><strong>PANEL DE OPCIONES</strong> </li>
        
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{!! url('/usuarios')!!}"><i class="fa fa-address-book"></i> <span>Index</span></a></li>
        <!-- EN LA CLASS PONER LATIDO PARA Q PARPADEE -->
        
        <li class="treeview  {{ request()->routeIs('usuario.solicitud.sgde') ? 'active' : '' }} {{ request()->routeIs('usuario.solicitud.capacitacion') ? 'active' : '' }} ">
          <a href="#"><i class="fa fa-address-book" aria-hidden="true"></i> <span>Sgde</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
           <li class="{{ request()->routeIs('usuario.solicitud.sgde') ? 'active' : '' }}"><a href="{!! route('usuario.solicitud.sgde')!!}"><i class=" fa fa-university" ></i> <span>Ayudas Sgde</span></a></li>
           <li class="{{ request()->routeIs('usuario.solicitud.capacitacion') ? 'active' : '' }}"><a href="{!!route('usuario.solicitud.capacitacion')!!}"><i class="fa fa-calendar"></i> <span>Capacitaci&oacute;n SGDE</span></a></li>
          </ul>
        </li>
        
        
        <!--li class=""><a href="{!!route('usuario.solicitud.sgde')!!}"><i class="fa fa-address-book" readonly></i> <span>Ayudas Sgde</span></a></li-->
         
            <!--li class=""><a href="{!!route('usuario.solicitud.capacitacion')!!}"><i class="fa fa-address-book" readonly></i> <span>Capacitaci&oacute;n SGDE</span></a></li-->
        
        <!--li class=""><a href="{!!route('usuario.solicitud.capacitacion.siugj')!!}"><i class="fa fa-address-book" readonly></i> <span>Capacitaci&oacute;n SIUGJ</span></a></li-->
        
        
        <!--li class=""><a href="{!!route('usuario.solicitud.capacitacion.siugj')!!}"><i class="fa fa-address-book" readonly></i> <span>Registro Capacitaci&oacute;n SIUGJ</span></a></li-->
        
            @if(now()->day <= 10)
                <li class=""><a href="{!!route('encuesta.IndexEncuenta')!!}"><i class="fa fa-area-chart" style="color:yellow" readonly></i> <span>Encuesta Uso Aplicativos</span></a></li>
            @endif
        
        <!--li class=""><a href="{!!route('usuario.solicitud.visita.siugj')!!}"><i class="fa fa-address-book" readonly></i> <span>Registro Visita SIUGJ</span></a></li-->
        
        <!--li><a href="{!!route('usuario.levantamineto.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Formulario SGDE</span></a></li-->
        
        <!--li><a href="{!! route('usuario.solicitud.trabajo.remoto')!!}"><i class="fa fa-globe"></i> <span>Solicitud Teletrabajo</span></a></li-->
        
        <li class="treeview  {{ request()->routeIs('usuario.reservas.reserva.index') ? 'active' : '' }} {{ request()->routeIs('usuario.consulta.reserva.sala') ? 'active' : '' }} {{ request()->routeIs('usuario.audiencias.pendientes') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Audiencias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              @if( auth()->user()->sede_ciudad == "76520")
                <li class="{{ request()->routeIs('usuario.reservas.reserva.index') ? 'active' : '' }}"><a href="{!!route('usuario.reservas.reserva.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Reservar de Salas Audiencia</span></a></li>
              @endif
           <li class="{{ request()->routeIs('usuario.consulta.reserva.sala') ? 'active' : '' }}"><a href="{!! route('usuario.consulta.reserva.sala')!!}"><i class=" fa fa-university" ></i> <span>Reserva Sala Audiencias</span></a></li>
           <li class="{{ request()->routeIs('usuario.audiencias.pendientes') ? 'active' : '' }}"><a href="{!!route('usuario.audiencias.pendientes')!!}"><i class="fa fa-address-book"></i> <span>Audiencias LifeSize</span></a></li>
          </ul>
        </li>
        
        <!--li  style="display=none"><a href="{!! route('usuario.solicitar.audiencia')!!}" ><i class="fa fa-at "></i> <span>Solicitar Audiencia Virtual</span></a></li-->
        <li><a href="{!! route('usuario.solicitud.servicio')!!}"><i class="fa fa-gavel" style="color:brown"></i> <span>Solicitud Servicios</span></a></li>
        
        <li alt="Portal de Insumos de Papeleria y Elementos de Oficina - Pipe" class="treeview {{ request()->routeIs('usuario.elementos.almacen') ? 'active' : '' }} {{ request()->routeIs('usuario.descarga.formatos') ? 'active' : '' }} {{ request()->routeIs('usuario.elementos.almacen.historico') ? 'active' : '' }}" >
          <a href="#"  <i class="fa fa-newspaper-o " aria-hidden="true"></i> <span>Portal de Insumos PIPE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
             <li class=" {{ request()->routeIs('usuario.elementos.almacen') ? 'active' : '' }}"><a href="{!! route('usuario.elementos.almacen')!!}"><i class=" fa fa-line-chart" ></i> <span>Solicitud Almac&eacute;n</span></a></li>
            @if( auth()->user()->email == "siriscali@cendoj.ramajudicial.gov.co")
            @endif
            <li class=" {{ request()->routeIs('usuario.elementos.almacen.historico') ? 'active' : '' }}"><a href="{!! route('usuario.elementos.almacen.historico')!!}"><i class=" fa fa-line-chart" ></i> <span>Hist&oacute;rico Almac&eacute;n</span></a></li>
            
            <li class="{{ request()->routeIs('usuario.descarga.formatos') ? 'active' : '' }}"><a href="{!!route('usuario.descarga.formatos')!!}" ><i class="fa fa-pencil-square" ></i> <span>Consulta Inventario y Formatos.</span></a></li>
          </ul>
        </li>
        @if( auth()->user()->email == "siriscali@cendoj.ramajudicial.gov.co")
        <li class="treeview {{ request()->routeIs('usuario.reportar.incidente') ? 'active' : '' }} {{ request()->routeIs('usuario.reportar.incidente') ? 'active' : '' }} {{ request()->routeIs('usuario.reportar.incidente') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-newspaper-o " aria-hidden="true"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
             <li class=" {{ request()->routeIs('usuario.elementos.almacen') ? 'active' : '' }}"><a href="{!! route('usuario.reportar.incidente')!!}"><i class=" fa fa-line-chart" ></i> <span>Solicitud Mantenimiento</span></a></li>
            
          </ul>
        </li>
        @endif
        
        @if(\Carbon\Carbon::now()->toDateString() > "2024-07-31")
             <li><a href="{!!route('usuario.informe.teletrabajo.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Reporte Teletrabajo</span></a></li>
        @endif
        <!--li><a href="{!! url('/UsuariosSolicitud/create')!!}"><i class="fa fa-gavel"></i> <span>Crear Solicitudes</span></a></li-->
        <!--li><a href="{!!route('missolicitudes')!!}"><i class="fa fa-address-book"></i> <span>Revisar mis Solicitudes</span></a></li-->
        
        <li class="treeview {{ request()->routeIs('prestamo.equipos.index') ? 'active' : '' }} {{ request()->routeIs('solicitud_ingreso.create') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span class="text-danger">Contingencia Terremoto</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('prestamo.equipos.index') ? 'active' : '' }}"><a href="{!!route('prestamo.equipos.index')!!}"><i class="fa fa-pencil-square"></i> <span  >Solicitud Pr&eacute;stamo Equipo</span></a></li>
            <li class="{{ request()->routeIs('solicitud_ingreso.index') || request()->routeIs('solicitud_ingreso.create') ? 'active' : '' }}"><a href="{!! route('solicitud_ingreso.index') !!}"><i class="fa fa-sign-in"></i> <span>Solicitud de Ingreso</span></a></li>
          </ul>
        </li>
        <!--li ><a href="{!!route('usuario.digitalizacion.reporte')!!}"><i class="fa fa-pencil-square" readonly="true" disabled="disabled"></i> <span>Inventario Digitalizaci&oacute;n</span></a></li-->
        
        @if( auth()->user()->requerimiento == "REQUERIMIENTO")
        <li><a href="{!!route('requerimientodespachos.create')!!}" ><i class="fa fa-area-chart"></i> <span>Requerimiento Despacho</span></a></li>
        
        <!--li><a href="{!!route('requerimientodespachos.index')!!}" ><i class="fa fa-area-chart"></i> <span>Requerimiento Oficina</span></a></li-->
        
        <li><a href="{!!route('requerimientodespachos.create')!!}" ><i class="fa fa-area-chart"></i> <span>Requerimiento Despacho </span></a></li>
         
        @endif
         @if( auth()->user()->email == "siriscali@cendoj.ramajudicial.gov.co")
        <li class="treeview">
          <a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Remision Reparto OFJ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!!route('usuario.ficha.remision')!!}"><i class="fa fa-pencil-square"></i> <span>Ficha Remisi&oacute;n</span></a></li>
           <li><a href="{!! route('usuario.historico.ficha.remision')!!}"><i class=" fa fa-line-chart" ></i> <span>Hist&oacute;rico</span></a></li>
          </ul>
        </li>
        <!--ficha de remision-->
        <li class="treeview">
          <a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Remision Reparto Cent.Serv</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!!route('usuario.ficha.preliminar')!!}"><i class="fa fa-pencil-square"></i> <span>Ficha Preliminar</span></a></li>
           <li><a href="{!! route('usuario.historico.ficha.preliminar')!!}"><i class=" fa fa-line-chart" ></i> <span>Hist&oacute;rico</span></a></li>
           
          </ul>
        </li>
        
           
        @endif
        
        <!--li><a href="{!!route('usuario.optometria.agendamiento')!!}"><i class="fa fa-address-book"></i> <span>Jornada Bienestar</span></a></li-->
        <li><a href="{!!route('usuario.clasificados.index')!!}" ><i class="fa fa-newspaper-o"></i> <span>Clasificados</span></a></li>
        
        @if( auth()->user()->tipo_rol == "OFICINA" ||  auth()->user()->email =="siriscali@cendoj.ramajudicial.gov.co")
        <li><a href="{!!route('usuario.seguimient.presencialidad.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Atenci&oacute;n Publico</span></a></li>
        @endif
        
        @if(  auth()->user()->email =="siriscali@cendoj.ramajudicial.gov.co")
        <li><a href="{!!route('usuario.seguimient.presencialidad.despacho.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Atenci&oacute;n Publico D</span></a></li>
        @endif
        
        @if(  auth()->user()->email =="siriscali@cendoj.ramajudicial.gov.co")
        <li><a href="{!!route('usuario.levantamineto.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Formulario SGDE</span></a></li>
        <li><a href="{!!route('usuario.docuemntos.trabajo.remoto')!!}" ><i class="fa fa-pencil-square"></i> <span>Enviar Documento Formalizado</span></a></li>
        <li><a href="{!!route('usuario.informe.teletrabajo.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Reporte Teletrabajo</span></a></li>
        
        @endif
        
        
        
       
        <!--li><a href="{!!route('consultar.usuario.vacunacion')!!}"><i class="fa fa-address-book"></i> <span>Agendamiento Vacuna</span></a></li-->
        <!--li><a href="{!!route('consultar.usuario.salud.index')!!}"><i class="fa fa-address-book"></i> <span>Jornada de Salud</span></a></li-->
        <li class="treeview">
        <!--  <a href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>Descargar Formatos</span>  usuario.descarga.formatos
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <a href=""onClick="window.open('/img/DocFormatos/formato.docx','popup', 'width=800px,height=600px')" class="product-title"><i class="fa fa-file-excel-o fa-1x text-danger" aria-hidden="true"></i>
		  <div class="mask flex-center waves-effect waves-light"></div>
		  </a> 
          
          <li><a href="#"><i class="fa fa-address-book"></i> <span>1</span></a></li>
          </ul>
        </li>-->
       
        
        <!--li><a href="{!!route('esquema.vacunacion')!!}"><i class="fa fa-address-book"></i> <span>Encuesta Esquema Vacunaci&oacute;n</span></a></li>
        
        <li><a href="{!!route('consultar.usuario.vacunacion')!!}"><i class="fa fa-address-book"></i> <span>Agendamiento Vacuna</span></a></li-->
        
        @if( auth()->user()->email == "siriscali@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="j01pccali@cendoj.ramajudicial.gov.co")
        <li><a href="{!!route('usuario.solicitud.notificacion')!!}" ><i class="fa fa-pencil-square"></i> <span>Solicitud Para Notificar</span></a></li>
        
        <li><a href="{!!route('usuario.historico.notificacion')!!}" ><i class="fa fa-eye"></i> <span>Historico Notificaciones</span></a></li>
        @endif
        @if( auth()->user()->email == "sdisajcali@cendoj.ramajudicial.gov.co")
        <li><a href="{!!route('usuario.solicitud.ingreso.autorizar')!!}" ><i class="fa fa-pencil-square"></i> <span>Autorizar Ingreso Archivo</span></a></li>
        @endif
         @if( auth()->user()->email == "siriscali@cendoj.ramajudicial.gov.co")
           
        <li><a href="{!!route('usuario.reservas.reserva.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Reserva de Salas Audiencia</span></a></li>
        @endif
         @if( auth()->user()->sede_ciudad == "76520")
           
        <li><a href="{!!route('usuario.reservas.reserva.index')!!}" ><i class="fa fa-pencil-square"></i> <span>Reserva de Salas Audiencia</span></a></li>
        
        @endif
         @if( auth()->user()->lleno_form_dig  != "SI" )
        <!--li><a href="{!!route('usuario.digitalizacion.despacho')!!}" ><i class="fa fa-check-square-o text-red" aria-hidden="true"></i> <span>Proceso de Digitalizaci&oacute;n </span></a></li-->
        @endif
        
        <li>
            <a href="{!! route('consulta.consejo.estado') !!}" target="_blank">
                <i class="fa fa-gavel fa-2x text-danger" aria-hidden="true"></i>
                <span> Consejo Seccional</span>
            </a>
        </li>
        @if( auth()->user()->email == "siriscali@cendoj.ramajudicial.gov.co" ||  auth()->user()->email == "root10@gmail.com")
        
        <li><a href="{!!route('consulta.escalafon.form')!!}" ><i class="fa fa-pencil-square"></i> <span>Certificado Escalaf&oacute;n</span></a></li>
        @endif
      </ul>
      <!-- /.sidebar-menu usuario.clasificados.index -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/adminlte/plugins/iCheck/icheck.min.js"></script> 
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
</script>

@stack('scripts')

  
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@include('layouts.script')

</body>
</html>