@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Formatos y Consultas de Inventario')
@section('cabecera', 'Formatos y Consulta de Inventario')

@section('content') 

<div class="container-fluid">
    
     <div class="row" >
        <div class="col-xs-12 col-lg-3" ></div>
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="">
              <img class="card-img-top" src="/img/1formatos/Inventario.PNG" alt="Inventario Servidores Juidiciales" width="300" height="200" style="display: block;margin-left: auto;  margin-right: auto;  width: 50%;">
              <div class="card-body">
                <h2 class="card-title">Consultar Inventario Servidores Juidiciales </strog></h2>
                <h4 class="card-text">En el siguiente link se podrá consultar el cargue de inventario de los Servidores Judiciales a través de la página</h4>
                <h4 class="card-text">El usuario y la contraseña son el número de cédula</h4>
                <a href="http://consulta_bienes.ramajudicial.gov.co:8080/portal_csj/jsp/login.app" target="_blank" class="btn btn-danger btn-block">CONSULTAR INVENTARIO</a>
              </div> <br>
            </div>
        </div>
        <div class="col-xs-12 col-lg-3"></div>
         
       
    </div>
    <br>
     <div class="row" style="" >
       
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="background-color:#f1fcf4">
              <img class="card-img-top" src="/img/DocFormatos/REINTEGRO DE ELEMENTOS.PNG" alt="Inventario Servidores Juidiciales" width="300" height="200" style="display: block;margin-left: auto;  margin-right: auto;  width: 50%;">
              <div class="card-body">
                <h2 class="card-title col text-center">F-AGA-02 - Formato reintegro bienes</strog></h2>
                <div class="col text-center">
    				<a href=""onClick="window.open('/img/DocFormatos/F-AGA-02 - Formato reintegro bienes.docx','popup', 'width=800px,height=600px')" class="btn btn-danger  mb-3" style="margin-center: auto;"> Descargar Formato </a> 
    			</div><br>
                  </div> 
            </div>
        </div>
         <div class="col-xs-12 col-lg-6">
            <div class="card" style="background-color:#f1fcf4">
              <img class="card-img-top" src="/img/DocFormatos/TRASPASO DE ELEMENTOS.PNG" alt="Inventario Servidores Juidiciales" width="300" height="200" style="display: block;margin-left: auto;  margin-right: auto;  width: 50%;">
              <div class="card-body">
                <h2 class="card-title text-center">F-AGA-01 - Formato traspaso bienes </strog></h2>
                 <div class="col text-center mt-4 mb-4">
    				 <a href=""onClick="window.open('/img/DocFormatos/F-AGA-01 - Formato traspaso bienes.docx','popup', 'width=800px,height=600px')" class="btn btn-danger  mb-3" style="margin-center: auto;"> Descargar  Formato  </a> 
             	</div><br>
                </div> 
            </div>
        </div>
        
        </div>
        <br>
        <div class="row" >
        <div class="col-xs-12 col-lg-6">
            <div class="card" style="background-color:#f1fcf4">
              <img class="card-img-top" src="/img/DocFormatos/ACUERDO PSAA 10-7024 DE 2010.PNG" alt="Inventario Servidores Juidiciales" width="300" height="200" style="display: block;margin-left: auto;  margin-right: auto;  width: 50%;">
              <div class="card-body">
                <h2 class="card-title text-center">Acta de Informe de Gestión y se establece la metodología para la entrega y recibo de Despacho Judicial por cambio de servidor judicial </strog></h2>
                <div class="col text-center">
    				 <a href=""onClick="window.open('/img/DocFormatos/Formato ACUERDO PSAA 10.docx','popup', 'width=800px,height=600px')" class="btn btn-danger  mb-3">Descargar Formato </a> 
              </div><br>
               </div> 
            </div>
        </div>
       <div class="col-xs-12 col-lg-6">
            <div class="card" style="background-color:#f1fcf4">
              <img class="card-img-top" src="/img/DocFormatos/SOLICITUD PAZ Y SALVO.PNG" alt="Inventario Servidores Juidiciales" width="300" height="200" style="display: block;margin-left: auto;  margin-right: auto;  width: 50%;">
              <div class="card-body text-center">
                <h2 class="card-title">Formato Solicitud  De Paz Y Salvo </strog></h2>
                <div class="col text-center">
    				 <a href=""onClick="window.open('/img/DocFormatos/FORMATO SOLICITUD  DE PAZ Y SALVO.xlsx','popup', 'width=800px,height=600px')" class="btn btn-danger  mb-3">Descargar Formato </a>  
    			</div><br>
              </div> 
            </div>
        </div>
         
       
    </div>
    
    
    
   
    
</div>


@endsection