@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Encuentas Uso de Aplicativos')
@section('cabecera', 'Encuentas Uso de Aplicativos')

@section('content') 

<style>
    .hidden-form {
      display: none;
    }
  </style>
  
   <div class="container-fluid well well-sm">
    <h2 class="text-center"><strong>Encuesta Uso Aplicaciones para Expedientes</strong></h2>
    <hr>
    <form id="dynamicForm" action="{{ route('encuesta.saveEncuentas') }}" method="POST">
      <!-- Token CSRF para Laravel -->
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <h3><label>Indique qu&eacute; aplicativos utiliza para el manejo de expedientes electr&oacute;nicos (puede seleccionar m&aacute;s de uno).</label></h3>
        <div class="checkbox" required>
          <label>
            <input type="checkbox" class="app-checkbox" name="aplicativo[]" id="onedrive" value="onedrive" onclick="toggleForm('onedrive')" > Onedrive
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" class="app-checkbox" name="aplicativo[]" id="sharepoint" value="sharepoint" onclick="toggleForm('sharepoint') "> SharePoint
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" class="app-checkbox" name="aplicativo[]" id="sgde" value="sgde" onclick="toggleForm('sgde')" > SGDE
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" class="app-checkbox" name="aplicativo[]" id="siugj" value="siugj" onclick="toggleForm('siugj')" > SIUGJ (LABORAL)
          </label>
        </div>
      </div>

      <!-- Contenedor para los formularios dinámicos -->
      <div id="dynamicFields">
        <!-- Formulario SGDE -->
        <div id="form-sgde" class="hidden-form well well-sm">
          <h4>Formulario SGDE</h4>
          <div class="form-group">
            <label for="expedientes-sgde">Cantidad de expedientes:</label>
            <input type="number" name="cantidadExpedientesSgde" id="expedientes-sgde" class="form-control" min="1">
          </div>
          <div class="form-group">
            <label for="capacitacion-sgde">Ha recibido Capacitacion SGDE:</label>
            <div class="radio">
              <label><input type="radio" name="capacitacionsgde" value="si" > Sí</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="capacitacionsgde" value="no" > No</label>
            </div>
          </div>
         
          
          <div class="form-group">
            <label for="expedientes-sgde">Señale los inconvenientes que ha evidenciado en el uso del SGDE:</label>
            <ul>
                <li>
                  <input type="checkbox" id="agreeTerms" name="problemas[]" value="El aplicativo S.G.D.E. refleja expedientes que son ajenos al despacho">
                  <label for="problema1">El aplicativo S.G.D.E. refleja expedientes que son ajenos al despacho</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms" name="problemas[]" value="Expedientes que fueron migrados se encuentran incompletos">
                  <label for="problema2">Expedientes que fueron migrados se encuentran incompletos</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms" name="problemas[]" value="Problemas para realizar traslados de expedientes a otro juzgado o a la oficina de apoyo">
                  <label for="problema3">Problemas para realizar traslados de expedientes a otro juzgado o a la oficina de apoyo</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms" name="problemas[]" value="Se encuentran en desorden los anexos de los expedientes que fueron migrados">
                  <label for="problema4">Se encuentran en desorden los anexos de los expedientes que fueron migrados</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms" name="problemas[]" value="El SGDE no reporta las notificaciones al instante">
                   <label for="problema5">Retraso en la notificaciones en las aciones del SGDE</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms" name="problemas[]" value="Las subseries no corresponden al tipo de procesos">
                  <label for="problema6">Las subseries no corresponden al tipo de procesos</label>
                </li>
              </ul>
          </div>
         <div class="form-group">
            <label for="expedientes-siugj">Otros Inconvenientes Presentandos con el SGDE:</label>
             <textarea id="comentarioSGDE" name="problemasSGDE" rows="5" cols="40" placeholder="Escribe tu mensaje aquí..." id="problemas-SGDE" class="form-control"></textarea>
   
          </div> 
          
          
        </div>

        <!-- Formulario SIUGJ -->
        <div id="form-siugj" class="hidden-form well well-sm">
          <h4>Formulario SIUGJ (LABORAL)</h4>
          <div class="form-group">
            <label for="expedientes-siugj">Cantidad de expedientes:</label>
            <input type="number" name="cantidadExpedientesSiugj" id="expedientes-siugj" class="form-control" min="1" >
          </div>
           <div class="form-group">
            <label for="expedientes-sgde">Señale los inconvenientes que ha evidenciado en el uso del SIUGJ (ESPECIALIDAD LABORAL):</label>
            <ul>
                <li>
                  <input type="checkbox" id="agreeTerms2" name="problemasiugj[]" value="Lentitud en el registro de informacion">
                  <label for="problemas1">Lentitud en el registro de informacion</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms2" name="problemasiugj[]" value="Problemas para registrarse o acceder al aplicativo">
                  <label for="problemas2">Problemas para registrarse o acceder al aplicativo</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms2" name="problemasiugj[]" value="Se cierra la sesión muy pronto">
                  <label for="problemas3">Se cierra la sesion muy pronto</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms2" name="problemasiugj[]" value="Para hacer el recepción de la demanda es obligatorio la fecha de expedición y en la norma no lo es">
                  <label for="problemas4">Para hacer el recepción de la demanda es obligatorio la fecha de expedición y en la norma no lo es</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms2" name="problemasiugj[]" value="Se demora en el cargue de documentos">
                  <label for="problemas5">Se demora en el cargue de documentos</label>
                </li>
                <li>
                  <input type="checkbox" id="agreeTerms2" name="problemasiugj[]" value="La verificación de la cédula o RUT, en algunos casos, puede presentar demoras o no proporcionar los datos esperadoss">
                  <label for="problemas7">La verificación de la cédula o RUT, en algunos casos, puede presentar demoras o no proporcionar los datos esperados</label>
                </li>
              </ul>
          </div>
           <div class="form-group">
            <label for="expedientes-siugj">Otros Inconvenientes Presentandos con el SIUGJ:</label>
             <textarea id="comentario" name="otros_problemasiugj" rows="5" cols="40" placeholder="Escribe tu mensaje aquí..." id="problemas-siugj" class="form-control"></textarea>
   
          </div>
        </div>

        <!-- Formulario Onedrive -->
        <div id="form-onedrive" class="hidden-form well well-sm">
          <h4>Formulario Onedrive</h4>
          <div class="form-group">
            <label for="expedientes-onedrive">Cantidad de expedientes Activos y sin Sentencia:</label>
            <input type="number" name="cantidadExpedientesOneDrive" id="expedientes-onedrive" class="form-control" min="1">
          </div>
        </div>

        <!-- Formulario SharePoint -->
        <div id="form-sharepoint" class="hidden-form well well-sm">
          <h4>Formulario SharePoint</h4>
          <div class="form-group">
            <label for="expedientes-sharepoint">Cantidad de expedientes Activos y sin Sentencia:</label>
            <input type="number" name="cantidadExpedientesSharePoint" id="expedientes-sharepoint" class="form-control" min="1">
          </div>
        </div>
      </div>
      
      
      
      <hr>
       <div class="form-group">
           <div class="mb-3">
              <label class="form-label">Solicitud Creacion Usuario Plataforma SIUGJ - SGDE</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="hasUsers" id="usersYes" value="si" required>
                  <label class="form-check-label" for="usersYes">Sí</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="hasUsers" id="usersNo" value="no" required>
                  <label class="form-check-label" for="usersNo">No</label>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Formulario de creación de usuarios (inicialmente oculto) -->
            <div id="userCreationForm" class="d-none hidden well well-sm">
              <h5>Datos de usuarios a crear</h5>
              <div id="userFields">
                <!-- Primer formulario de usuario -->
                <div class="userForm mb-3">
                    <label>Aplicativo donde va a crear los usuarios:</label><br>
                    <select class="form-control" name="usuario[]">
                        <option value="">Seleccione una opción</option>
                        <option value="siugj">SIUGJ(LABORAL)</option>
                        <option value="sgde">SGDE</option>
                    </select>
                </div>
                <div class="userForm mb-3">
                  <label for="userCedula" class="form-label">Cédula:</label>
                  <input type="text" name="userCedula[]" class="form-control">
                </div>
                <div class="userForm mb-3">
                  <label for="userName" class="form-label">Nombre:</label>
                  <input type="text" name="userName[]" class="form-control">
                </div>
                <div class="userForm mb-3">
                  <label for="userEmail" class="form-label">Correo:</label>
                  <input type="email" name="userEmail[]" class="form-control">
                </div>
                <div class="userForm mb-3">
                  <label for="userDomain" class="form-label">Usuario de dominio:</label>
                  <input type="text" name="userDomain[]" class="form-control">
                </div>
                <div class="userForm mb-3">
                  <label for="userPosition" class="form-label">Cargo:</label>
                  <input type="text" name="userCargo[]" class="form-control">
                </div>
                <!-- Botón para eliminar el formulario -->
                <button type="button" class="btn btn-danger btn-sm" onclick="removeUserForm(this)">Eliminar</button>
              </div>
              <!-- Botón para agregar más formularios -->
              <button type="button" id="addUserBtn" class="btn btn-primary">Agregar otro usuario</button>
            </div>

      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>

<script>
  // Función para mostrar/ocultar formularios dinámicos
  function toggleForm(appId) {
      //alert(appId)
    const form = document.getElementById(`form-${appId}`);
    const checkbox = document.getElementById(appId);
    
    if(appId=='onedrive'){
        
        //expedientes-onedrive
        document.getElementById('expedientes-onedrive').setAttribute('required', 'true');
    }
    if(appId=='sharepoint'){
        
        //expedientes-onedrive
        document.getElementById('expedientes-sharepoint').setAttribute('required', 'true');
    }
    if(appId=='siugj'){
        
        //expedientes-siugj
        document.getElementById('expedientes-siugj').setAttribute('required', 'true');
    }
    if(appId=='sgde'){
        
        //expedientes-onedrive
        document.getElementById('expedientes-sgde').setAttribute('required', 'true');
    }
    
    if(appId=='nouso'){
        
       form.style.display = 'none';
      form.querySelectorAll('input, select, textarea').forEach(input => {
        input.removeAttribute('required');
      });
    }
    //

    if (checkbox.checked) {
      // Mostrar el formulario y agregar "required" a los campos
      form.style.display = 'block';
      form.querySelectorAll('input, select, textarea').forEach(input => {
       // input.setAttribute('required', 'required');
       
       
      });
    } else {
      // Ocultar el formulario y eliminar "required" de los campos
      form.style.display = 'none';
      form.querySelectorAll('input, select, textarea').forEach(input => {
        input.removeAttribute('required');
      });
    }

    // Quitar "required" dinámicamente de todos los elementos con la clase "agreeTerms"
    document.querySelectorAll('.agreeTerms').forEach(checkbox => {
      checkbox.removeAttribute('required');
    });
  }
</script>

  
 <script>
  // Mostrar u ocultar el formulario de creación de usuarios
  document.getElementById('usersYes').addEventListener('change', function() {
    document.getElementById('userCreationForm').classList.remove('hidden');
  });

  document.getElementById('usersNo').addEventListener('change', function() {
    document.getElementById('userCreationForm').classList.add('hidden');
  });

  // Agregar un nuevo formulario de usuario
  document.getElementById('addUserBtn').addEventListener('click', function() {
    const userFields = document.getElementById('userFields');
    
    // Clonar el primer conjunto de campos para un nuevo usuario
    const newUserForm = document.createElement('div');
    newUserForm.classList.add('userForm', 'mb-3');
    
    const fields = `<hr>
        <div class="userForm mb-3">
                    <label>Aplicativo donde va a crear los usuarios:</label><br>
                    <select class="form-control" name="usuario[]">
                        <option value="">Seleccione una opción</option>
                        <option value="siugj">SIUGJ (LABORAL)</option>
                        <option value="sgde">SGDE</option>
                    </select>
                </div>
      <div class="mb-3 well well-sm">
        <label for="userCedula" class="form-label">Cédula:</label>
        <input type="text" name="userCedula[]" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="userName" class="form-label">Nombre:</label>
        <input type="text" name="userName[]" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="userEmail" class="form-label">Correo:</label>
        <input type="email" name="userEmail[]" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="userDomain" class="form-label">Usuario de dominio:</label>
        <input type="text" name="userDomain[]" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="userPosition" class="form-label">Cargo:</label>
        <input type="text" name="userCargo[]" class="form-control" required>
      </div>
      <!-- Botón para eliminar el formulario -->
      <button type="button" class="btn btn-danger btn-sm" onclick="removeUserForm(this)">Eliminar</button>
      <hr>
    `;
    
    newUserForm.innerHTML = fields;
    userFields.appendChild(newUserForm);
  });

  // Función para eliminar un formulario de usuario
  function removeUserForm(button) {
    const userForm = button.closest('.userForm');
    userForm.remove();
  }
</script>


@endsection