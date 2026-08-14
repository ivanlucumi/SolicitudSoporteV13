$(document).ready(function() {

function ponleFocus(){
    //autofocus
    document.getElementById("cedulaIngreso").focus();
    console.log('hola, ingreso')
}

const regist = document.getElementById('tipo_sangre');
regist.addEventListener('change', registrarVisita);

function registrarVisita(e) {
    e.preventDefault();
    var cedulaIng = $('#cedulaIngreso').val();
    var primer_ap = $('#primer_ap').val();
    var segundo_ap = $('#segundo_ap').val();
    var primer_nomb = $('#primer_nomb').val();
    var segundo_nomb = $('#segundo_nomb').val();
    var sexo = $('#sexo').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var tipo_sangre = $('#tipo_sangre').val();

    $('#vis_identificacion').val(parseInt(cedulaIng));
    $('#vis_fullname').val(primer_nomb.trimEnd()+" "+segundo_nomb.trimEnd()+" "+primer_ap.trimEnd()+" "+segundo_ap.trimEnd());       
    $('#vis_sexo').val(sexo); 
    $('#vis_fecha_nacimiento').val(fecha_nacimiento);
    $('#vis_tipo_sangre').val(tipo_sangre);
    //alert('hola')
    $('#modal_registrar_visitas').modal('show');

    //borrar valores
    $('#cedulaIngreso').val("");
    $('#primer_ap').val("");       
    $('#segundo_ap').val(""); 
    $('#primer_nomb').val("");
    $('#segundo_nomb').val(""); 
    $('#sexo').val(""); 
    $('#fecha_nacimiento').val(""); 
    $('#tipo_sangre').val(""); 
    //autofocus
    document.getElementById("cedulaIngreso").focus();
}

$('#BRegisVist').click(function(e) {
    e.preventDefault();
     var cedulaIng = $('#cedulaIngreso').val();
    var primer_ap = $('#primer_ap').val();
    var segundo_ap = $('#segundo_ap').val();
    var primer_nomb = $('#primer_nomb').val();
    var segundo_nomb = $('#segundo_nomb').val();
    var sexo = $('#sexo').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var tipo_sangre = $('#tipo_sangre').val();

    $('#vis_identificacion').val(parseInt(cedulaIng));
    $('#vis_fullname').val(primer_nomb.trimEnd()+" "+segundo_nomb.trimEnd()+" "+primer_ap.trimEnd()+" "+segundo_ap.trimEnd());       
    $('#vis_sexo').val(sexo); 
    $('#vis_fecha_nacimiento').val(fecha_nacimiento);
    $('#vis_tipo_sangre').val(tipo_sangre);
    //alert('hola')
    $('#modal_registrar_visitas').modal('show');

    //borrar valores
    $('#cedulaIngreso').val("");
    $('#primer_ap').val("");       
    $('#segundo_ap').val(""); 
    $('#primer_nomb').val("");
    $('#segundo_nomb').val(""); 
    $('#sexo').val(""); 
    $('#fecha_nacimiento').val(""); 
    $('#tipo_sangre').val(""); 
    //autofocus
    document.getElementById("cedulaIngreso").focus();
    
});

$('#BorrarVista').click(function(e) {
    e.preventDefault();
    console.log('hola')

    //borrar valores
    $('#cedulaIngreso').val("");
    $('#primer_ap').val("");       
    $('#segundo_ap').val(""); 
    $('#primer_nomb').val("");
    $('#segundo_nomb').val(""); 
    $('#sexo').val(""); 
    $('#fecha_nacimiento').val(""); 
    $('#tipo_sangre').val(""); 
    //autofocus
    $('#modal_registrar_visitas').modal('hide');
    document.getElementById("cedulaIngreso").focus();

});

function BCancelarIngreso(e) {
    e.preventDefault();
    console.log('hola')

    //borrar valores
    $('#cedulaIngreso').val("");
    $('#primer_ap').val("");       
    $('#segundo_ap').val(""); 
    $('#primer_nomb').val("");
    $('#segundo_nomb').val(""); 
    $('#sexo').val(""); 
    $('#fecha_nacimiento').val(""); 
    $('#tipo_sangre').val(""); 
    //autofocus
    $('#modal_registrar_visitas').modal('hide');
    document.getElementById("cedulaIngreso").focus();

}





});
