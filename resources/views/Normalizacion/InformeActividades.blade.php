@extends('layouts.digitalizacion.digitalizacion')

@section('title', 'Informe de Actividades')
@section('cabecera', 'Informe de Actividades Diarias')

@section('content')
<div class="container-fluid fade-in">

    {{-- CARD FORMULARIO --}}
    <div class="card">

        <div class="card-header">
            <h3>
                <i class="glyphicon glyphicon-list-alt"></i>
                Informe de Actividades Diarias
            </h3>
            <small class="text-muted">Registro habilitado después de las 12:00 PM</small>
        </div>

        {{-- MENSAJE HORARIO --}}
        <div id="time-message" class="time-banner" style="{{ $isAfterNoon ? 'display:none;' : '' }}">
            <i class="glyphicon glyphicon-time"></i>
            El formulario se habilitará automáticamente después del mediodía
        </div>

        {{-- FORMULARIO --}}
        <form id="activity-form"
              method="POST"
              action="{{ route('activities.store') }}"
              class="{{ $isAfterNoon ? '' : 'disabled-form' }}">
            @csrf

            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="text"
                               class="form-control input-minimal"
                               value="{{ $today->translatedFormat('l, d \d\e F \d\e Y') }}"
                               readonly>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Plataforma o Tema <span class="text-danger">*</span></label>
                        <select name="plataforma" class="form-control input-minimal" required>
                            <option value="">Seleccione…</option>
                            <option value="general">General</option>
                            <option value="siugj">SIUGJ</option>
                            <option value="sgde">SGDE</option>
                            <option value="ventanilla_judicial">Ventanilla Judicial</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Descripción de actividades <span class="text-danger">*</span></label>
                        <textarea name="description"
                                  rows="6"
                                  minlength="10"
                                  required
                                  class="form-control input-minimal"
                                  placeholder="Describa las actividades realizadas..."></textarea>
                    </div>
                </div>

                <div class="col-xs-12 text-right">
                    <button type="submit"
                            class="btn btn-primary btn-lg btn-save"
                            {{ $isAfterNoon ? '' : 'disabled' }}>
                        <i class="glyphicon glyphicon-floppy-disk"></i>
                        Guardar Actividades
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- CARD REPORTE --}}
    <div class="card fade-slide">
        <div class="card-header">
            <h4>
                <i class="glyphicon glyphicon-file"></i>
                Generar Informe Mensual
            </h4>
        </div>

        <form action="{{ route('activities.generate-report') }}" method="POST" class="form-inline">
            @csrf

            <div class="form-group">
                <label class="control-label">Mes</label>
                <input type="month"
                       name="month"
                       class="form-control input-minimal"
                       value="{{ now()->format('Y-m') }}"
                       max="{{ now()->format('Y-m') }}"
                       onchange="checkReportAvailability(this.value)">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="glyphicon glyphicon-download-alt"></i>
                Descargar PDF
            </button>

            <span id="report-warning" class="text-warning" style="display:none; margin-left:10px;">
                <i class="glyphicon glyphicon-warning-sign"></i>
                Al generar el informe, las actividades del mes se bloquearán.
            </span>
        </form>
    </div>

    {{-- CARD HISTORIAL --}}
    <div class="card fade-slide">

        <div class="card-header">
            <h4>
                <i class="glyphicon glyphicon-calendar"></i>
                Historial de Actividades
            </h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="15%">Fecha</th>
                        <th width="15%">Plataforma</th>
                        <th width="50%">Descripción</th>
                        <th width="20%">Registrado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activitiesHistory as $activity)
                        <tr class="{{ $activity->activity_date->isToday() ? 'info' : '' }} table-row">
                            <td>{{ $activity->activity_date->format('d/m/Y') }}</td>
                            <td>{{ ucfirst($activity->plataforma) }}</td>
                            <td>
                                <a href="javascript:void(0)"
                                   onclick="showActivityDetails({{ json_encode([
                                       'date' => $activity->activity_date->format('d/m/Y'),
                                       'description' => $activity->description,
                                       'created_at' => $activity->created_at->format('d/m/Y H:i')
                                   ]) }})">
                                    {{ Str::limit(strip_tags($activity->description), 80) }}
                                </a>
                            </td>
                            <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No hay actividades registradas aún
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="pull-left text-muted">
                Mostrando {{ $activitiesHistory->count() }} registros
            </div>
            <div class="pull-right">
                {{ $activitiesHistory->links() }}
            </div>
        </div>

    </div>

</div>

{{-- MODAL --}}
<div class="modal fade" id="activityModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    Detalle de Actividad
                </h4>
            </div>
            <div class="modal-body">
                <p><strong>Fecha:</strong> <span id="modal-date"></span></p>
                <p><strong>Registrado:</strong> <span id="modal-created-at"></span></p>
                <hr>
                <div id="modal-description" class="well"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.fade-in { animation: fadeIn .5s ease; }
.fade-slide { animation: slideUp .6s ease; }

@keyframes fadeIn {
    from { opacity:0; transform:translateY(8px); }
    to { opacity:1; transform:none; }
}

@keyframes slideUp {
    from { opacity:0; transform:translateY(15px); }
    to { opacity:1; transform:none; }
}

.card {
    background:#fff;
    border-radius:10px;
    box-shadow:0 8px 24px rgba(0,0,0,.06);
    padding:20px;
    margin-bottom:25px;
}

.card-header h3, .card-header h4 {
    margin:0;
    font-weight:600;
}

.input-minimal {
    border-radius:6px;
    border:1px solid #ddd;
}

.input-minimal:focus {
    border-color:#3498db;
    box-shadow:0 0 0 2px rgba(52,152,219,.15);
}

.time-banner {
    background:#fdf6e3;
    padding:12px;
    border-radius:6px;
    margin-bottom:15px;
}

.disabled-form {
    pointer-events:none;
    opacity:.6;
}

.table-row {
    transition: background .3s;
}

.table-row:hover {
    background:#f5f9ff;
    cursor:pointer;
}
</style>
@endsection

@section('scripts')
<script>
function showActivityDetails(activity) {
    $('#modal-date').text(activity.date);
    $('#modal-created-at').text(activity.created_at);
    $('#modal-description').text(activity.description);
    $('#activityModal').modal('show');
}

function checkTime() {
    var hour = new Date().getHours();
    if (hour >= 12) {
        $('#time-message').fadeOut();
        $('#activity-form').removeClass('disabled-form');
    } else {
        $('#time-message').fadeIn();
        $('#activity-form').addClass('disabled-form');
    }
}

function checkReportAvailability(month) {
    var currentMonth = new Date().toISOString().slice(0, 7);
    if (month === currentMonth) {
        $('#report-warning').fadeIn();
    } else {
        $('#report-warning').fadeOut();
    }
}

setInterval(checkTime, 60000);
checkTime();
</script>
@endsection
