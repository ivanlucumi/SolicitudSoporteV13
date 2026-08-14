@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
    
    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
    </button>

    <strong><i class="fa fa-check-circle"></i> Operación exitosa:</strong>
    {{ session('message') }}

</div>
@endif