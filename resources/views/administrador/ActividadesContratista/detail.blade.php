<div class="row">
    <div class="col-md-3">
        <p><strong>Fecha:</strong></p>
        <p>{{ $activity->activity_date->format('d/m/Y') }}</p>
    </div>
    <div class="col-md-4">
        <p><strong>Usuario:</strong></p>
        <p>{{ $activity->user->name }} ({{ $activity->user->email }})</p>
    </div>
    <div class="col-md-3">
        <p><strong>Registrado el:</strong></p>
        <p>{{ $activity->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <p><strong>Descripción:</strong></p>
        <div class="well" style="white-space: pre-wrap;">{{ $activity->description }}</div>
    </div>
</div>