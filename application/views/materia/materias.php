<div class="row">
  <div class="col s12">
    <ul id="task-card" class="collection with-header">
      <li class="collection-header gradient-45deg-light-blue-cyan">
        <h4 class="task-card-title">Materias</h4>
        <p class="task-card-date">Especialidad: Materia</p>
      </li>
      <a class="task-add modal-trigger btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow"  ng-click="nueva_materia()">
        <i class="material-icons">add</i>
      </a>
      <li class="collection-item dismissable">
        <div class="row">

          <div class="card-panel">
          <table class="responsive-table highlight">
            <thead>
              <th>Color</th>
              <th>Materia</th>
              <th>Curso</th>
              <th>Integrantes</th>
              <th>Opciones</th>
            </thead>
            <tbody>
            <tr ng-repeat="mat in lista">
                <td><i class="material-icons left" style="color:{{mat.color_hex}}">lens</i></td>

                <td class="tooltipped suspensivos" data-tooltip="Biologia">{{mat.titulo}}</td>
                <td>{{mat.curso}} {{mat.nivel}}</td>
                <td>{{mat.integrantes}}</td>
                <td><a class="btn-floating waves-effect waves-light green" ng-click="form_modificar_materia($index)"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a class="btn-floating waves-effect waves-light red" ng-click="desactivar_materia(mat.id_mat)"><i class="material-icons">delete</i></a></td>
            </tr>
            </tbody>
          </table>
        </div>
        </div>
      </li>
    </ul>
  </div>  
</div>



<div id="addmateria" class="modal material-modal">
    <div class="modal-content">
      <div class="card-panel">
        <nav class="red">
        <div class="nav-wrapper" style="padding-left: 5px;">
          <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Nueva materia</a>
          <ul class="right hide-on-med-and-down">
            <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
          </ul>
        </div>
    </nav>
    <form id="form-add-materia" class="card-panel" style="margin: 0;" ng-submit="guardar_materia($event)">
      <div class="row">
        <div class="col s12">
            <label for="in_materia">Materia</label>
            <select class="browser-default" name="materia" id="in_materia">
              <option value="" selected disabled>Seleccione una materia</option>
              <option value="Biologia">Biologia</option>
              <option value="Fisica Quimica">Fisica Quimica</option>
              <option value="Comunicacion y lenguajes">Comunicacion y lenguajes</option>
              <option value="Lengua extranjera">Lengua extranjera</option>
              <option value="Ciencias Sociales">Ciencias Sociales</option>
              <option value="Educacion Fisica y Deportes">Educacion Fisica y Deportes</option>
              <option value="Educacion Musical">Educacion Musical</option>
              <option value="Artes Plasticas y Visuales">Artes Plasticas y Visuales</option>
              <option value="Cosmovisiones, Filosofia y sicologia">Cosmovisiones, Filosofia y sicologia</option>
              <option value="Valores, Espiritualidad y religion">Valores, Espiritualidad y religion</option>
              <option value="Matematica">Matematica</option>
              <option value="Tecnica Tecnologica General">Tecnica Tecnologica General</option>
              <option value="Tecnica Tecnologica Especializada (Computacion)">Tecnica Tecnologica Especializada (Computacion)</option>
            </select>
            <!-- <input type="text" value="{{item_materia}}" name="item_materia"> -->
        </div>

        <div class="col s1">
          <br>
          <label for="in_color_hex">Color</label>
          <!-- <p>{{color}}</p> -->
          <div style="margin-left: 50px">
              <color-picker color="color" options="options" on-color-changed="colorChanged(newColor, oldColor)"></color-picker>
          </div>
          <input id="in_color" type="hidden" value="{{color}}" name="in_color_hex">
        </div>
                                                                                                            <!-- agregar materia -->
        <div class="col s12">
            <label for="in_curso">Curso</label>
            <select class="browser-default" name="curso" id="in_curso" ng-model="item_curso">
              <option value="" selected disabled>Seleccione un curso</option>
              <option ng-repeat="op in lista_cursos" value="{{op.id}}">{{op.curso}} {{op.nivel}}</option>
            </select>
            <!-- <input type="text" value="{{item_curso}}" name="item_curso"> -->
        </div>
      </div>
      <!-- <p>{{item_curso}} {{item_materia}} {{color}}</p> -->
      <center><button class="btn red" type="submit">Registrar</button></center>
    </form>
      </div>
    </div>
</div>









<div id="editamateria" class="modal material-modal">
    <div class="modal-content">
      <div class="card-panel">
        <nav class="red">
        <div class="nav-wrapper" style="padding-left: 5px;">
          <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Editar materia</a>
          <ul class="right hide-on-med-and-down">
            <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
          </ul>
        </div>
    </nav>
    <form id="form_edit_materia" ng-submit="modificar_materia($event)" class="card-panel" style="margin: 0;">
      <div class="row">
        <input type="text" name="id_materia2" value="{{form.id_mat}}">
        <div class="col s12">
            <label for="in_materia2">Materia</label>
            <select class="browser-default" name="materia2" id="in_materia2" ng-model="form.titulo">
              <option value="Biologia">Biologia</option>
              <option value="Fisica Quimica">Fisica Quimica</option>
              <option value="Comunicacion y lenguajes">Comunicacion y lenguajes</option>
              <option value="Lengua extranjera">Lengua extranjera</option>
              <option value="Ciencias Sociales">Ciencias Sociales</option>
              <option value="Educacion Fisica y Deportes">Educacion Fisica y Deportes</option>
              <option value="Educacion Musical">Educacion Musical</option>
              <option value="Artes Plasticas y Visuales">Artes Plasticas y Visuales</option>
              <option value="Cosmovisiones, Filosofia y sicologia">Cosmovisiones, Filosofia y sicologia</option>
              <option value="Valores, Espiritualidad y religion">Valores, Espiritualidad y religion</option>
              <option value="Matematica">Matematica</option>
              <option value="Tecnica Tecnologica General">Tecnica Tecnologica General</option>
              <option value="Tecnica Tecnologica Especializada (Computacion)">Tecnica Tecnologica Especializada (Computacion)</option>
            </select>
        </div>

        <div class="col s1">
          <br>
          <label for="in_color_hex2">Color</label>

          <div style="margin-left: 50px">
              <color-picker color="color" options="options" on-color-changed="colorChanged(newColor, oldColor)"></color-picker>
          </div>
          <input id="in_color_hex2" type="hidden"  name="color_hex2" value="{{color}}">
        </div>
                                                                                                            <!-- editar materia  -->
        <div class="col s12">
            <label for="in_curso2">Curso</label>
            <select class="browser-default" name="curso2" id="in_curso2" ng-model="form.id">
              <option value="" selected disabled>Seleccione un curso</option>
              <option ng-repeat="op in lista_cursos" value="{{op.id}}">{{op.curso}} {{op.nivel}}</option>
            </select>
        </div>
      </div>
      <center><button class="btn red" type="submit">Modificar</button>
      <a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a></center>
    </form>
      </div>
    </div>
</div>
