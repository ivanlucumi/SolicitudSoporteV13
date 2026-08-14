@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Seguridad y salud en el Trabajo')

@section('content') 

<style>
    .video-responsive {
  width: 100%;
  max-width: 720px; /* tamaño máximo del video */
  height: auto; /* mantiene la proporción */
}
</style>

<div class="container">
                <video autoplay loop muted  style="width: 100%; height: 720px" id="video" controls>
                    <source src="/video/VideoDrJorgeVallejo.mp4" type="video/mp4">
                    Tu navegador no soporta el elemento de video.
                </video>  
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCGdocumentos.js"></script>  
<script src="/js/filterCGgaleria.js"></script>  


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('video');

    // Iniciar el video con sonido
    video.muted = false;
    video.play().catch(error => {
      console.error('Error al reproducir el video:', error);
    });

    // Cambiar la fuente del video cuando termine (si tienes varios videos)
   /* video.addEventListener('ended', function() {
      video.src = 'video/VideoDrJorgeVallejoConcredito.mp4';
      video.play().catch(error => {
        console.error('Error al reproducir el video:', error);
      });
    });*/

    // Habilitar sonido al hacer clic en el video (si el navegador bloquea el autoplay con sonido)
    video.addEventListener('click', function enableSound() {
      video.muted = false;
      video.play();
    });
  });
</script>

@endsection