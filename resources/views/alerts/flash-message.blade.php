@foreach ([
    'success' => 'success',
    'error' => 'danger',
    'warning' => 'warning',
    'info' => 'info'
] as $key => $class)

    @if(session()->has($key))
        <div class="alert alert-{{ $class }} alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>

            {{ session($key) }}
        </div>
    @endif

@endforeach

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>

        <strong>Se encontraron errores en el formulario:</strong>

        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif