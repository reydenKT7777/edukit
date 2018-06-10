<div class="row">
	<div class="col s12 m6 l4 offset-m3 offset-l4">
		<div class="card">
		    <div class="card-image">
		        <img src="<?=base_url()?>assets/images/gallary/17.png">
		        <span class="card-title">Cursos</span>
		        <a class="btn-floating btn-large halfway-fab waves-effect waves-light red modalopen" data-namemodal="modal_nuevo_curso"><i class="material-icons">add</i></a>
		    </div>
		    <div class="card-content" style="padding: 0; max-height: 280px; overflow-y: auto;">
		    	<ul class="collection" style="margin-top: 30px; border: none;">
					<li class="collection-item dismissable" ng-repeat="c in cursos">
						<div><i class="material-icons left" ng-class="{textok: c.estado == 1,  textnook: c.estado == 0}">lens</i>
							<b>{{c.grado}} {{c.paralelo}}</b> de {{c.nivel}}
							<a href="" class="secondary-content" ng-click="form_editar_curso($index)"><i class="material-icons">edit</i></a>
						</div>
					</li>
				</ul> 
		    </div>
		</div>
	</div>
</div>
<div id="modal_nuevo_curso" class="modal modal-xs">
    <div class="modal-content">
      <h5>Habilitar nuevo curso</h5>
      <hr>
      <form>
        <div class="row">
          <div class="col s12">
            <select class="browser-default" name="curso_nuevo" id="in_curso" ng-model="select_curso">
              <option value="" selected disabled>Seleccione un curso para habilitarlo</option>
              <option ng-repeat="li in cursos_libres" value="{{$index}}">{{li.grado}} {{li.paralelo}} {{li.nivel}}</option>
            </select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
    	<button class="btn red" ng-click="habilitar_curso()">guardar</button>
      <a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>
<div id="modal_editar_curso" class="modal modal-xs">
    <div class="modal-content">
      <h5>Editar Curso</h5>
      <hr>
      <form>
        <div class="row">
          <div class="col s12 m6">
            <span style="font-size: 50px; font-weight: 800;">{{datos_curso.grado}}{{datos_curso.paralelo}}</span><b class="blue-text" style="font-size: 25px;"> {{datos_curso.nivel}}</b>
          </div>
          <div class="col s12 m6">
            <div class="switch" style="margin-top: 40px;">
              <label>
                Deshabilitar
                <input type="checkbox" ng-model="datos_curso.estado" ng-true-value="'1'" ng-false-value="'0'">
                <span class="lever"></span>
                Habilitar
              </label>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
    	<button class="btn orange" ng-click="deshabilitar_curso()">Modificar</button>
      <a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>