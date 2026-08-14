@extends('layouts.ensayo1')

@section('title', 'Encuesta de Satisfacción')
@section('cabecera', 'Encuesta de Satisfacción del Servicio')

@section('content')

<!-- ======== ESTILOS ======== -->
<style>
    .form-container {
        background: #ffffff;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .form-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.3);
    }
    h2 {
        color: #b92d0f;
        text-align: center;
        margin-bottom: 20px;
    }
    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0 20px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        transition: border-color 0.3s;
    }
    input[type="text"]:focus, input[type="email"]:focus {
        border-color: #007bff;
        outline: none;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background 0.3s ease;
    }
    button:hover {
        background: #0056b3;
    }

    /* Modal */
    .encuesta-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .encuesta-content {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        width: 90%;
        max-width: 1300px;
        max-height: 90vh;
        overflow-y: auto;
    }
</style>

<!-- ======== CONTENIDO ======== -->
<div class="container-fluid">
    
    @php
    use Carbon\Carbon;
    $hoy = Carbon::now();
    $inicio = Carbon::create(2026, 03, 25); // yyyy, mm, dd
    $fin = Carbon::create(2026, 04, 12);
@endphp

@if($hoy->between($inicio, $fin))
    <!-- Modal con la encuesta -->
    @include('externo.Encuesta.FormEncuentas')

@else
    {{-- Modal: encuesta no disponible --}}
    <div class="modal fade" id="modalEncuestaCerrada" tabindex="-1" role="dialog" aria-labelledby="modalEncuestaCerradaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalEncuestaCerradaLabel">
                        ENCUESTA NO DISPONIBLE
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fa fa-exclamation-circle fa-3x text-danger mb-3"></i>
                    <p class="mb-0">
                        Esta encuesta ya no está disponible.  
                        Gracias por tu interés.
                    </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#modalEncuestaCerrada').modal('show');
        });
    </script>

@endif

    

    <!-- Fondo oscuro del modal -->
    <div class="modal-backdrop fade in" style="z-index: 1040;"></div>

</div>

<!-- ======== SCRIPTS ======== -->
<!-- Librerías -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function() {

    // Verificar si ya se respondió la encuesta al cargar la página
    if (sessionStorage.getItem('encuesta_respondida')) {
        // Ocultar el modal de la encuesta
        $('.encuesta-modal').hide();
        $('.modal-backdrop').hide();
        
        // Mostrar mensaje de agradecimiento
        Swal.fire({
            icon: 'success',
            title: '¡Gracias por tu participación!',
            text: 'Tu encuesta ha sido enviada exitosamente. Agradecemos tu tiempo y colaboración.',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        }).then(() => {
            // Limpiar la sesión después de 2 segundos
            sessionStorage.removeItem('encuesta_respondida');
            // Recargar o redirigir si es necesario
            window.location.reload();
        });
    }

    // Evento al enviar formulario
    $('#MiFormulario').on('submit', function(e) {
        e.preventDefault(); // Evita recargar la página

        // Guardar en sessionStorage que ya se respondió
        sessionStorage.setItem('encuesta_respondida', 'true');
        
        // ✅ Mensaje de agradecimiento
        Swal.fire({
            icon: 'success',
            title: '¡Gracias por tu participación!',
            text: 'Tu encuesta ha sido enviada exitosamente. Agradecemos tu tiempo y colaboración.',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            // Limpiar la sesión después de 2 segundos
            sessionStorage.removeItem('encuesta_respondida');
            
            // Si deseas enviar realmente al servidor, descomenta:
            // e.target.submit();
            // O redirigir:
            // window.location.href = '/gracias';
            
            // Recargar la página
            window.location.reload();
        });
    });

});
</script>

@endsection