@extends('layouts.ensayo')

@section('title', 'COE - SIRIS CALI')

@section('content')
<!-- CDN para Material Icons y Fuente Roboto -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<style>
    :root {
        --primary-color: #002147;
        --secondary-color: #FDC500;
        --background-light: #F9FAFB;
        --text-dark: #111;
        --accent-color: #4DA6FF;
    }
    
    body {
        background-color: var(--background-light);
        font-family: 'Roboto', sans-serif;
        color: var(--text-dark);
    }


    /* Estilos generales */
    .coe-container {
        padding: 30px 15px;
    }
    
    .coe-card {
        background: #ffffff;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .coe-title, .coe-subtitle {
        color: var(--primary-color);
        font-weight: 700;
    }
    
    .coe-title {
        font-size: 28px;
        border-left: 5px solid var(--secondary-color);
        padding-left: 12px;
        margin-bottom: 20px;
    }

    .coe-subtitle {
        font-size: 22px;
        border-bottom: 2px solid var(--secondary-color);
        padding-bottom: 6px;
        margin-bottom: 15px;
    }
    
    .coe-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        padding: 25px;
        margin-bottom: 25px;
        transition: box-shadow 0.3s ease;
    }

    .coe-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    
    .coe-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .coe-list-item {
        background: #fff;
        border: 1px solid var(--secondary-color);
        border-radius: 6px;
        padding: 14px 18px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        transition: background 0.2s ease;
    }
    
    .coe-list-item:hover {
        background: var(--background-light);
    }

    .coe-list-item i {
        margin-right: 12px;
        color: var(--primary-color);
        font-size: 24px;
    }
    
    
    /* Estilos para el banner multimedia */
    .coe-media-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        background: #fff;
        margin-bottom: 25px;
    }

    .coe-media-header {
        background: var(--secondary-color);
        color: var(--text-dark);
        font-weight: 700;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        font-size: 18px;
    }
    
    
    .coe-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .coe-table thead {
        background: var(--primary-color);
        color: #fff;
    }

    .coe-table th, .coe-table td {
        padding: 14px 16px;
        text-align: left;
    }

    .coe-table tbody tr {
        border-bottom: 1px solid #eee;
    }

    .coe-table tbody tr:hover {
        background-color: var(--background-light);
    }

    .coe-btn {
        background: var(--secondary-color);
        color: var(--text-dark);
        border-radius: 20px;
        padding: 8px 20px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        border: 2px solid var(--secondary-color);
        transition: all 0.3s ease;
    }

    .coe-btn:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .coe-btn i {
        margin-right: 8px;
    }

    .pdf-icon {
        color: #F44336;
    }

    .doc-icon {
        font-size: 22px;
    }
    
    
    
    
    #mainCarousel {
        width: 100%;
        height: 550px;
    }
    
    /* Carrusel mejorado */
    #coeCarousel {
        height: calc(100% - 50px);
        position: relative;
    }
    
    #coeCarousel .carousel-inner {
        height: 100%;
        width: 100%;
    }
    
    .carousel-item {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
        width: 100%;
        height: 100%;
    }
    
    /* Estilos para imágenes y videos */
    .media-content {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    
    .banner-media {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
    }
    
    /* Estilos específicos para video */
    .video-container {
            width: 100%;
            height: 100%;
            background-color: #000;  /* Fondo negro por defecto */
            position: relative;
            overflow: hidden;
        }
    .video-fixed-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* Relación 16:9 → ajusta si tu video tiene otra relación */
    background-color: #000;
    overflow: hidden;
    border-radius: 4px;
}

.banner-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain; /* ← clave para mostrar todo el video sin recortarlo */
    background-color: #000;
}

    
    /* Indicadores y controles */
    #coeCarousel .carousel-indicators {
        bottom: 10px;
    }
    
    #coeCarousel .carousel-indicators li {
        background-color: rgba(255,255,255,0.5);
        border: none;
    }
    
    #coeCarousel .carousel-indicators .active {
        background-color: #fff;
    }
    
    #coeCarousel .carousel-control {
        width: 48px;
        height: 48px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 33, 71, 0.7); /* navy con opacidad */
        border-radius: 50%;
        text-align: center;
        line-height: 48px;
        transition: background 0.3s, transform 0.3s;
    }
    
    #coeCarousel .carousel-control:hover {
        background: #002147; /* navy sólido en hover */
        transform: translateY(-50%) scale(1.1);
    }
    
   #coeCarousel .carousel-control .material-icons {
        color: #FDC500; /* amarillo institucional */
        font-size: 28px;
        line-height: 48px;
        transition: color 0.3s;
    }
    
    #coeCarousel .carousel-control:hover .material-icons {
        color: #fff;
    }
        
    /* Control de audio mejorado */
    .sound-toggle {
        background: var(--secondary-color);
        color: var(--text-dark);
        border: none;
        border-radius: 50%;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s;
    }

    .sound-toggle:hover {
        background: var(--accent-color);
        color: #fff;
    }

    .carousel-caption {
        background: rgba(0,0,0,0.6);
        padding: 12px 20px;
        border-radius: 6px;
    }
    
    .sound-toggle i {
        font-size: 20px;
    }
    
    /* Leyenda del carrusel */
    
    
    .carousel-caption a {
        color: white;
        text-decoration: none;
    }
    
    /* Estilos para la tabla */
    
    
    /* Botones */
    .coe-btn {
        /*background: #1976D2;*/
        color: black;
        border: none;
        border-radius: 4px;
        padding: 8px 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background 0.3s;
    }
    
    .coe-btn:hover {
        background: #1565C0;
        color: white;
    }
    
    .coe-btn i {
        margin-right: 8px;
    }
    
    /* Iconos de documentos */
    .doc-icon {
        margin-right: 8px;
        font-size: 20px;
    }
    
    .pdf-icon { color: #F44336; }
    .docx-icon { color: #2196F3; }
    
    
    .panel-heading {
    background-color: #FDC500;
    color: #111;
}

.panel-title a {
    display: flex;
    align-items: center;
    color: #111;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s;
}

.panel-title a:hover {
    text-decoration: underline;
}

.panel-title i {
    margin-right: 8px;
    color: #002147;
    font-size: 22px;
}

 /* Estado expandido: color institucional azul */
.panel-group .panel-heading a[aria-expanded="true"] {
    background-color: #002147;
    color: #fff;
}

/* Hover general en headers */
.panel-group .panel-heading a {
    background-color: ;
    color: #111;
    display: block;
    padding: 12px 15px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.panel-group .panel-heading a:hover {
    background-color: #002147;
    color: #fff;
}

/* Íconos en header */
.panel-group .panel-heading i {
    margin-right: 8px;
    vertical-align: middle;
    font-size: 22px;
}
.panel-body{
   font-size: 16px; 
}
   
  
</style>

<style>
    nav.navbar.cBlanco {
        background-color: #002147 !important;
    }
    .footer{
        background-color: #002147 !important;
    }
</style>





<div class="container-fluid coe-container">
    <div class="row">
        <div class="col-md-5">
            <!-- Banner multimedia mejorado -->
            <div class="coe-media-card">
                
                @if(is_iterable($banner) && count($banner) > 0)
                <div id="coeCarousel" class="carousel slide" data-ride="carousel" data-interval="9000">
                    <!-- Indicadores -->
                    <ol class="carousel-indicators">
                        @for ($i = 0; $i < count($banner); $i++)
                            <li data-target="#coeCarousel" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
                        @endfor
                    </ol>

                    <!-- Slides mejorados -->
                    <div class="carousel-inner">
                        @foreach($banner as $id => $bnr)
                        <div class="item{{$id == 0 ? ' active' : ''}}" data-is-video="{{$bnr->bextension == 'mp4' || $bnr->bextension == 'webm' ? 'true' : 'false'}}">
                            <div class="media-content">
                                @if($bnr->bLink != '')
                                    @php
                                        $isFile = preg_match('/\.(pdf|docx?|xlsx?|pptx?|zip|rar|txt|csv)$/i', $bnr->bLink);
                                    @endphp
                                    <div class="carousel-caption">
                                        @if($isFile)
                                            <a href="https://{{$bnr->bLink}}" rel="noopener" target="_self" download style="color: white;">
                                                <p>{{strtoupper($bnr->bNombre)}}</p>
                                            </a>
                                        @else
                                            <a href="https://{{$bnr->bLink}}" rel="noopener" target="_blank" style="color: white;">
                                                <p>{{strtoupper($bnr->bNombre)}}</p>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <div class="carousel-caption">
                                        <p>{{strtoupper($bnr->bNombre)}}</p>
                                    </div>
                                @endif
                                
                                
                
                                @if($bnr->bextension == "mp4" || $bnr->bextension == "webm")
                                
                                    <div class="video-fixed-container">
                                        <video id="video{{$id}}" class="banner-video" autoplay loop  muted playsinline>
                                            <source src="video/{{$bnr->bFoto}}" type="video/{{$bnr->bextension}}">
                                            Tu navegador no soporta el video.
                                        </video>
                                    
                                        <button id="soundToggle{{$id}}" class="sound-toggle" data-video-id="video{{$id}}">
                                            <i class="glyphicon glyphicon-volume-off"></i>
                                        </button>
                                    </div>

                                @else
                                    @if($bnr->bLink != '')
                                        <a href="https://{{$bnr->bLink}}" target="{{$isFile ? '_self' : '_blank'}}" rel="noopener" {{$isFile ? 'download' : ''}}>
                                            <img src="img/{{$bnr->bFoto}}" alt="{{$bnr->bNombre}}" class="banner-media">
                                        </a>
                                    @else
                                        <img src="img/{{$bnr->bFoto}}" alt="{{$bnr->bNombre}}" class="banner-media">
                                    @endif
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                   <a class="left carousel-control" href="#coeCarousel" data-slide="prev">
                        <span class="material-icons">arrow_back_ios_new</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="right carousel-control" href="#coeCarousel" data-slide="next">
                        <span class="material-icons">arrow_forward_ios</span>
                        <span class="sr-only">Siguiente</span>
                    </a>

                </div>
                @else
                <div class="coe-media-card">
                    <div class="coe-media-header">
                    </div>
                    
                    <div id="coeCarousel" class="carousel slide" data-ride="carousel" data-interval="9000">
                        <!-- Indicadores -->
                        <ol class="carousel-indicators">
                            <li data-target="#coeCarousel" data-slide-to="1" class="1active1"></li>
                        </ol>
                        <!-- Slides mejorados -->
                        <div class="carousel-inner">
                            <div class=" active" data-is-video="false">
                                <div class="media-content">
                                    <div class="carousel-caption">
                                        <p>Seguridad y salud en el trabajo</p>
                                    </div>
                                    <img src="img/SIRISCALI.jpg" alt="SIRIS CALI" class="banner-media">
                                </div>
                            </div>
                        </div>
                    
                        <a class="left carousel-control" href="#coeCarousel" data-slide="prev">
                            <span class="material-icons">arrow_back_ios_new</span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#coeCarousel" data-slide="next">
                            <span class="material-icons">arrow_forward_ios</span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    
                    </div>
                    
                </div>
                @endif
            </div>
        </div>
        
        <div class="col-md-7">
            <!-- Información principal -->
            <div class="coe-card">
                <h1 class="coe-title">COE EN LA RAMA JUDICIAL</h1>
                <p style="text-align: justify;font-size: 16px;">El COE en la rama judicial hace referencia al Centro de Operaciones de Emergencia Judicial, un organismo encargado de coordinar acciones inmediatas ante situaciones críticas que afecten el funcionamiento del poder judicial en algunos países, como Colombia. Su objetivo es garantizar la continuidad de los servicios judiciales durante emergencias (desastres naturales, crisis sociales, fallas tecnológicas, etc.).</p>
            </div>

            <!-- Sección de información adicional -->
            <!-- Sección de información adicional con acordeón -->
<div class="coe-card">
    <h2 class="coe-subtitle">Funciones Principales</h2>
    <div class="panel-group" id="accordionFunciones" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h3 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordionFunciones" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="material-icons">group_work</i>
                        Coordinación de emergencias judiciales
                    </a>
                </h3>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    Organización y articulación de las acciones para enfrentar situaciones críticas que afecten la justicia.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionFunciones" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="material-icons">chat</i>
                        Comunicación centralizada durante crisis
                    </a>
                </h3>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    Garantiza canales efectivos de información entre entidades y actores judiciales durante emergencias.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionFunciones" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="material-icons">build</i>
                        Soporte logístico para juzgados
                    </a>
                </h3>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    Coordina recursos, personal y equipamiento para mantener la operatividad de los juzgados.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionFunciones" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="material-icons">warning</i>
                        Respuesta a situaciones críticas
                    </a>
                </h3>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    Implementa acciones inmediatas para mitigar los efectos de desastres naturales, fallas tecnológicas o crisis sociales.
                </div>
            </div>
        </div>

    </div>
</div>

        </div>

        
    </div>

    <!-- Tabla de publicaciones -->
    <div class="row">
        <div class="col-md-12">
            <div class="coe-card">
                <h2 class="coe-subtitle">
                    <i class="material-icons" style="margin-right: 8px;">description</i>
                    Documentos Recientes 
                </h2>
                <div class="table-responsive">
                    <table class="coe-table">
                        <thead>
                            <tr>
                                <th width="50%">Tipo</th>
                                <th width="40%">Descripción</th>
                                <th width="10%">Documento</th>
                            </tr>
                        </thead>
                            @if(!empty($seguridad_st))
            				    @foreach($seguridad_st as $ifn)
            					<tbody class="buscar">
            						<tr class="table-light coe-card">
            							<td scope="row"><i class="material-icons doc-icon">description</i> {{$ifn->sst_titulo}}</td>									
            							<td scope="row">{{$ifn->created_at}}</td>
            							<td scope="row">
            								<a href="" onClick="window.open('/img/{{$ifn->sst_documento}}','popup', 'width=800px,height=600px')" class="product-title coe-btn"><img src="/img/pdf.svg" alt="Product Image" class="img-fluid" style="height: 30px; max-height: 50px;">
            		                    	<div class="mask flex-center waves-effect waves-light"></div></a>
            		                	</td>												     
            						</tr>	                
            					</tbody>
            					@endforeach
            				@else
            				<tr class="table-light">
            					<p class="lead">Actualmente esta secci&oacute;n no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
            				</tr>
            				@endif
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script mejorado para el carrusel y control de audio -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const carousel = $('#mainCarousel');
    let currentIndex = 0;
    const items = document.querySelectorAll('#mainCarousel .item');
    let autoSlideInterval;

    function avanzarSlide() {
        currentIndex = (currentIndex + 1) % items.length;
        carousel.carousel(currentIndex);
    }

    function reproducirVideo() {
        items.forEach(item => {
            const video = item.querySelector('video');
            if (video) {
                video.pause();
                video.currentTime = 0;
                video.muted = true;
                const icon = item.querySelector('.sound-toggle i');
                if (icon) icon.className = 'glyphicon glyphicon-volume-off';
            }
        });

        const active = document.querySelector('#mainCarousel .item.active');
        const video = active.querySelector('video');
        if (video) {
            video.play().catch(err => console.log("Autoplay failed:", err));
           // video.onended = avanzarSlide;
        }
    }

    // Evento de cambio de slide
    carousel.on('slid.bs.carousel', function () {
        reproducirVideo();
    });

    // Botón de sonido
    document.querySelectorAll('.sound-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const videoId = btn.dataset.videoId;
            const video = document.getElementById(videoId);
            const icon = btn.querySelector('i');

            if (video) {
                if (video.muted) {
                    document.querySelectorAll('video').forEach(v => {
                        v.muted = true;
                        const ic = v.parentElement.querySelector('.sound-toggle i');
                        if (ic) ic.className = 'glyphicon glyphicon-volume-off';
                    });
                    video.muted = false;
                    icon.className = 'glyphicon glyphicon-volume-up';
                } else {
                    video.muted = true;
                    icon.className = 'glyphicon glyphicon-volume-off';
                }
            }
        });
    });

    // Iniciar
    reproducirVideo();
    autoSlideInterval = setInterval(avanzarSlide, 10000);
});
</script>


@endsection