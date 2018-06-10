<div class="card blue">
    <div class="card-content">
      <h4 class="white-text">Nomina de profesores</h4>
    </div>
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width tabs-transparent" tabs reload="allTabContentLoaded">
        <li class="tab"><a class="active" href="#tab_activos">Profesores activos</a></li>
        <li class="tab"><a href="#tab_inactivos" ng-click="listar_profesores_inactivos()">Profesores inactivos</a></li>
      </ul>
    </div>
    <div class="card-content blue lighten-5">
      <div id="tab_activos">
        <div class="card-panel">
          <div class="row">
            <div class="col l8">
              <a class="btn-floating btn-large waves-effect waves-light blue modalopen" data-namemodal="addprofesor"><i class="material-icons left">add</i></a>
              <a class='dropdown-button btn indigo' href='javascript:void(0);' data-activates='dropdown_reporte' dropdown data-hover="true"><i class="material-icons left">print</i>Reportes</a>
              <ul id='dropdown_reporte' class='dropdown-content' style="min-width: 170px;">
                <li><a href="<?=base_url()?>controlador_profesor/reporte_profesor_pdf_nomina" target="_blank">Nomina</a></li>
                <li><a href="<?=base_url()?>controlador_profesor/reporte_profesor_pdf_planilla" target="_blank">Planilla</a></li>
              </ul>
            </div>
            <div class="col l4">
              <input type="text" ng-model="buscar" placeholder="Buscar..." id="buscar_dato">
            </div>
          </div>
          <table class="responsive-table highlight">
            <thead>
              <th></th>
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
              <td>
                <span class="avatar-status">
                  <img src="<?=base_url()?>{{profesor.foto_perfil}}" alt="avatar">
                </span>
              </td>
              <td>{{profesor.nombres}}</td>
              <td>{{profesor.a_paterno}}</td>
              <td>{{profesor.a_materno}}</td>
              <td>{{profesor.ci}}</td>
              <td>{{profesor.sexo}}</td>
              <td>{{profesor.especialidad}}</td>
              <td><a class="btn-floating waves-effect waves-light orange" ng-click="ver_registro($index)"><i class="material-icons">add</i></a>&nbsp;&nbsp;<a class="btn-floating waves-effect waves-light green" ng-click="form_modificar_registro($index)"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a class="btn-floating waves-effect waves-light red" ng-click="eliminar_registro(profesor.id)"><i class="material-icons">delete</i></a></td>
            </tr>
            </tbody>
          </table>
        </div>        
      </div>
      <div id="tab_inactivos">
        <ul class="collection">
          <li class="collection-item avatar" ng-repeat="profesor2 in lista2">
            <img src="<?=base_url()?>assets/images/avatar/default.png" alt="" class="circle">
            <span class="title">{{profesor2.nombres}} {{profesor2.a_paterno}} {{profesor2.a_materno}}</span><br>
            <a class="secondary-content btn-floating waves-effect waves-light blue" ng-click="activar_registro(profesor2.id)"><i class="material-icons">restore</i></a>
            <span class="task-cat red" style="margin: 0;"> Especialidad: {{profesor2.especialidad}}</span>
          </li>
        </ul>
      </div>
    </div>
</div>
<div id="addprofesor" class="modal full-modal modal-md">
  <div class="modal-content">
    <div class="col s12">
      <div class="card" style="margin: 0;">
        <div class="card-content">
          <form id="form_add_profesor" ng-submit="agregar_registro($event)">
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
                    <div class="input-field col s12 m3 l3">
                      <input id="in_ci" name="ci" type="text" class="validate" required>
                      <label for="in_ci">Cedula de Identidad</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                      <select id="in_expedido" name="exp">
                        <option value="LP">La Paz</option>
                        <option value="CB">Cochabamba</option>
                        <option value="SC">Santa Cruz</option>
                        <option value="PT">Potosi</option>
                        <option value="OR">Oruro</option>
                        <option value="CH">Chuquisaca</option>
                        <option value="TJ">Tarija</option>
                        <option value="PA">Pando</option>
                        <option value="BN">Beni</option>
                      </select>
                      <label for="in_expedido">Expedido</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                      <select id="in_sexo" name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                      <label for="in_sexo">Sexo</label>
                    </div>
                    <div class="col s12 m3 l3">
                      <label for="in_fecha">Fecha de nacimiento</label>
                      <input id="in_fecha" name="fecha" type="text" class="validate" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m3 l3">
                      <input id="in_telefono" name="telefono" type="text" class="validate" required>
                      <label for="in_telefono">Telefono</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                      <input id="in_telefono_op" name="telefono_op" type="text" class="">
                      <label for="in_telefono_op">Telefono opcional</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                      <input id="in_direccion" name="direccion" type="text" class="validate" required>
                      <label for="in_direccion">Dirección</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step" type="button">Continuar</button>
                    <a class="waves-effect waves-dark btn transparent grey-text modal-close">Cancelar</a>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Especialidad" class="step-title waves-effect waves-dark">Paso 2</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">work</i>
                      <input id="in_especialidad" name="especialidad" type="text" class="validate" required>
                      <label for="in_especialidad">Especialidad</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step" type="button">Continuar</button>
                    <button class="waves-effect waves-dark btn-flat previous-step" type="button">Atras</button>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Usuario" class="step-title waves-effect waves-dark">Paso 3</div>
                <div class="step-content">
                  <div class="row">
                    <div class="col s12 m3 l2">
                      <div class="picture-container">
                        <div class="picture">
                          <img src="<?=base_url()?>assets/images/avatar/default.png" class="picture-src" id="visualizacion_foto" title="">
                          <input id="in_img" type="file" name="foto" accept="image/*">
                        </div>
                      </div>
                    </div>
                    <div class="col s12 m9 l10">
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="in_usuario" name="usuario" type="text" class="validate" required>
                          <label for="in_usuario">Nombre de usuario</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">lock_outline</i>
                          <input id="in_password" name="password" type="password" class="validate" required>
                          <label for="in_password">Contraseña</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">contact_mail</i>
                      <input id="in_correo" name="correo" type="email" class="validate" required>
                      <label for="in_correo">Correo electronico</label>
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
          <form id="form_edit_profesor" ng-submit="modificar_registro($event)">
            <ul class="stepper horizontal" id="horizontal">
              <li class="step active">
                <div data-step-label="Persona" class="step-title waves-effect waves-dark">Paso 1</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12 m4 l4">
                      <input id="in_nombres2" ng-model="form.nombres" name="nombres" type="text" class="validate" required>
                      <label for="in_nombres2">Nombre</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="in_a_paterno2" ng-model="form.a_paterno" name="a_paterno" type="text" class="validate" required>
                      <label for="in_a_paterno2">Apellido Paterno</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="in_a_materno2" ng-model="form.a_materno" name="a_materno" type="text" class="validate" required>
                      <label for="in_a_materno2">Apellido Materno</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m3 l3">
                      <input id="in_ci2" ng-model="form.ci" name="ci" type="text" class="validate" required>
                      <label for="in_ci2">Cedula de Identidad</label>
                    </div>
                    <div class="col s12 m3 l3">
                      <label>Expedido</label>
                      <select id="in_expedido2" class="browser-default" ng-model="form.exp" name="exp">
                        <option value="LP">La Paz</option>
                        <option value="CB">Cochabamba</option>
                        <option value="SC">Santa Cruz</option>
                        <option value="PT">Potosi</option>
                        <option value="OR">Oruro</option>
                        <option value="CH">Chuquisaca</option>
                        <option value="TJ">Tarija</option>
                        <option value="PA">Pando</option>
                        <option value="BN">Beni</option>
                      </select>
                    </div>
                    <div class="col s12 m3 l3">
                      <label>Sexo</label>
                      <select class="browser-default" id="in_sexo2" ng-model="form.sexo" name="sexo">
                          <option value="M">Masculino</option>
                          <option value="F">Femenino</option>
                      </select>
                    </div>
                    <div class="col s12 m3 l3">
                      <label for="in_fecha2">Fecha de nacimiento</label>
                      <input id="in_fecha2" ng-model="form.f_nacimiento" name="fecha" type="text" class="validate" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m3 l3">
                      <input id="in_telefono2" ng-model="form.telf" name="telefono" type="text" class="validate" required>
                      <label for="in_telefono2">Telefono</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                      <input id="in_telefono_op2" ng-model="form.telf_opc" name="telefono_op" type="text" class="">
                      <label for="in_telefono_op2">Telefono opcional</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                      <input id="in_direccion2" ng-model="form.direccion" name="direccion" type="text" class="validate" required>
                      <label for="in_direccion2">Dirección</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step" type="button">Continuar</button>
                    <a class="waves-effect waves-dark btn transparent grey-text modal-close">Cancelar</a>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Especialidad" class="step-title waves-effect waves-dark">Paso 2</div>
                <div class="step-content">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">work</i>
                      <input id="in_especialidad2" ng-model="form.especialidad" name="especialidad" type="text" class="validate" required>
                      <label for="in_especialidad2">Especialidad</label>
                    </div>
                  </div>
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue next-step" type="button">Continuar</button>
                    <button class="waves-effect waves-dark btn-flat previous-step" type="button">Atras</button>
                  </div>
                </div>
              </li>
              <li class="step">
                <div data-step-label="Usuario" class="step-title waves-effect waves-dark">Paso 3</div>
                <div class="step-content">
                  <div class="row">
                    <div class="col s12 m3 l2">
                      <div class="picture-container">
                        <div class="picture">
                          <img src="<?=base_url()?>{{form.foto_perfil}}" class="picture-src" id="visualizacion_foto2" title="">
                          <input id="in_img2" type="file" name="foto" accept="image/*">
                        </div>
                      </div>
                    </div>
                    <div class="col s12 m9 l10">
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="in_usuario2" ng-model="form.nombre_usuario" name="usuario" type="text" class="validate" required>
                          <label for="in_usuario2">Nombre de usuario</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">lock_outline</i>
                          <input id="in_password2" name="password" type="password">
                          <label for="in_password2">Nueva Contraseña</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">contact_mail</i>
                      <input id="in_correo2" ng-model="form.correo_electronico" name="correo" type="email" class="validate" required>
                      <label for="in_correo2">Correo electronico</label>
                    </div>
                  </div>
                  <input type="hidden" name="id_persona" value="{{form.id}}">
                  <div class="step-actions">
                    <button class="waves-effect waves-dark btn blue" type="submit">Modificar</button>
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
<div id="verprofesor" class="modal bottom-sheet">
    <div class="modal-content">
      <div class="row">
        <div class="col s12 m4 l4">
          <div id="profile-card" class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img src="<?=base_url()?>/assets/images/gallary/3.png" alt="user bg">
            </div>
            <div class="card-content">
              <img src="<?=base_url()?>{{info_pro.foto_perfil}}" alt="" class="circle responsive-img card-profile-image cyan lighten-1 padding-2">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right" ng-click="form_modificar_registro2()">
                <i class="material-icons">edit</i>
              </a>
              <span class="card-title grey-text text-darken-4">{{info_pro.nombres}} {{info_pro.a_paterno}}</span>
              <p>Profesor de {{info_pro.especialidad}}</p>
            </div>
          </div>   
        </div>
        <div class="col s12 m8 l8">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Informacion General</span>
              <div class="row">
                <div class="col s12 m12">
                  <p>
                    <b>Nombre Completo: </b>{{info_pro.nombres}} {{info_pro.a_paterno}} {{info_pro.a_materno}} <br><br>
                  </p>
                </div> 
              </div>
              <div class="row">
                <div class="col s12 m6">
                  <p>
                    <b>Cedula de identidad: </b>{{info_pro.ci}} {{info_pro.exp}} <br><br>
                  </p>
                </div>
                <div class="col s12 m6">
                  <p>
                    <b>Fecha de nacimiento: </b>{{info_pro.f_nacimiento}} <br><br>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m6">
                  <p>
                    <b>Telefono: </b>{{info_pro.telf}}<br>
                    <b>Telefono opcional: </b>{{info_pro.telf_opc}}<br><br>
                  </p>
                </div>
                <div class="col s12 m6">
                  <p>
                    <b>Correo electronico: </b>{{info_pro.correo_electronico}}<br><br>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m12">
                  <p>
                    <b>Direccion: </b>{{info_pro.direccion}}<br>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
</div>
