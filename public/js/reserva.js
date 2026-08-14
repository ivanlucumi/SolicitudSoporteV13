$('.crear_reserva').click(function(e) { 
      e.preventDefault(); 

$('#modal_crear_reserva').modal('show');
});


//BOTON ALMACENAR reserva
 $('.boton_almacenar_reserva').click(function(e) { 
  e.preventDefault();
  	
       var form = $('#form-almacenar-reserva');
       var ruta = form.attr('action');
       var datos = form.serialize();
      
      $.ajax({
        url:ruta,
        type:'POST',
        data:datos,
        success:function(msj) {
          $('#modal_crear_reserva').modal('hide');
        document.getElementById("form-almacenar-reserva").reset();        
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


 //mostrar informacion en el modal de la reserva a editar
$('.editar_reserva').click(function(e) { 
    e.preventDefault();           
    var row = $(this).parents('tbody')
    var id = row.data('id'); //alert(id);
    var form = $('#form-edit-reserva');
    var url = form.attr('action').replace(':RESERVA_ID', id);
    var data = form.serialize();

       //alert(id);
    $.get(url, function(result){
        //alert(result);
        console.log(result);
        $("#idE").val(result.id);
        $("#nombre_reserva").val(result.t_nombre);  
        $('#modal_editar_reserva').modal('show');
    });
});

 

//ACTUALIZAR reserva
 $('.boton_update_reserva').click(function(e) { 
  	e.preventDefault(); 	
 	var id = $('#idE').val();
 	  
$.ajax({
    //ruta manual
    url:'/administrador/reservas-update/'+ id,
        type:'PUT',
        data:{
            '_token': $('input[name=_token]').val(),
            't_nombre': $('#nombre_reserva').val(),
        },
        success:function(result) {
        	$('#modal_editar_reserva').modal('hide');
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