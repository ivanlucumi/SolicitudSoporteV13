$(document).ready(function(){
	$('#demandante').on('change',function(){
		console.log($('input[name=demandante1]:checked').val());
	});	
});


$(document).ready(function() {

    
  $('#informacion_pdf').click(function(e) {
        e.preventDefault();
        var radicado_id = $("input#radicado_id").val();
        var cantidad_paginas = $("input#cantidad_paginas").val();
        var nombre_pdf = $("input#nombre_pdf").val();
        var dataString = 'cantidad_paginas='+ cantidad_paginas + '&nombre_pdf=' + nombre_pdf + '&radicado_id=' + radicado_id;
 // alert (dataString);
        
  
   $.ajax({
       
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            url: "/revision/proceso/digitalizacion/supervision/protocolo/dos/save/" + radicado_id,
            data: dataString,
            success: function(data) {
                
            $("#cantidad_paginas").val("");
            $("#nombre_pdf").val("");
            
            //console.log(data[0])
            
            //$('#id_pdfs').setAttribute('data-id',  data[0].id);
            var d = document.getElementById("id_pdfs");  //   Javascript
                d.setAttribute('data-id' , data[0].id);
                
            
            $('#id_pdfs').append('<tr><td>' + data[0].nombre_pdf + 
                                           '</td><td>' + data[0].cantidad_paginas + 
                                           '</td><td>'+

                              '<a id="eliminarPfd" class="btn btn-danger  bnt-xs fa fa-trash fa-lg eliminarPfd"></a>' 
                            
                     
                        + '</td></tr>');
            
                
             document.querySelector('#total_paginas').innerText = data[1];
             
             window.location.reload(); 
             
             //d.removeAttribute('id');
            }
        });
  
  return false;
  });
  
  

  
   //BORRRAR DATOS DE PDF
$('.eliminarPfd').click(function(e) {       
       e.preventDefault();

       var row = $(this).parents('tbody')
       
       //alert(row)
       var id = row.data('id');
       var form = $('#form-delete-PDF');
       var url = form.attr('action').replace(':PDF_ID', id);
       var data = form.serialize();
     
     //alert();
       row.fadeOut();
      $.post(url, data, function(result){
        
        document.querySelector('#total_paginas').innerText = result;
        
       });

     });

    });
