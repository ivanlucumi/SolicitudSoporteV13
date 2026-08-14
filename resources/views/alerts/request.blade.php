@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade in" role="alert" style="font-size:15px;">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
    </button>

    <strong>
        <i class="fa fa-exclamation-circle"></i>
        Se encontraron los siguientes errores:
    </strong>

    <ul style="margin-top:10px; margin-bottom:0;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

</div>
@endif