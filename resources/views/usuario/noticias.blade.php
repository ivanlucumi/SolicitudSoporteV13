@extends('layouts.usuarios')
@section('title', 'Noticias Siriscali')
@section('cabecera', 'Sección de Noticias')

@section('content')
<style>
    body {
        background-color: #f4f6f9;
    }

    h2, h4, h5 {
        color: #b92d0f;
        font-weight: bold;
        text-align: center;
    }

    /* ==== CARD BASE ==== */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #1e3d59;
        background: #E6E4E3; /* azul oscuro elegante */
        color: #0C0C0D; /* texto blanco para contraste */
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.25);
        border: none;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }

    /* ==== IMÁGENES ==== */
    .card-img-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }

    .card-img-container img,
    .card img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Cambia a 'cover' si quieres llenar sin dejar bordes */
    }

    /* ==== CARD UNIFORME ==== */
    .card-uniforme {
        height: 430px; /* altura fija igual para todas las cards */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-body {
        padding: 15px;
        text-align: center;
        flex-grow: 1;
    }

    .card-body h5, .card-body h4 {
        font-weight: bold;
        color: #b92d0f;
    }

    .btn-danger, .btn-primary, .btn-secondary {
        border-radius: 8px;
        font-weight: bold;
        width: 100%;
        transition: background 0.3s ease, transform 0.2s ease;
        margin-top: 5px;
    }

    .btn:hover {
        transform: scale(1.03);
    }

    .section-title {
        background: linear-gradient(90deg, #b92d0f 0%, #7a1c07 100%);
        color: white;
        padding: 12px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .card-uniforme {
            height: auto; /* en móviles, se ajusta dinámicamente */
        }
        .card-img-container {
            height: 160px;
        }
        h2 { font-size: 1.3rem; }
        .card-body h4 { font-size: 1rem; }
    }
</style>

<div class="container-fluid mt-4">
  <div class="row">

    <!-- CARD 1 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/nomina2026Calendario.jpg" alt="Calendario Nómina 2026">
        </div>
        <div class="card-body">
          <h5>CALENDARIO NÓMINA VIGENCIA 2026</h5>
          <a href="/Circulares/DEAJC26-2 CALENDARIO NÓMINA VIGENCIA 2026 (1).pdf" target="_blank" rel="noopener" class="btn btn-primary">Ver Calendario</a>
        </div>
      </div>
    </div>

    <!-- CARD 2 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/1formatos/HERRAMIENTASRAMA.jpg" alt="Herramientas Rama Judicial">
        </div>
        <div class="card-body">
          <h5>HERRAMIENTAS COLABORATIVAS</h5>
          <a class="btn btn-danger" href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" target="_blank">Abrir Herramientas</a>
        </div>
      </div>
    </div>

    <!-- CARD 3 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/1formatos/SgdeUrl.jpg" alt="SGDE URL">
        </div>
        <div class="card-body">
          <h5>URL SGDE</h5>
          <a href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" target="_blank" class="btn btn-primary">Abrir SGDE</a>
        </div>
      </div>
    </div>

    <!-- CARD 4 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/logoLargo.png" alt="Solicitud Usuario Micrositio">
        </div>
        <div class="card-body">
          <h5><strong>USUARIO MICROSITIO ATENCIÓN AL CIUDADANO</strong></h5>
          <p>Configura la imagen de PowerPoint con los datos del despacho y guarda como PNG.</p>
          <a href="#" onclick="window.open('https://www.ramajudicial.gov.co/documents/3196516/72775766/video+-+configurar+pagina+atencion+virtual.mp4/15cfc5e8-27f2-4e72-8f20-4d1955bd86ba','popup','width=800,height=600')" class="btn btn-primary">Descargar Instrucción</a>
          <a href="#" onclick="window.open('/img/1formatos/BannerAtencionVirtual.pptx','popup','width=800,height=600')" class="btn btn-secondary">Descargar Banner</a>
        </div>
      </div>
    </div>

    <!-- CARD 5 >
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/logoLargo.png" alt="Solicitud Usuario BestDoc">
        </div>
        <div class="card-body">
          <h5><strong>Solicitud Creación Usuario BestDoc</strong></h5>
          <p>Recuerde diligenciar el formato y enviarlo desde su correo institucional a <strong>mesadeayuda@deaj.ramajudicial.gov.co</strong>.</p>
          <a href="#" onclick="window.open('/img/DocFormatos/Solicitud Usuario Gestor Documental.docx','popup','width=800,height=600')" class="btn btn-primary">Descargar Formato</a>
        </div>
      </div>
    </div-->

    <!-- CARD 6 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/logoLargo.png" alt="TRD Rama Judicial">
        </div>
        <div class="card-body">
          <h5><strong>Tablas de Retención Documental</strong></h5>
          <p>Instrumento para la administración y control de los documentos de los despachos judiciales.</p>
          <a href="https://www.ramajudicial.gov.co/web/centro-de-documentacion-judicial/tablas-de-retencion-documental" target="_blank" class="btn btn-primary">Buscar TRD</a>
        </div>
      </div>
    </div>

    <!-- CARD 7 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/logoLargo.png" alt="Protocolo Digitalización">
        </div>
        <div class="card-body">
          <h5><strong>Protocolo Digitalización Versión 2</strong></h5>
          <p>Parámetros técnicos y funcionales para la gestión de documentos y expedientes electrónicos.</p>
          <a href="https://www.ramajudicial.gov.co/documents/3196516/46103054/Protocolo+para+la+gesti%C3%B3n+de+documentos+electronicos.pdf/cb0d98ef-2844-4570-b12a-5907d76bc1a3" target="_blank" class="btn btn-primary">Visualizar Protocolo</a>
        </div>
      </div>
    </div>

    <!-- CARD 8 -->
    <div class="col-xs-12 col-sm-6">
      <div class="card card-uniforme shadow-sm">
        <div class="card-img-container">
          <img src="/img/logoLargo.png" alt="Formato Referencia Cruzada">
        </div>
        <div class="card-body">
          <h5><strong>Formato de Referencia Cruzada</strong></h5>
          <p>Descarga el formato oficial publicado por la Rama Judicial.</p>
          <a href="#" onclick="window.open('/formatoExcel/FormatoReferenciaCruzada.xlsx','popup','width=800,height=600')" class="btn btn-primary">Descargar Formato</a>
        </div>
      </div>
    </div>

  </div>
</div>

 @php
    use Carbon\Carbon;
    $hoy = Carbon::now();
    $inicio = Carbon::create(2026, 06, 22); // yyyy, mm, dd
    $fin = Carbon::create(2026, 07, 07);
@endphp

@if($hoy->between($inicio, $fin))

    @auth
        @if ( auth()->user()->encuesta == 5)
        <!--@include('externo.Encuesta.ServicviosJudiciales')-->
        @endif
      @if ( auth()->user()->encuesta == 0 )
      <style>
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
                border-radius: 8px;
                width: 90%;
                max-width: 1300px;
                max-height: 90vh;
                overflow-y: auto;
            }
            .blocked-page {
                pointer-events: none;
                opacity: 0.5;
                overflow: hidden;
            }
        </style>
    <style>
            .form-container {
                max-width: 500px;
                margin: 50px auto;
            }
        </style>
        
       
       
       @include('externo.Encuesta.FormEncuentas')
       
       <!-- Fondo oscuro para el modal -->
        <div class="modal-backdrop fade in" style="z-index: 1040;"></div>
    
        <style>
          /* Estilos adicionales */
          .modal {
            z-index: 1050 !important;
          }
          .modal-lg {
            width: 90%;
            max-width: 1000px;
          }
          .panel-title {
            font-size: 16px;
            font-weight: bold;
          }
          .radio {
            margin-top: 5px;
            margin-bottom: 5px;
          }
          .hidden {
            display: none;
          }
        </style>
    
        <script>
          // Bloquear el cierre del modal
          $(document).ready(function() {
            $('#encuestaModal').modal({
              backdrop: 'static',
              keyboard: false
            });
            
            // Mostrar el modal
            $('#encuestaModal').modal('show');
            
            // Prevenir el cierre con ESC
            $(document).keydown(function(e) {
              if (e.keyCode == 27) {
                return false;
              }
            });
          });
    
        </script>
      @endif
    @endauth
@endif
    
   
    

    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            const correoInstitucional = document.getElementById('correo_institucional').value;
            const regex = /@cendoj\.ramajudicial\.gov\.co$/;
            if (!regex.test(correoInstitucional)) {
                event.preventDefault();
                alert('El correo institucional debe tener el dominio @cendoj.ramajudicial.gov.co');
            }
        });
    </script>

@endsection
