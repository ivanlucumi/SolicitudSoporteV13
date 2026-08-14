      //EMPLEADO
     
    var verifCedula = document.getElementById('cedula');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            console.log(response[0].nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre').value = response[0].nameE;
                document.getElementById('apellido').value = response[0].lastnameE;
                document.getElementById('cargo').value = response[0].cargo_titular;
                
                document.getElementById('telefono').value = response[0].telefono;
                document.getElementById('direccion').value = response[0].direccion;
            } else {
                document.getElementById('nombre').value = "";
                document.getElementById('apellido').value = "";
                document.getElementById('cargo').value = "";
            }
            $("#despacho").val(response[0].cod_despacho);
            $("#ciudad").val(response[0].nombreCiudad);
            
            
        });
    });
    
    
    
    //EQUIPO DE SOPORTE
    
     var verifPlaca = document.getElementById('placa');
    verifPlaca.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/inventario/" + this.value + "", function(response, juzgado) {

            console.log(response.serial)
           if (Object.keys(response).length > 0) {
                document.getElementById('serial_equipo').value = response.serial;
                document.getElementById('marca_equipo').value = response.marca;
                document.getElementById('modelo_equipo').value = response.modelo;
            } else {
                document.getElementById('serial_equipo').value = "";
                document.getElementById('marca_equipo').value = "";
                document.getElementById('modelo_equipo').value = "";
            }
          //  $("#despacho").val(response.cod_despacho);
            
            
        });
    });
    
  
    
    /*jQuery(document).ready(function() {
        jQuery('.input_apellido').keypress(function(tecla) {
        if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 'Alt'+165)) return false;
        });
    });*/
    
    $(".input_apellido").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
     $(".input_nombre").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
    //mostrar div
    function requerid() {
        document.getElementById("id_elementos_de_soporte").removeAttribute("display:none");
         $('#id_elementos_de_soporte').css('display', '');
         $('#id_elementos_de_soporte').css('visibility', 'visible');
  
        // Resetear, por si acaso has estado jugando con la otra propiedad
     // $('#id_elementos_de_soporte').css('visibility', 'visible');
       /*if( $('#id_elementos_de_soporte').css('visibility') != 'hidden' ) {
            $('id_elementos_de_soporte').css('visibility', 'visible');
          } else {
            $('#id_elementos_de_soporte').css('visibility', 'visible');
          }*/
        //PonerProp();
        
    }
    
    //mostrar div
    function no_requerid() {
          if( $('#id_elementos_de_soporte').is(":visible") ) {
            $('#id_elementos_de_soporte').css('display', 'none'); 
          } else {
            $('#id_elementos_de_soporte').css('display', 'none');
          }
          document.getElementById("elemeto_soporte").removeAttribute("required"); 
        quitarprovpropi();
        
    }
    
     //mostrar div
    function otro_tipo(e) {
        console.log(e)
        
        if(e == "OTRO"){
            if( $('#elemeto_soporte').is(":visible") ) {
            $('#elemeto_soporte').css('display', 'block'); 
          } else {
            $('#elemeto_soporte').css('display', 'block');
          }
            document.getElementById("elemeto_soporte").setAttribute("required",'True');
             CPU_SERVIDOR();
            $('#oc_sistema_operativo_soporte').css('display', '');
            $('#oc_memoria_soporte').css('display', '');
            $('#oc_disco_soporte').css('display', '');
            $('#oc_procesador_soporte').css('display', '');
        }else{
            
          document.getElementById("elemeto_soporte").removeAttribute("required"); 
          if( $('#elemeto_soporte').is(":visible") ) {
            $('#elemeto_soporte').css('display', 'none'); 
          } else {
            $('#elemeto_soporte').css('display', 'none');
          }
        }
        
        if(e == "CPU" || e == "SERVIDOR"){
            CPU_SERVIDOR();
            $('#oc_sistema_operativo_soporte').css('display', '');
            $('#oc_memoria_soporte').css('display', '');
            $('#oc_disco_soporte').css('display', '');
            $('#oc_procesador_soporte').css('display', '');
        }
        
        if(e == "MONITOR" || e == "TECLADO" || e == "MOUSE"){
            quitarprovpropi();
            $('#oc_sistema_operativo_soporte').css('display', 'none');
            $('#oc_memoria_soporte').css('display', 'none');
            $('#oc_disco_soporte').css('display', 'none');
            $('#oc_procesador_soporte').css('display', 'none');
            
            EQUIPOS_SIN_SO();
        }
        
        
        
        
    }
    
    
        //poner atributos
    function CPU_SERVIDOR(){
      document.getElementById("placa_soporte").setAttribute("required",'True');
        document.getElementById("serial_equipo_soporte").setAttribute("required",'True');
        document.getElementById("marca_equipo_soporte").setAttribute("required",'True');
        document.getElementById("modelo_equipo_soporte").setAttribute("required",'True');
        document.getElementById("sistema_operativo_soporte").setAttribute("required",'True');
        document.getElementById("memoria_soporte").setAttribute("required",'True');
        document.getElementById("disco_soporte").setAttribute("required",'True');
        document.getElementById("procesador_soporte").setAttribute("required",'True');
        document.getElementById("tipo_equipo_soporte").setAttribute("required",'True');
        document.getElementById("nombre_equipo_soporte").setAttribute("required",'True');
      
}
function EQUIPOS_SIN_SO(){
      document.getElementById("placa_soporte").setAttribute("required",'True');
        document.getElementById("serial_equipo_soporte").setAttribute("required",'True');
        document.getElementById("marca_equipo_soporte").setAttribute("required",'True');
        document.getElementById("modelo_equipo_soporte").setAttribute("required",'True');
        //document.getElementById("sistema_operativo_soporte").setAttribute("required",'True');
        //document.getElementById("memoria_soporte").setAttribute("required",'True');
        //document.getElementById("disco_soporte").setAttribute("required",'True');
        //document.getElementById("procesador_soporte").setAttribute("required",'True');
        document.getElementById("tipo_equipo_soporte").setAttribute("required",'True');
        document.getElementById("nombre_equipo_soporte").setAttribute("required",'True');
      
}

function quitarprovpropi(){
        document.getElementById("placa_soporte").removeAttribute("required");
        document.getElementById("serial_equipo_soporte").removeAttribute("required");
        document.getElementById("marca_equipo_soporte").removeAttribute("required");
        document.getElementById("modelo_equipo_soporte").removeAttribute("required");
        document.getElementById("sistema_operativo_soporte").removeAttribute("required");
        document.getElementById("memoria_soporte").removeAttribute("required");
        document.getElementById("disco_soporte").removeAttribute("required");
        document.getElementById("procesador_soporte").removeAttribute("required");
        document.getElementById("tipo_equipo_soporte").removeAttribute("required");
        document.getElementById("nombre_equipo_soporte").removeAttribute("required");
    }
    
    