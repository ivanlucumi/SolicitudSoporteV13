$(document).ready(function() {
    //ACEPTAR SOLO NUMERO EN INPUTS
    //funcion para solo permitir ingreso de valores numericos
    let numerico = document.querySelector('#nProceso').addEventListener('keypress', validaNumericos);

    function validaNumericos(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }

   /* let numerico2 = document.querySelector('#nProceso2').addEventListener('keypress', validaNumericos2);

    function validaNumericos2(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }*/
    // verificar que sea un total de 23 digitos


    /* function validarcantidad(catidad) {
         var maxLength = 23;
         var strLength = catidad.value.length;
         if (strLength > maxLength) {
             document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + strLength + ' de ' + maxLength + ' dígitos</span></strong>';
         }
         if (strLength === maxLength) {
             document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
         } else {
             document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + strLength + ' de ' + maxLength + ' dígitos</span></strong>';
         }
     }

     //validar email   poner esto en el input email'onchange'=>"return ValidarEmail(this)"
     function ValidarEmail(mail) {
         if (mail.value.indexOf("@cendoj.ramajudicial.gov.co") == -1) {
             alert("Correo inválido")
             mail.focus()
             mail.select()
         }
     }
     */

    /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })


    //verificar los 23 digitos
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })
    
 


    //revisar si la audiencia es con el detenido


    /*var toggle = document.querySelector(".cambio-checkbox");
    var body = document.querySelector("body");

    toggle.addEventListener('change', function() {
        //body.style.background = this.checked ? "#2E2E2E" : "initial";
        document.getElementById("informacion_detenido").innerHTML = `
                    <div class="col-xs-12 col-sm-6  form-group"  >
                    <label >Identificacion detenido:</label>
                    <input class="form-control bg-light border-0 shadow" placeholder="Profesión" name="cedula-detenido" type="number">
                    </div>
                      
                     <div class="col-xs-12 col-sm-6  form-group"  >
                              <label >Nombre Detenido:</label>
                              <input class="form-control bg-light border-0 shadow" placeholder="Profesión" name="nombe-detenido">
                     </div>
                     <div class="col-xs-12 col-sm-6  form-group"  >
                              <label >Ciudad Detención:</label>
                              <input class="form-control bg-light border-0 shadow" placeholder="Profesión" name="ciudad-detencion">
                     </div>
                     <div class="col-xs-12 col-sm-6  form-group"  >
                              <label >Nombre Establecimiento:</label>
                              <input class="form-control bg-light border-0 shadow" placeholder="Profesión" name="establecimiento-carcelario">
                     </div>
             </div>`;
    });*/

    var Capturar = function() {
        let lstNumero = document.getElementsByClassName("numero"),
            arrayGuardar = {};
        for (var i = 0; i < lstNumero.length; i++) {
            arrayGuardar[i] = lstNumero[i].value;
            console.log(lstNumero[i].value);
        }
    }

    (function($) {
        $(function() {
            $('#timeini').timepicker({
                timeFormat: 'hh:mm p',
                // year, month, day and seconds are not important
                minTime: new Date(0, 0, 0, 8, 0, 0),
                maxTime: new Date(0, 0, 0, 15, 0, 0),
                // time entries start being generated at 6AM but the plugin 
                // shows only those within the [minTime, maxTime] interval
                startHour: 6,
                // the value of the first item in the dropdown, when the input
                // field is empty. This overrides the startHour and startMinute 
                // options
                startTime: new Date(0, 0, 0, 8, 20, 0),
                // items in the dropdown are separated by at interval minutes
                interval: 10,
                change: function(time) {
                    var element = $(this),
                        text, color;
                    var timepicker = element.timepicker();

                    color = '#' + (~~(Math.random() * 16777215)).toString(16);
                    element.css({ 'background': color });
                }
            });
        });
    });












});