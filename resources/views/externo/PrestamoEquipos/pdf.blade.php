@php
  // Intentar obtener la imagen localmente y codificarla en base64 para evitar problemas en producción
  $logoPath = public_path('img/logoLargo.png');
  if (!file_exists($logoPath)) {
      $logoPath = base_path('public_html/img/logoLargo.png');
  }
  if (!file_exists($logoPath)) {
      $logoPath = base_path('public/img/logoLargo.png');
  }
  
  $logoData = '';
  if (file_exists($logoPath)) {
      $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
  } else {
      $logoData = asset('img/logoLargo.png');
  }
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Acta de Entrega Temporal #{{ str_pad($solicitud->id, 4,'0',STR_PAD_LEFT) }}</title>
<style>
  @page { margin: 30px 30px 90px 30px; }
  body { font-family: Arial, sans-serif; font-size: 11px; color: #111; line-height: 1.5; margin: 0; padding: 0; }
  .page { padding: 0px; }
  
  /* Footer */
  footer {
    position: fixed;
    bottom: -70px;
    left: 0px;
    right: 0px;
    height: 75px;
  }
  .footer-table { width: 100%; font-size: 10.5px; color: #777; }
  .footer-table td { vertical-align: middle; }

  /* Encabezado */
  .header { text-align: center; margin-bottom: 18px; }
  .header .logo-line { border-top: 3px solid #0a2a4a; border-bottom: 1px solid #0a2a4a; padding: 6px 0; margin: 4px 0; }
  .header h1 { font-size: 13px; font-weight: bold; text-transform: uppercase; color: #0a2a4a; letter-spacing: 0.5px; }
  .header h2 { font-size: 11px; color: #333; font-weight: normal; }
  .header .radicado { font-size: 10px; color: #555; margin-top: 4px; }

  /* Intro */
  .intro { text-align: justify; margin-bottom: 14px; font-size: 11px; line-height: 1.6; }

  /* Títulos de sección */
  .seccion-titulo {
    background: #0a2a4a;
    color: #fff;
    font-weight: bold;
    font-size: 10.5px;
    padding: 4px 10px;
    margin-bottom: 8px;
    margin-top: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Tabla de datos */
  .tabla-datos { width: 100%; border-collapse: collapse; margin-bottom: 10px; font-size: 10.5px; }
  .tabla-datos td { border: 1px solid #bbb; padding: 5px 8px; vertical-align: top; }
  .tabla-datos td.campo { width: 35%; background: #f1f5f9; font-weight: bold; color: #0a2a4a; }
  .tabla-datos td.valor { width: 65%; }

  /* Tabla de empleados y elementos */
  .tabla-emp { width: 100%; border-collapse: collapse; margin-bottom: 8px; font-size: 10px; }
  .tabla-emp th { background: #0d3b66; color: #fff; padding: 4px 6px; text-align: center; border: 1px solid #0a2a4a; }
  .tabla-emp td { border: 1px solid #bbb; padding: 4px 6px; vertical-align: top; }
  .tabla-emp tr:nth-child(even) td { background: #f8faff; }
  .bloque-empleado { margin-bottom: 14px; }
  .empleado-header { background: #e8f0ff; font-weight: bold; font-size: 10.5px; padding: 4px 8px; border: 1px solid #bbb; border-bottom: none; color: #0a2a4a; }

  /* Compromisos */
  .compromisos { text-align: justify; font-size: 10.5px; line-height: 1.7; }
  .compromisos p { margin-bottom: 8px; }
  .compromisos ol { padding-left: 18px; margin-bottom: 8px; }
  .compromisos li { margin-bottom: 5px; }

  /* Firmas */
  .firmas-tabla { width: 100%; margin-top: 30px; }
  .firmas-tabla td { width: 50%; vertical-align: top; text-align: center; padding: 0 20px; }
  .firma-linea { border-top: 1px solid #000; margin-top: 50px; padding-top: 6px; font-size: 10.5px; }

  /* Utiles */
  .page-break { page-break-after: always; }
  .text-center { text-align: center; }
  .text-muted { color: #666; }
</style>
</head>
<body>
  <footer>
    <table class="footer-table">
      <tr>
        <td style="width: 75%; text-align: left; line-height: 1.4;">
          Palacio de Justicia "Pedro Elías Serrano Abadía" Carrera 10 No. 12-15 Piso 17<br>
          www.ramajudicial.gov.co
        </td>
        <td style="width: 25%; text-align: right;">
          <img src="data:image/png;base64,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" width="140" style="max-width: 140px; height: auto;">
        </td>
      </tr>
    </table>
  </footer>
<div class="page">

  {{-- ========== ENCABEZADO ========== --}}
  <table style="width: 100%; margin-bottom: 15px; border-collapse: collapse;">
    <tr>
      <td style="width: 50%; vertical-align: middle; text-align: left;">
        <img src="{{ $logoData }}" width="240" style="border:0;" alt="Logo Rama Judicial">
      </td>
      <td style="width: 50%; vertical-align: middle; text-align: center; color: #555; line-height: 1.3;">
        <span style="font-size: 14px;">Consejo Superior de la Judicatura</span><br>
        <span style="font-size: 14px;">Dirección Seccional de Administración Judicial</span><br>
        <span style="font-size: 14px;">Cali - Valle del Cauca</span>
      </td>
    </tr>
  </table>

  <div style="text-align: center; margin-bottom: 18px; border-left: 2px solid #000; padding-left: 5px; margin-left: 10px;">
    <h1 style="font-size: 13px; font-weight: bold; text-transform: uppercase; color: #000; margin:0;">ACTA DE ENTREGA TEMPORAL Y COMPROMISO DE CUSTODIA DE ELEMENTOS ENTREGADOS</h1>
  </div>

  <div class="radicado" style="text-align: right; margin-bottom: 12px;">
    Radicado Interno N.° <strong>{{ str_pad($solicitud->id, 4,'0',STR_PAD_LEFT) }}</strong>
    &nbsp;|&nbsp; Generado: {{ $solicitud->created_at->format('d/m/Y H:i') }}
  </div>

  {{-- ========== PÁRRAFO INTRODUCTORIO ========== --}}
  <p class="intro">
    En Santiago de Cali, a los
    <strong>{{ \Carbon\Carbon::parse($solicitud->fecha_acta)->day }}</strong>
    días del mes de
    <strong>{{ \Carbon\Carbon::parse($solicitud->fecha_acta)->locale('es')->translatedFormat('F') }}</strong>
    de <strong>{{ \Carbon\Carbon::parse($solicitud->fecha_acta)->year }}</strong>,
    la Dirección Seccional de Administración Judicial de Cali – Valle del Cauca hace entrega temporal
    al servidor judicial identificado a continuación del equipo de cómputo relacionado en la presente
    acta, para facilitar el cumplimiento de sus funciones institucionales en el marco de las medidas
    excepcionales adoptadas con ocasión del sismo ocurrido el 10 de agosto de 2026.
  </p>

  {{-- ========== SECCIÓN 1: DATOS DEL TITULAR ========== --}}
  <div class="seccion-titulo">1. Datos del Servidor del Titular del Despacho</div>

  <table class="tabla-datos">
    <tr>
      <td class="campo">Nombre</td>
      <td class="valor">{{ strtoupper($solicitud->nombre_juez) }}</td>
    </tr>
    <tr>
      <td class="campo">Cédula</td>
      <td class="valor">{{ $solicitud->cedula_juez }}</td>
    </tr>
    <tr>
      <td class="campo">Cargo</td>
      <td class="valor">{{ $solicitud->cargo_titular ?? '____________________________________________' }}</td>
    </tr>
    <tr>
      <td class="campo">Despacho / Dependencia</td>
      <td class="valor">{{ $solicitud->despacho }}</td>
    </tr>
    <tr>
      <td class="campo">Correo Institucional</td>
      <td class="valor">{{ $solicitud->correo_titular ?? '____________________________________________' }}</td>
    </tr>
  </table>

  {{-- ========== SECCIÓN 2: EMPLEADOS Y ELEMENTOS ========== --}}
  <div class="seccion-titulo">2. Identificación del Elemento Entregado Perteneciente al Inventario del Titular</div>

  @php $equipos = $solicitud->equipos ?? []; @endphp

  @if(count($equipos) > 0)
    {{-- Tabla resumen de empleados --}}
    <table class="tabla-emp" style="margin-bottom:12px;">
      <thead>
        <tr>
          <th>Cédula</th>
          <th>Nombre</th>
          <th>Cargo</th>
          <th>Lugar de uso</th>
        </tr>
      </thead>
      <tbody>
        @foreach($equipos as $emp)
        <tr>
          <td>{{ $emp['cedula'] }}</td>
          <td>{{ strtoupper($emp['nombre']) }}</td>
          <td>{{ $emp['cargo'] ?? '' }}</td>
          <td>{{ $emp['lugar'] ?? '' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Detalle de elementos por empleado --}}
    @foreach($equipos as $i => $emp)
    <div class="bloque-empleado">
      <div class="empleado-header">
        Empleado: {{ strtoupper($emp['nombre']) }} — C.C. {{ $emp['cedula'] }}
        @if(!empty($emp['cargo'])) &nbsp;|&nbsp; Cargo: {{ $emp['cargo'] }} @endif
      </div>
      <table class="tabla-emp">
        <thead>
          <tr>
            <th>Elemento</th>
            <th>Placa</th>
            <th>Serial</th>
            <th>Marca</th>
          </tr>
        </thead>
        <tbody>
          @forelse($emp['elementos'] ?? [] as $el)
          <tr>
            <td>{{ $el['elemento'] ?? '' }}</td>
            <td>{{ $el['placa'] ?? '' }}</td>
            <td>{{ $el['serial'] ?? '' }}</td>
            <td>{{ $el['marca'] ?? '' }}</td>
          </tr>
          @empty
          <tr><td colspan="4" style="text-align:center; color:#888;">Sin elementos registrados</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @endforeach
  @endif

  <p style="font-size:10.5px; text-align:justify; margin-bottom:8px;">
    El servidor manifiesta haber recibido el elemento anteriormente identificado, verificando su estado al momento de la entrega.
  </p>

  {{-- ========== SECCIÓN 3: COMPROMISOS ========== --}}
  <div class="seccion-titulo">3. Compromisos de Custodia, Uso y Seguridad</div>
  <div class="compromisos">
    <p>Con la suscripción de la presente acta, el servidor judicial que recibe el elemento se compromete a:</p>
    <ol>
      <li>Custodiar, conservar y utilizar adecuadamente el equipo entregado, destinándolo exclusivamente al desarrollo de las funciones propias de su cargo y a las actividades institucionales de la Rama Judicial.</li>
      <li>Mantener el equipo bajo su cuidado y adoptar las medidas razonables de seguridad física necesarias para prevenir su pérdida, hurto, daño, deterioro, manipulación o utilización por personas no autorizadas.</li>
      <li>No entregar, prestar, ceder, transferir ni permitir el uso del equipo a terceras personas, salvo autorización o instrucción institucional debidamente impartida.</li>
      <li>Abstenerse de efectuar modificaciones, intervenciones técnicas, desinstalaciones, instalaciones no autorizadas o cualquier actuación que pueda comprometer el funcionamiento, configuración o seguridad del equipo.</li>
      <li>Cumplir las disposiciones institucionales relacionadas con la seguridad de la información y protección de datos, utilizando la información y los activos informáticos exclusivamente para el ejercicio de sus funciones.</li>
      <li>Informar inmediatamente a la Dirección Seccional de Administración Judicial cualquier daño, falla, pérdida, hurto, incidente, siniestro o situación que afecte o pueda comprometer la integridad, seguridad, ubicación o funcionamiento del elemento.</li>
      <li>No cambiar el lugar informado para la utilización y custodia del equipo sin comunicar previamente la novedad correspondiente.</li>
      <li>Informar oportunamente cualquier novedad relacionada con el estado o asignación del elemento, con el propósito de mantener actualizados los registros institucionales de inventario.</li>
      <li>Devolver o reintegrar el equipo y la totalidad de sus accesorios cuando finalicen las circunstancias que dieron origen a su entrega, cuando termine la habilitación correspondiente, cuando se produzca una novedad administrativa que así lo requiera o cuando la Dirección Seccional de Administración Judicial solicite su devolución.</li>
      <li>Entregar el elemento en las condiciones correspondientes a su uso adecuado, salvo el deterioro normal derivado de su utilización ordinaria, y efectuar su devolución mediante el procedimiento institucional correspondiente.</li>
    </ol>
  </div>

  {{-- ========== SECCIÓN 4: RESPONSABILIDAD ========== --}}
  <div class="seccion-titulo">4. Responsabilidad sobre el Elemento</div>
  <div class="compromisos">
    <p>El servidor reconoce que el equipo objeto de la presente acta constituye un bien de propiedad de la Rama Judicial y que su entrega temporal no implica transferencia de dominio ni autorización para destinarlo a fines diferentes del cumplimiento de las funciones institucionales.</p>
    <p>Durante el tiempo que permanezca bajo su custodia, deberá observar los deberes de cuidado, conservación, seguridad y reporte establecidos en la presente acta, en el Manual de Administración y Control de Activos Muebles de la Rama Judicial y en las demás disposiciones institucionales aplicables.</p>
    <p>La suscripción de la presente acta constituye igualmente el compromiso de acceso y cuidado del equipo de cómputo previsto en el literal d) del artículo 8 del Acuerdo PCSJA26-12564 de 2026.</p>
    <p>Cualquier pérdida, daño, deterioro, uso indebido o incumplimiento de los deberes de custodia será informado y tramitado conforme a los procedimientos institucionales aplicables, sin que la sola ocurrencia de la novedad implique automáticamente la atribución de responsabilidad al servidor, la cual se determinará por las autoridades competentes y mediante los procedimientos correspondientes.</p>
  </div>

  {{-- ========== SECCIÓN 5: DEVOLUCIÓN ========== --}}
  <div class="seccion-titulo">5. Devolución</div>
  <div class="compromisos">
    <p>La entrega tiene carácter temporal y excepcional. En consecuencia, el servidor se obliga a poner el equipo a disposición de la Dirección Seccional de Administración Judicial cuando sea requerido y a formalizar su devolución o reintegro conforme al procedimiento establecido para los bienes de la Rama Judicial.</p>
    <p>La responsabilidad asociada a la custodia del elemento se mantendrá hasta que su devolución o reintegro quede debidamente formalizado y registrado conforme al procedimiento institucional aplicable.</p>
  </div>

  <p style="font-size:10.5px; text-align:justify; margin-top:8px; margin-bottom:4px;">
    Para constancia se firma por quienes intervienen:
  </p>

  {{-- ========== FIRMAS ========== --}}
  <table class="firmas-tabla">
    <tr>
      {{-- Firma de quien entrega (almacén) --}}
      <td>
        <div class="firma-linea">
          <strong>ADRIANA MANUELA TRILLOS RAMÍREZ</strong><br>
          Jefe de Servicios Administrativos, Almacén e Inventarios<br>
          <span class="text-muted">ENTREGA</span>
        </div>
      </td>
      {{-- Firma del titular del despacho --}}
      <td>
        <div class="firma-linea">
          <strong>{{ strtoupper($solicitud->nombre_juez) }}</strong><br>
          C.C. {{ $solicitud->cedula_juez }}<br>
          {{ $solicitud->cargo_titular ?? 'Titular del Despacho' }}<br>
          {{ $solicitud->despacho }}<br>
          <span class="text-muted">RECIBE Y ACEPTA LOS COMPROMISOS DE CUSTODIA</span>
        </div>
      </td>
    </tr>
  </table>  

</div>
</body>
</html>
