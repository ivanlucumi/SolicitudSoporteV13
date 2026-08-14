@extends('layouts.ensayo')

@section('title', 'Conversor & Limpiador de Texto')

@push('style')
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

    <!-- Se eliminó el CDN de Bootstrap 5 porque rompía el navbar/layout global de Bootstrap 3 -->
    <!-- Font Awesome 6 (Requerido para los nuevos iconos) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.3);
            --glass-border: rgba(255, 255, 255, 0.5);
            --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            --glass-blur: blur(16px);
            --primary-gradient: linear-gradient(135deg, #4b5563 0%, #1f2937 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --text-primary: #1a1a2e;
            --text-secondary: #2d2d44;
            --text-muted: #4a4a6a;
            --text-white: #ffffff;
        }

        /* --- UTILIDADES TIPO BOOTSTRAP 5 (Para no depender del CDN global que rompe BS3) --- */
        .text-tool-wrapper .d-flex { display: flex !important; }
        .text-tool-wrapper .align-items-center { align-items: center !important; }
        .text-tool-wrapper .flex-wrap { flex-wrap: wrap !important; }
        .text-tool-wrapper .text-end { text-align: right !important; }
        .text-tool-wrapper .mt-2 { margin-top: 0.5rem !important; }
        .text-tool-wrapper .mt-3 { margin-top: 1rem !important; }
        .text-tool-wrapper .mt-4 { margin-top: 1.5rem !important; }
        .text-tool-wrapper .mb-4 { margin-bottom: 1.5rem !important; }
        .text-tool-wrapper .me-1 { margin-right: 0.25rem !important; }
        .text-tool-wrapper .me-2 { margin-right: 0.5rem !important; }
        .text-tool-wrapper .ms-3 { margin-left: 1rem !important; }
        .text-tool-wrapper .g-4 { gap: 1.5rem !important; }
        .text-tool-wrapper .form-check { display: flex; align-items: center; }
        .text-tool-wrapper .form-control { display: block; width: 100%; }
        /* --------------------------------------------------------------------------------- */

        /* Fondo decorativo confinado a la vista */
        .text-tool-wrapper {
            background: linear-gradient(135deg, #f0f2f5 0%, #e0e4e8 100%);
            min-height: calc(100vh - 100px);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 20px;
            padding-bottom: 60px; /* Espacio para el footer fijo */
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            margin-top: 20px;
        }

        .text-tool-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(200, 205, 215, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(190, 195, 205, 0.3) 0%, transparent 50%);
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        .main-container {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--glass-shadow);
            padding: 2.5rem;
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .main-container:hover {
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.3);
        }

        .tool-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .tool-title {
            font-size: 2.2rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .tool-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
            opacity: 0.8;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(31, 38, 135, 0.15);
        }

        .instructions {
            background: rgba(102, 126, 234, 0.15);
            backdrop-filter: blur(8px);
            border-left: 4px solid #38ef7d;
            padding: 1rem 1.2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 500;
        }

        .instructions strong {
            color: #2d2d44;
        }

        /* Área de checkboxes mejorada */
        .options-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .checkbox-wrapper {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .checkbox-wrapper:hover {
            background: rgba(255, 255, 255, 0.45);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 38, 135, 0.1);
        }

        .checkbox-wrapper .form-check-input {
            margin-right: 0.5rem;
            cursor: pointer;
            border-color: rgba(102, 126, 234, 0.5);
        }

        .checkbox-wrapper .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .checkbox-wrapper .form-check-label {
            cursor: pointer;
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 600;
            user-select: none;
        }

        .checkbox-wrapper .form-check-label i {
            color: #667eea;
        }

        .exceptions-label {
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .exceptions-label i {
            color: #667eea;
        }

        /* Estilos para textareas */
        .glass-textarea {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            color: var(--text-primary);
            padding: 1rem;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            resize: vertical;
            font-weight: 500;
        }

        .glass-textarea:focus {
            background: rgba(255, 255, 255, 0.6);
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.2);
            outline: none;
            color: var(--text-primary);
        }

        .glass-textarea::placeholder {
            color: rgba(45, 45, 68, 0.5);
            font-weight: 400;
        }

        .output-area {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            padding: 1rem;
            min-height: 200px;
            max-height: 400px;
            overflow-y: auto;
            color: var(--text-primary);
            font-family: 'Courier New', monospace;
            font-size: 1.3rem;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-weight: 500;
            line-height: 1.6;
        }

        .section-label {
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .section-label i {
            color: #667eea;
        }

        /* Contadores de caracteres */
        .char-count {
            color: var(--text-muted);
            font-size: 1.3rem;
            font-weight: 500;
        }

        /* Botones con estilo cristal */
        .btn-glass {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            color: var(--text-primary);
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            transition: all 0.3s ease;
            margin: 0.3rem;
            letter-spacing: 0.3px;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: var(--text-primary);
        }

        .btn-glass.btn-copy {
            background: var(--success-gradient);
            border: none;
            color: white;
            font-weight: 700;
        }

        .btn-glass.btn-copy:hover {
            background: linear-gradient(135deg, #0f7a71 0%, #2dd46d 100%);
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.4);
            transform: translateY(-2px);
            color: white;
        }

        .btn-file {
            background: rgba(255, 255, 255, 0.3);
            border: 2px dashed rgba(102, 126, 234, 0.5);
            color: var(--text-primary);
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .btn-file:hover {
            background: rgba(255, 255, 255, 0.5);
            border-color: #667eea;
            color: #667eea;
        }

        .btn-file i {
            color: #667eea;
            transition: all 0.3s ease;
        }

        .file-name {
            color: var(--text-muted);
            font-size: 1.3rem;
            font-weight: 500;
        }

        .stats-bar {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            margin: 1.5rem 0;
        }

        .stat-item {
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 600;
        }

        .stat-item i {
            color: #667eea;
        }

        .stat-val {
            font-weight: 800;
            color: #11998e;
            font-size: 1.3rem;
        }

        .footer-text {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            padding: 12px 0;
            z-index: 1050;
            color: var(--text-muted);
            font-size: 1.3rem;
            text-align: center;
            font-weight: 500;
            margin: 0;
        }

        .footer-text i {
            color: #38ef7d;
        }

        /* Scrollbar personalizado */
        .output-area::-webkit-scrollbar {
            width: 8px;
        }

        .output-area::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .output-area::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.4);
            border-radius: 4px;
        }

        .output-area::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.6);
        }

        /* Placeholder para el área de output vacía */
        .output-area:empty::before {
            content: 'El texto normalizado aparecerá aquí...';
            color: rgba(45, 45, 68, 0.4);
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 1.5rem;
                border-radius: 18px;
            }
            
            .tool-title {
                font-size: 2rem;
            }
            
            .options-container {
                grid-template-columns: 1fr 1fr;
                gap: 0.5rem;
            }
            
            .checkbox-wrapper {
                padding: 0.6rem 0.8rem;
            }
            
            .checkbox-wrapper .form-check-label {
                font-size: 1.3rem;
            }
            
            .stats-bar {
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 1rem;
                margin: 1rem;
            }
            
            .tool-title {
                font-size: 1.5rem;
            }
            
            .options-container {
                grid-template-columns: 1fr;
            }
            
            .stats-bar {
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
            }
            
            .stat-item {
                font-size: 1.3rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="text-tool-wrapper">
    <div class="main-container">
        <!-- Encabezado -->
        <div class="tool-header">
            <h1 class="tool-title">
                 Conversor & Limpiador de Texto
            </h1>
        </div>

        <!-- Instrucciones -->
        <div class="instructions">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Instrucciones:</strong> Pega tu texto o carga un archivo. El sistema normalizará tildes, signos y espacios de forma segura en tu navegador.
        </div>

        <!-- Opciones principales -->
        <div class="glass-card">
            <label class="exceptions-label">
                <i class="fas fa-sliders-h me-2"></i>Opciones de formato
            </label>
            <div class="options-container">
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-uppercase">
                        <label class="form-check-label" for="opt-uppercase">
                            <i class="fas fa-font me-1"></i> MAYÚSCULAS
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-live" checked>
                        <label class="form-check-label" for="opt-live">
                            <i class="fas fa-bolt me-1"></i> En vivo
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-keep-hyphen">
                        <label class="form-check-label" for="opt-keep-hyphen">
                            <i class="fas fa-minus me-1"></i> Guiones (-)
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-collapse" checked>
                        <label class="form-check-label" for="opt-collapse">
                            <i class="fas fa-compress-arrows-alt me-1"></i> Sin espacios dobles
                        </label>
                    </div>
                </div>
            </div>

            <!-- Excepciones Español -->
            <label class="exceptions-label mt-3">
                <i class="fas fa-language me-2"></i>Excepciones Español
            </label>
            <div class="options-container">
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-keep-enie">
                        <label class="form-check-label" for="opt-keep-enie">
                            <i class="fas fa-n me-1"></i> Dejar Ñ
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-keep-tildes">
                        <label class="form-check-label" for="opt-keep-tildes">
                            <i class="fas fa-i me-1"></i> Dejar Tildes
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-keep-questions">
                        <label class="form-check-label" for="opt-keep-questions">
                            <i class="fas fa-question me-1"></i> Dejar ¿ ¡ ? !
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="opt-keep-acronyms" checked>
                        <label class="form-check-label" for="opt-keep-acronyms">
                            <i class="fas fa-building me-1"></i> Conservar siglas
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Área de carga de archivos -->
        <div class="d-flex align-items-center mb-4 flex-wrap">
            <label class="btn-file" for="file-input">
                <i class="fas fa-cloud-upload-alt me-2"></i>
                Cargar Word (.docx) o TXT
                <input type="file" id="file-input" accept=".docx, .txt, text/plain, application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="display: none;">
            </label>
            <span id="file-name" class="file-name ms-3 mt-2 mt-md-0">Ningún archivo seleccionado</span>
        </div>

        <!-- Áreas de texto -->
        <div class="row g-4">
            <div class="col-md-6">
                <label class="section-label">
                    <i class="fas fa-pen me-2"></i>Texto Original
                </label>
                <textarea id="input" class="glass-textarea form-control" rows="12" placeholder="Pega aquí tu texto..."></textarea>
                <div class="text-end mt-2">
                    <small class="char-count">
                        <span id="count-in">0</span> caracteres
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <label class="section-label">
                    <i class="fas fa-check-circle me-2"></i>Texto Normalizado
                </label>
                <div id="output" class="output-area"></div>
                <div class="text-end mt-2">
                    <small class="char-count">
                        <span id="count-out">0</span> caracteres
                    </small>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="stats-bar">
            <div class="stat-item">
                <i class="fas fa-remove-format me-1"></i> Tildes removidas: <span id="stat-tildes" class="stat-val">0</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-quote-right me-1"></i> Signos removidos: <span id="stat-signos" class="stat-val">0</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-compress me-1"></i> Espacios dobles quitados: <span id="stat-espacios" class="stat-val">0</span>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="text-center mt-4">
            <button id="btn-copy" class="btn btn-glass btn-copy">
                <i class="fas fa-copy me-2"></i> Copiar Resultado
            </button>
        </div>

        <!-- Footer -->
        <div class="footer-text">
            <i class="fas fa-shield-alt me-1"></i>
            Seguridad local: Los archivos y textos no abandonan tu navegador.
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- Mammoth JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.8.0/mammoth.browser.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const CHAR_MAP = {
            'á':'a','é':'e','í':'i','ó':'o','ú':'u','Á':'A','É':'E','Í':'I','Ó':'O','Ú':'U',
            'ñ':'n','Ñ':'N','ü':'u','Ü':'U','à':'a','è':'e','ì':'i','ò':'o','ù':'u',
            'À':'A','È':'E','Ì':'I','Ò':'O','Ù':'U','ä':'a','ë':'e','ï':'i','ö':'o',
            'Ä':'A','Ë':'E','Ï':'I','Ö':'O','â':'a','ê':'e','î':'i','ô':'o','û':'u',
            'Â':'A','Ê':'E','Î':'I','Ô':'O','Û':'U'
        };
        const ACCENTS_REGEX = /[áéíóúÁÉÍÓÚñÑüÜàèìòùÀÈÌÒÙäëïöÄËÏÖâêîôûÂÊÎÔÛ]/g;
        const ACRONYMS = [
            'DIAN','SENA','SIRIS','PDF','URL','ID','QR','API','JSON','XML',
            'HTML','CSS','JS','PHP','SQL','CPU','RAM','USB','GPS','HTTP',
            'HTTPS','FTP','SMTP','POP3','IMAP','LAN','WAN','VPN','NIT','RUT',
            'EPS','IPS','DANE','SIC','RAMA JUDICIAL','CSJ','DISAJ','ONU','UNESCO','UNICEF'
        ];
        const PUNCT_REGEX = /[¡!¿?"'“”‘’«»()[\]{}\/\\|@#$%^&*_+=<>~`\-°]/g;

        const input = document.getElementById('input');
        const output = document.getElementById('output');
        
        // Helper para obtener valores de checkbox
        const isChecked = (id) => document.getElementById(id)?.checked || false;

        // 1. Normalizar acentos y tildes
        function normalizeAccents(text, stats) {
            return text.replace(ACCENTS_REGEX, (char) => {
                if (isChecked('opt-keep-enie') && (char === 'ñ' || char === 'Ñ')) return char;
                if (isChecked('opt-keep-tildes') && 'áéíóúÁÉÍÓÚ'.includes(char)) return char;
                stats.tildesRemoved++;
                return CHAR_MAP[char] || char;
            });
        }

        // 2. Remover signos de puntuación
        function removePunctuation(text, stats) {
            return text.replace(PUNCT_REGEX, (char) => {
                if (char === '-' && isChecked('opt-keep-hyphen')) return '-';
                if (isChecked('opt-keep-questions') && (char === '¿' || char === '¡' || char === '?' || char === '!')) return char;
                stats.signsRemoved++;
                return '';
            });
        }

        // 3. Normalizar espacios
        function normalizeSpaces(text, stats) {
            if (isChecked('opt-collapse')) {
                const before = text.length;
                text = text.replace(/[^\S\r\n]+/g, ' ');
                text = text.replace(/\s+([.,;:!?])/g, '$1');
                stats.spacesRemoved += Math.max(0, before - text.length);
            }
            return text.trim();
        }

        // 4. Formato tipo oración
        function sentenceCase(text) {
            text = text.toLowerCase();
            text = text.replace(/(^\s*|[.!?\n]\s*[¿¡]*\s*)([\p{L}])/gu, function(match, p1, p2) {
                return p1 + p2.toUpperCase();
            });
            return text;
        }

        // 5. Conservar siglas
        function preserveAcronyms(text) {
            if (!isChecked('opt-keep-acronyms')) return text;
            
            ACRONYMS.forEach(acronym => {
                const regex = new RegExp(`\\b${acronym}\\b`, 'gi');
                text = text.replace(regex, acronym.toUpperCase());
            });
            return text;
        }

        // 6. Función principal
        function render() {
            const rawText = input.value;
            let stats = { tildesRemoved: 0, signsRemoved: 0, spacesRemoved: 0 };
            
            let text = rawText;
            
            text = normalizeAccents(text, stats);
            text = removePunctuation(text, stats);
            text = normalizeSpaces(text, stats);
            
            const mantenerMayusculas = isChecked('opt-uppercase');
            
            if (mantenerMayusculas) {
                text = text.toUpperCase();
            } else {
                text = sentenceCase(text);
                text = preserveAcronyms(text);
            }

            output.textContent = text;
            
            // Actualizar estadísticas
            document.getElementById('count-in').textContent = rawText.length;
            document.getElementById('count-out').textContent = text.length;
            document.getElementById('stat-tildes').textContent = stats.tildesRemoved;
            document.getElementById('stat-signos').textContent = stats.signsRemoved;
            document.getElementById('stat-espacios').textContent = stats.spacesRemoved;
        }

        let debounceTimer;
        input.addEventListener('input', function() {
            if (isChecked('opt-live')) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(render, 150);
            }
        });

        // Listeners para checkboxes
        document.querySelectorAll('.form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', render);
        });

        // Manejo de archivos
        document.getElementById('file-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            document.getElementById('file-name').textContent = file.name;
            
            if (file.name.endsWith('.docx')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    mammoth.extractRawText({ arrayBuffer: event.target.result })
                        .then(function(result) {
                            input.value = result.value;
                            render();
                        }).catch(function(err) {
                            alert("Error al procesar el archivo Word. Es posible que esté dañado o el formato no sea compatible.");
                        });
                };
                reader.readAsArrayBuffer(file);
            } else {
                const reader = new FileReader();
                reader.onload = function(event) {
                    input.value = event.target.result;
                    render();
                };
                reader.readAsText(file);
            }
        });

        // Botón copiar
        document.getElementById('btn-copy').addEventListener('click', function() {
            const text = output.textContent;
            if (!text) return;
            
            navigator.clipboard.writeText(text).then(() => {
                const btn = this;
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check me-2"></i> ¡Copiado!';
                
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            }).catch(() => {
                alert("Tu navegador bloqueó el copiado automático. Por favor, selecciona y copia manualmente.");
            });
        });

        // Render inicial
        render();
    });
    </script>
@endpush