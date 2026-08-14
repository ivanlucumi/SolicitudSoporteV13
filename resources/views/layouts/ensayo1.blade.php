<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio telefonico disajcali"/>
  <meta name="description" content="SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio telefonico disajcali, despachos cali, juzgado cali, ramajudcial cali">
  <meta name="author" content="grupo soporte tecnologico de cali valle del cauca">

  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('img/icono.png') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- AOS Animations -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Bootstrap 3 (ya existente) -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.css') }}">
  @stack('style')

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#003f75',
            'primary-dark': '#002147',
            'primary-light': '#0056a3',
            secondary: '#00a651',
            accent: '#e8a020',
            bg: '#f4f6f9',
            surface: '#ffffff',
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    /* =============================================
       BASE
    ============================================= */
    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: 'Inter', 'Segoe UI', Roboto, Arial, sans-serif;
      background: #e2e8f0;
      background-image:
        radial-gradient(at 0% 0%,   rgba(0, 63, 117, 0.10) 0px, transparent 50%),
        radial-gradient(at 100% 0%,  rgba(232,160, 32, 0.08) 0px, transparent 50%),
        radial-gradient(at 100% 100%,rgba(0, 166, 81, 0.05) 0px, transparent 50%);
      background-attachment: fixed;
      color: #1e293b;
      font-size: 16px;
      line-height: 1.6;
      overflow-x: hidden;
      scroll-behavior: smooth;
    }

    h1, h2, h3, h4, h5 {
      font-family: 'Inter', sans-serif;
      letter-spacing: -0.02em;
      font-weight: 600;
    }

    :root {
      --primary: #003f75;
      --accent:  #e8a020;
    }

    /* =============================================
       SCROLLBAR
    ============================================= */
    ::-webkit-scrollbar       { width: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* =============================================
       GLASS UTILITIES
    ============================================= */
    .glass {
      background: rgba(255,255,255,0.75);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255,255,255,0.4);
      box-shadow: 0 4px 30px rgba(0,0,0,0.05);
    }
    .glass-dark {
      background: rgba(0,33,71,0.85);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255,255,255,0.1);
      box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    }
    .glass-card {
      background: rgba(255,255,255,0.6);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.5);
      transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .glass-card:hover {
      transform: translateY(-4px) scale(1.01);
      background: rgba(255,255,255,0.9);
      box-shadow: 0 12px 40px rgba(0,63,117,0.12);
      border-color: rgba(0,63,117,0.2);
    }

    /* =============================================
       NAVBAR FLOTANTE
    ============================================= */
    .floating-nav {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      width: calc(100% - 20px);
      max-width: 1400px;
      z-index: 1050;
      padding: 10px 16px;
      border-radius: 16px;
      transition: all .3s ease;
    }

    .floating-nav.scrolled {
      top: 0;
      width: 100%;
      max-width: 100%;
      border-radius: 0;
      padding: 8px 16px;
    }

    /* El contenedor directo necesita position:relative
       para que el menú absoluto se posicione bien */
    .floating-nav > div {
      position: relative;
    }

    /* =============================================
       BRAND LINK
    ============================================= */
    .brand-link {
      font-family: 'Inter', 'Segoe UI', Roboto, Arial, sans-serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: -0.01em;
      color: #002147;
      display: flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
      transition: all .25s ease;
      padding: 8px 12px;
      border-radius: 10px;
      white-space: nowrap;
    }
    .brand-link:hover,
    .brand-link:focus {
      color: var(--primary);
      background: rgba(0,63,117,0.07);
      transform: translateX(2px);
    }
    .brand-link i { font-size: 16px; }

    /* =============================================
       BOTÓN HAMBURGUESA  (siempre oculto en desktop)
    ============================================= */
    .nav-toggle {
      display: none;
      background: rgba(0,63,117,0.07);
      border: none;
      border-radius: 8px;
      width: 38px;
      height: 38px;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: var(--primary);
      font-size: 22px;
      transition: background .2s;
      flex-shrink: 0;
    }
    .nav-toggle:hover { background: rgba(0,63,117,0.15); }

    /* =============================================
       NAV LINKS — DESKTOP (≥ 992 px)
    ============================================= */
    @media (min-width: 992px) {
      .nav-toggle { display: none !important; }

      .nav-links {
        display: flex !important;   /* siempre visible en desktop */
        position: static;
        flex-direction: row;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.25rem;
        padding: 0;
        background: transparent;
        border: none;
        box-shadow: none;
        border-radius: 0;
        animation: none;
      }
    }

    /* =============================================
       NAV LINKS — MÓVIL / TABLET (≤ 991 px)
    ============================================= */
    @media (max-width: 991px) {
      .floating-nav {
        padding: 8px 12px;
        width: calc(100% - 10px);
      }

      /* Mostrar botón hamburguesa */
      .nav-toggle {
        display: inline-flex;
      }

      /* Menú cerrado por defecto */
      .nav-links {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        right: 0;
        flex-direction: column;
        align-items: stretch;
        gap: 2px;
        padding: 10px;
        background: rgba(255,255,255,0.98);
        border-radius: 16px;
        box-shadow: 0 14px 34px rgba(0,0,0,0.14);
        border: 1px solid rgba(255,255,255,0.6);
        z-index: 999;
        animation: navDropIn .18s ease forwards;
      }

      /* Menú abierto */
      .nav-links.is-open {
        display: flex;
      }

      /* En móvil los brand-links ocupan el ancho completo */
      .nav-links .brand-link {
        width: 100%;
        font-size: 14px;
        padding: 10px 14px;
      }
    }

    @keyframes navDropIn {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* =============================================
       TEXTO HERO / SECCIONES
    ============================================= */
    .legal-hero h1 {
      margin: 0;
      font-weight: 700;
      font-size: clamp(24px, 2.5vw, 38px);
      letter-spacing: -0.03em;
    }
    .legal-hero p {
      margin-top: 10px;
      opacity: .9;
      font-size: clamp(14px, 1.2vw, 16px);
    }
    .section-title {
      margin: 0;
      color: #1f2d3d;
      font-weight: 600;
      font-size: clamp(16px, 1.5vw, 20px);
      letter-spacing: -0.01em;
    }
    .text-legal {
      text-align: justify;
      line-height: 1.8;
      color: #4a5568;
      font-size: clamp(14px, 1.1vw, 16px);
      font-weight: 400;
    }

    /* =============================================
       MAIN — desplazamiento bajo el navbar fijo
    ============================================= */
    main { padding-top: 96px; }

    @media (max-width: 480px) {
      main         { padding-top: 86px; }
      .logo-rama   { height: 30px; }
    }

    /* =============================================
       LOGO
    ============================================= */
    .logo-rama {
      height: 70px;
      width: auto;
      object-fit: contain;
    }
    @media (max-width: 768px) { .logo-rama { height: 50px; } }
    @media (max-width: 480px) { .logo-rama { height: 30px; } }

    /* =============================================
       TEXTO INSTITUCIONAL — responsive
    ============================================= */
    .brand-text-wrap {
      min-width: 0;
      flex-shrink: 1;
    }
    .brand-text-inst {
      margin: 0;
      line-height: 1.45;
      color: #475569;
      /* clamp(mínimo, fluido, máximo) */
      font-size: clamp(7px, 1.4vw, 12px);
    }

    /* En pantallas muy pequeñas ocultamos la frase larga para ganar espacio */
    @media (max-width: 400px) {
      .brand-text-inst .italic { display: none; }
    }

    /* Bootstrap 3 compat */
    .container-fluid { padding-right: 0; padding-left: 0; }

    .wave-btn{
    position: relative;
    overflow: hidden;

    display: flex;
    align-items: center;
    gap: 8px;

    padding: 12px 18px;
    border-radius: 14px;

    background: #002147;
    color: #fff !important;

    font-weight: 600;
    text-decoration: none;

    transition: all .35s ease;
    z-index: 1;
}

/* Ola brillante */
.wave-btn::before{
    content: '';
    position: absolute;

    top: 0;
    left: -120%;

    width: 80%;
    height: 100%;

    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,.15),
        rgba(255,255,255,.45),
        rgba(255,255,255,.15),
        transparent
    );

    transform: skewX(-25deg);
    transition: all .8s ease;

    z-index: -1;
}

/* Hover */
.wave-btn:hover{
    color: #fff !important;
    background: #002147;

    transform: translateY(-4px);

    box-shadow:
        0 8px 20px rgba(0,33,71,.35),
        0 0 20px rgba(0,63,117,.30);

    border-color: rgba(255,255,255,.2);
}

/* Movimiento de la ola */
.wave-btn:hover::before{
    left: 130%;
}

/* Click */
.wave-btn:active{
    transform: translateY(-1px);
}

.wave-btn:hover{
    animation: pulseBlue 1.5s infinite;
}

@keyframes pulseBlue{
    0%{
        box-shadow:
        0 8px 20px rgba(0,33,71,.35),
        0 0 0 rgba(0,63,117,.5);
    }

    50%{
        box-shadow:
        0 10px 25px rgba(0,33,71,.45),
        0 0 20px rgba(0,63,117,.7);
    }

    100%{
        box-shadow:
        0 8px 20px rgba(0,33,71,.35),
        0 0 0 rgba(0,63,117,.5);
    }
}
  </style>
</head>

<body class="antialiased selection:bg-primary selection:text-white flex flex-col min-h-screen">

  @unless(request()->routeIs('indexBienestar'))
  <!-- ===== NAVBAR FLOTANTE ===== -->
  <header id="navbar" class="floating-nav glass">

    <div class="flex items-center justify-between gap-3">

      <!-- Logo + texto institucional -->
      <div class="flex items-center gap-3 min-w-0">
        <a href="{!! url('/') !!}"                              class="brand-link">
        <img src="/Logo/LogoRama.png" alt="LogoRama" class="logo-rama shrink-0">
        </a>
        <div class="brand-text-wrap leading-tight min-w-0">          
          <p class="brand-text-inst font-bold text-slate-600 text-center">
            Consejo Superior de la Judicatura<br>
            Dirección Seccional de Administración Judicial<br>
            Cali - Valle del Cauca<br>
            <span class="italic">"Fortaleciendo la justicia, promoviendo el bienestar de todos"</span>
          </p>
          
        </div>
      </div>

      <!-- Links de navegación -->
      <nav id="navLinks" class="nav-links text-sm font-medium" aria-label="Menú principal">

    <a href="{!! url('/') !!}" class="brand-link wave-btn">
        <i class="bi bi-house-door"></i>
    </a>

    <a href="{!! url('/directorio') !!}" class="brand-link wave-btn">
        <i class="bi bi-telephone"></i> Directorio
    </a>

    <a href="{!! url('/comite_genero') !!}" class="brand-link wave-btn">
        <i class="bi bi-people"></i> Comité de Género
    </a>

    <a href="{!! url('/seguridad_y_salud_en_el_trabajo') !!}" class="brand-link wave-btn">
        <i class="bi bi-shield-check"></i> Seguridad y Salud
    </a>

    <!-- MENÚ SERVICIOS (CSS Dropdown puro para que no falle con JS) -->
    <div class="relative group">
        <button class="brand-link wave-btn flex items-center gap-1 cursor-pointer w-full text-left">
            <i class="bi bi-grid-fill"></i> Servicios <i class="bi bi-chevron-down text-[10px] transition-transform group-hover:rotate-180"></i>
        </button>
        <!-- Menú Desplegable -->
        <div class="absolute left-0 top-full mt-2 w-56 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-slate-100 overflow-hidden lg:left-1/2 lg:-translate-x-1/2">
            <a href="{!! route('certificacion.form') !!}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors border-b border-slate-50 last:border-0 flex items-center gap-2">
                <i class="bi bi-person-badge text-primary"></i> Certificación R.H.
            </a>
            <a href="{!! route('acortador.url') !!}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors border-b border-slate-50 last:border-0 flex items-center gap-2">
                <i class="bi bi-link-45deg text-primary"></i> Acortador URL
            </a>
            <a href="{!! route('sirisqrcode.form') !!}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors border-b border-slate-50 last:border-0 flex items-center gap-2">
                <i class="bi bi-qr-code-scan text-primary"></i> Generador QR
            </a>
            <a href="{!! route('numeros.aleatorios') !!}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors border-b border-slate-50 last:border-0 flex items-center gap-2">
                <i class="bi bi-dice-5 text-primary"></i> Sorteos
            </a>
            <a href="{!! route('correccion.texto') !!}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors border-b border-slate-50 last:border-0 flex items-center gap-2">
                <i class="bi bi-spellcheck text-primary"></i> Normalizador Texto
            </a>
            <a href="{{ url('/ventanilla/digital') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors flex items-center gap-2">
                <i class="bi bi-inbox text-primary"></i> Ventanilla Digital
            </a>
        </div>
    </div>

    @if(isset($ip))
        @php $ipPrefix = implode('.', array_slice(explode('.', $ip), 0, 3)); @endphp
        @if($ipPrefix == "190.217.19" || $ipPrefix == "190.217.24")
            <a href="{!! url('/clasificados') !!}" class="brand-link wave-btn">
                <i class="bi bi-shop"></i> Clasificados
            </a>
        @endif
    @endif

</nav>

      <!-- Acciones globales -->
      <div class="flex items-center gap-2 shrink-0">
        <div class="hidden lg:flex flex-col text-right">
          <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Hoy</span>
          <span class="text-xs text-primary font-semibold" id="currentDate"></span>
        </div>
        <a href="{!! url('/login') !!}"
           class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-full text-sm font-semibold
                  shadow-lg shadow-primary/30 transition-all transform hover:-translate-y-0.5
                  flex items-center gap-2 whitespace-nowrap wave-btn">
          <i class="bi bi-person-circle"></i>
          <span class="hidden sm:inline">SIRIS</span>
        </a>

        <!-- Botón hamburguesa — solo en móvil/tablet -->
        <button id="menuBtn"
                class="nav-toggle"
                type="button"
                aria-label="Abrir menú"
                aria-expanded="false"
                aria-controls="navLinks">
          <i class="bi bi-list" id="menuIcon"></i>
        </button>
      </div>

    </div>
  </header>
  @endunless

  <!-- ===== CONTENIDO PRINCIPAL ===== -->
  <main class="flex-grow pb-28">
    @include('alerts.flash-message')
    @yield('content')
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="fixed bottom-0 left-0 w-full bg-slate-900/95 backdrop-blur-md text-slate-400 py-4 border-t border-slate-800 z-50 shadow-[0_-4px_15px_rgba(0,0,0,0.3)]">
    <div class="container mx-auto px-6">
      <div class="flex flex-col md:flex-row justify-between items-center gap-6">

        <div class="flex items-center gap-4">
          <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Escudo_de_la_Rep%C3%BAblica_de_Colombia.svg"
               alt="Escudo"
               class="h-10 opacity-50 grayscale hover:grayscale-0 transition-all">
          <div>
            <p>&copy; {{ now()->year }}. Todos los derechos reservados.
              <a href="{{ url('/legal') }}" class="hover:text-white">Legal</a>
            </p>
          </div>
        </div>

        <div class="flex gap-4 items-center">
          <div class="text-center">
            <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Hoy</span>
            <span class="text-xs text-primary font-semibold" id="currentDateFooter"></span>
          </div>
          <div class="text-center">
            <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider block">Hoy</span>
            <span class="text-white font-bold">@if(isset($diaria)){{$diaria->visitas}}@else 0 @endif</span>
          </div>
          <div class="text-center">
            <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider block">Total</span>
            <span class="text-accent font-bold">@if(isset($global)){{$global->visitas}}@else 0 @endif</span>
          </div>
          <a href="#" class="hover:text-white transition-colors text-xl"><i class="bi bi-facebook"></i></a>
          <a href="#" class="hover:text-white transition-colors text-xl"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="hover:text-white transition-colors text-xl"><i class="bi bi-youtube"></i></a>
        </div>

      </div>
    </div>
  </footer>

  <!-- ===== JS ===== -->
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
  <script src="/js/adminlte-layout.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  @stack('scripts')

  <script>
    /* =============================================
       RELOJ EN TIEMPO REAL
    ============================================= */
    function actualizarFechaHora() {
      const opts = {
        weekday: 'long', year: 'numeric', month: 'long',
        day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'
      };
      const str = new Date().toLocaleString('es-CO', opts);
      const texto = str.charAt(0).toUpperCase() + str.slice(1);

      const el1 = document.getElementById('currentDate');
      const el2 = document.getElementById('currentDateFooter');
      if (el1) el1.textContent = texto;
      if (el2) el2.textContent = texto;
    }
    actualizarFechaHora();
    setInterval(actualizarFechaHora, 1000);

    /* =============================================
       NAVBAR: SCROLL → clase scrolled
    ============================================= */
    window.addEventListener('scroll', () => {
      document.getElementById('navbar')?.classList.toggle('scrolled', window.scrollY > 50);
    });

    /* =============================================
       MENÚ HAMBURGUESA
    ============================================= */
    (function () {
      const menuBtn  = document.getElementById('menuBtn');
      const navLinks = document.getElementById('navLinks');
      const menuIcon = document.getElementById('menuIcon');

      if (!menuBtn || !navLinks) return;

      function setOpen(open) {
        navLinks.classList.toggle('is-open', open);
        menuBtn.setAttribute('aria-expanded', String(open));
        // Cambia ícono: ☰ ↔ ✕
        if (menuIcon) {
          menuIcon.className = open ? 'bi bi-x-lg' : 'bi bi-list';
        }
      }

      // Clic en el botón
      menuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        setOpen(!navLinks.classList.contains('is-open'));
      });

      // Clic en cualquier enlace del menú → cerrar
      navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => setOpen(false));
      });

      // Clic fuera del menú → cerrar
      document.addEventListener('click', (e) => {
        if (!navLinks.contains(e.target) && !menuBtn.contains(e.target)) {
          setOpen(false);
        }
      });

      // Al ampliar la ventana → cerrar y resetear estado
      window.addEventListener('resize', () => {
        if (window.innerWidth > 991) setOpen(false);
      });
    })();

    /* =============================================
       AOS
    ============================================= */
    AOS.init({ duration: 800, once: true });
  </script>

  <!-- Google Translate -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement(
        { pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE },
        'google_translate_element'
      );
    }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>