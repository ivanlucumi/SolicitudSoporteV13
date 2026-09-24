@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Comité de Genero Galeráa')

@section('content') 
<div class="container mx-auto px-4">
	<div class="row" data-aos="fade-down" data-aos-duration="1000">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<h2 class="text-center font-extrabold text-4xl md:text-5xl text-primary mb-12 uppercase tracking-widest drop-shadow-md relative inline-block left-1/2 -translate-x-1/2">
				Galería Comité de Género
				<span class="block w-3/4 h-1 bg-accent mx-auto mt-4 rounded-full"></span>
			</h2>
		</div>
	</div>

	@if($comitegaleria != null && count($comitegaleria) > 0)
		<!-- Image Gallery -->
		<div class="row" data-aos="fade-up" data-aos-duration="1200">
			<div class="col-xs-12 col-md-12">                        
				<div id="aniimated-thumbnials" class="flex flex-wrap justify-center gap-8 list-none p-0 m-0">                                
					@foreach($comitegaleria as $imagen)                        
					<div class="w-full sm:w-[48%] md:w-[31%] lg:w-[30%] flex justify-center mb-8" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
						<a href="/img/{{$imagen->cggImagen}}" data-sub-html="{{$imagen->cggTitulo}}" class="block w-full overflow-hidden rounded-2xl shadow-xl border-4 border-white/60 group relative cursor-pointer">
							<div class="absolute inset-0 bg-primary/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 flex items-center justify-center">
								<i class="fa fa-search-plus text-white text-4xl transform scale-50 group-hover:scale-100 transition-transform duration-300"></i>
							</div>
							<img class="object-cover w-full h-[280px] transition-transform duration-700 group-hover:scale-110 group-hover:rotate-1" src="/img/{{$imagen->cggImagen}}" alt="{{$imagen->cggTitulo}}">
						</a>
					</div>                        
					@endforeach                                
				</div>
			</div>
		</div>
	@else
		<div class="row" data-aos="fade-up">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="glass-card p-10 rounded-3xl shadow-lg border border-white/50 text-center bg-white/80">
					<i class="fa fa-picture-o text-gray-300 text-6xl mb-4"></i>
					<h3 class="text-2xl text-gray-500 font-semibold mb-2">No hay imágenes disponibles</h3>
					<p class="text-gray-400 text-lg">Actualmente esta galería no cuenta con contenido fotográfico.</p>
				</div>
			</div>
		</div>
	@endif
</div>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCGdocumentos.js"></script>  
<script src="/js/filterCGgaleria.js"></script>  

@endsection