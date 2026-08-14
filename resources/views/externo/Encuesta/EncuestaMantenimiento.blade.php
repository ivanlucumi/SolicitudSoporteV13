@extends('layouts.ensayo1')

@section('content')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

.card-encuesta {
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border: none;
    font-size: 17px; /* 🔥 aumenta tamaño general */
}

h4 {
    font-size: 24px;
    font-weight: 700;
}

p.text-muted {
    font-size: 16px;
}

label.fw-bold {
    font-size: 17px;
    margin-bottom: 6px;
}

.form-control {
    font-size: 16px;
    padding: 8px 12px;
}

/* Escala */
.scale-group {
    display: flex;
    justify-content: space-between;
    gap: 8px;
    margin-top: 8px;
}

.scale-option {
    flex: 1;
    text-align: center;
}

.scale-option input[type="radio"] {
    display: none;
}

.scale-option label {
    display: block;
    padding: 12px 0;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    cursor: pointer;
    font-weight: 700;
    font-size: 18px; /* 🔥 números más grandes */
    transition: all 0.2s ease;
    background: #f8f9fa;
}

.scale-option input[type="radio"]:checked + label {
    background: #0d6efd;
    color: white;
    border-color: #0d6efd;
    box-shadow: 0 4px 10px rgba(13,110,253,0.3);
}

.scale-labels {
    display: flex;
    justify-content: space-between;
    font-size: 14px; /* 🔥 texto descriptivo más grande */
    margin-top: 6px;
    color: #6c757d;
}

textarea {
    font-size: 16px;
}

button {
    font-size: 18px;
    font-weight: 600;
    padding: 10px;
}

</style>

<div class="container d-flex justify-content-center py-5">
    <div class="card card-encuesta p-4 w-100" style="max-width: 650px;">

<h4 class="mb-2">Encuesta Servicio de Mantenimiento</h4>
<p class="text-muted">Consecutivo: <strong>{{ $reporte->consecutivo }}</strong></p>

<form method="POST" action="{{ route('mantenimiento.encuesta.guardar',$reporte->consecutivo) }}">
@csrf

<!-- Problema solucionado -->
<div class="mb-4">
    <label class="fw-bold">¿El problema fue solucionado?</label>
    <select name="problema_solucionado" class="form-control" required>
        <option value="">Seleccione...</option>
        <option value="completamente">Sí, completamente</option>
        <option value="parcialmente">Sí, parcialmente</option>
        <option value="no_solucionado">No fue solucionado</option>
    </select>
</div>

{{-- ESCALA REUTILIZABLE --}}
@php
function escala($name,$minLabel,$maxLabel){
@endphp
<div class="mb-4">
    <div class="scale-group">
        @for($i=1;$i<=5;$i++)
            <div class="scale-option">
                <input type="radio" id="{{ $name.$i }}" name="{{ $name }}" value="{{ $i }}" required>
                <label for="{{ $name.$i }}">{{ $i }}</label>
            </div>
        @endfor
    </div>
    <div class="scale-labels">
        <span>{{ $minLabel }}</span>
        <span>{{ $maxLabel }}</span>
    </div>
</div>
@php } @endphp

<!-- Tiempo -->
<label class="fw-bold">Tiempo de respuesta</label>
@php escala('tiempo_respuesta','Muy lento','Excelente'); @endphp

<!-- Atención -->
<label class="fw-bold">Atención del personal</label>
@php escala('atencion_personal','Deficiente','Excelente'); @endphp

<!-- Calidad -->
<label class="fw-bold">Calidad técnica</label>
@php escala('calidad_tecnica','Baja','Excelente'); @endphp

<!-- General -->
<label class="fw-bold">Satisfacción general</label>
@php escala('satisfaccion_general','Muy insatisfecho','Muy satisfecho'); @endphp

<!-- Comentario -->
<div class="mb-4">
    <label class="fw-bold">¿Qué podríamos mejorar?</label>
    <textarea name="comentario" class="form-control" rows="3"></textarea>
</div>

<button class="btn btn-primary w-100 py-2">Enviar Encuesta</button>

</form>
</div>
</div>

@if(session('encuesta_respondida'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'info',
        title: 'Encuesta no disponible',
        text: "{{ session('encuesta_respondida') }}",
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#0d6efd',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/";
        }
    });
});
</script>
@endif

@endsection