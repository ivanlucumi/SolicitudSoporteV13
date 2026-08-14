@extends('layouts.ensayo1')

@section('title', 'Ayudas Ventanilla Judicial Electronica')

<meta name="description" content="SIRIS CALI, DISAJCALI, siriscali, disajcali, Ventanilla Judicial Electronica, Siug Ventanilla Judicial Electronica">

@section('content')
<div class="container-fluid">
    <h2 class="text-center">Ventanilla Judicial Electr&oacute;nica | Servicio radicaci&oacute;n de demandas</h2>
    <hr>

    <div class="row">
        @php
            $videos = [
                ['titulo' => 'Creación de cuenta de Usuario', 'archivo' => '1. Creación de cuenta de Usuario.mp4'],
                ['titulo' => 'Olvido de contraseña', 'archivo' => '2. Olvido de contraseña.mp4'],
                ['titulo' => 'Demanda Familia', 'archivo' => '3. Demanda Familia.mp4'],
                ['titulo' => 'Demanda Civil', 'archivo' => '4. Demanda Civil.mp4'],
                ['titulo' => 'Administración de cuenta de usuario', 'archivo' => '5. Administración de cuenta de usuario.mp4'],
                ['titulo' => 'Consulta de demandas', 'archivo' => '6. Consulta de demandas.mp4'],
                ['titulo' => 'Herramientas de consulta', 'archivo' => '7. Herramientas de consulta.mp4'],
                ['titulo' => 'Demanda laboral', 'archivo' => '8. Demanda laboral.mp4'],
                
            ];
        @endphp
        <!--['titulo' => 'Queja Disciplinaria Anónima', 'archivo' => '9. Queja Disciplinaria Anonima.mp4']-->

        @foreach ($videos as $video)
            <div class="col-md-4 col-sm-6">
                <div class="panel panel-default video-card wow fadeIn" data-wow-delay="0.2s">
                    <div class="panel-heading text-center" style="font-weight: bold; background: #003366; color: #fff;">
                        {{ $video['titulo'] }}
                    </div>

                    <div class="panel-body text-center" style="background: #f9fafc;">
                        {{-- Imagen previa del video (miniatura genérica) --}}
                        <div class="video-thumbnail" data-src="{{ asset('/video/Ventanilla Digital/' . $video['archivo']) }}">
                            <img src="{{ asset('/video/Ventanilla Digital/video-placeholder.jpg') }}" 
                                 alt="{{ $video['titulo'] }}" 
                                 class="img-responsive center-block" 
                                 style="border-radius: 6px; cursor: pointer;">
                            <div class="play-button">&#9658;</div>
                        </div>

                        {{-- El video se carga solo al hacer clic (lazy load) --}}
                        <video width="100%" height="280" controls preload="none" style="display:none; border-radius: 6px;">
                            <source src="" type="video/mp4">
                            Tu navegador no soporta reproducción de video.
                        </video>
                    </div>

                    <div class="panel-footer text-justify" style="height: 80px; overflow-y: auto; background: #eef2f7;">
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    

    
    
</div>

{{-- Animaciones y Lazy Loading --}}
<style>
    .video-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
    .video-thumbnail {
        position: relative;
        display: inline-block;
    }
    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 48px;
        color: white;
        opacity: 0.8;
        text-shadow: 0 0 10px #000;
        pointer-events: none;
    }
    .video-thumbnail img {
        transition: opacity 0.3s ease;
    }
    .video-thumbnail:hover img {
        opacity: 0.85;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const thumbnails = document.querySelectorAll('.video-thumbnail');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const panelBody = this.parentNode;
            const video = panelBody.querySelector('video');
            const source = video.querySelector('source');

            // Evita recargar varios videos a la vez
            document.querySelectorAll('video').forEach(v => v.pause());

            source.src = this.getAttribute('data-src');
            video.style.display = 'block';
            this.style.display = 'none';
            video.load();
            video.play();
        });
    });
});
</script>
@endsection
