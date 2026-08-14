@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Comité de Genero')

@section('content') 
<div class="container mx-auto px-4">
	<div class="row" data-aos="fade-down" data-aos-duration="1000">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<h2 class="text-center font-extrabold text-4xl md:text-5xl text-primary mb-8 uppercase tracking-widest drop-shadow-md">
				Comité de Género
			</h2>
			<div class="glass-card p-8 md:p-10 rounded-2xl shadow-xl border border-white/40 hover:shadow-2xl transition-all duration-500 relative overflow-hidden group">
				<div class="absolute inset-0 bg-gradient-to-br from-white/40 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
				<p class="text-justify text-gray-800 leading-relaxed text-lg mb-6 relative z-10 font-medium">	
					Colombia ha experimentado significativas transformaciones a nivel normativo en materia de protección especial a la mujer, especialmente luego de la expedición de la Constitución de 1991. Sin embargo, para garantizar la igualdad y la no discriminación en la práctica, se precisa la adopción de medidas de orden pedagógico y administrativo que hagan realidad la equidad de género.
				</p>
				<p class="text-justify text-gray-800 leading-relaxed text-lg relative z-10 font-medium">
					La administración de justicia no puede ser ajena a este propósito y por ello la Sala Administrativa del Consejo Superior de la Judicatura de Colombia creó la Comisión Nacional de Género en la Rama Judicial, mediante Acuerdo 4552 de 2008, la cual fue instalada el 9 de junio de 2008, con el propósito de promover la incorporación e institucionalización de la perspectiva de género en el quehacer de la labor judicial.
				</p>
			</div>
		</div>
	</div>
<hr>
@if($comitegaleria != null)
	<div class="row mt-12" data-aos="fade-up" data-aos-duration="1200">
		<div class="col-xs-12 col-md-12">
			<h2 class="text-center font-bold text-3xl md:text-4xl text-primary mb-10 uppercase tracking-widest relative inline-block left-1/2 -translate-x-1/2">
				Nuestra Galería
				<span class="block w-1/2 h-1 bg-accent mx-auto mt-2 rounded-full"></span>
			</h2>
			<div class="row flex flex-wrap justify-center gap-8">
				@if($total == 1)
					@foreach($comitegaleria as $cmtg)
						<div class="col-xs-12 col-sm-10 col-md-8 flex justify-center" data-aos="zoom-in" data-aos-delay="100">
							<div class="overflow-hidden rounded-2xl shadow-2xl border-4 border-white/50 group">
								<img src="/img/{{$cmtg->cggImagen}}" class="object-cover w-full h-auto max-h-[500px] transition-transform duration-700 group-hover:scale-110">
							</div>
						</div>
					@endforeach
				@else
					@foreach($comitegaleria as $cmtg)
						<div class="col-xs-12 col-sm-6 col-md-4 flex justify-center mb-8" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
							<div class="overflow-hidden rounded-2xl shadow-xl border-4 border-white/60 group w-full relative">
								<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
								<img src="/img/{{$cmtg->cggImagen}}" class="object-cover w-full h-[300px] transition-transform duration-700 group-hover:scale-110 group-hover:rotate-2">
							</div>
						</div>
					@endforeach				
				@endif
			</div>
			<div class="flex justify-center mt-10 mb-8" data-aos="fade-up">
				<a href="{!! url('/comite_genero_galeria')!!}" class="relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary to-primary-light text-white font-bold text-lg rounded-full shadow-[0_10px_20px_rgba(0,63,117,0.3)] hover:shadow-[0_15px_30px_rgba(0,63,117,0.4)] transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
					<span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
					<i class="fa fa-camera-retro text-xl"></i> Ver Galería Completa
				</a>
			</div>		
		</div>
	</div>
<hr>
@endif
	<div class="row mt-10">
		<div class="col-xs-12 col-md-10 col-md-offset-1 mb-12" data-aos="fade-right" data-aos-duration="1000">
			<div class="glass-card rounded-2xl shadow-lg border border-white/50 overflow-hidden">
				<div class="bg-gradient-to-r from-primary to-primary-light p-5">
					<h2 class="text-center font-bold text-2xl md:text-3xl text-white uppercase tracking-widest m-0 flex items-center justify-center gap-3">
						<i class="fa fa-file-pdf-o"></i> Documentos
					</h2>
				</div>
				<div class="table-responsive p-6 bg-white/80">
					<table id="table9" class="table table-hover mb-0">
						<thead class="text-primary border-b-2 border-primary/20">
							<tr>
								<th class="py-4 px-4 font-bold text-lg">TÍTULO</th>
								<th class="py-4 px-4 font-bold text-lg w-1/4">PUBLICACIÓN</th>
								<th class="py-4 px-4 font-bold text-lg text-center w-32">ARCHIVO</th>						
							</tr>
						</thead>
						@if($informe != null && count($informe) > 0)
							<tbody class="buscar">
							@foreach($informe as $ifn)
								<tr class="transition-all duration-300 hover:bg-blue-50/50 border-b border-gray-100/50 group">
									<td class="py-4 px-4 align-middle text-gray-800 text-base font-medium group-hover:text-primary transition-colors">{{$ifn->cgtitulo}}</td>									
									<td class="py-4 px-4 align-middle text-gray-500 text-sm font-semibold">{{$ifn->created_at}}</td>
									<td class="py-4 px-4 align-middle text-center">
										<a href="#" onClick="window.open('/img/{{$ifn->cgdocumento}}','popup', 'width=800px,height=600px'); return false;" class="inline-flex flex-col items-center justify-center w-12 h-12 bg-red-50 text-red-600 rounded-full shadow-sm hover:bg-red-600 hover:text-white hover:shadow-md transition-all duration-300 hover:-translate-y-1 mx-auto relative overflow-hidden" title="Ver Documento">
											<i class="fa fa-file-pdf-o text-xl relative z-10"></i>
											<span class="absolute inset-0 bg-red-500 transform scale-0 rounded-full transition-transform duration-300 group-hover:scale-100 z-0"></span>
										</a>
									</td>												     
								</tr>	                
							@endforeach
							</tbody>
						@else
							<tbody>
								<tr>
									<td colspan="3" class="py-8 px-4 text-center text-gray-500 text-lg italic">Actualmente esta sección no cuenta con información disponible.</td>
								</tr>
							</tbody>
						@endif
					</table>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-10 col-md-offset-1 mb-16" data-aos="fade-left" data-aos-duration="1000">
			<div class="glass-card rounded-2xl shadow-lg border border-white/50 overflow-hidden">
				<div class="bg-gradient-to-r from-accent to-yellow-500 p-5">
					<h2 class="text-center font-bold text-2xl md:text-3xl text-white uppercase tracking-widest m-0 flex items-center justify-center gap-3">
						<i class="fa fa-link"></i> Enlaces de interés
					</h2>
				</div>
				<div class="table-responsive p-6 bg-white/80">
					<table id="table10" class="table table-hover mb-0">
						<thead class="text-accent border-b-2 border-accent/20">
							<tr>
								<th class="py-4 px-4 font-bold text-lg">TÍTULO</th>
								<th class="py-4 px-4 font-bold text-lg">DESCRIPCIÓN</th>
								<th class="py-4 px-4 font-bold text-lg w-1/4">PUBLICACIÓN</th>						
								<th class="py-4 px-4 font-bold text-lg text-center w-32">ENLACE</th>						
							</tr>
						</thead>
						@if($comieenlaces != null && count($comieenlaces) > 0)
							<tbody class="buscar">
							@foreach($comieenlaces as $ifn)
								<tr class="transition-all duration-300 hover:bg-orange-50/50 border-b border-gray-100/50 group">
									<td class="py-4 px-4 align-middle text-gray-800 text-base font-bold group-hover:text-accent transition-colors">{{$ifn->cgetitulo}}</td>									
									<td class="py-4 px-4 align-middle text-gray-600 text-sm leading-relaxed">{{$ifn->cgedescripcion}}</td>
									<td class="py-4 px-4 align-middle text-gray-500 text-sm font-semibold">{{$ifn->created_at}}</td>
									<td class="py-4 px-4 align-middle text-center">
										<a href="{{$ifn->cgelink}}" target="_blank" class="inline-flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-full shadow-sm hover:bg-blue-600 hover:text-white hover:shadow-md transition-all duration-300 hover:-translate-y-1 mx-auto" title="Visitar Enlace">
											<i class="fa fa-external-link text-xl"></i>
										</a>
									</td>												     
								</tr>	                
							@endforeach
							</tbody>
						@else
							<tbody>
								<tr>
									<td colspan="4" class="py-8 px-4 text-center text-gray-500 text-lg italic">Actualmente esta sección no cuenta con información disponible.</td>
								</tr>
							</tbody>
						@endif
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCGdocumentos.js"></script>  
<script src="/js/filterCGgaleria.js"></script>  

@endsection