@extends('layouts.Bienestar')
@section('title', 'SIRIS CALI')

<style type="text/css">
    /* Estilos base mejorados */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #f5f5f5;
    }
    
    .content-loaded {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    /* Contenedor principal del banner con tamaño fijo 1131x1600 */
    .banner-container {
        position: relative;
        width: 100%;
        height: calc(100vh - 150px);
        overflow: hidden;
        background: #f6f6f6;
        margin: 10px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    }

    /* Marco para las imágenes con proporción 1131x1600 */
    .image-frame {
        width: 100%;
        height: 100%;
        max-width: 1131px;
        max-height: 1600px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        position: relative;
        margin: auto;
    }
    
    /* Ajustes para el título principal */
    .text-center h1 {
        margin: 10px 0;
        font-size: 1.8rem;
        padding: 0 10px;
        text-align: center;
        color: #333;
    }
    
    /* Estilos para imágenes - Ajuste perfecto en el marco */
    .banner-media {
        width: 100%;
        height: 100%;
        object-fit: contain;
        position: absolute;
    }
    
    /* Contenedor del video con tamaño adaptable */
    .video-fixed-container {
        width: 100%;
        height: 100%;
        max-width: 1131px;
        max-height: 1600px;
        position: relative;
        margin: 0 auto;
    }
    
    /* Estilos para el video */
    .banner-video {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    /* Título del banner */
    .banner-title {
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        color: white;
        text-shadow: 0 1px 3px rgba(0,0,0,0.8);
        padding: 10px;
        background: rgba(0, 0, 0, 0.5);
        z-index: 10;
        font-size: 1.2rem;
    }
    
    /* Botón de sonido */
    .sound-toggle {
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 10;
        background: rgba(255,0,0,0.8);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    /* Botón de siguiente manual */
    .manual-next {
        position: absolute;
        bottom: 20px;
        left: 20px;
        z-index: 10;
        background: rgba(0,0,255,0.8);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    
    /* Carousel adjustments */
    .carousel {
        height: 100%;
        width: 100%;
    }
    
    .carousel-inner {
        height: 100%;
        width: 100%;
    }
    
    .carousel-inner .item {
        height: 100%;
        width: 100%;
        position: relative;
    }
    
    /* Featurette divider */
    .featurette-divider {
        margin: 10px 0;
        border-top: 1px solid #ddd;
    }
    
    /* Ajustes para dispositivos móviles */
    @media (max-width: 1200px) {
        .image-frame {
            max-width: 90%;
            max-height: calc(90% * (1600/1131)); /* Mantener proporción 1131x1600 */
        }
    }

    @media (max-width: 768px) {
        .banner-container {
            height: calc(100vh - 120px);
            border-radius: 10px;
        }
        
        .text-center h1 {
            font-size: 1.4rem;
        }
        
        .banner-title {
            font-size: 1rem;
            padding: 8px;
        }
        
        .image-frame {
            max-width: 95%;
            max-height: calc(95% * (1600/1131));
        }
    }

    @media (max-width: 480px) {
        .text-center h1 {
            font-size: 1.2rem;
        }
        
        .banner-title {
            font-size: 0.9rem;
        }
        
        .image-frame {
            max-width: 98%;
            max-height: calc(98% * (1600/1131));
        }
        
        .sound-toggle, .manual-next {
            width: 35px;
            height: 35px;
            bottom: 15px;
        }
    }
    
    .banner-video, .banner-media {
    will-change: transform;
}

</style>

@section('content') 
<div class="content-loaded">
    <div class="row">
        <div class="col-xs-12 col-md-12 text-center">
            <h1 class="text-primary">SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI
            <strong>"SIRISCALI"</strong></h1>
        </div>
    </div>


    @if(is_iterable($banner) && count($banner) > 0)
    <div id="mainCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < count($banner); $i++)
                <li data-target="#mainCarousel" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
            @endfor
        </ol>

        <div class="carousel-inner">
            @foreach($banner as $id => $bnr)
            <div class="item{{$id == 0 ? ' active' : ''}}" data-is-video="{{$bnr->bextension == 'mp4' || $bnr->bextension == 'webm' ? 'true' : 'false'}}">
                <div class="banner-title">
                    @if($bnr->bLink != '')
                        @php
                            $isFile = preg_match('/\.(pdf|docx?|xlsx?|pptx?|zip|rar|txt|csv)$/i', $bnr->bLink);
                        @endphp
                        <a href="https://{{$bnr->bLink}}" rel="noopener" target="{{$isFile ? '_self' : '_blank'}}" {{$isFile ? 'download' : ''}} style="color: white;">
                            <h4>{{strtoupper($bnr->bNombre)}}</h4>
                        </a>
                    @else
                        <h4>{{strtoupper($bnr->bNombre)}}</h4>
                    @endif
                </div>

                @if($bnr->bLink != '')
                    @php
                        $isFile = preg_match('/\.(pdf|docx?|xlsx?|pptx?|zip|rar|txt|csv)$/i', $bnr->bLink);
                    @endphp
                    <a href="https://{{$bnr->bLink}}" target="{{$isFile ? '_self' : '_blank'}}" rel="noopener" {{$isFile ? 'download' : ''}}>
                @endif

                <div class="banner-container">
                    <div class="image-frame">
                        @if($bnr->bextension == "mp4" || $bnr->bextension == "webm")
                            <div class="video-fixed-container">
                                <video id="video{{$id}}" class="banner-video" autoplay loop muted playsinline preload="auto">
                                    <source src="img/{{$bnr->bFoto}}" type="video/{{$bnr->bextension}}">
                                    Tu navegador no soporta el elemento de video.
                                </video>
                                
                                <button id="soundToggle{{$id}}" class="sound-toggle" data-video-id="video{{$id}}">
                                    <i class="glyphicon glyphicon-volume-off"></i>
                                </button>
                                <button class="manual-next" onclick="$('#mainCarousel').carousel('next')">
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </button>
                            </div>
                        @else
                            <img src="img/{{$bnr->bFoto}}" alt="{{$bnr->bNombre}}" class="banner-media" loading="lazy">
                        @endif
                    </div>
                </div>

                @if($bnr->bLink != '')
                    </a>
                @endif
            </div>
            @endforeach
        </div>

        <a class="left carousel-control" href="#mainCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#mainCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
    @else
    <div class="banner-container">
        <div class="image-frame">
            <img src="img/SIRISCALI.jpg" alt="SIRIS CALI" class="banner-media">
        </div>
    </div>
    @endif

    <hr class="featurette-divider">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalSlides = {{ count($banner) }};
    let currentSlide = 0;
    let timer = null;

    function setupVideoControls(videoId, toggleId) {
        const video = document.getElementById(videoId);
        const toggle = document.getElementById(toggleId);

        if (!video || !toggle) return;

        video.loop = false; // Desactiva loop para escuchar ended

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            video.muted = !video.muted;
            updateToggleButton();
        });

        video.addEventListener('click', () => {
            video.muted = !video.muted;
            updateToggleButton();
        });

        function updateToggleButton() {
            toggle.innerHTML = video.muted
                ? '<i class="glyphicon glyphicon-volume-off"></i>'
                : '<i class="glyphicon glyphicon-volume-up"></i>';
        }

        updateToggleButton();
    }

    @foreach($banner as $id => $bnr)
        @if($bnr->bextension == "mp4" || $bnr->bextension == "webm")
            setupVideoControls("video{{$id}}", "soundToggle{{$id}}");
        @endif
    @endforeach

    function showNextSlide() {
        if (currentSlide < totalSlides - 1) {
            $('#mainCarousel').carousel('next');
        } else {
            location.reload();
        }
    }

    function scheduleAdvanceForSlide($item) {
        clearTimeout(timer);

        const isVideo = $item.data('is-video') === true || $item.data('is-video') === 'true';
        if (isVideo) {
            const video = $item.find('video').get(0);
            if (video) {
               /* video.currentTime = 0;
                video.play();*/
                video.load();
                video.play();

                video.onended = () => {
                    if (currentSlide === totalSlides - 1) {
                        location.reload();
                    } else {
                        $('#mainCarousel').carousel('next');
                    }
                };
            }
        } else {
            timer = setTimeout(() => {
                if (currentSlide === totalSlides - 1) {
                    location.reload();
                } else {
                    $('#mainCarousel').carousel('next');
                }
            }, 10000);
        }
    }

    $('#mainCarousel').carousel({
        interval: false,
        pause: false
    });
    
    //cambio de carga carusel
    
    $('#mainCarousel').on('slid.bs.carousel', function (e) {
        currentSlide = $(e.relatedTarget).index();
        scheduleAdvanceForSlide($(e.relatedTarget));
        preloadNextVideo(currentSlide);
    });


    // Cuando cambia de slide
    $('#mainCarousel').on('slid.bs.carousel', function (e) {
        currentSlide = $(e.relatedTarget).index();
        scheduleAdvanceForSlide($(e.relatedTarget));
    });

    // Ajustar tamaños al cargar/redimensionar
    function adjustImageFrame() {
        const headerHeight = $('.text-center').outerHeight(true) + $('.featurette-divider').outerHeight(true) * 2;
        const availableHeight = $(window).height() - headerHeight;
        const aspectRatio = 1131 / 1600;
        let frameHeight = Math.min(1600, availableHeight);
        let frameWidth = frameHeight * aspectRatio;

        if (frameWidth > $(window).width() * 0.9) {
            frameWidth = $(window).width() * 0.9;
            frameHeight = frameWidth / aspectRatio;
        }

        $('.image-frame').css({
            'max-width': frameWidth + 'px',
            'max-height': frameHeight + 'px'
        });
    }

    $(window).on('load resize', adjustImageFrame);
    $('#mainCarousel').on('slid.bs.carousel', adjustImageFrame);
    adjustImageFrame();

    // Iniciar comportamiento en el primer slide
    const $firstItem = $('.carousel-inner .item.active');
    scheduleAdvanceForSlide($firstItem);
});
</script>

<script>
    function preloadNextVideo(index) {
    if (index < totalSlides - 1) {
        const $nextItem = $('.carousel-inner .item').eq(index + 1);
        if ($nextItem.data('is-video') === true || $nextItem.data('is-video') === 'true') {
            const video = $nextItem.find('video').get(0);
            if (video) {
                video.preload = 'auto';
            }
        }
    }
}

</script>


<!--script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalSlides = {{ count($banner) }};
        let currentSlide = 0;

        function setupVideoControls(videoId, toggleId) {
            const video = document.getElementById(videoId);
            const toggle = document.getElementById(toggleId);

            if (!video || !toggle) return;

            video.loop = false;

            video.addEventListener('click', () => {
                video.muted = !video.muted;
                updateToggleButton();
            });

            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                video.muted = !video.muted;
                updateToggleButton();
            });

            function updateToggleButton() {
                toggle.innerHTML = video.muted
                    ? '<i class="glyphicon glyphicon-volume-off"></i>'
                    : '<i class="glyphicon glyphicon-volume-up"></i>';
                if (!video.muted) video.play();
            }

            updateToggleButton();

            video.addEventListener('ended', () => {
                $('#mainCarousel').carousel('next');
            });
        }

        @foreach($banner as $id => $bnr)
            @if($bnr->bextension == "mp4" || $bnr->bextension == "webm")
                setupVideoControls("video{{$id}}", "soundToggle{{$id}}");
            @endif
        @endforeach

        // Configura el carrusel sin intervalo automático
        $('#mainCarousel').carousel({
            interval: false,
            pause: false
        });

        $('#mainCarousel').on('slid.bs.carousel', function (e) {
            const activeItem = $(e.relatedTarget);
            currentSlide = $('.carousel-inner .item').index(activeItem);

            if (currentSlide === totalSlides - 1) {
                const isVideo = activeItem.data('is-video') === true || activeItem.data('is-video') === 'true';
            
                if (isVideo) {
                    activeItem.find('video').each(function () {
                        this.currentTime = 0;
                        this.play();
                        this.onended = () => location.reload();
                    });
                } else {
                    setTimeout(() => location.reload(), 5000);
                }
            } else {
                const isVideo = activeItem.data('is-video') === true || activeItem.data('is-video') === 'true';

                if (isVideo) {
                    activeItem.find('video').each(function () {
                        this.currentTime = 0;
                        this.play();
                    });
                } else {
                    setTimeout(() => {
                        $('#mainCarousel').carousel('next');
                    }, 10000);
                }
            }
        });

        // Inicio automático si el primer ítem es imagen
        const firstIsVideo = $('.item.active').data('is-video') === true || $('.item.active').data('is-video') === 'true';
        if (!firstIsVideo && totalSlides > 1) {
            setTimeout(() => {
                $('#mainCarousel').carousel('next');
            }, 10000);
        }

        // Función para ajustar el marco de la imagen
        function adjustImageFrame() {
            const headerHeight = $('.text-center').outerHeight(true) + $('.featurette-divider').outerHeight(true) * 2;
            const availableHeight = $(window).height() - headerHeight;
            
            // Calcular el tamaño máximo manteniendo la proporción 1131x1600
            const maxWidth = 1131;
            const maxHeight = 1600;
            const aspectRatio = maxWidth / maxHeight;
            
            let frameWidth = maxWidth;
            let frameHeight = maxHeight;
            
            if (maxHeight > availableHeight) {
                frameHeight = availableHeight;
                frameWidth = frameHeight * aspectRatio;
            }
            
            if (frameWidth > $(window).width() * 0.9) {
                frameWidth = $(window).width() * 0.9;
                frameHeight = frameWidth / aspectRatio;
            }
            
            $('.image-frame').css({
                'max-width': frameWidth + 'px',
                'max-height': frameHeight + 'px'
            });
        }

        // Ajustar al cargar y al redimensionar
        $(window).on('load resize', adjustImageFrame);
        
        // Ajustar también cuando cambia el slide
        $('#mainCarousel').on('slid.bs.carousel', adjustImageFrame);
        
        // Ejecutar inicialmente
        adjustImageFrame();
        
        // Añadido: recarga si solo hay una imagen o video
            if (totalSlides === 1) {
                const activeItem = $('.carousel-inner .item').eq(0);
                const isVideo = activeItem.data('is-video') === true || activeItem.data('is-video') === 'true';
            
                if (isVideo) {
                    const video = activeItem.find('video')[0];
                    if (video) {
                        video.currentTime = 0;
                        video.play();
                        video.onended = () => location.reload();
                    }
                } else {
                    // Si es imagen estática, recarga después de 20 segundos
                    setTimeout(() => location.reload(), 20000);
                }
            }
    });
</script-->
@endsection