@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Misi&oacute;n')

@section('content') 

@if($institucional != null)
    @if($institucional[0]->iTipo == "Mision")
    @foreach($institucional as $itcl)
        @if ($itcl->iTipo == 'Mision')
        <div class="col-md-7 col-md-push-5">
            <h2 class="featurette-heading" style="text-transform: uppercase;">{{$itcl->iTitulo}}</h2>
            
            <p class="lead" style="word-wrap: break-word;height: auto;width: 100%; text-align: justify;">{{$itcl->iDescripcion}}</p>
            
          </div>
          <div class="col-md-5 col-md-pull-7">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="img/{{$itcl->iFoto}}">
          </div>
        @endif
    @endforeach
    @else
      <div class="jumbotron">
        <h3>Señor@ Visitante</h3>
        <p class="lead">Actualmente esta secion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
      </div>
    @endif
@else
      <div class="jumbotron">
        <h3>Señor@ Visitante</h3>
        <p class="lead">Actualmente esta secion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
      </div>
@endif
<script>
    history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};
</script>

@endsection