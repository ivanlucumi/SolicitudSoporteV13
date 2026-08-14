@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Políticas de Privacidad y Términos de Uso')

@section('content')

<style>

body{
    background: linear-gradient(135deg,#f5f7fa,#eef4ff);
}

.legal-hero{
    background: linear-gradient(135deg,#002147,#003366);
    color:white;
    padding:50px;
    border-radius:24px;

    box-shadow:
        0 20px 50px rgba(0,33,71,.25);

    position:relative;
    overflow:hidden;
}

.legal-hero:before{
    content:'';
    position:absolute;
    width:350px;
    height:350px;
    right:-120px;
    top:-120px;

    border-radius:50%;

    background:rgba(255,255,255,.08);
}
.legal-hero:after{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    left:-80px;
    bottom:-80px;

    border-radius:50%;

    background:rgba(255,255,255,.05);
}

.legal-hero h1{
    margin:0;
    font-weight:700;
}

.legal-hero p{
    margin-top:10px;
    opacity:.95;
}

.glass-panel{
    background:rgba(255,255,255,.96);

    border:none;

    border-radius:22px;

    box-shadow:
        0 10px 30px rgba(0,0,0,.06);

    transition:all .35s ease;
}

.glass-panel:hover{

    transform:translateY(-6px);

    box-shadow:
        0 25px 50px rgba(0,33,71,.12);
}

.panel-title-modern{
    background: linear-gradient(135deg,#002147,#003366);
    color:#fff;
    padding:18px 20px;
    font-size:18px;
    font-weight:600;
}

.sidebar-card{
    position:sticky;
    top:90px;
}

.list-group-item{
    border:none !important;
    border-bottom:1px solid #f3f3f3 !important;
    transition:.3s;
}

.list-group-item:hover{
    background:#f6fffd;
    padding-left:25px;
}

.list-group-item a{
    color:#34495e;
    transition:.3s;
}

.list-group-item a:hover{
    color:#002147;
    text-decoration:none;
}

.modern-heading{
    background: linear-gradient(
        135deg,
        #00152e 0%,
        #002147 40%,
        #003366 100%
    ) !important;

    color:#fff !important;
    font-size:18px;
    font-weight:600;
    padding:18px 20px !important;

    position:relative;
    overflow:hidden;

    box-shadow:
        0 8px 20px rgba(0,33,71,.20);
}

.modern-heading:before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;

    width:100%;
    height:100%;

    background:linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,.15),
        transparent
    );

    transition:all .8s;
}

.glass-panel:hover .modern-heading:before{
    left:100%;
}
.section-title{
    color:#002147;
    font-weight:700;
    letter-spacing:.3px;
}

.section-header{
    display:flex;
    align-items:center;
    margin-top:35px;
    margin-bottom:20px;
}

.section-icon{
    width:50px;
    height:50px;
    background: linear-gradient(135deg,#002147,#003366);
    border-radius:15px;
    color:white;
    text-align:center;
    line-height:50px;
    font-size:20px;
    margin-right:15px;
    box-shadow:0 8px 20px rgba(0,33,71,.25);
}

.section-title{
    margin:0;
    color:#2c3e50;
    font-weight:700;
}

.text-legal{
    text-align:justify;
    line-height:1.9;
    color:#555;
    font-size:15px;
}

.copyright-box{
    background:#f8fafc;
    border-left:4px solid #002147;
    padding:15px;
    border-radius:10px;
    margin-bottom:25px;
    text-align:right;
}

.reading-progress{
    position:fixed;
    top:0;
    left:0;
    height:4px;
    width:0;
    z-index:9999;
    background:linear-gradient(
        90deg,
        #002147,
        #0A4D8C
    );
}

.back-top{
    position:fixed;
    bottom:25px;
    right:25px;
    width:55px;
    height:55px;
    border:none;
    border-radius:50%;
    background:linear-gradient(
        135deg,
        #002147,
        #003366
    );
    color:white;
    font-size:22px;
    display:none;
    z-index:999;
    box-shadow:0 10px 25px rgba(0,33,71,.25);
}

.back-top:hover{
    transform:scale(1.1);
}

@media(max-width:768px){

    .sidebar-card{
        position:relative;
        top:auto;
    }

    .legal-hero{
        padding:25px;
    }

    .legal-hero h1{
        font-size:28px;
    }
}

</style>

<div class="reading-progress" id="readingProgress"></div>

<div class="legal-hero">
    <h1>
        <i class="glyphicon glyphicon-lock"></i>
        Políticas de Privacidad y Términos de Uso
    </h1>

    <p>
        Sistema de Registro de Requerimientos Informáticos - SIRIS Cali
    </p>
</div>

	<div class="row">

		<div class="col-xs-12 col-md-4">
			<div class="panel glass-success" >
			 <div class="panel-title-modern">Enlaces de Interes</div>
			  <div class="panel-body">
			  	 <ul class="list-group">
				    <li class="list-group-item"><a href="https://www.ramajudicial.gov.co/web/consejo-superior-de-la-judicatura/portal/inicio" target="_blank">Consejo Superior de la Judicatura</a></li>
				    <li class="list-group-item"><a href="http://www.cortesuprema.gov.co/corte/" target="_blank">Corte Suprema de Justicia </a></li>
				    <li class="list-group-item"><a href="http://www.consejodeestado.gov.co/" target="_blank">Consejo de Estado</a></li>
				    <li class="list-group-item"><a href="http://www.corteconstitucional.gov.co/" target="_blank">Corte Constitucional</a></li>
				    <li class="list-group-item"><a href="https://www.fiscalia.gov.co/colombia/" target="_blank">Fiscalía General de la Nación</a></li>
				    <li class="list-group-item"><a href="https://www.procuraduria.gov.co/portal/" target="_blank">Procuraduría General de la Nación</a></li>
				    <li class="list-group-item"><a href="https://www.contraloria.gov.co/" target="_blank">Contraloría General de la Republica</a></li>
				    <li class="list-group-item"><a href="https://www.policia.gov.co/" target="_blank">Policía Nacional de Colombia</a></li>		    
				  </ul>
			  </div>
			</div>
		</div>

		<div class="col-xs-12 col-md-8">
			<div class="panel panel-success" >
			  <div class="panel-heading modern-heading">Políticas de Privacidad y Términos de Uso</div>
			  <div class="panel-body">
			  	<div class="section-header">
                    <div class="section-icon">
                        <i class="glyphicon glyphicon-lock"></i>
                    </div>
                    <h4 class="section-title">
                        POLÍTICAS DE CONFIDENCIALIDAD
                    </h4>
                </div>
			  	<div class="copyright-box"><b>SIRIS CALI Copyright © 2018. Todos los derechos reservados</b></div>
			  	 <p class="" style="text-legal">
			  	 	PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DESAJ CALI <b>“SIRISCALI”</b>. El Proceso de tecnología de diseño, así como cualquier marca y logotipo que aparezca en esta página forman parte de la identidad visual de la Rama Judicial - Acuerdo PSAA13-9858 de marzo 7 de 2013.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	Esta página Web tiene por objeto establecer una comunicación entre la Direccion Ejecutiva Seccional y el Servidor Judicial de cada uno de los Despachos Judiciales del Valle del Cauca, a través del PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI <b>“SIRISCALI”</b>. 
			  	 </p><br>
			  	 <div class="section-header">
                <div class="section-icon">
                    <i class="glyphicon glyphicon-lock"></i>
                </div>
                <h4 class="section-title">
                    CONDICIONES DE USO
                </h4>
                </div>
			  	 <p class="" style="text-legal">
			  	 	La utilización de esta página web y su contenido está sujeta a las condiciones de uso y confidencialidad de acuerdo con lo que se establece a continuación:<br><br>
					El Usuario reconoce que el ingreso de información personal, lo realiza de manera voluntaria y ante la solicitud de un requerimiento específico de un servicio técnico.

			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	El Usuario acepta que a través del registro en el Sitio Web, el PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI <b>“SIRISCALI”</b> recoge datos personales, los cuales no se cederán a terceros sin su conocimiento.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	El Usuario también comprende que los datos por él consignados harán parte de un archivo y/o base de datos que podrá ser usado por el PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI <b>“SIRISCALI”</b>, para efectos de surtir determinado reporte técnico. 
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	La información personal proporcionada por el Usuario está asegurada por una clave de acceso que sólo él conoce, por tanto, es el único responsable de mantener en secreto su clave. <b>SIRISCALI</b> se compromete a no acceder ni pretender conocer dicha clave, debido a que ninguna transmisión por Internet es absolutamente segura ni puede garantizarse dicho extremo, el Usuario asume el hipotético riesgo que ello implica, el cual acepta y conoce.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	<b>SIRISCALI</b> ha adoptado los niveles de seguridad de protección de los datos personales legalmente requeridos, instalando las medidas técnicas y organizativas necesarias para evitar la pérdida, mal uso, alteración, acceso no autorizado y robo de los datos facilitados.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	Señor usuario al acceder, navegar o usar este portal Web, usted reconoce que ha leído, entendido, y se obliga a cumplir con estos términos y con todas las leyes y reglamentos aplicables, incluida la exportación y reexportación de leyes y reglamentos de control.
			  	 </p><br>
			  	 <div class="section-header">
    <div class="section-icon">
        <i class="glyphicon glyphicon-lock"></i>
    </div>
    <h4 class="section-title">INFORMACIÓN LEGAL </h4>
</div>
			  	 <p class="" style="text-legal">
			  	 	El uso de esta página y este Aviso Legal será regulado, interpretado y cumplido de acuerdo con la Ley 1712 de 2014 que reglamenta el acceso a la Información pública Nacional y demás leyes de la República de Colombia que regulan la materia.
			  	 </p><br>
			  	 <div class="section-header">
    <div class="section-icon">
        <i class="glyphicon glyphicon-lock"></i>
    </div>
    <h4 class="section-title">DERECHO DE PROPIEDAD</h4>
</div>
			  	 <p class="" style="text-legal">
			  	 	Este portal Web incluye avisos sobre servicios y publicaciones relacionados con la gestión que tiene la Direccion Ejecutiva Seccional de Administracion Judicial. Ningún contenido de este sitio puede ser copiado, reproducido, recopilado, cargado, publicado, transmitido, distribuido, o utilizado para la creación de servicios derivados de PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI <b>“SIRISCALI”</b> sin su consentimiento previo por escrito, salvo que se le otorgue permiso para acceder y visualizar las páginas Web dentro de este sitio, únicamente para su uso personal y no comercial. Esta autorización está condicionada a no modificar el contenido mostrado en este sitio, su mantenimiento intacto, todos los derechos de autor, marcas y otros avisos de propiedad, y su aceptación de cualquiera de los términos, condiciones y avisos que acompañan al contenido o de otro tipo establecidos en este sitio. No obstante, lo anterior, cualquier material que esté disponible para su descarga, el acceso, o cualquier otra utilización de este sitio con sus propios términos de licencia, condiciones y avisos, se rige por dichos términos, condiciones y avisos. 
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	Los materiales de esta página Web están restringidos y cualquier uso no autorizado, así como el incumplimiento de los términos, condiciones o avisos contenidos en ella, pueden violar la normatividad nacional vigente al respecto. La autorización concedida para utilizar esta página se entenderá automáticamente terminada en caso de infringir cualquiera de estas condiciones, estando obligado a destruir inmediatamente cualquier material obtenido o impreso de esta página, sin perjuicio de iniciar las acciones judiciales a que haya lugar.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	La Dirección Ejecutiva Seccional de Administración Judicial de Cali Valle del Cauca, es titular de todos los derechos sobre el software de la página Web, así como de los derechos de propiedad intelectual referidos a los contenidos que en ella se incluyan, a excepción de los derechos sobre productos y servicios que no son propiedad de la Rama Judicial.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	El sitio Web puede tener enlaces a otros sitios de interés o a documentos localizados en otras páginas web de propiedad de otras entidades u organizaciones diferentes a la Rama Judicial, por lo que al momento de acceder a ellas el Usuario debe someterse a las condiciones de uso y a la política de privacidad de la página web a la que envía el link.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI <b>“SIRISCALI”</b> no concede ninguna licencia o autorización de uso de ninguna clase sobre los desarrollos intelectuales publicados en la Página Web, o sobre cualquier otra propiedad o derecho relacionado con sus contenidos, motivo por el cual no se hace responsable de la información que se halle fuera del Sitio Web.
			  	 </p><br>
			  	 <div class="section-header">
    <div class="section-icon">
        <i class="glyphicon glyphicon-lock"></i>
    </div>
    <h4 class="section-title">COMERCIALIZACIÓN</h4>
</div>
			  	 <p class="" style="text-legal">
			  	 	El usuario de esta página deberá abstenerse, sin la previa autorización escrita de PORTAL WEB SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI <b>“SIRISCALI”</b>, de publicar, retransmitir o comercializar a cualquier título o por cualquier medio, total o parcialmente, tanto la información contenida en la página, como en sus enlaces, so pena de incurrir en las responsabilidades por violación de los derechos de autor, conforme a las normas vigentes.
			  	 </p>
			  	 <p class="" style="text-legal">
			  	 	El usuario podrá hacer copia de su contenido, exclusivamente para su uso personal, no comercial, siempre y cuando se mantengan intactos todos los avisos de derechos de autor y se cite la fuente.
			  	 </p>
			  </div>
			</div>			
		</div>
	</div>

<button class="back-top" id="backTop">
    ↑
</button>

<script>

window.addEventListener('scroll',function(){

    let scrollTop =
        document.documentElement.scrollTop;

    let scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    let progress =
        (scrollTop / scrollHeight) * 100;

    document.getElementById('readingProgress').style.width =
        progress + '%';

    if(scrollTop > 250){
        document.getElementById('backTop').style.display='block';
    }else{
        document.getElementById('backTop').style.display='none';
    }
});

document.getElementById('backTop')
.addEventListener('click',function(){

    window.scrollTo({
        top:0,
        behavior:'smooth'
    });

});

</script>

@endsection

