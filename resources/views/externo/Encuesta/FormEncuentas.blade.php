<style>
        .encuesta-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .encuesta-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 1300px;
            max-height: 90vh;
            overflow-y: auto;
        }
        .blocked-page {
            pointer-events: none;
            opacity: 0.5;
            overflow: hidden;
        }
    </style>
    
    <!-- Modal de Encuesta -->
    <div class="modal fade in" id="encuestaModal" tabindex="-1" role="dialog" aria-labelledby="encuestaModalLabel" style="display: block; padding-right: 17px;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #002147; color: white;">
              <strong>
                <h4 class="modal-title text-center" id="encuestaModalLabel">ENCUESTA DE SATISFACCI&Oacute;N</h4>
              </strong>
          </div>
          <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #004182; color: white;">
                <h2 class="panel-title text-center">Como parte de nuestro propósito hacia asegurar niveles más altos de satisfacción de los servicios que brinda el Grupo de Mantenimiento y Soporte Tecnológico, le agradecemos responder la siguiente encuesta:</h2>
              </div>
              <div class="panel-body">
                <div class=" text-center">
                  <h4>Evaluando el periodo de Enero a Marzo del 2026, por favor díganos cual es su nivel de satisfacción con los siguientes Servicios y/o Aplicaciones:</h4>
                </div>
                
                @include('alerts.flash-message')
                @include('../alerts.success')
                @include('../alerts.request')
                
                <form id="MiFormulario" class="form-horizontal" action="{{ route('encuesta.satisfaccion.store') }}" method="POST">
    @csrf
                <!-- Preguntas -->
                <div class="panel-group" id="accordion">
                  <!-- Pregunta 1 -->
                  <div class="panel panel-default question" id="question1">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 1/10: ¿Cómo califica el servicio de Soporte Correo Electr&oacute;nico?</h4>
                    </div>
                    <div class="panel-body">
                      <div class="radio">
                        <label>
                          <input type="radio" name="q1" value="Muy Satisfactoria" onclick="handleOptionChange(1)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q1" value="Satisfactoria" onclick="handleOptionChange(1)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q1" value="Normal" onclick="handleOptionChange(1)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q1" value="Poco Satisfactoria" onclick="handleOptionChange(1)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q1" value="No Satisfactoria" onclick="handleOptionChange(1)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q1" value="No Aplica" onclick="handleOptionChange(1)">
                          No Aplica
                        </label>
                      </div>
                      <div class="form-group hidden" id="obs1">
                        <label for="observation1">Observaciones</label>
                        <textarea class="form-control" id="observation1" name="observaciones_soportecorreoelectronico" rows="3" oninput="checkObservation(1)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 text-right">
                          <button type="button" class="btn btn-primary" id="next1" onclick="nextQuestion(1)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pregunta 2 -->
                  <div class="panel panel-default question hidden" id="question2">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 2/10: ¿Cómo califica el servicio de Página Web Rama Judicial?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q2" value="Muy Satisfactoria" onclick="handleOptionChange(2)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q2" value="Satisfactoria" onclick="handleOptionChange(2)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q2" value="Normal" onclick="handleOptionChange(2)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q2" value="Poco Satisfactoria" onclick="handleOptionChange(2)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q2" value="No Satisfactoria" onclick="handleOptionChange(2)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q2" value="No Aplica" onclick="handleOptionChange(2)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs2">
                        <label for="observation2">Observaciones</label>
                        <textarea class="form-control" id="observation2" name="observaciones_paginaramajudicial" rows="3" oninput="checkObservation(2)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev2" onclick="prevQuestion(2)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next2" onclick="nextQuestion(2)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                   <!-- Pregunta 3 -->
                  <div class="panel panel-default question hidden" id="question3">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 3/10: ¿Cómo califica el servicio de Justicia XXI?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q3" value="Muy Satisfactoria" onclick="handleOptionChange(3)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q3" value="Satisfactoria" onclick="handleOptionChange(3)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q3" value="Normal" onclick="handleOptionChange(3)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q3" value="Poco Satisfactoria" onclick="handleOptionChange(3)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q3" value="No Satisfactoria" onclick="handleOptionChange(3)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q3" value="No Aplica" onclick="handleOptionChange(3)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs3">
                        <label for="observation2">Observaciones</label>
                        <textarea class="form-control" id="observation3" name="observaciones_justiciaxxi" rows="3" oninput="checkObservation(3)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev3" onclick="prevQuestion(3)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next3" onclick="nextQuestion(3)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                    <!-- Pregunta 4 -->
                  <div class="panel panel-default question hidden" id="question4">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 4/10: ¿Cómo califica el servicio de Tyba - Justicia XXI Web?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q4" value="Muy Satisfactoria" onclick="handleOptionChange(4)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q4" value="Satisfactoria" onclick="handleOptionChange(4)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q4" value="Normal" onclick="handleOptionChange(4)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q4" value="Poco Satisfactoria" onclick="handleOptionChange(4)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q4" value="No Satisfactoria" onclick="handleOptionChange(4)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q4" value="No Aplica" onclick="handleOptionChange(4)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs4">
                        <label for="observation4">Observaciones</label>
                        <textarea class="form-control" id="observation4" name="observaciones_tybajusticiaxxi" rows="3" oninput="checkObservation(4)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev4" onclick="prevQuestion(4)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next4" onclick="nextQuestion(4)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                    <!-- Pregunta 5 -->
                  <div class="panel panel-default question hidden" id="question5">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 5/10: ¿Cómo califica el servicio de Conectividad e Internet?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q5" value="Muy Satisfactoria" onclick="handleOptionChange(5)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q5" value="Satisfactoria" onclick="handleOptionChange(5)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q5" value="Normal" onclick="handleOptionChange(5)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q5" value="Poco Satisfactoria" onclick="handleOptionChange(5)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q5" value="No Satisfactoria" onclick="handleOptionChange(5)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q5" value="No Aplica" onclick="handleOptionChange(5)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs5">
                        <label for="observation5">Observaciones</label>
                        <textarea class="form-control" id="observation5" name="observaciones_conectividadeinternet" rows="3" oninput="checkObservation(5)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev5" onclick="prevQuestion(5)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next5" onclick="nextQuestion(5)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  <!-- Pregunta 6 -->
                  <div class="panel panel-default question hidden" id="question6">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 6/10: ¿Cómo califica el servicio de Firma Electr&oacute;nica?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q6" value="Muy Satisfactoria" onclick="handleOptionChange(6)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q6" value="Satisfactoria" onclick="handleOptionChange(6)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q6" value="Normal" onclick="handleOptionChange(6)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q6" value="Poco Satisfactoria" onclick="handleOptionChange(6)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q6" value="No Satisfactoria" onclick="handleOptionChange(6)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q6" value="No Aplica" onclick="handleOptionChange(6)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs6">
                        <label for="observation6">Observaciones</label>
                        <textarea class="form-control" id="observation6" name="observaciones_firmaelectronica" rows="3" oninput="checkObservation(6)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev6" onclick="prevQuestion(6)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next6" onclick="nextQuestion(6)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  <!-- Pregunta 7 -->
                  <div class="panel panel-default question hidden" id="question7">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 7/10: ¿Cómo califica la funcionalidad de las plataformas del Sistema de Gestión Documental Electrónico (SGDE) – Aplica para las especialidades Civil, Familia y Penal y del Sistema Integrado de Gestión Judicial (SIUGJ) – Aplica para la especialidad Laboral:</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q7" value="Muy Satisfactoria" onclick="handleOptionChange(7)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q7" value="Satisfactoria" onclick="handleOptionChange(7)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q7" value="Normal" onclick="handleOptionChange(7)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q7" value="Poco Satisfactoria" onclick="handleOptionChange(7)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q7" value="No Satisfactoria" onclick="handleOptionChange(7)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q7" value="No Aplica" onclick="handleOptionChange(7)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs7">
                        <label for="observation7">Observaciones</label>
                        <textarea class="form-control" id="observation7" name="observaciones_siugj_sgde" rows="3" oninput="checkObservation(7)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev7" onclick="prevQuestion(7)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next7" onclick="nextQuestion(7)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>


                 <!-- Pregunta 8 -->
                  <div class="panel panel-default question hidden" id="question8">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 8/10: ¿Cómo califica el servicio de Soporte mesa de ayuda (línea 018000 124 595)?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q8" value="Muy Satisfactoria" onclick="handleOptionChange(8)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q8" value="Satisfactoria" onclick="handleOptionChange(8)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q8" value="Normal" onclick="handleOptionChange(8)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q8" value="Poco Satisfactoria" onclick="handleOptionChange(8)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q8" value="No Satisfactoria" onclick="handleOptionChange(8)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q8" value="No Aplica" onclick="handleOptionChange(8)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs8">
                        <label for="observation8">Observaciones</label>
                        <textarea class="form-control" id="observation8" name="observaciones_mesadeayuda" rows="3" oninput="checkObservation(8)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev8" onclick="prevQuestion(8)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next8" onclick="nextQuestion(8)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  <!-- Pregunta 9 -->
                  <div class="panel panel-default question hidden" id="question9">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 9/10: ¿Cómo califica el servicio de soporte en las Salas de Audiencias?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q9" value="Muy Satisfactoria" onclick="handleOptionChange(9)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q9" value="Satisfactoria" onclick="handleOptionChange(9)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q9" value="Normal" onclick="handleOptionChange(9)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q9" value="Poco Satisfactoria" onclick="handleOptionChange(9)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q9" value="No Satisfactoria" onclick="handleOptionChange(9)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q9" value="No Aplica" onclick="handleOptionChange(9)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs9">
                        <label for="observation9">Observaciones</label>
                        <textarea class="form-control" id="observation9" name="observaciones_salaaudiencia" rows="3" oninput="checkObservation(9)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev9" onclick="prevQuestion(9)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="button" class="btn btn-primary" id="next9" onclick="nextQuestion(9)" disabled>Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>

                
                
                <!-- Pregunta 10 -->
                  <div class="panel panel-default question hidden" id="question10">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 10/10: ¿Cómo califica el servicio de Creaci&oacute;n Usuario de Dominio?</h4>
                    </div>
                    <div class="panel-body">
                       <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="Muy Satisfactoria" onclick="handleOptionChange(10)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="Satisfactoria" onclick="handleOptionChange(10)">
                          Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="Normal" onclick="handleOptionChange(10)">
                          Normal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="Poco Satisfactoria" onclick="handleOptionChange(10)">
                          Poco Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="No Satisfactoria" onclick="handleOptionChange(10)">
                          No Satisfactoria
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="No Aplica" onclick="handleOptionChange(10)">
                          No Aplica
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 2 -->
                      <div class="form-group hidden" id="obs10">
                        <label for="observation10">Observaciones</label>
                        <textarea class="form-control" id="observation10" name="observaciones_usuariodominio" rows="3" oninput="checkObservation(10)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev10" onclick="prevQuestion(10)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="submit" class="btn btn-success mt-3" id="submitBtn" disabled>Enviar</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Resto de preguntas (3-9) con la misma estructura -->

                  <!-- Pregunta 10 -->
                  <div class="panel panel-default question hidden" id="question10">
                    <div class="panel-heading">
                      <h4 class="panel-title">Pregunta 10/10: ¿Cómo califica el servicio de Creación Usuario de Dominio?</h4>
                    </div>
                    <div class="panel-body">
                      <div class="radio">
                        <label>
                          <input type="radio" name="q10" value="Muy Satisfactoria" onclick="handleOptionChange(10)">
                          Muy Satisfactoria
                        </label>
                      </div>
                      <!-- Resto de opciones para pregunta 10 -->
                      <div class="form-group hidden" id="obs10">
                        <label for="observation10">Observaciones</label>
                        <textarea class="form-control" id="observation10" name="observaciones_usuariodominio" rows="3" oninput="checkObservation(10)"></textarea>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <button type="button" class="btn btn-default" id="prev10" onclick="prevQuestion(10)">Anterior</button>
                        </div>
                        <div class="col-xs-6 text-right">
                          <button type="submit" class="btn btn-success" id="submitBtn" disabled>Enviar Encuesta</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Fondo oscuro para el modal -->
    <div class="modal-backdrop fade in" style="z-index: 1040;"></div>

    <style>
      /* Estilos adicionales */
      .modal {
        z-index: 1050 !important;
      }
      .modal-lg {
        width: 90%;
        max-width: 1000px;
      }
      .panel-title {
        font-size: 16px;
        font-weight: bold;
      }
      .radio {
        margin-top: 5px;
        margin-bottom: 5px;
      }
      .hidden {
        display: none;
      }
    </style>

    <script>
      // Bloquear el cierre del modal
      $(document).ready(function() {
        $('#encuestaModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        
        // Mostrar el modal
        $('#encuestaModal').modal('show');
        
        // Prevenir el cierre con ESC
        $(document).keydown(function(e) {
          if (e.keyCode == 27) {
            return false;
          }
        });
      });

    </script>
      <script>
            // Mostrar y ocultar observaciones, manejar botones de siguiente y anterior
            function showObservation(observationId) {
                document.getElementById(observationId).classList.remove('hidden');
            }
    
            function hideObservation(observationId, obsFieldId) {
                document.getElementById(observationId).classList.add('hidden');
                document.getElementById(obsFieldId).value = '';  // Limpiar el campo de observaciones
            }
    
            function handleOptionChange(questionNumber) {
                const selectedOption = document.querySelector(`input[name="q${questionNumber}"]:checked`);
                const obs = document.getElementById(`obs${questionNumber}`);
                const nextButton = document.getElementById(`next${questionNumber}`);
                const submitBtn = document.getElementById('submitBtn');
    
                if (selectedOption && (selectedOption.value === 'Poco Satisfactoria' || selectedOption.value === 'No Satisfactoria')) {
                    showObservation(`obs${questionNumber}`);
                } else {
                    hideObservation(`obs${questionNumber}`, `observation${questionNumber}`);
                }
    
                if (selectedOption && questionNumber < 10) {
                    nextButton.disabled = false;
                } else if (questionNumber === 10 && selectedOption) {
                    submitBtn.disabled = false;
                }
            }
    
            function checkObservation(questionNumber) {
                const observation = document.getElementById(`observation${questionNumber}`).value;
                const nextButton = document.getElementById(`next${questionNumber}`);
                const submitBtn = document.getElementById('submitBtn');
    
                if (observation.trim() === '' && (document.querySelector(`input[name="q${questionNumber}"]:checked`).value === 'Poco Satisfactoria' || document.querySelector(`input[name="q${questionNumber}"]:checked`).value === 'No Satisfactoria')) {
                    nextButton.disabled = true;
                    submitBtn.disabled = true;
                } else {
                    nextButton.disabled = false;
                    submitBtn.disabled = false;
                }
            }
    
            function nextQuestion(currentQuestion) {
                const nextQuestion = currentQuestion + 1;
                document.getElementById(`question${currentQuestion}`).classList.add('hidden');
                document.getElementById(`question${nextQuestion}`).classList.remove('hidden');
            }
    
            function prevQuestion(currentQuestion) {
                const prevQuestion = currentQuestion - 1;
                document.getElementById(`question${currentQuestion}`).classList.add('hidden');
                document.getElementById(`question${prevQuestion}`).classList.remove('hidden');
            }
        </script>
 