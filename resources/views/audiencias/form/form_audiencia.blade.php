@if(Carbon\Carbon::now()->toDateString() <= "2022-11-30")
<form action="{{ route('$url') }}" method="POST">
    @csrf   

@include('audiencias.form.form')
<div class="row">
    <div class="col-xs-12 col-sm-4"></div>
    <div class="col-xs-12 col-sm-4" style="display:none" id="Detenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">SIGUIENTE</button>
        
    </div>
    <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">FINALIZAR</button>
        
    </div>
    
    <div class="col-xs-12 col-sm-4"></div>                
</div>   
</form> 
@else

<p>
    <center>
       <h1> <strong>SE PUEDE AGENDAR DIRECTAMENTE A TRAV&Eacute;S DE ESTE LINK  
<a href="http://sistemaaudiencias.ramajudicial.gov.co" rel="noopener" target="_blank" >SISTEMA DE AUDIENCIAS</a></h1></strong>
    </center>
</p>

@endif