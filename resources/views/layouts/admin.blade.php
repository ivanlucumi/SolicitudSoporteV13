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

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

  

  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">
  <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/css/style.css">
  

  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
  <header class="main-header" >

    <!-- Logo -->
    <a href="{{ url()->previous() }}" class="logo" style="background-color: #274a8a">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <span class="logo-mini"><b><img src="{{asset('img/icono.png')}}"  width="50px" height="50px" alt=""></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIRIS CALI</b></span>
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
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color: #274a8a">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree" >
        <li class="header" style="color: #fff; background-color: #274a8a"><strong>GRUPO SOPORTE TECNOL&Oacute;GICO</strong> </li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-home" aria-hidden="true"></i> <span>Index</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
        @if( auth()->user()->tipo_rol !="SECCIONAL" &&  auth()->user()->tipo_rol !="ARL" &&  auth()->user()->tipo_rol !="ADMINISTRACION" &&  auth()->user()->tipo_rol !="SECCIONAL_BASICO" &&  auth()->user()->tipo_rol !="BIENESTAR")
          <ul class="treeview-menu">
            <li><a href="{!! url('/administrador/banner')!!}"><i class="fa fa-image" ></i> <span>Banner</span></a></li>
            <li><a href="{!! route('baner.coe')!!}"><i class="fa fa-map-o" ></i> <span>Banner Coe</span></a></li>
            <li><a href="{!! url('/administrador/sst-documentos')!!}"><i class="fa fa-file-image-o" ></i> <span>SST Documentos</span></a></li>
            <li><a href="{!! url('/administrador/genero-documentos')!!}"><i class="fa fa-link" ></i> <span>Genero Documentos</span></a></li>
            <li><a href="{!! url('/administrador/genero-galeria')!!}"><i class="fa fa-link" ></i> <span>Genero Galer&iacute;a</span></a></li>
            <li><a href="{!! url('/administrador/genero-enlaces')!!}"><i class="fa fa-link" ></i> <span>Genero Enalces</span></a></li>                     
            <li><a href="{!! url('/administrador/especial')!!}"><i class="fa fa-file-image-o" ></i> <span>Imagenes Informativas</span></a></li>
            <li><a href="{!! url('/administrador/institucional')!!}"><i class=" fa fa-institution" ></i> <span>Institucional</span></a></li>
             <li><a href="{!! url('/administrador/noticias')!!}"><i class="fa fa-address-card-ofa fa-newspaper-o" ></i> <span>Noticias</span></a></li>
             <li><a href="{!! route('admin.consulta.dia.familia')!!}"><i class="fa fa-address-card-ofa fa-newspaper-o" ></i> <span>D&iacute;a de la Familia</span></a></li>
          </ul>
        </li>

       
      

        <li class="treeview">
          <a href="#"><i class="fa fa-clipboard" aria-hidden="true"></i> <span>Requerimientos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{!! url('/administrador/ciudad')!!}"><i class=" fa fa-home" ></i> <span>Ciudades</span></a></li>
            <li><a href="{!! url('/administrador/requerimientos')!!}"><i class=" fa fa-eye" ></i> <span>Requerimientos</span></a></li>
            <li><a href="{!! url('/administrador/tiempoAtencion')!!}"><i class=" fa fa-group" ></i> <span>Tiempos de atenci&oacute;n</span></a></li>
            <li><a href="{!! url('/administrador/categorias')!!}"><i class=" fa fa-group" ></i> <span>Categorias</span></a></li>
            <li><a href="{!! url('/administrador/elementos')!!}"><i class=" fa fa-wpexplorer" ></i> <span>Elementos</span></a></li>
            <li><a href="{!! url('/administrador/seccionales')!!}"><i class=" fa fa-desktop" ></i> <span>Seccionales</span></a></li>

          </ul>
        </li>

	<li class="treeview">
          <a href="#"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> <span>Distribucion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{!! url('/administrador/reservas-juzgados')!!}"><i class=" fa fa-ticket "  ></i> <span>Reservas</span></a></li>
           <li><a href="{!! url('/administrador/torres-juzgados')!!}"><i class=" fa fa-university" ></i> <span>Torres</span></a></li>
            <li><a href="{!! url('/administrador/pisos-juzgados')!!}"><i class=" fa fa-square-o" ></i> <span>Pisos</span></a></li>
            <li><a href="{!! url('/administrador/salas-juzgados')!!}"><i class=" fa fa-th-list" ></i> <span>Salas</span></a></li>
          </ul>
        </li>
        <li class="treeview {{ request()->routeIs('administrador.registro.solicitud') ? 'active' : '' }} {{ request()->routeIs('administrador.registro.solicitud.resueltas') ? 'active' : '' }} {{ request()->routeIs('administrador.registro.solicitud.estadistica') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span>Requerimiento Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="{{ request()->routeIs('administrador.registro.solicitud') ? 'active' : '' }}"><a href="{!! route('administrador.registro.solicitud')!!}"><i class=" fa fa-wrench "  ></i> <span>Presentadas</span></a></li>
           <li class="{{ request()->routeIs('administrador.registro.solicitud.resueltas') ? 'active' : '' }}"><a href="{!! route('administrador.registro.solicitud.resueltas')!!}"><i class=" fa fa-university" ></i> <span>Resueltas</span></a></li>
           
           <li class="{{ request()->routeIs('administrador.registro.solicitud.estadistica') ? 'active' : '' }}"><a href="{!! route('administrador.registro.solicitud.estadistica')!!}"><i class=" fa fa-pie-chart" ></i> <span>Estadistica</span></a></li>
          </ul>
        </li>

         <li class="{{ request()->routeIs('despachos.index') ? 'active' : '' }}"><a href="{!! url('/administrador/despachos')!!}"><i class="fa fa-university" aria-hidden="true"></i> <span>Despachos</span></a></li>
         
         <li class="{{ request()->routeIs('administrador.audiencias') ? 'active' : '' }}"><a href="{!! route('administrador.audiencias')!!}"><i class="fa fa-gavel" aria-hidden="true"></i> <span>Audiencias</span></a></li>
         <li class="{{ request()->routeIs('administrador.estadistica') ? 'active' : '' }}"><a href="{!! route('administrador.estadistica')!!}"><i class="fa fa-pie-chart" aria-hidden="true"></i> <span>Estadística</span></a></li>
         
         
         
                
            <li class="treeview">
          <a href="#"><i class="fa fa-user-plus"></i> <span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! url('/administrador/user')!!}"><i class="fa fa-address-book"></i> <span>Usuarios Sistema</span></a></li>
            <li><a href="{!! url('/administrador/empleados')!!}"><i class=" fa fa-user-circle" ></i> <span>Empleados</span></a></li>
            <li><a href="{!! url('/administrador/rol')!!}"><i class="fa fa-gavel"></i> <span>Roles</span></a></li>
            </ul>
        </li>

        <li class="treeview {{ request()->routeIs('administrador.carga.excel.teletrabajo.2024') ? 'active' : '' }}">
          <a href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>Archivos de Excel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <li><a href="{!! route('emppleados.excel')!!}"><i class="fa fa-address-book"></i> <span>Excel Actualizacion Empleados</span></a></li>
            <li><a href="{!! route('administrador.carga.excel.estado.archivo')!!}"><i class="fa fa-address-book"></i> <span>Excel Estado Expediente</span></a></li>
            <li><a href="{!! route('digitalizacion.cargue')!!}"><i class="fa fa-address-book"></i> <span>Excel Registro Digitalizacion</span></a></li>
            <li><a href="{!! route('administrador.carga.excel.bestdoc')!!}"><i class="fa fa-address-book"></i> <span>Excel Registro BestDoc</span></a></li>
            <li><a href="{!! url('/administrador/store/despachos')!!}"><i class="fa fa-address-book"></i> <span>Usuarios Sistema por excel</span></a></li>
            <li><a href="{!! route('emppleados.excel')!!}"><i class="fa fa-address-book"></i> <span>Empleados por excel</span></a></li>
            
            <li><a href="{!! url('/administrador/store/solcitud/audiencia')!!}"><i class=" fa fa-user-circle" ></i> <span>Excel Solicitud Audiencia</span></a></li>
            <li><a href="{!! route('emppleados.activos.excel')!!}"><i class="fa fa-address-book"></i> <span>Contratos Activos</span></a></li>
            <li><a href="{!! route('parqueadero.excel.index')!!}"><i class="fa fa-address-book"></i> <span>Excel Parqueadero</span></a></li>
            <li><a href="{!! route('restriccion.salud.excel.index')!!}"><i class="fa fa-address-book"></i> <span>Excel Restriccion Salud</span></a></li>
            <li><a href="{!! route('factura.cumplido.excel.index')!!}"><i class="fa fa-address-book"></i> <span>Excel Factura Cumplido</span></a></li>
            <li><a href="{!! route('index.codigo.despacho.excel')!!}"><i class="fa fa-address-book"></i> <span>Cambio Codigo Despacho</span></a></li>
            <li class="{{ request()->routeIs('administrador.carga.excel.teletrabajo.2024') ? 'active' : '' }}"><a href="{!! route('administrador.carga.excel.teletrabajo.2024')!!}"><i class="fa fa-address-book"></i> <span>Cargar Excel Teletrabajo</span></a></li>
            
            

          </ul>
        </li>
         <li class="treeview">
          <a href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>Digitalizaci&oacute;n</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="{!! route('administrador.registro.incidentes')!!}"><i class="fa fa-address-book"></i> <span>Incidentes Digitalizaci&oacute;n</span></a></li>
             <li><a href="{!! route('administrador.inventario.digitalizacion')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Inventario Digitalizacion</span></a></li>
             <li><a href="{!! route('administrador.estadistica.digitalizacion')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Estad&iacute;stica Digitalizacion</span></a></li>
         <li><a href="{!! route('administrador.resultado.encuesta')!!}"><i class="fa fa-pie-chart" aria-hidden="true"></i> <span>Encuesta Digitalizaci&oacute;n</span></a></li>
        

          </ul>
        </li>
        
        
         
         <li class="treeview">
          <a href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left  pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            @if( auth()->user()->email =="jortegas@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="mfernandp@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="gmstdesajvalle3@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="aolivarc@cendoj.ramajudicial.gov.co"||  auth()->user()->email =="gmstdesajvalle2@cendoj.ramajudicial.gov.co")
             <li><a href="{!! route('copia.index')!!}"><i class="fa fa-television" aria-hidden="true" ></i> <span>Reporte Copia Seguridad</span></a></li>
             <li class="{{ request()->routeIs('contratos.novedades.index') ? 'active' : '' }}"><a href="{!! route('contratos.novedades.index')!!}"><i class="fa fa-university" aria-hidden="true"></i> <span>Seguimiento Contratos</span></a></li>
            @endif
             <li><a href="{!! route('admin.inventario.index')!!}"><i class="fa fa-television" aria-hidden="true" ></i> <span>Reporte Salas Audiencia</span></a></li>
            
             <li><a href="{!! route('admin.activities.index')!!}"><i class="fa fa-television" aria-hidden="true" ></i> <span>Reporte Actividades Contratista</span></a></li>
             <li><a href="{!! route('actividades.despacho.dashboard')!!}"><i class="fa fa-pie-chart" aria-hidden="true" ></i> <span>Reporte Por Despacho</span></a></li>
             
          
             <li><a href="{!! route('stats.acortadores')!!}"><i class="fa fa-edge" aria-hidden="true" ></i> <span>AcortadoUrl</span></a></li>
             <li><a href="{!! route('admin.show.comodato.impresora')!!}"><i class="fa fa-print" ></i> <span>Impresoras</span></a></li>
             <li><a href="{!! route('requerimientodespachos.listado.admin')!!}"><i class=" fa fa-book" ></i> <span>Requerimiento Despacho</span></a></li>
              <!--li><a href="{{url('/administrador/requerimiento/despacho/')}}" ><i class="fa fa-info-circle"></i> <span >Requerimiento Despacho</span></a></li-->
             <li><a href="{{route('administrador.siniestro')}}" ><i class="fa fa-info-circle"></i> <span >Siniestros</span></a></li>
             <li><a href="{!! route('administrador.soporte.listado')!!}"><i class="fa fa-address-book"></i> <span>Reporte de Ip</span></a></li>
             <li><a href="{!! url('/administrador/inventarios')!!}"><i class=" fa fa-book" ></i> <span>Inventario</span></a></li>
             <li><a href="{!! route('administrador.listado.regional')!!}"><i class=" fa fa-book" ></i> <span>Reporte Regional Cali</span></a></li>
             
             <li><a href="{!! url('/administrador/excel')!!}"><i class="fa fa-download"></i> <span>Download Excel</span></a></li>
             <li><a href="{!! route('empleados.despacho.activos')!!}" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Tabla Certificacion Empelados</span></a></li>
             <li><a href="{!! route('administrador.vacunacion')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Agendamiento Vacunaci&oacute;n</span></a></li>
             <li><a href="{!! route('administrador.encuesta.esquema.vacunacion')!!}"target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Encuesta Esquema Vacunacion</span></a></li>
             <li><a href="{!! route('administrador.jornada.salud')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Agendamiento Jornada Salud</span></a></li>
             <li><a href="{!! route('administrador.listado.eventos')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Registro Eventos</span></a></li>
             <li><a href="{!! route('admin.solicitudes.teletrabajo.registro')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Solicitudes Teletrabajo 2024</span></a></li>
             <li><a href="{!! route('admin.consulta.teletrabajo.registro')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Teletrabajo 2024</span></a></li>
             
             <li><a href="{!! route('listado.usuario.sgde')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Usuarios registrados Sgde</span></a></li>
        

          </ul>
        </li>
        
        

       
         <li class="{{ request()->routeIs('administrador.index') ? 'active' : '' }}"><a href="{!! url('/administrador/')!!}"><i class="fa fa-link"></i> <span>Revisar Solicitudes</span></a></li>
         <li class="{{ request()->routeIs('administrador/show') ? 'active' : '' }}"><a href="{!! url('/administrador/show')!!}"><i class="fa fa-search" aria-hidden="true"></i> <span>Revisar mis Solicitudes</span></a></li>
         <li class="{{ request()->routeIs('administrador/edit') ? 'active' : '' }}"><a href="{!! url('/administrador/historial')!!}"><i class="fa fa-line-chart" aria-hidden="true"></i></i> <span>Historial Solicitudes</span></a></li>
         
         <li class="{{ request()->routeIs('admin.solicitud.trabajo.remoto') ? 'active' : '' }}"><a href="{!! route('admin.solicitud.trabajo.remoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Teletrabajo</span></a></li-->
         
         <li class="{{ request()->routeIs('manual.solicitud.trabajo.remoto') ? 'active' : '' }}"><a href="{!! route('manual.solicitud.trabajo.remoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Cargue Manual</span></a></li-->
         <li><a href="{{route('index.tanqueo.admin')}}" ><i class="fa fa-info-circle"></i> <span >Registro Veh&iacute;culos</span></a></li>
        @endif
        @if( auth()->user()->tipo_rol =="SECCIONAL")
         <li><a href="{!! url('/administrador/banner')!!}"><i class="fa fa-image" ></i> <span>Banner</span></a></li>
            <li><a href="{!! url('/administrador/sst-documentos')!!}"><i class="fa fa-file-image-o" ></i> <span>SST Documentos</span></a></li>
            <li><a href="{!! route('baner.coe')!!}"><i class="fa fa-map-o" ></i> <span>Banner Coe</span></a></li>
         <!--li><a href="{!! route('administrador.vacunacion')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Agendamiento Vacunaci&oacute;n</span></a></li>
         <li><a href="{!! route('administrador.jornada.salud')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Agendamiento Jornada Salud</span></a></li-->
         <li><a href="{!! route('admin.solicitud.trabajo.remoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Teletrabajo</span></a></li>
         <li><a href="{!! route('admin.solicitud.trabajo.historicoremoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Historico Teletrabajo</span></a></li-->
         <li><a href="{!! route('manual.solicitud.trabajo.remoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Cargue Manual</span></a></li-->
         
         <li><a href="{!! route('admin.solicitudes.teletrabajo.registro')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Solicitudes Teletrabajo 2024</span></a></li-->
         <li><a href="{!! route('admin.consulta.teletrabajo.registro')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Teletrabajo 2024</span></a></li-->
        @endif
         @if( auth()->user()->tipo_rol =="ARL" )
         <li><a href="{!! route('admin.solicitud.trabajo.remoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Teletrabajo</span></a></li-->
         <li><a href="{!! route('admin.solicitud.trabajo.historicoremoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Historico Teletrabajo</span></a></li-->
        @endif
        @if( auth()->user()->tipo_rol =="ADMINISTRACION")
        <li><a href="{{route('administrador.siniestro')}}" ><i class="fa fa-info-circle"></i> <span >Siniestros</span></a></li>
        <li><a href="{{route('index.tanqueo.admin')}}" ><i class="fa fa-info-circle"></i> <span >Registro Veh&iacute;culos</span></a></li>
        @endif
        @if( auth()->user()->tipo_rol =="SECCIONAL_BASICO")
         <li><a href="{!! route('admin.solicitud.trabajo.remoto')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Teletrabajo</span></a></li-->
        @endif
        
        @if( auth()->user()->tipo_rol =="BIENESTAR")
         <li><a href="{!! route('baner.bienestar')!!}"><i class="fa fa-file-text-o" aria-hidden="true"></i></i></i> <span>Banner Bienestar</span></a></li-->
        @endif
        
        
        @if(  auth()->user()->email =="mfernandp@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="gmstdesajvalle3@cendoj.ramajudicial.gov.co" )
             <li><a href="{!! route('admin.enviar.certificacion.form')!!}"><i class="fa fa-television" aria-hidden="true" ></i> <span>Certificaciones RH</span></a></li>
             <li><a href="{!!route('admin.consulta.escalafon.form')!!}" ><i class="fa fa-pencil-square"></i> <span>Certificado Escalaf&oacute;n</span></a></li>
             <li target="_blank"><a href="{{ route('admin.carnet.validador') }}"><i class="fa fa-qrcode" aria-hidden="true"></i> <span>Validador Carnets</span></a></li>

       
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
        <li><a href="javascript:void(0)" style="color: #696969"><i class="fa fa-dashboard" ></i> @yield('cabecera')</a></li>
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
         

          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
              <div class="container-fluid">
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

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

@include('layouts.partials.adminlte-scripts')
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>        

<!--        https://cdnjs.com/libraries/bootstrap-datetimepicker-->
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


<script src="/js/invenDinamico.js"></script>

<script>

</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
  $(function () {
    $('#searchtable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
   // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    

    
  });
</script>

</body>
</html>