@if( auth()->user()->rol == 3 )
 @include('usuario.ayudaServisoft')
@endif

@if ( auth()->user()->rol == 1)
 @include('administrador.ayudaServisoft.index')
@endif
