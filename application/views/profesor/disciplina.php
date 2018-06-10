<div class="card-panel" style="padding: 0; background-color: #eeeeee;">
	<div class="row">
		<div class="col s12">
			<nav class="nav-extended indigo accent-4">
			    <div class="nav-wrapper">
			    	<span class="brand-logo" style="padding-left: 10px;"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Indisciplina</span>
			    </div>
			    <div class="nav-content">
			      <span class="nav-title"></span>
			      <a class="btn-floating btn-large halfway-fab waves-effect waves-light red" ng-click="nueva_disciplina()">
			        <i class="material-icons">add</i>
			      </a>
			    </div>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<ul id="task-card" class="collection with-header collection-float">
				<li class="collection-header">
					<h4 class="task-card-title2">Registro de profesores</h4>
					<p class="task-card-date2">Observaciones</p>
	            </li>
				<li class="collection-item avatar" ng-repeat="d in lista_disciplinas">
					<img src="<?=base_url()?>{{d.foto_perfil}}" alt="" class="circle">
					<span class="title"><b>{{d.nombres}} {{d.a_paterno}} {{d.a_materno}}</b> <span class="orange-text"><i class="material-icons">notifications_none</i></span></span><br>
					<a href="" class="secondary-content">
						<span class="ultra-small">{{d.fecha}}</span>
					</a>
					<span class="task-cat red" style="margin: 0;"><b>Disciplina: </b> {{d.descripcion}}
					</span>
				</li>
			</ul>	
		</div>
	</div>
</div>
<div id="modal_nuevo" class="modal material-modal">
    <div class="modal-content">
      <div class="card-panel">
      	<nav class="red">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Nueva disciplina</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<form id="form-add-disciplina" class="card-panel" style="margin: 0;" ng-submit="registrar_disciplina($event)">
			<div class="row">
				<div class="input-field col s12">
					<select id='in_profe' name="profesor_id" style='width: 100%;'>
                	</select>
                	<label class="active" for="in_profe">Nombre del profesor</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<textarea id="in_descripcion" name="descripcion" class="materialize-textarea"></textarea>
					<label for="in_descripcion">Descripcion de la observacion</label>
				</div>
			</div>
			<center><button class="btn red" type="submit">Registrar</button></center>
		</form>
      </div>
    </div>
</div>