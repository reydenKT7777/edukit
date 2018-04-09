<h4 class="grey-text text-darken-4">Nomina docente</h4>
<div class="card-panel">
  <div class="row">
    <div class="col l8">
      <a class="btn waves-effect waves-light blue modalopen" data-namemodal="addprofesor"><i class="material-icons left">add</i>Agregar</a>
    </div>
    <div class="col l4">
      <input type="text" ng-model="buscar" placeholder="Buscar...">
    </div>
  </div>
  <table class="striped">
    <thead>
      <th>Nombres</th>
      <th>Apellido paterno</th>
      <th>Apellido materno</th>
      <th>Ci</th>
      <th>Sexo</th>
      <th>Especialidad</th>
      <th>Opciones</th>
    </thead>
    <tbody>
    <tr ng-repeat="profesor in lista | filter : buscar">
      <td>{{profesor.nombres}}</td>
      <td>{{profesor.a_paterno}}</td>
      <td>{{profesor.a_materno}}</td>
      <td>{{profesor.ci}}</td>
      <td>{{profesor.sexo}}</td>
      <td>{{profesor.especialidad}}</td>
      <td><a class="btn-floating waves-effect waves-light green" ng-click="form_modificar_registro($index)"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a class="btn-floating waves-effect waves-light red" ng-click="eliminar_registro(profesor.id)"><i class="material-icons">delete</i></a></td>
    </tr> 
    </tbody>
  </table>  
</div>
<div id="addprofesor" class="modal full-modal modal-md">
  <div class="modal-content">
    <div class="col s12">
      <div class="card" style="margin: 0;">
        <div class="card-content">
          <form>
            <ul class="stepper horizontal" id="horizontal">
              <li class="step active">
                <div data-step-label="Persona" class="step-title waves-effect waves-dark">Paso 1</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12 m4 l4">
                      <input id="in_nombres" name="nombres" type="text" class="validate" required>
                      <label for="in_nombres">Nombre</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="in_a_paterno" name="a_paterno" type="text" class="validate" required>
                      <label for="in_a_paterno">Apellido Paterno</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="in_a_materno" name="a_materno" type="text" class="validate" required>
                      <label for="in_a_materno">Apellido Materno</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m4 l4">
                      <input id="in_ci" name="ci" type="text" class="validate" required>
                      <label for="in_ci">Cedula de Identidad</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <select id="in_expedido">
                        <option value="LP">La Paz</option>
                        <option value="">Cochabamba</option>
                        <option value="">Santa Cruz</option>
                        <option value="">Potosi</option>
                        <option value="">Oruro</option>
                        <option value="">Sucre</option>
                        <option value="">Tarija</option>
                        <option value="">Pando</option>
                        <option value="">Beni</option>
                      </select>
                      <label for="in_expedido">Expedido</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <select id="in_sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                      <label for="in_sexo">Sexo</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step">Continuar</button>
                    <a class="waves-effect waves-dark btn transparent grey-text modal-close">Cancelar</a>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Especialidad" class="step-title waves-effect waves-dark">Paso 2</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="in_especialidad" name="especialidad" type="text" class="validate" required>
                      <label for="in_especialidad">Especialidad</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step" data-feedback="someFunction">Continuar</button>
                    <button class="waves-effect waves-dark btn-flat previous-step">Atras</button>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Usuario" class="step-title waves-effect waves-dark">Paso 3</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="in_usuario" name="usuario" type="text" class="validate" required>
                      <label for="in_usuario">Nombre de usuario</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="in_password" name="password" type="password" class="validate" required>
                      <label for="in_password">Contraseña</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue" type="submit">Registrar</button>
                  </div>
                </div>
              </li>
            </ul>
          </form>
        </div>
      </div>                  
    </div>
  </div>
</div>
<div id="editprofesor" class="modal full-modal modal-md">
  <div class="modal-content">
    <div class="col s12">
      <div class="card" style="margin: 0;">
        <div class="card-content">
          <form>
            <ul class="stepper horizontal" id="horizontal">
              <li class="step active">
                <div data-step-label="Persona" class="step-title waves-effect waves-dark">Paso 1</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12 m4 l4">
                      <input id="in_nombres" ng-model="form.nombres" name="nombres" type="text" class="validate" required>
                      <label for="in_nombres">Nombre</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="in_a_paterno" ng-model="form.a_paterno" name="a_paterno" type="text" class="validate" required>
                      <label for="in_a_paterno">Apellido Paterno</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="in_a_materno" ng-model="form.a_materno" name="a_materno" type="text" class="validate" required>
                      <label for="in_a_materno">Apellido Materno</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m4 l4">
                      <input id="in_ci" ng-model="form.ci" name="ci" type="text" class="validate" required>
                      <label for="in_ci">Cedula de Identidad</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <select id="in_expedido">
                        <option value="LP">La Paz</option>
                        <option value="">Cochabamba</option>
                        <option value="">Santa Cruz</option>
                        <option value="">Potosi</option>
                        <option value="">Oruro</option>
                        <option value="">Sucre</option>
                        <option value="">Tarija</option>
                        <option value="">Pando</option>
                        <option value="">Beni</option>
                      </select>
                      <label for="in_expedido">Expedido</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <select id="in_sexo" ng-model="form.sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                      <label for="in_sexo">Sexo</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step">Continuar</button>
                    <a class="waves-effect waves-dark btn transparent grey-text modal-close">Cancelar</a>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Especialidad" class="step-title waves-effect waves-dark">Paso 2</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="in_especialidad" ng-model="form.especialidad" name="especialidad" type="text" class="validate" required>
                      <label for="in_especialidad">Especialidad</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step" data-feedback="someFunction">Continuar</button>
                    <button class="waves-effect waves-dark btn-flat previous-step">Atras</button>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Usuario" class="step-title waves-effect waves-dark">Paso 3</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="in_usuario" name="usuario" type="text" class="validate" required>
                      <label for="in_usuario">Nombre de usuario</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="in_password" name="password" type="password" class="validate" required>
                      <label for="in_password">Nueva Contraseña</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue" type="submit">Registrar</button>
                  </div>
                </div>
              </li>
            </ul>
          </form>
        </div>
      </div>                  
    </div>
  </div>
</div>

<pre> 
{{form | json}}
</pre>