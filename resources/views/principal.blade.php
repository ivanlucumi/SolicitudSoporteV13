@extends('layouts.ensayo1')
@section('title', 'Siris Cali - Disaj Cali')

@push('style')
<style>
  /* Bento Grid Image Slider - MEJORADO */
  .bento-slider {
    position: relative;
    border-radius: 1.5rem;
    overflow: hidden;
    box-shadow: 0 25px 50px -12px rgba(0, 63, 117, 0.25);
    background: #0a0a0a;
    height: 400px;
  }
  
  .bento-slider .slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
    z-index: 1;
    overflow: hidden;
  }
  
  .bento-slider .slide.active {
    opacity: 1;
    z-index: 5;
  }
  
  .bento-slider .slide .slide-media {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  
  .slide-overlay {
    background: linear-gradient(to top, rgba(0,33,71,0.9) 0%, rgba(0,63,117,0.4) 50%, transparent 100%);
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 2;
  }

  /* Contenedor para imágenes y videos */
  .slide-media-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  
  .slide-media-wrapper img,
  .slide-media-wrapper video {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
  }

  /* Estilos para documentos y enlaces */
  .doc-viewer, .link-viewer {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
    text-align: center;
    padding: 40px;
    position: relative;
    z-index: 3;
  }
  
  .doc-viewer {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    color: #334155;
  }
  
  .doc-viewer i { font-size: 80px; color: #dc2626; margin-bottom: 20px; }
  .doc-viewer h3 { font-size: 1.5rem; font-weight: 700; margin-bottom: 10px; }
  .doc-viewer p { font-size: 0.9rem; color: #64748b; margin-bottom: 25px; }

  .link-viewer {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    color: #065f46;
  }
  
  .link-viewer i { font-size: 80px; color: #059669; margin-bottom: 20px; }
  .link-viewer h3 { font-size: 1.5rem; font-weight: 700; margin-bottom: 10px; color: #064e3b; }
  .link-viewer p { font-size: 0.9rem; color: #047857; margin-bottom: 25px; }

  /* BOTÓN DE REDIRECCIÓN - PARTE INFERIOR IZQUIERDA */
  .slide-link-btn {
    position: absolute;
    bottom: 100px;
    left: 30px;
    z-index: 20;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.95);
    color: #003f75;
    padding: 10px 24px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.3);
    cursor: pointer;
    pointer-events: auto;
  }
  
  .slide-link-btn:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 30px rgba(0,0,0,0.35);
    background: white;
    color: #002147;
  }
  
  .slide-link-btn i {
    font-size: 18px;
  }

  /* BOTÓN DE AUDIO - PARTE INFERIOR IZQUIERDA */
  .sound-toggle {
    position: absolute;
    bottom: 100px;
    left: 210px;
    z-index: 20;
    background: rgba(220, 38, 38, 0.9);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 20px;
    box-shadow: 0 4px 20px rgba(220, 38, 38, 0.5);
  }
  
  .sound-toggle:hover { 
    transform: scale(1.15);
    background: rgba(220, 38, 38, 1);
    box-shadow: 0 6px 30px rgba(220, 38, 38, 0.7);
  }
  
  .sound-toggle:active {
    transform: scale(0.95);
  }
  
  .sound-toggle.unmuted {
    background: rgba(34, 197, 94, 0.9);
    box-shadow: 0 4px 20px rgba(34, 197, 94, 0.5);
    border-color: rgba(255, 255, 255, 0.5);
  }
  
  .sound-toggle.unmuted:hover {
    background: rgba(34, 197, 94, 1);
    box-shadow: 0 6px 30px rgba(34, 197, 94, 0.7);
  }
  
  /* Animación de pulso para el botón de audio */
  .sound-toggle.pulsing {
    animation: pulse 2s ease-in-out infinite;
  }
  
  @keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(220, 38, 38, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
  }

  .slide-indicators {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 10;
  }
  
  .slide-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
  }
  
  .slide-indicator.active {
    background: white;
    width: 32px;
    border-radius: 4px;
  }
  
  .slide-indicator:hover {
    background: rgba(255,255,255,0.8);
  }

  /* Indicador de clic para video */
  .video-click-hint {
    position: absolute;
    bottom: 170px;
    left: 30px;
    z-index: 8;
    color: white;
    background: rgba(0,0,0,0.5);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,0.2);
    opacity: 0;
    transition: opacity 0.5s ease;
    pointer-events: none;
    white-space: nowrap;
  }
  
  .slide.active .video-click-hint {
    opacity: 1;
    animation: fadeInUp 1s ease forwards;
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .tab-btn {
    position: relative;
    transition: all 0.3s ease;
    background: transparent;
    border: none;
    padding: 10px 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
  }
  
  .tab-btn.active {
    color: var(--primary);
    background: #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    font-weight: 600;
  }
  
  .tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: -2px; left: 10%; width: 80%; height: 3px;
    background: var(--accent);
    border-radius: 4px 4px 0 0;
  }

  .tab-content {
    display: none;
    animation: fadeUp 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
  }
  
  .tab-content.active { display: block; }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .btn-glow {
    position: relative;
    overflow: hidden;
  }
  
  .btn-glow::after {
    content: '';
    position: absolute;
    top: -50%; left: -50%; width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 60%);
    transform: scale(0);
    transition: transform 0.5s ease-out;
  }
  
  .btn-glow:hover::after { transform: scale(1); }

  /* Overlay de carga para videos */
  .video-loading {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.7);
    z-index: 6;
    color: white;
    font-size: 14px;
    transition: opacity 0.5s ease;
    flex-direction: column;
    gap: 12px;
  }
  
  .video-loading.hidden {
    opacity: 0;
    pointer-events: none;
  }
  
  .video-loading .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(255,255,255,0.1);
    border-top-color: #dc2626;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    to { transform: rotate(360deg); }
  }

  /* Forzar que las imágenes se adapten correctamente */
  .slide-media-wrapper img {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain !important;
    display: block !important;
  }

  .slide-media-wrapper video {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain !important;
    display: block !important;
  }

  @media (max-width: 768px) {
    .bento-slider { height: 280px !important; }
    .doc-viewer i, .link-viewer i { font-size: 50px; }
    .slide-link-btn {
      bottom: 80px;
      left: 15px;
      padding: 8px 16px;
      font-size: 0.75rem;
    }
    .slide-link-btn i { font-size: 14px; }
    .sound-toggle {
      width: 40px;
      height: 40px;
      font-size: 16px;
      bottom: 80px;
      left: 155px;
    }
    .video-click-hint {
      font-size: 9px;
      padding: 4px 10px;
      bottom: 130px;
      left: 15px;
    }
  }
</style>
@endpush

@section('content')
  <!-- MAIN APP LAYOUT (BENTO GRID) -->
  <main class="container mx-auto px-4 lg:px-6 flex-grow mb-12">
    
    <!-- Top Section: Bento Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8" data-aos="fade-up">
      
      <!-- Bento Item 1: Hero Slider MEJORADO -->
      <div class="lg:col-span-8 bento-slider rounded-3xl shadow-xl overflow-hidden group">
        @if(isset($banner) && is_iterable($banner) && count($banner) > 0)
          @foreach($banner as $id => $bnr)
            @php
              $isVideo = in_array(strtolower($bnr->bextension ?? ''), ['mp4', 'webm', 'mov', 'avi']);
              $isImage = in_array(strtolower($bnr->bextension ?? ''), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
              $isDoc = in_array(strtolower($bnr->bextension ?? ''), ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar', 'txt', 'csv']);
              $hasLink = !empty($bnr->bLink);
              $isFileLink = $hasLink && preg_match('/\.(pdf|docx?|xlsx?|pptx?|zip|rar|txt|csv)$/i', $bnr->bLink);
              $isExternalLink = $hasLink && !$isFileLink;
              $slideClass = $id == 0 ? 'slide active' : 'slide';
              $title = strtoupper($bnr->bNombre ?? '');
              $desc = $bnr->bDescripcion ?? 'Banner institucional';
              $bLink = $bnr->bLink ?? '';
              $linkUrl = $hasLink ? ($isFileLink ? 'https://'.$bLink : 'https://'.$bLink) : '#';
              $linkText = $isFileLink ? 'Descargar Documento' : 'Ver Más';
              $linkIcon = $isFileLink ? 'bi-download' : 'bi-arrow-right-circle';
            @endphp

            <div class="{{ $slideClass }}" 
                 data-title="{{ $title }}" 
                 data-desc="{{ $desc }}"
                 data-index="{{ $id }}"
                 data-link="{{ $linkUrl }}"
                 data-haslink="{{ $hasLink ? 'true' : 'false' }}">

              @if($isVideo)
                <!-- Video Slide -->
                <div class="slide-media-wrapper">
                  <!-- Overlay de carga -->
                  <div class="video-loading" id="loading{{$id}}">
                    <div class="spinner"></div>
                    <span>Cargando video...</span>
                  </div>
                  
                  <video class="slide-media banner-video"
                    id="video{{$id}}"
                    autoplay
                    muted
                    playsinline
                    loop
                    preload="auto">
                    <source src="{{ asset('video/'.$bnr->bFoto) }}" type="video/{{$bnr->bextension ?? 'mp4'}}">
                    Tu navegador no soporta videos.
                  </video>
                  
                  <!-- Botón de redirección si tiene enlace -->
                  @if($hasLink)
                    <a href="{{ $linkUrl }}" 
                       class="slide-link-btn" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       @if($isFileLink) download @endif
                       onclick="event.stopPropagation();">
                      <i class="bi {{ $linkIcon }}"></i>
                      {{ $linkText }}
                    </a>
                  @endif
                  
                  <!-- Botón de sonido -->
                  <button class="sound-toggle pulsing" 
                          id="soundToggle{{$id}}"
                          onclick="event.stopPropagation(); toggleSound('video{{$id}}', this)"
                          aria-label="Alternar sonido">
                    <i class="bi bi-volume-mute"></i>
                  </button>
                  
                  <!-- Indicador de clic para activar audio -->
                  <div class="video-click-hint">
                    <i class="bi bi-hand-index-thumb"></i> Haz clic para activar audio
                  </div>
                  
                  <div class="slide-overlay"></div>
                </div>

              @elseif($isImage)
                <!-- Image Slide -->
                <div class="slide-media-wrapper">
                  <img src="{{ asset('img/'.$bnr->bFoto) }}" 
                       alt="{{ $title }}"
                       class="slide-media"
                       loading="lazy"
                       style="width:100%;height:100%;object-fit:contain;">
                  
                  <!-- Botón de redirección si tiene enlace -->
                  @if($hasLink)
                    <a href="{{ $linkUrl }}" 
                       class="slide-link-btn" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       @if($isFileLink) download @endif
                       onclick="event.stopPropagation();">
                      <i class="bi {{ $linkIcon }}"></i>
                      {{ $linkText }}
                    </a>
                  @endif
                  
                  <div class="slide-overlay"></div>
                </div>

              @elseif($isDoc || $isFileLink)
                <!-- Document Slide -->
                <div class="doc-viewer">
                  <i class="bi bi-file-earmark-pdf"></i>
                  <h3>{{ $title }}</h3>
                  <p>{{ $desc }}</p>
                  <a href="{{ $linkUrl }}" 
                     class="btn-download" 
                     target="_blank" 
                     rel="noopener noreferrer"
                     download>
                    <i class="bi bi-download"></i> Descargar Documento
                  </a>
                </div>

              @elseif($isExternalLink)
                <!-- External Link Slide -->
                <div class="link-viewer">
                  <i class="bi bi-box-arrow-up-right"></i>
                  <h3>{{ $title }}</h3>
                  <p>{{ $desc }}</p>
                  <a href="{{ $linkUrl }}" 
                     class="btn-visit" 
                     target="_blank" 
                     rel="noopener noreferrer">
                    <i class="bi bi-arrow-right-circle"></i> Visitar Enlace
                  </a>
                </div>

              @else
                <!-- Default Slide with Background Image -->
                <div class="slide-media-wrapper">
                  @if(!empty($bnr->bFoto))
                    <img src="{{ asset('img/'.$bnr->bFoto) }}" 
                         alt="{{ $title }}"
                         class="slide-media"
                         loading="lazy"
                         style="width:100%;height:100%;object-fit:contain;">
                  @else
                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                      <div class="text-center text-white p-8">
                        <i class="bi bi-image text-6xl mb-4 opacity-50"></i>
                        <h3 class="text-xl font-bold">{{ $title }}</h3>
                        <p class="text-primary-light mt-2 text-sm">{{ $desc }}</p>
                      </div>
                    </div>
                  @endif
                  
                  <!-- Botón de redirección si tiene enlace -->
                  @if($hasLink)
                    <a href="{{ $linkUrl }}" 
                       class="slide-link-btn" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       @if($isFileLink) download @endif
                       onclick="event.stopPropagation();">
                      <i class="bi {{ $linkIcon }}"></i>
                      {{ $linkText }}
                    </a>
                  @endif
                  
                  <div class="slide-overlay"></div>
                </div>
              @endif
            </div>
          @endforeach
        @else
          <!-- Fallback Slide -->
          <div class="slide active">
            <div class="slide-media-wrapper">
              <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                <div class="text-center text-white p-8">
                  <i class="bi bi-image text-6xl mb-4"></i>
                  <h3 class="text-2xl font-bold">Sin contenido disponible</h3>
                  <p class="text-primary-light mt-2">No hay banners configurados</p>
                </div>
              </div>
            </div>
          </div>
        @endif
        
        <!-- Content Overlay -->
        <div class="absolute bottom-0 left-0 p-8 w-full z-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div class="max-w-xl">
            <span class="bg-accent text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3 inline-block shadow-lg">Noticia Principal</span>
            <h2 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-2" id="slideTitle">Modernización Judicial 2026</h2>
            <p class="text-slate-200 text-sm md:text-base line-clamp-2" id="slideDesc">Implementación de nuevas tecnologías para agilizar los procesos en los despachos judiciales del Valle del Cauca.</p>
          </div>
          <button onclick="nextSlide()" 
                  class="glass text-white hover:bg-white hover:text-primary rounded-full w-12 h-12 flex items-center justify-center transition-all flex-shrink-0">
            <i class="bi bi-arrow-right text-xl"></i>
          </button>
        </div>
        
        <!-- Controls -->
        <div class="absolute top-4 right-4 flex gap-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <button onclick="prevSlide()" class="glass text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-white hover:text-primary">
            <i class="bi bi-chevron-left"></i>
          </button>
          <button onclick="nextSlide()" class="glass text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-white hover:text-primary">
            <i class="bi bi-chevron-right"></i>
          </button>
        </div>

        <!-- Slide Indicators -->
        @if(isset($banner) && is_iterable($banner) && count($banner) > 1)
          <div class="slide-indicators">
            @foreach($banner as $id => $bnr)
              <button class="slide-indicator {{ $id == 0 ? 'active' : '' }}" 
                      onclick="goToSlide({{ $id }})"
                      aria-label="Ir al slide {{ $id + 1 }}"></button>
            @endforeach
          </div>
        @endif
      </div>

      <!-- Bento Item 2 & 3: Quick Actions & Stats -->
      <div class="lg:col-span-4 flex flex-col gap-6">
        
        <!-- Ventanilla Digital -->
        <a href="{{ url('/ventanilla/digital') }}" class="flex-1 glass-dark rounded-3xl p-6 flex flex-col justify-between group overflow-hidden relative text-white decoration-transparent hover:text-white">
          <div class="absolute -right-10 -top-10 text-[100px] text-white/5 group-hover:scale-110 transition-transform duration-500"><i class="bi bi-inbox-fill"></i></div>
          <div>
            <div class="bg-white/10 w-12 h-12 rounded-2xl flex items-center justify-center text-accent text-2xl mb-4 backdrop-blur-sm group-hover:bg-accent group-hover:text-white transition-colors">
              <i class="bi bi-cloud-arrow-up-fill"></i>
            </div>
            <h3 class="text-xl font-bold mb-1">Ventanilla Digital</h3>
            <p class="text-slate-300 text-sm">Radique solicitudes y documentos oficiales sin desplazarse.</p>
          </div>
          <div class="mt-4 flex items-center gap-2 text-sm font-semibold text-accent group-hover:text-white transition-colors">
            Ingresar ahora <i class="bi bi-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
          </div>
        </a>

        <!-- Stats -->
        <div class="flex-1 grid grid-cols-2 gap-4">
          <div class="glass-card rounded-2xl p-4 flex flex-col justify-center items-center text-center">
            <a href="{{ url('/comite_genero') }}" class="flex-1 glass-dark rounded-3xl p-6 flex flex-col justify-between group overflow-hidden relative text-white decoration-transparent hover:text-white">
              <div class="absolute -right-10 -top-10 text-[100px] text-white/5 group-hover:scale-40 transition-transform duration-500"></div>
              <div>
                <h3 class="text-xl font-bold mb-1">Comité de Género</h3>
                <p class="text-slate-300 text-sm">Conozca más información sobre el comité de género.</p>
              </div>
              <div class="mt-4 flex items-center gap-2 text-sm font-semibold text-accent group-hover:text-white transition-colors">
                Ingresar <i class="bi bi-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
              </div>
            </a>
          </div>
          <div class="glass-card rounded-2xl p-4 flex flex-col justify-center items-center text-center">
            <a href="{{ url('/sst') }}" class="flex-1 glass-dark rounded-3xl p-6 flex flex-col justify-between group overflow-hidden relative text-white decoration-transparent hover:text-white">
              <div class="absolute -right-10 -top-10 text-[100px] text-white/5 group-hover:scale-40 transition-transform duration-500"></div>
              <div>
                <h3 class="text-xl font-bold mb-1">Seguridad y Salud en el Trabajo</h3>
                <p class="text-slate-300 text-sm">Conozca más información sobre Seguridad y Salud en el Trabajo.</p>
              </div>
              <div class="mt-4 flex items-center gap-2 text-sm font-semibold text-accent group-hover:text-white transition-colors">
                Ingresar <i class="bi bi-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- CENTRAL HUB (TABS) -->
    <div class="glass rounded-3xl p-4 md:p-8" data-aos="fade-up" data-aos-delay="100">
      
      <!-- Tab Navigation -->
      <div class="flex flex-wrap gap-2 md:gap-4 border-b border-slate-200 pb-4 mb-6">
        <button class="tab-btn active px-4 py-2 rounded-xl text-slate-500 text-sm md:text-base font-medium flex items-center gap-2" onclick="openTab(event, 'tab-noticias')">
          <i class="bi bi-newspaper"></i> Circulares & Noticias
        </button>
        <button class="tab-btn px-4 py-2 rounded-xl text-slate-500 text-sm md:text-base font-medium flex items-center gap-2" onclick="openTab(event, 'tab-servicios')">
          <i class="bi bi-grid-fill"></i> Servicios & Trámites
        </button>
        <button class="tab-btn px-4 py-2 rounded-xl text-slate-500 text-sm md:text-base font-medium flex items-center gap-2" onclick="openTab(event, 'tab-contratos')">
          <i class="bi bi-file-earmark-text"></i> Contratación
        </button>
        <button class="tab-btn px-4 py-2 rounded-xl text-slate-500 text-sm md:text-base font-medium flex items-center gap-2" onclick="openTab(event, 'tab-institucional')">
          <i class="bi bi-building"></i> Institucional
        </button>
      </div>

      <!-- TAB 1: Noticias -->
      <div id="tab-noticias" class="tab-content active">
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-xl font-bold text-primary">Actualidad DISAJ</h3>
          <div class="relative">
            <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
            <input type="text" placeholder="Buscar circular..." class="pl-9 pr-4 py-2 rounded-full border border-slate-200 bg-white/50 focus:outline-none focus:ring-2 focus:ring-primary/50 text-sm w-48 md:w-64 transition-all">
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @if(isset($noticia) && is_iterable($noticia) && count($noticia) > 0)
            @foreach(array_slice($noticia, 0, 6) as $n)
              <a href="{{ !empty($n->nLink) ? 'https://'.$n->nLink : '#' }}" target="_blank" class="glass-card rounded-2xl p-5 group flex flex-col h-full">
                <div class="flex justify-between items-start mb-3">
                  <span class="bg-primary/10 text-primary text-[10px] uppercase font-bold px-2 py-1 rounded">Noticia</span>
                  <span class="text-xs font-semibold text-slate-400 flex items-center gap-1">
                    <i class="bi bi-calendar3"></i> {{ isset($n->created_at) ? \Carbon\Carbon::parse($n->created_at)->format('d M') : '' }}
                  </span>
                </div>
                <h4 class="font-bold text-slate-800 leading-snug mb-2 group-hover:text-primary transition-colors">{{ $n->nNombre }}</h4>
                @if(!empty($n->nDescripcion))
                  <p class="text-sm text-slate-500 line-clamp-2 mt-auto">{{ \Illuminate\Support\Str::limit($n->nDescripcion, 100) }}</p>
                @endif
              </a>
            @endforeach
          @else
            <div class="glass-card rounded-2xl p-5 group flex flex-col h-full items-center justify-center text-center">
              <i class="bi bi-newspaper text-4xl text-slate-300 mb-3"></i>
              <p class="text-sm text-slate-500">No hay noticias disponibles</p>
            </div>
          @endif
        </div>
      </div>

      <!-- TAB 2: Servicios -->
      <div id="tab-servicios" class="tab-content">
        <h3 class="text-xl font-bold text-primary mb-6">Herramientas en Línea</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          
          <a href="{!! route('certificacion.form') !!}" class="glass-card rounded-2xl p-6 text-center group">
            <div class="w-14 h-14 mx-auto bg-primary/10 rounded-full flex items-center justify-center text-primary text-2xl mb-3 group-hover:scale-110 transition-transform"><i class="bi bi-person-badge"></i></div>
            <h4 class="font-bold text-slate-700 text-sm">Certificación R.H.</h4>
            <p class="text-[11px] text-slate-500 mt-1">Descarga certificados</p>
          </a>

          <a href="{!! route('acortador.url') !!}" class="glass-card rounded-2xl p-6 text-center group">
            <div class="w-14 h-14 mx-auto bg-primary/10 rounded-full flex items-center justify-center text-primary text-2xl mb-3 group-hover:scale-110 transition-transform"><i class="bi bi-link-45deg"></i></div>
            <h4 class="font-bold text-slate-700 text-sm">Acortador URL</h4>
            <p class="text-[11px] text-slate-500 mt-1">Enlaces oficiales</p>
          </a>

          <a href="{!! route('sirisqrcode.form') !!}" class="glass-card rounded-2xl p-6 text-center group">
            <div class="w-14 h-14 mx-auto bg-primary/10 rounded-full flex items-center justify-center text-primary text-2xl mb-3 group-hover:scale-110 transition-transform"><i class="bi bi-qr-code-scan"></i></div>
            <h4 class="font-bold text-slate-700 text-sm">Generador QR</h4>
            <p class="text-[11px] text-slate-500 mt-1">Para documentos</p>
          </a>

          <a href="{!! route('numeros.aleatorios') !!}" class="glass-card rounded-2xl p-6 text-center group">
            <div class="w-14 h-14 mx-auto bg-primary/10 rounded-full flex items-center justify-center text-primary text-2xl mb-3 group-hover:scale-110 transition-transform"><i class="bi bi-dice-5"></i></div>
            <h4 class="font-bold text-slate-700 text-sm">Sorteos</h4>
            <p class="text-[11px] text-slate-500 mt-1">Números aleatorios</p>
          </a>

          <a href="https://www.ramajudicial.gov.co" target="_blank" class="glass-card rounded-2xl p-6 text-center group col-span-2 md:col-span-1">
            <div class="w-14 h-14 mx-auto bg-accent/10 rounded-full flex items-center justify-center text-accent text-2xl mb-3 group-hover:scale-110 transition-transform"><i class="bi bi-bank2"></i></div>
            <h4 class="font-bold text-slate-700 text-sm">Rama Judicial</h4>
            <p class="text-[11px] text-slate-500 mt-1">Portal Nacional</p>
          </a>

          <a href="{{ url('/ventanilla/digital') }}" class="glass-card rounded-2xl p-6 text-center group col-span-2 md:col-span-1">
            <div class="w-14 h-14 mx-auto bg-secondary/10 rounded-full flex items-center justify-center text-secondary text-2xl mb-3 group-hover:scale-110 transition-transform"><i class="bi bi-inbox"></i></div>
            <h4 class="font-bold text-slate-700 text-sm">Ventanilla Digital</h4>
            <p class="text-[11px] text-slate-500 mt-1">Radicación en línea</p>
          </a>

        </div>
      </div>

      <!-- TAB 3: Contratación -->
      <div id="tab-contratos" class="tab-content">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="flex-1">
            <h3 class="text-xl font-bold text-primary mb-4">Procesos Activos</h3>
            <div class="space-y-3">
              <div class="glass-card rounded-xl p-4 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                <div>
                  <h4 class="font-semibold text-sm text-slate-800">Circulares y Actos Administrativos</h4>
                  <div class="flex gap-4 mt-1 text-xs text-slate-500">
                    <span><i class="bi bi-file-text"></i> Normatividad</span>
                  </div>
                </div>
                <a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/actos-administrativos" target="_blank" class="bg-secondary/10 text-secondary text-[10px] uppercase font-bold px-3 py-1.5 rounded-full w-fit">Ver</a>
              </div>

              <div class="glass-card rounded-xl p-4 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                <div>
                  <h4 class="font-semibold text-sm text-slate-800">Contratación de Mínima Cuantía</h4>
                  <div class="flex gap-4 mt-1 text-xs text-slate-500">
                    <span><i class="bi bi-currency-dollar"></i> Procesos activos</span>
                  </div>
                </div>
                <a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/contratacion-de-minima-cuantia" target="_blank" class="bg-secondary/10 text-secondary text-[10px] uppercase font-bold px-3 py-1.5 rounded-full w-fit">Ver</a>
              </div>

              <div class="glass-card rounded-xl p-4 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                <div>
                  <h4 class="font-semibold text-sm text-slate-800">Selección Abreviada de Menor Cuantía</h4>
                  <div class="flex gap-4 mt-1 text-xs text-slate-500">
                    <span><i class="bi bi-calendar-event"></i> En curso</span>
                  </div>
                </div>
                <a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/seleccion-abreviada-de-menor-cuantia" target="_blank" class="bg-accent/10 text-accent text-[10px] uppercase font-bold px-3 py-1.5 rounded-full w-fit">Ver</a>
              </div>

              <div class="glass-card rounded-xl p-4 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                <div>
                  <h4 class="font-semibold text-sm text-slate-800">Licitación Pública</h4>
                  <div class="flex gap-4 mt-1 text-xs text-slate-500">
                    <span><i class="bi bi-calendar-event"></i> Convocatorias</span>
                  </div>
                </div>
                <a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/licitacion-publica" target="_blank" class="bg-accent/10 text-accent text-[10px] uppercase font-bold px-3 py-1.5 rounded-full w-fit">Ver</a>
              </div>
            </div>
            <a href="https://www.secop.gov.co" target="_blank" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary-dark transition-colors">
              Ir a SECOP II <i class="bi bi-box-arrow-up-right"></i>
            </a>
          </div>

          <div class="md:w-1/3 glass bg-primary/5 rounded-2xl p-5 h-fit">
            <h4 class="font-bold text-slate-800 mb-3 flex items-center gap-2"><i class="bi bi-shield-check text-primary"></i> Transparencia</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/plan-anual-de-adquisiciones" target="_blank" class="text-slate-600 hover:text-primary flex items-center gap-2"><i class="bi bi-arrow-right-short"></i> Plan Anual de Adquisiciones</a></li>
              <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/concurso-de-meritos" target="_blank" class="text-slate-600 hover:text-primary flex items-center gap-2"><i class="bi bi-arrow-right-short"></i> Concurso de Méritos</a></li>
              <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/contratacion-directa" target="_blank" class="text-slate-600 hover:text-primary flex items-center gap-2"><i class="bi bi-arrow-right-short"></i> Contratación Directa</a></li>
              <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/seleccion-abreviada-subasta-inversa" target="_blank" class="text-slate-600 hover:text-primary flex items-center gap-2"><i class="bi bi-arrow-right-short"></i> Subasta Inversa</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- TAB 4: Institucional -->
      <div id="tab-institucional" class="tab-content">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="glass-card rounded-2xl p-6 border-l-4 border-l-primary">
            <div class="flex items-center gap-3 mb-4">
              <div class="bg-primary/10 p-2 rounded-lg text-primary"><i class="bi bi-bullseye text-xl"></i></div>
              <h3 class="text-lg font-bold text-slate-800">Nuestra Misión</h3>
            </div>
            <p class="text-sm text-slate-600 leading-relaxed">Administrar de manera eficiente y transparente los recursos humanos, físicos y financieros asignados a la Dirección Seccional de Administración Judicial de Cali, garantizando el buen funcionamiento de los despachos judiciales y la prestación de un servicio de justicia de calidad.</p>
          </div>
          <div class="glass-card rounded-2xl p-6 border-l-4 border-l-accent">
            <div class="flex items-center gap-3 mb-4">
              <div class="bg-accent/10 p-2 rounded-lg text-accent"><i class="bi bi-eye text-xl"></i></div>
              <h3 class="text-lg font-bold text-slate-800">Nuestra Visión 2030</h3>
            </div>
            <p class="text-sm text-slate-600 leading-relaxed">Ser reconocida como la Dirección Seccional modelo en Colombia por su nivel de innovación tecnológica, excelencia en la gestión administrativa, bienestar de sus servidores y aporte al acceso a la justicia.</p>
          </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-4">
          <a href="{{ url('/comite_genero') }}" class="btn-glow bg-slate-800 text-white px-5 py-2.5 rounded-full text-sm font-medium flex items-center gap-2 shadow-lg">
            <i class="bi bi-heart-fill text-red-400"></i> Comité de Género
          </a>
          <a href="{{ url('/seguridad_y_salud_en_el_trabajo') }}" class="btn-glow bg-slate-800 text-white px-5 py-2.5 rounded-full text-sm font-medium flex items-center gap-2 shadow-lg">
            <i class="bi bi-shield-plus text-secondary"></i> Seg. y Salud en el Trabajo
          </a>
        </div>
      </div>

    </div>
  </main>
@endsection

@push('scripts')
<script>
  // ==================== SLIDER MEJORADO ====================
  let currentSlide = 0;
  let slideInterval = null;
  const slides = document.querySelectorAll('.bento-slider .slide');
  const totalSlides = slides.length;
  let isAutoPlaying = true;

  // ==================== FUNCIONES DEL SLIDER ====================
  function startAutoPlay() {
    if (slideInterval) {
      clearTimeout(slideInterval);
      slideInterval = null;
    }

    const activeSlide = slides[currentSlide];
    if (!activeSlide) return;

    const activeVideo = activeSlide.querySelector('video');
    let duration = 5000;

    if (activeVideo) {
      if (activeVideo.duration && !isNaN(activeVideo.duration) && activeVideo.duration > 0) {
        duration = activeVideo.duration * 1000;
      } else {
        activeVideo.addEventListener('loadedmetadata', function() {
          if (this.duration && !isNaN(this.duration) && this.duration > 0) {
            duration = this.duration * 1000;
            clearTimeout(slideInterval);
            slideInterval = setTimeout(() => {
              nextSlide();
            }, duration);
          }
        });
        duration = 8000;
      }
    }

    slideInterval = setTimeout(() => {
      nextSlide();
    }, duration);
  }

  function updateSlide(index) {
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;
    
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      if (i === index) {
        slide.classList.add('active');
      }
    });

    const activeSlide = slides[index];
    if (activeSlide) {
      const title = activeSlide.getAttribute('data-title') || 'Sin título';
      const desc = activeSlide.getAttribute('data-desc') || 'Sin descripción';
      
      const titleEl = document.getElementById('slideTitle');
      const descEl = document.getElementById('slideDesc');
      
      if (titleEl && descEl) {
        titleEl.style.opacity = '0';
        descEl.style.opacity = '0';
        
        setTimeout(() => {
          titleEl.textContent = title;
          descEl.textContent = desc;
          titleEl.style.opacity = '1';
          descEl.style.opacity = '1';
        }, 300);
      }
    }

    document.querySelectorAll('.slide-indicator').forEach((indicator, i) => {
      indicator.classList.toggle('active', i === index);
    });

    slides.forEach((slide, i) => {
      const video = slide.querySelector('video');
      if (video) {
        if (i === index) {
          const playPromise = video.play();
          if (playPromise !== undefined) {
            playPromise.catch(error => {
              console.log('Error al reproducir video:', error);
              setTimeout(() => {
                video.play().catch(() => {});
              }, 500);
            });
          }
          
          const loadingId = video.id.replace('video', '');
          const loading = document.getElementById('loading' + loadingId);
          if (loading) {
            setTimeout(() => {
              loading.classList.add('hidden');
            }, 500);
          }
        } else {
          video.pause();
        }
      }
    });

    currentSlide = index;
  }

  function nextSlide() {
    if (totalSlides === 0) return;
    updateSlide((currentSlide + 1) % totalSlides);
    resetAutoPlay();
  }

  function prevSlide() {
    if (totalSlides === 0) return;
    updateSlide((currentSlide - 1 + totalSlides) % totalSlides);
    resetAutoPlay();
  }

  function goToSlide(index) {
    if (index >= 0 && index < totalSlides) {
      updateSlide(index);
      resetAutoPlay();
    }
  }

  function toggleSound(videoId, button) {
    const video = document.getElementById(videoId);
    if (!video) return;
    
    video.muted = !video.muted;
    
    const icon = button.querySelector('i');
    if (!icon) return;
    
    if (video.muted) {
      icon.className = 'bi bi-volume-mute';
      button.classList.remove('unmuted');
      button.classList.add('pulsing');
      button.style.background = 'rgba(220, 38, 38, 0.9)';
      button.style.boxShadow = '0 4px 20px rgba(220, 38, 38, 0.5)';
    } else {
      icon.className = 'bi bi-volume-up';
      button.classList.add('unmuted');
      button.classList.remove('pulsing');
      button.style.background = 'rgba(34, 197, 94, 0.9)';
      button.style.boxShadow = '0 4px 20px rgba(34, 197, 94, 0.5)';
      
      if (video.paused) {
        video.play().catch(() => {});
      }
    }
    
    // Ocultar el hint
    const slide = button.closest('.slide');
    if (slide) {
      const hint = slide.querySelector('.video-click-hint');
      if (hint) {
        hint.style.opacity = '0';
        hint.style.pointerEvents = 'none';
      }
    }
  }

  function resetAutoPlay() {
    if (slideInterval) {
      clearTimeout(slideInterval);
      slideInterval = null;
    }
    if (isAutoPlaying && totalSlides > 1) {
      startAutoPlay();
    }
  }

  // ==================== INICIALIZACIÓN ====================
  document.addEventListener('DOMContentLoaded', function() {
    if (totalSlides > 0) {
      setTimeout(() => {
        updateSlide(0);
        
        const firstVideo = document.querySelector('.bento-slider .slide.active video');
        if (firstVideo) {
          firstVideo.play().catch(e => console.log('Initial play error:', e));
          const loading = document.getElementById('loading0');
          if (loading) {
            setTimeout(() => {
              loading.classList.add('hidden');
            }, 1000);
          }
        }
      }, 500);
      
      if (totalSlides > 1) {
        setTimeout(() => {
          startAutoPlay();
        }, 1500);
      }

      const slider = document.querySelector('.bento-slider');
      if (slider) {
        slider.addEventListener('mouseenter', () => {
          if (slideInterval) {
            clearTimeout(slideInterval);
            slideInterval = null;
          }
        });
        
        slider.addEventListener('mouseleave', () => {
          if (isAutoPlaying && totalSlides > 1) {
            startAutoPlay();
          }
        });
      }
    }
  });

  // ==================== TABS ====================
  function openTab(evt, tabId) {
    const tabContents = document.getElementsByClassName("tab-content");
    for (let i = 0; i < tabContents.length; i++) {
      tabContents[i].classList.remove("active");
    }
    
    const tabBtns = document.getElementsByClassName("tab-btn");
    for (let i = 0; i < tabBtns.length; i++) {
      tabBtns[i].classList.remove("active");
    }
    
    document.getElementById(tabId).classList.add("active");
    evt.currentTarget.classList.add("active");
  }

  // ==================== COUNTER ANIMATION ====================
  const animateCount = (el) => {
    const target = parseFloat(el.getAttribute('data-count'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        el.textContent = target + (target % 1 !== 0 ? '' : '+');
        clearInterval(timer);
      } else {
        el.textContent = current.toFixed(target % 1 !== 0 ? 1 : 0);
      }
    }, 16);
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCount(entry.target);
        observer.unobserve(entry.target);
      }
    });
  });
  
  document.querySelectorAll('[data-count]').forEach(el => observer.observe(el));
</script>
@endpush