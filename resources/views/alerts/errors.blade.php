@if(session()->has('message-error'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
    </button>

    <strong><i class="fa fa-times-circle"></i> Error:</strong>
    {{ session('message-error') }}

</div>
@endif