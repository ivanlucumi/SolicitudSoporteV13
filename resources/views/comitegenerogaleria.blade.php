@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Comité de Genero Galeráa')

@section('content') 
<div class="row">
	<div class="col-xs-12 col-md-12">
		<p> 
			<h2 style="text-align: center; text-transform: uppercase; font: 200% Footlight-MT-Light;">Galería Comité de Género</h2>
		</p>
		@if($comitegaleria != null)
            <!-- Image Gallery -->
            <div class="row">
                <div class="col-xs-12 col-md-12">                        
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">                                
                        @foreach($comitegaleria as $imagen)                        
                        <div class="col-xs-12 col-md-4">
                            <a href="/img/{{$imagen->cggImagen}}" data-sub-html="{{$imagen->cggTitulo}}">
                                <img class="img-thumbnail" src="/img/{{$imagen->cggImagen}}" style="width: 360px; height: 240px;">
                            </a>
                        </div>                        
                        @endforeach                                
                    </div>
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div align="center">
                    <img class="featurette-image img-responsive center-block" style="width: auto; height: 500px;" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="/img/sindatos.png"> 
                </div>
            </div>
        </div>
        @endif
	</div>
</div>
<hr>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCGdocumentos.js"></script>  
<script src="/js/filterCGgaleria.js"></script>  

@endsection