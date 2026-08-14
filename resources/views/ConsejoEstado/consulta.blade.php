@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Consejo Seccional de la Judicatura')

@section('content') 

<style>
    .loader-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 850px;
    background: rgba(255, 255, 255, 0.95);
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader-content {
    text-align: center;
    color: #003366;
    font-size: 16px;
}

#powerbi {
    position: relative;
}

</style>






<h4>
    <center>
        <p>
            Cualquier novedad, inconsistencia o inconveniente que se presente en relación con la consulta de esta página
            deberá ser informada y tramitada mediante comunicación formal dirigida a la
            <strong>Secretaría del Consejo Seccional</strong>, a través del correo electrónico institucional:
        </p>
        <p>
            <strong>
                <a href="mailto:ssadmvalle@cendoj.ramajudicial.gov.co">
                    ssadmvalle@cendoj.ramajudicial.gov.co
                </a>
            </strong>
        </p>

    </center>
</h4>
<hr>

<div class="tab-content">
    <div id="powerbi" class="tab-pane fade in active">

        <!-- Loader -->
        <div id="loaderPowerBI" class="loader-overlay">
            <div class="loader-content">
                <i class="fa fa-spinner fa-spin fa-3x"></i>
                <p>Cargando reporte, por favor espere…</p>
            </div>
        </div>

        <!-- Iframe -->
        <iframe
            id="iframePowerBI"
            title="Reporte Power BI"
            src="https://app.powerbi.com/view?r=eyJrIjoiMDYzZThmNTYtMzg4ZS00YjdhLTg0YjYtMGExYmY2OTZhZmZjIiwidCI6IjYyMmNiYTk4LTgwZjgtNDFmMy04ZGY1LThlYjk5OTAxNTk4YiIsImMiOjR9"
            width="100%"
            height="850"
            frameborder="0"
            allowfullscreen="true"
            onload="ocultarLoaderPowerBI()">
        </iframe>

    </div>
</div>



<hr>
<script>
document.addEventListener("DOMContentLoaded", function () {

    var iframe = document.getElementById("iframePowerBI");
    var loader = document.getElementById("loaderPowerBI");

    // Cuando el iframe realmente carga
    iframe.addEventListener("load", function () {
        loader.style.display = "none";
    });

    // 🔴 Respaldo: por si Power BI no dispara load
    setTimeout(function () {
        loader.style.display = "none";
    }, 6000); // 15 segundos
});
</script>


@endsection