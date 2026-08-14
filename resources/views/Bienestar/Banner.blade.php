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
    
    /* Botón de sonido 
    .sound-toggle {
        position: absolute;
        bottom: 20px;
        right: 40px;
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
    }*/
    .sound-toggle {
        position: absolute;
        bottom: 20px;
        left: 60%;
        transform: translateX(-50%);
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
    
    nav.navbar.cBlanco {
        background-color: #002147 !important;
    }
    .footer{
        background-color: #002147 !important;
    }
    .dropdown-menu{
      background-color: #002147 !important;  
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
                                <video id="video{{$id}}" class="banner-video" autoplay loop muted playsinline preload="auto" poster="img/SIRISCALI.jpg"> 
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
    const lastUpdated = @json($lastUpdated ?? '');
    let currentSlide = 0;
    let timer = null;

    /** Video mute/unmute toggle **/
    function setupVideoControls(videoId, toggleId) {
        const video = document.getElementById(videoId);
        const toggle = document.getElementById(toggleId);
        if (!video || !toggle) return;

        video.loop = false;

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

    /** Fade-in video when ready **/
    function setupVideoFadeIn(video) {
        if (!video) return;

        video.addEventListener('canplay', () => {
            video.classList.add('ready');
        });

        if (video.readyState >= 3) {
            video.classList.add('ready');
        }
    }

    /** Apply controls and fade-in for all videos **/
    @foreach($banner as $id => $bnr)
        @if($bnr->bextension == "mp4" || $bnr->bextension == "webm")
            setupVideoControls("video{{$id}}", "soundToggle{{$id}}");
            setupVideoFadeIn(document.getElementById("video{{$id}}"));
        @endif
    @endforeach

    /** Carousel auto-advance logic 
    function scheduleAdvanceForSlide($item) {
        clearTimeout(timer);

        const isVideo = $item.data('is-video') === true || $item.data('is-video') === 'true';
        if (isVideo) {
            const video = $item.find('video').get(0);
            if (video) {
                video.load();
                video.play();

                video.onended = () => {
                    if (currentSlide < totalSlides - 1) {
                        $('#mainCarousel').carousel('next');
                    } else {
                        $('#mainCarousel').carousel(0); // 🔁 Loop infinito
                    }
                };
            }
        } else {
            timer = setTimeout(() => {
                if (currentSlide < totalSlides - 1) {
                    $('#mainCarousel').carousel('next');
                } else {
                    $('#mainCarousel').carousel(0); // 🔁 Loop infinito
                }
            }, 10000);
        }
    }**/
    
    function scheduleAdvanceForSlide($item) {
        clearTimeout(timer);
    
        const isVideo = $item.data('is-video') === true || $item.data('is-video') === 'true';
    
        function goToNext() {
            if (currentSlide < totalSlides - 1) {
                $('#mainCarousel').carousel('next');
            } else {
                // Estamos en el último slide: antes de volver al inicio, verifica cambios
                console.log('🕵️ Verificando si hay cambios en el banner...');
                checkForBannerUpdatesAtEnd(() => {
                    console.log('🔁 No hay cambios. Reiniciando carrusel.');
                    $('#mainCarousel').carousel(0);
                });
            }
        }
    
        if (isVideo) {
            const video = $item.find('video').get(0);
            if (video) {
                video.load();
                video.play();
    
                video.onended = () => {
                    goToNext();
                };
            }
        } else {
            timer = setTimeout(goToNext, 10000);
        }
    }


    /** Carousel init **/
    $('#mainCarousel').carousel({ interval: false, pause: false });

    $('#mainCarousel').on('slid.bs.carousel', function (e) {
        currentSlide = $(e.relatedTarget).index();
        scheduleAdvanceForSlide($(e.relatedTarget));
        preloadNextVideo(currentSlide);
    });

    /** Preload next video **/
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

    /** Responsive frame adjustment **/
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

    // Start first slide
    const $firstItem = $('.carousel-inner .item.active');
    scheduleAdvanceForSlide($firstItem);

    // ---- CHECK FOR UPDATES ----
    let checkData = {
        count: totalSlides,
        last_updated: lastUpdated
    };

    function valuesAreDifferent(oldData, newData) {
        if (oldData.count !== newData.count) return true;
        if (!oldData.last_updated && newData.last_updated) return true;
        if (oldData.last_updated && newData.last_updated && oldData.last_updated !== newData.last_updated) return true;
        return false;
    }

    function checkForBannerUpdates() {
        fetch('{{ route('banner.check-update') }}')
            .then(response => response.json())
            .then(data => {
                if (!data || typeof data !== 'object' || !('count' in data) || !('last_updated' in data)) {
                    console.warn('⚠️ Respuesta inválida:', data);
                    return;
                }

                if (valuesAreDifferent(checkData, data)) {
                    console.log('⚡ Cambio detectado en banners. Recargando...');
                    location.reload();
                } else {
                    console.log('✅ Sin cambios detectados en banners.');
                }
            })
            .catch(error => console.error('❌ Error checking for updates:', error));
    }
    
    function checkForBannerUpdatesAtEnd(callbackIfNoChange) {
        fetch('{{ route('banner.check-update') }}')
            .then(response => response.json())
            .then(data => {
                if (!data || typeof data !== 'object' || !('count' in data) || !('last_updated' in data)) {
                    console.warn('⚠️ Respuesta inválida al checar actualizaciones:', data);
                    callbackIfNoChange();
                    return;
                }
    
                if (valuesAreDifferent(checkData, data)) {
                    console.log('⚡ Cambio detectado en banners al finalizar carrusel. Recargando...');
                    location.reload();
                } else {
                    callbackIfNoChange();
                }
            })
            .catch(error => {
                console.error('❌ Error verificando cambios al final del carrusel:', error);
                callbackIfNoChange();
            });
    }


    // Check every 60 seconds
    const POLLING_INTERVAL_MS = 60000;
    setInterval(checkForBannerUpdates, POLLING_INTERVAL_MS);
});
</script>

<script>
setInterval(function() {
    location.reload();
}, 3600000); // 1 hora
</script>

@endsection