@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{!! session()->get('success') !!}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{!! session()->get('error') !!}",
            confirmButtonColor: '#274a8a',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if (session()->has('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: "{!! session()->get('warning') !!}",
            confirmButtonColor: '#274a8a',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if ($errors->any())
    @php
        $errorList = '<ul>';
        foreach($errors->all() as $error) {
            $errorList .= '<li>' . $error . '</li>';
        }
        $errorList .= '</ul>';
    @endphp
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Errores de Validación',
            html: '{!! $errorList !!}',
            confirmButtonColor: '#274a8a',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
