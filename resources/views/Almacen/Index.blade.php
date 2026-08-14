@extends('layouts.Almacen.Almacen')
<!--ponerle titulo a la paginga-->
@section('title', 'Almacen Noticias')
@section('cabecera', 'Seccion de Noticias')



@section('content') 

 
	<div class="row justify-content-md-center">
        <center>AVISOS IMPORTANTES</center>
	</div>
    <hr>

  
   
  @push('scripts')
  <script src="/js/jquery.js"></script>
    <script src="/js/1configuracion.js"></script>  
   <script src="/js/detenido.js"></script> 
   <script src="/js/horaMilitar/combodate.js"></script> 
   

   @endpush
   

@endsection