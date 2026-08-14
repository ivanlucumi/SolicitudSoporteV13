$('.crear_torre').click(function(e) { 
      e.preventDefault(); 

$('#modal_crear_torre').modal('show');
});


//BOTON ALMACENAR torre
 $('.boton_almacenar_torre').click(function(e) { 
  e.preventDefault();
  	
       var form = $('#form-almacenar-torre');
       var ruta = form.attr('action');
       var datos = form.serialize();
      
      $.ajax({
        url:ruta,
        type:'POST',
        data:datos,
        success:function(msj) {
          $('#modal_crear_torre').modal('hide');
        document.getElementById("form-almacenar-torre").reset();        
        window.location.reload();
        },

         error:function(msj) {
          var mensajeError = "";
          $.each(msj.responseJSON.errors,function(i,field){
            mensajeError += "<li>"+field+"</li>"
           //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
           console.log(mensajeError)
                 });
          $("#msj-error").html("<ul>"+mensajeError+"</ul>").fadeIn();
        },       
      });
  });


 //mostrar informacion en el modal de la torre a editar
$('.editar_torre').click(function(e) { 
    e.preventDefault();           
    var row = $(this).parents('tbody')
    var id = row.data('id'); //alert(id);
    var form = $('#form-edit-torre');
    var url = form.attr('action').replace(':TORRE_ID', id);
    var data = form.serialize();

       //alert(id);
    $.get(url, function(result){
        //alert(result);
        console.log(result);
        $("#idE").val(result.id);
        $("#nombre_torre").val(result.t_nombre);  
        $('#modal_editar_torre').modal('show');
    });
});

 

//ACTUALIZAR torre
 $('.boton_update_torre').click(function(e) { 
  	e.preventDefault(); 	
 	var id = $('#idE').val();
 	  
$.ajax({
    //ruta manual
    url:'/administrador/torres-update/'+ id,
        type:'PUT',
        data:{
            '_token': $('input[name=_token]').val(),
            't_nombre': $('#nombre_torre').val(),
        },
        success:function(result) {
        	$('#modal_editar_torre').modal('hide');
        	window.location.reload(); 
        },

        error:function(result) {          
          	var mensajeError = "";
          	$.each(result.responseJSON.errors,function(i,field){
            	mensajeError += "<li>"+field+"</li>"
           		//$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
           		console.log(mensajeError)
        	});
          	$("#msj-error").html("<ul>"+mensajeError+"</ul>").fadeIn();         
        },       
    });
});
 /*****************************************/

 $('.crear_pisos').click(function(e) { 
      e.preventDefault(); 

$('#modal_crear_pisos').modal('show');
});


//BOTON ALMACENAR torre
 $('.boton_almacenar_pisos').click(function(e) { 
  e.preventDefault();
  	
       var form = $('#form-almacenar-pisos');
       var ruta = form.attr('action');
       var datos = form.serialize();
      
      $.ajax({
        url:ruta,
        type:'POST',
        data:datos,
        success:function(msj) {
          $('#modal_crear_pisos').modal('hide');
        document.getElementById("form-almacenar-pisos").reset();        
        window.location.reload();
        },

         error:function(msj) {
          var mensajeError = "";
          $.each(msj.responseJSON.errors,function(i,field){
            mensajeError += "<li>"+field+"</li>"
           //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
           console.log(mensajeError)
                 });
          $("#msj-error").html("<ul>"+mensajeError+"</ul>").fadeIn();
        },       
      });
  });


 //mostrar informacion en el modal de la pisos a editar
$('.editar_pisos').click(function(e) { 
    e.preventDefault();           
    var row = $(this).parents('tbody')
    var id = row.data('id'); //alert(id);
    var form = $('#form-edit-pisos');
    var url = form.attr('action').replace(':PISOS_ID', id);
    var data = form.serialize();

       //alert(id);
    $.get(url, function(result){
        //alert(result);
        console.log(result);
        $("#idE").val(result.id);
        $("#nombre_piso").val(result.p_nombre);  
        $("#id_torre").val(result.p_torre);  
        $('#modal_editar_pisos').modal('show');
    });
});

 

//ACTUALIZAR pisos
 $('.boton_update_pisos').click(function(e) { 
  	e.preventDefault(); 	
 	var id = $('#idE').val();
 	  
$.ajax({
    //ruta manual
    url:'/administrador/pisos-update/'+ id,
        type:'PUT',
        data:{
            '_token': $('input[name=_token]').val(),
            'p_nombre': $('#nombre_piso').val(),
            'p_torre': $('#id_torre').val(),
        },
        success:function(result) {
        	$('#modal_editar_pisos').modal('hide');
        	window.location.reload(); 
        },

        error:function(result) {          
          	var mensajeError = "";
          	$.each(result.responseJSON.errors,function(i,field){
            	mensajeError += "<li>"+field+"</li>"
           		//$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
           		console.log(mensajeError)
        	});
          	$("#msj-error-piso").html("<ul>"+mensajeError+"</ul>").fadeIn();         
        },       
    });
});


/*****************************************/

 $('.crear_salas').click(function(e) { 
      e.preventDefault(); 

$('#modal_crear_salas').modal('show');
});


//BOTON ALMACENAR torre
 $('.boton_almacenar_salas').click(function(e) { 
  e.preventDefault();
    
       var form = $('#form-almacenar-salas');
       var ruta = form.attr('action');
       var datos = form.serialize();
      
      $.ajax({
        url:ruta,
        type:'POST',
        data:datos,
        success:function(msj) {
          $('#modal_crear_salas').modal('hide');
        document.getElementById("form-almacenar-salas").reset();        
        window.location.reload();
        },

         error:function(msj) {
          var mensajeError = "";
          $.each(msj.responseJSON.errors,function(i,field){
            mensajeError += "<li>"+field+"</li>"
           //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
           console.log(mensajeError)
                 });
          $("#msj-error").html("<ul>"+mensajeError+"</ul>").fadeIn();
        },       
      });
  });


 //mostrar informacion en el modal de la salas a editar
$('.editar_salas').click(function(e) { 
    e.preventDefault();           
    var row = $(this).parents('tbody')
    var id = row.data('id'); //alert(id);
    var form = $('#form-edit-salas');
    var url = form.attr('action').replace(':SALAS_ID', id);
    var data = form.serialize();

       //alert(id);
    $.get(url, function(result){
        //alert(result);
        console.log(result);
        $("#idE").val(result.id);
        $("#nombre_sala").val(result.s_nombre);  
        $("#id_piso").val(result.s_piso);  
        $('#modal_editar_salas').modal('show');
    });
});

 

//ACTUALIZAR pisos
 $('.boton_update_pisos').click(function(e) { 
    e.preventDefault();   
  var id = $('#idE').val();
    
$.ajax({
    //ruta manual
    url:'/administrador/pisos-update/'+ id,
        type:'PUT',
        data:{
            '_token': $('input[name=_token]').val(),
            's_nombre': $('#nombre_sala').val(),
            's_piso': $('#id_piso').val(),
        },
        success:function(result) {
          $('#modal_editar_pisos').modal('hide');
          window.location.reload(); 
        },

        error:function(result) {          
            var mensajeError = "";
            $.each(result.responseJSON.errors,function(i,field){
              mensajeError += "<li>"+field+"</li>"
              //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
              console.log(mensajeError)
          });
            $("#msj-error-piso").html("<ul>"+mensajeError+"</ul>").fadeIn();         
        },       
    });
});