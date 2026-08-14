$(document).ready(function() {

    /*			 beforeSend: function(objeto){
    			$("#loader").html("<img src='loader.gif'>");
                } */




    $('.boton_revisar_solicitud').click(function(e) {
        e.preventDefault();

        var row = $(this).parents('tbody');
        var id = row.data('id');
        var form = $('#form-visualizar-solicitud');
        var url = form.attr('action').replace(':SOLICITUD_ID', id);
        //alert(url);
        var data = form.serialize();

        $.get(url, function(result) {
            //alert(result.fecha_prgramada);
            console.log(result.id);
            $("#idsoli").val(result.id);
            $("#fecha_prgramada").val(result.fecha_prgramada);
            $("#hora_inicio").val(result.hora_inicio);
            $("#hora_fin").val(result.hora_fin);
            $("#email").val(result.email);
            $("#nombre_entidad").val(result.nombre_entidad);
            $("#ciudad_destino").val(result.ciudad_destino);
            $("#entidad_destino").val(result.entidad_destino);
            $("#numero_radicado_proceso").val(result.numero_radicado_proceso);
            $("#declarante_indiciado").val(result.declarante_indiciado);
            $("#direccion").val(result.direccion);
            $("#telefono").val(result.telefono);
            $('#modal_revisar_solicitud').modal('show');
        });

    });



    /** revisar  solicitudes */
    $('.boton-asignar-tecnico-audienciaV').click(function(e) {
        e.preventDefault();

        var row = $(this).parents('tbody');
        var id = row.data('id');

        var form = $('#form-verificar-disponibilidad');

        //var url = form.attr('action').replace(':ESTADO_ID', id);

        var url = "/tecnico/verificar/estado/pen-4879" + id + "56932"
            //alert(url)
        var data = form.serialize();

        $.get(url, function(result) {
            if (result == 1) {
                alert('Debe seleccionar otra solicitud, la actual ya ha sido asignada');
            }
            window.location.reload();

        });

    });


    //metodo para alacenar solicitud de audiencia virtual

    $('.boton-almacenar-audienciaV').click(function(e) {
        e.preventDefault();


        //var row = $(this).parents('tbody')
        //var id = row.data('id');
        //alert($('#inputUrl' + id).val().length);

       /* if ($('#inputUrl' + id).val().length == 0 || $('#inputId' + id).val().length == 0) {
            alert('Verifique que campos no esten vacios!');
            document.getElementById("input-id" + id).focus();
            document.getElementById("input-url" + id).focus();
            return false;
        }*/

        var row = $(this).parents('tbody')
        var id = row.data('id');
        var form = $('#form-almacenar-solicitud-tecnico');
        var url = form.attr('action').replace(':SOLICITUD_ID', id);
        //alert(url);
        var datos = form.serialize();

        $.ajax({
            url: url,
            type: 'put',
            data: datos,
            success: function(response) {
                row.fadeOut();
                //window.location.reload();
            },
            error: function(msj) {
                var mensajeError = "";
                $.each(msj.responseJSON.errors, function(i, field) {
                    mensajeError += "<li>" + field + "</li>"
                });
                $("#msj-error").html("<ul>" + mensajeError + "</ul>").fadeIn();


            },

        });

    });


















});