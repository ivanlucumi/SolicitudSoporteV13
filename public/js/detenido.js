$(document).ready(function() {
   
   /* let modaldetenido = document.querySelector('#boton_crear_detenido').addEventListener('click', abrirModal);

    function abrirModal(e) {
        e.preventDefault();
        console.log('dio clic');

        $('#modal_crear_detenido').modal('show');
    }*/
    
    $('.boton_crear_detenido').click(function(e) { 
      e.preventDefault(); 
      $('#modal_crear_detenido').modal('show');
        
    });


    /** guardar detenido */

    $('.boton_guardar_detenido').click(function(e) {
        e.preventDefault();

        var form = $('#form-almacenar-detenido');
        var ruta = form.attr('action');
        var datos = form.serialize();
        //alert(ruta)

        $.ajax({
            url: ruta,
            type: 'POST',
            data: datos,
            success: function(msj) {
                $('#modal_crear_detenido').modal('hide');
                document.getElementById("form-almacenar-detenido").reset();
                window.location.reload();

            },

            error: function(msj) {
                var mensajeError = "";
                $.each(msj.responseJSON.errors, function(i, field) {
                    mensajeError += "<li>" + field + "</li>"
                        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
                    console.log(mensajeError)
                });
                $("#msj-error").html("<ul>" + mensajeError + "</ul>").fadeIn();


            },

        });
    });


    //borrar referencia familiar
    //
    $('.boton_delete_detenido').click(function(e) {
        e.preventDefault();

        var row = $(this).parents('tbody')
        var id = row.data('id');
        var form = $('#form-delete-detenido');
        var url = form.attr('action').replace(':DETENIDO_ID', id);
        var data = form.serialize();

        //alert();

        $.post(url, data, function(result) {
            row.fadeOut();
            toastr.success('REFERENCIA ELIMINADA CORRECTAMENTE!!');


        });

    });




});