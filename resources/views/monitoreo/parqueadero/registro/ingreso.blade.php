@extends( auth()->user()->rol == 10 ? 'layouts.monitoreo.coordinador' : 'layouts.monitoreo.parqueadero')

@section('cabecera')
    Registro de Ingreso - Contratistas
@endsection

@section('content')

{{-- CABECERA CON CÉDULA GRANDE --}}
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary" style="border-top: 4px solid #0f3460;">
            <div class="box-header with-border" style="background: #0f3460; padding:12px 20px;">
                <h3 class="box-title" style="color:#fff; font-size:17px;">
                    <i class="fa fa-id-card-o"></i> &nbsp;Ingreso Contratista
                </h3>
                <span class="pull-right" style="color:#aed6f1; font-size:14px; margin-top:4px;">
                    <i class="fa fa-map-marker"></i> {{ $puerta }}
                </span>
            </div>
            <div class="box-body" style="padding: 20px 25px 15px;">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible" style="margin-bottom:15px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                {{-- INPUT CÉDULA GRANDE --}}
                <div class="form-group" style="margin-bottom:8px;">
                    <label style="font-size:13px; color:#666; margin-bottom:5px; display:block;">
                        <i class="fa fa-barcode"></i> &nbsp;ESCANEE O ESCRIBA LA CÉDULA — PRESIONE <kbd>ENTER</kbd>
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon" style="background:#0f3460; color:#fff; font-size:20px; padding:0 16px; border:none;">
                            <i class="fa fa-qrcode"></i>
                        </span>
                        <input
                            type="text"
                            id="cedula_scan"
                            class="form-control"
                            placeholder="Escáner o teclado..."
                            autocomplete="off"
                            autofocus
                            style="font-size:28px; font-weight:700; letter-spacing:4px; height:60px; border:2px solid #0f3460; border-left:none; color:#1a1a2e;"
                        >
                        <span class="input-group-btn">
                            <button type="button" id="btn_registrar"
                                class="btn btn-flat"
                                style="height:60px; padding:0 22px; background:#0f3460; color:#fff; font-size:15px; border:none;">
                                <i class="fa fa-sign-in"></i>&nbsp;Registrar
                            </button>
                        </span>
                    </div>
                </div>

                {{-- LOADER --}}
                <div id="loader_registrar" style="display:none; text-align:center; padding:10px 0 5px;">
                    <i class="fa fa-spinner fa-spin fa-lg" style="color:#0f3460;"></i>
                    <span style="color:#555; margin-left:8px; font-size:13px;">Procesando...</span>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- TABLA DE ÚLTIMOS INGRESOS DEL DÍA --}}
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-default" style="margin-top:0;">
            <div class="box-header with-border" style="padding:10px 15px;">
                <h4 class="box-title" style="font-size:13px; color:#555;">
                    <i class="fa fa-history"></i> &nbsp;Últimos Ingresos del Día
                </h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-xs btn-default" onclick="location.reload()">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" style="padding:0;">
                <div id="tabla_ingresos_container">
                    <table class="table table-condensed table-hover" style="margin:0; font-size:13px;">
                        <thead style="background:#f5f5f5;">
                            <tr>
                                <th style="padding:8px 12px; width:140px;">Hora</th>
                                <th style="padding:8px 12px; width:130px;">Cédula</th>
                                <th style="padding:8px 12px;">Nombre</th>
                                <th style="padding:8px 12px;">Empresa</th>
                                <th style="padding:8px 12px; width:100px;">Puerta</th>
                                <th style="padding:8px 12px; width:90px;">Tipo</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_ingresos">
                            @forelse($ingresosHoy as $index => $r)
                            <tr style="{{ $index === 0 ? 'background:#f0f7ff; font-weight:600;' : '' }}">
                                <td style="padding:7px 12px; color:#0f3460;">{{ $r['hora'] }}</td>
                                <td style="padding:7px 12px; font-family:monospace; font-size:14px;">{{ $r['cedula'] }}</td>
                                <td style="padding:7px 12px;">{{ $r['nombre'] }}</td>
                                <td style="padding:7px 12px; color:#555;">{{ $r['empresa'] }}</td>
                                <td style="padding:7px 12px;"><span class="label label-info">{{ $r['puerta'] }}</span></td>
                                <td style="padding:7px 12px;">
                                    <span class="label label-{{ $r['tipo'] == 'INGRESO' ? 'success' : 'warning' }}">
                                        {{ $r['tipo'] }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted" style="padding:20px;">
                                    <i class="fa fa-clock-o"></i> &nbsp;No hay ingresos registrados para hoy.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    const puerta = "{{ $puerta }}";
    const autoRegistrarUrl = "{{ route('parqueadero.auto.registrar') }}";
    const csrfToken = "{{ csrf_token() }}";
    // Cargar datos iniciales desde el servidor (pasados por el controlador)
    let ingresosRecientes = {!! json_encode($ingresosHoy) !!};

    function renderTabla() {
        if (ingresosRecientes.length === 0) return;
        let html = '';
        ingresosRecientes.forEach(function(r, i) {
            html += `<tr style="${i===0 ? 'background:#f0f7ff;font-weight:600;' : ''}">
                <td style="padding:7px 12px; color:#0f3460;">${r.hora}</td>
                <td style="padding:7px 12px; font-family:monospace; font-size:14px;">${r.cedula}</td>
                <td style="padding:7px 12px;">${r.nombre}</td>
                <td style="padding:7px 12px; color:#555;">${r.empresa}</td>
                <td style="padding:7px 12px;"><span class="label label-info">${r.puerta}</span></td>
                <td style="padding:7px 12px;">
                    <span class="label label-${r.tipo === 'INGRESO' ? 'success' : 'warning'}">${r.tipo}</span>
                </td>
            </tr>`;
        });
        $('#tbody_ingresos').html(html);
    }

    function registrarIngreso() {
        let cedula = $.trim($('#cedula_scan').val());

        // Limpieza rápida en el frontend para escáneres 2D
        if (cedula.length > 15) {
            const match = cedula.match(/\d{6,11}/);
            if (match) cedula = match[0];
        }

        if (!cedula) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Ingrese o escanee un número de cédula.',
                confirmButtonColor: '#0f3460',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            return;
        }

        $('#loader_registrar').fadeIn(150);
        $('#btn_registrar').prop('disabled', true);
        $('#cedula_scan').prop('disabled', true);

        $.ajax({
            url: autoRegistrarUrl,
            method: 'POST',
            data: { _token: csrfToken, cedula: cedula, puerta: puerta },
            success: function (data) {
                $('#loader_registrar').hide();

                if (data.success) {
                    // Limpiar input de inmediato para agilizar el siguiente escaneo
                    $('#cedula_scan').val('').prop('disabled', false).focus();
                    $('#btn_registrar').prop('disabled', false);

                    // Agregar a la tabla local
                    ingresosRecientes.unshift(data);
                    if (ingresosRecientes.length > 15) ingresosRecientes.pop();
                    renderTabla();

                    // Foto
                    const fotoHtml = data.foto
                        ? `<img src="${data.foto}" alt="Foto"
                               style="width:110px;height:110px;object-fit:cover;border-radius:50%;
                                      border:4px solid #0f3460;display:block;margin:0 auto 15px auto;">`
                        : `<div style="width:110px;height:110px;border-radius:50%;
                                       background:linear-gradient(135deg,#1a1a2e,#0f3460);
                                       display:flex;align-items:center;justify-content:center;
                                       margin:0 auto 15px auto;">
                               <i class='fa fa-user' style='font-size:50px;color:#fff;'></i>
                           </div>`;

                    const infoHtml = `
                        ${fotoHtml}
                        <div style="background:#f9f9f9; padding:15px; border-radius:12px; border:1px solid #eee;">
                            <table style="width:100%;border-collapse:collapse;font-size:15px;text-align:left;">
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:8px 5px;color:#888;width:40%">
                                        <i class='fa fa-id-card' style='color:#0f3460;'></i>&nbsp;Cédula
                                    </td>
                                    <td style="padding:8px 5px;font-weight:700;font-family:monospace;font-size:17px;color:#1a1a2e;">${data.cedula}</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:8px 5px;color:#888;">
                                        <i class='fa fa-building' style='color:#0f3460;'></i>&nbsp;Empresa
                                    </td>
                                    <td style="padding:8px 5px;font-weight:600;color:#333;">${data.empresa}</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:8px 5px;color:#888;">
                                        <i class='fa fa-exchange' style='color:#0f3460;'></i>&nbsp;Evento
                                    </td>
                                    <td style="padding:8px 5px;color:${data.tipo === 'INGRESO' ? '#27ae60' : '#e67e22'};font-weight:800;font-size:18px;">
                                        ${data.tipo} REGISTRADO ✓
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 5px;color:#888;">
                                        <i class='fa fa-clock-o' style='color:#0f3460;'></i>&nbsp;Hora
                                    </td>
                                    <td style="padding:8px 5px;font-weight:600;color:#555;">${data.hora}</td>
                                </tr>
                            </table>
                        </div>
                    `;

                    Swal.fire({
                        title: `<span style="color:#0f3460;font-size:26px;font-weight:800;">${data.nombre}</span>`,
                        html: infoHtml,
                        icon: 'success',
                        width: 600,
                        timer: 4500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        allowOutsideClick: true
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Acceso Denegado',
                        html: data.message,
                        confirmButtonColor: '#c0392b',
                        confirmButtonText: 'Cerrar',
                    }).then(function() {
                        $('#cedula_scan').val('').prop('disabled', false).focus();
                        $('#btn_registrar').prop('disabled', false);
                    });
                }
            },
            error: function () {
                $('#loader_registrar').hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo procesar. Intente de nuevo.',
                    confirmButtonColor: '#c0392b',
                }).then(function() {
                    $('#cedula_scan').val('').prop('disabled', false).focus();
                    $('#btn_registrar').prop('disabled', false);
                });
            }
        });
    }

    // Enter desde teclado o escáner
    $('#cedula_scan').on('keypress', function (e) {
        if (e.which === 13) { e.preventDefault(); registrarIngreso(); }
    });

    // Clic en botón
    $('#btn_registrar').on('click', function () { registrarIngreso(); });

    // Mantener foco en el input cuando el SweetAlert no está abierto
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.swal2-container, button, a').length) {
            $('#cedula_scan').focus();
        }
    });

    $('#cedula_scan').focus();
});
</script>

<style>
kbd {
    background: #0f3460;
    color: #fff;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 12px;
}
</style>
@endpush
