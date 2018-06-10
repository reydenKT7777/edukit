<div class="row">
	<div class="col s12">
		<ul class="tabs" tabs reload="allTabContentLoaded">
		    <li class="tab col s3"><a class="active" href="#tab_inscripcion"><i class="material-icons left" style="padding-top: 10px;">create</i>Inscripcion</a></li>
		    <li class="tab col s3"><a href="#tab_nomina"><i class="material-icons left" style="padding-top: 10px;">subject</i>Nomina</a></li>
		</ul>
		<div id="tab_inscripcion" class="col s12">
			<div class="row">
				<div class="col s12 m4 l4 offset-m4 offset-l4">
					<div class="card">
                        <div class="card-image">
                          <img src="<?=base_url()?>assets/images/gallary/33.png" alt="sample">
                          <span class="card-title">Inscripcion 2018</span>
                        </div>
                        <div class="card-content">
                          <p>
                          	Con esta opcion usted podra realizar una inscripcion de un estudiante en la presente gestion.
                          </p>
                          <div class="input-field">
	                          <input type="text" id="in_ci_ins" ng-model="ci_padre">
	                          <label for="in_ci_ins">Cedula de indentidad del padre</label>
                          </div>
                        </div>
                        <div class="card-action">
                        	<center>
                          		<a href="" class="waves-effect waves-light btn gradient-45deg-red-pink" ng-click="verifica_padre()">Inscribir</a>	
                        	</center>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div id="tab_nomina" class="col s12">
			<div class="card-panel">
				<h5>Estudiantes</h5>
				<div class="row">
					<div class="col s11">
						<label for="">Curso</label>
						<select class="browser-default" name="" id="" ng-model="item_curso">
							<option value="" selected disabled>Seleccione un curso</option>
							<option ng-repeat="op in lista_cursos" value="{{op.id}}">{{op.grado}}</option>
						</select>
					</div>
					<div class="col s1">
						<button class="btn-floating btn-large waves-effect waves-light" style="margin-top: 14px;" ng-click="listar_estudiantes_curso()"><i class="material-icons">search</i></button>
					</div>
				</div>
				<br>
				<div class="fixed-action-btn click-to-toggle" style="bottom: 45px;">
				    <a class="btn-floating btn-large orange">
				      <i class="material-icons">print</i>
				    </a>
				    <ul>
				      <li><a class="btn-floating red tooltipped" data-position="left" data-delay="50" data-tooltip="Planilla de alumnos"><i class="material-icons">insert_chart</i></a></li>
				      <li><a class="btn-floating green tooltipped" data-position="left" data-delay="50" data-tooltip="Imprimir nomina de alumnos"><i class="material-icons">content_paste</i></a></li>
				      <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Otros"><i class="material-icons">featured_play_list</i></a></li>
				    </ul>
				 </div>
				<div class="row">
					<div class="col s12">
						<table class="tabla-simple">
							<thead>
								<tr>
									<td></td>
									<th>Nombre Completo</th>
									<th>Curso</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="est in estudiantes_curso">
									<td></td>
									<td>{{est.nombres}} {{est.a_paterno}} {{est.a_materno}}</td>
									<td>{{est.curso}}</td>
									<td>
										<a class="btn-floating waves-effect waves-light orange" ng-click="modal_info()"><i class="material-icons">add</i></a>&nbsp;&nbsp;<a class="btn-floating waves-effect waves-light green"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a class="btn-floating waves-effect waves-light blue"><i class="material-icons">list</i></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal_registrar" class="modal material-modal modal-lg">
    <div class="modal-content">
      <div class="card-panel">
      	<nav class="red">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Inscripcion</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<form id="form-add-ins" class="card-panel" style="margin: 0;"  ng-submit="registrar_inscripcion($event)">
			<div class="row">
				<div class="col s12 l4 m4">
					<div id="profile-card" class="card">
			            <div class="card-image waves-effect waves-block waves-light">
			                <img src="<?=base_url()?>assets/images/gallary/33.png" alt="user bg">
			            </div>
			            <div class="card-content">
							<img src="<?=base_url()?>{{data_padre.foto_perfil}}" alt="" class="circle responsive-img card-profile-image-center cyan lighten-1 padding-2">
							<a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right" ng-click="form_edit_tutor()">
			                <i class="material-icons">edit</i>
			                </a>
			                <span class="card-title grey-text text-darken-4" style="margin-top: 30px; text-align: center;">{{data_padre.nombres}} {{data_padre.a_paterno}} {{data_padre.a_materno}}</span>
			                <p>
			                	<b>Parentesco: </b>{{data_padre.parentesco}}<br>
			                    <b>Cedula de identidad: </b>{{data_padre.ci}} {{data_padre.exp}} 
			                </p>
			            </div>
			        </div>
				</div>
				<div class="col s12 l8 m8">
					<span class="mini-titulo">Estudiantes inscritos</span><a class="btn-floating waves-effect waves-block waves-light red right" ng-click="modal_registrar_estudiante()"><i class="material-icons">add</i></a>
					<hr>
					<div class="row">
						<div class="col s12">
							<ul class="collection">
								<li class="collection-item avatar" ng-repeat="e in data_estudiantes">
									<img src="<?=base_url()?>{{e.foto_perfil}}" alt="" class="circle">
									<span class="title">{{e.nombres}} {{e.a_paterno}} {{e.a_materno}}</span>
									<p><b>Curso: </b><select class="browser-default select-md" name="curso" ng-model="e.id_curso">
										<option ng-repeat="op in lista_cursos" value="{{op.id}}">{{op.grado}}</option>
									</select><br>
								    </p>
									<a href="" class="secondary-content" ng-click="form_edit_estudiante($index)">
										<i class="material-icons">edit</i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<center><button class="btn red" type="submit"><i class="material-icons left">done</i>guardar</button></center>
		</form>
      </div>
    </div>
</div>
<div id="modal_registrar_nuevo" class="modal material-modal">
    <div class="modal-content">
      <div class="card-panel">
      	<nav ng-class="{blue: modal_reg_tutor,  green: !modal_reg_tutor}">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Registrar nuevo {{modal_reg_head}}</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<div>
			<form id="form_reg_ins_nuevo" class="card-panel" style="margin: 0;" ng-submit="nuevo_registro($event)">
				<div class="row">
					<div class="col s12 m3 l2">
						<div class="picture-container">
	                        <div class="picture">
	                          <img src="<?=base_url()?>assets/images/avatar/hombre.png" class="picture-src" id="visualizacion_foto" title="">
	                          <input id="in_img" type="file" name="foto" accept="image/*">
	                        </div>
	                    </div>
					</div>
					<div class="col s12 m9 l10">
						<div class="row">
							<div class="input-field col s12 m4">
								<input type="text" id="in_nombres" name="nombres">
								<label for="in_nombres">Nombres</label>
							</div>
							<div class="input-field col s12 m4">
								<input type="text" id="in_a_paterno" name="a_paterno">
								<label for="in_a_paterno">Apellido Paterno</label>
							</div>
							<div class="input-field col s12 m4">
								<input type="text" id="in_a_materno" name="a_materno">
								<label for="in_a_materno">Apellido Materno</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m4">
								<input type="text" id="in_ci" name="ci">
								<label for="in_ci">Cedula de identidad</label>
							</div>
							<div class="col s12 m4">
								<label>Expedido</label>
								<select class="browser-default" name="exp" id="in_exp">
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
							<div class="col s12 m4" ng-if="modal_reg_tutor">
								<label>Parentesco</label>
								<select class="browser-default" name="parentesco" id="in_parentesco">
									<option value="Padre">Padre</option>
			                        <option value="Madre">Madre</option>
			                        <option value="Tutor">Tutor</option>
								</select>
							</div>
							<div class="col s12 m4" ng-if="!modal_reg_tutor">
								<label for="in_asignar_curso">Curso</label>
								<select id="in_asignar_curso" name="asignar_curso" class="browser-default">
									<option value="" selected>Seleccione un curso</option>
									<option ng-repeat="op in lista_cursos" value="{{op.id}}">{{op.grado}}</option>
								</select>
								<input type="hidden" name="tutor_id" value="{{data_padre.tutor_id}}">
							</div>
						</div>
					</div>
				</div>
				<br><br>
				<center><button class="btn" type="submit" ng-class="{blue: modal_reg_tutor,  green: !modal_reg_tutor}">Registrar</button></center>
			</form>
		</div>
      </div>
    </div>
</div>
<div id="modal_editar_registro" class="modal material-modal">
    <div class="modal-content">
      <div class="card-panel">
      	<nav class="red">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Modificar  {{modal_reg_head}}</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<div>
			<form id="form_reg_ins_edit" class="card-panel" style="margin: 0;" ng-submit="editar_registro($event)">
				<div class="row">
					<div class="col s12 m3 l2">
						<div class="picture-container">
	                        <div class="picture">
	                          <img src="<?=base_url()?>{{data_editar.foto_perfil}}" class="picture-src" id="visualizacion_foto" title="">
	                          <input id="in_img2" type="file" name="foto" accept="image/*">
	                        </div>
	                    </div>
					</div>
					<div class="col s12 m9 l10">
						<div class="row">
							<div class="input-field col s12 m4">
								<input type="text" id="in_nombres2" name="nombres" ng-model="data_editar.nombres">
								<label for="in_nombres2" class="active">Nombres</label>
							</div>
							<div class="input-field col s12 m4">
								<input type="text" id="in_a_paterno2" name="a_paterno" ng-model="data_editar.a_paterno">
								<label for="in_a_paterno2" class="active">Apellido Paterno</label>
							</div>
							<div class="input-field col s12 m4">
								<input type="text" id="in_a_materno2" name="a_materno" ng-model="data_editar.a_materno">
								<label for="in_a_materno2" class="active">Apellido Materno</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m4">
								<input type="text" id="in_ci2" name="ci" ng-model="data_editar.ci">
								<label for="in_ci2" class="active">Cedula de identidad</label>
							</div>
							<div class="col s12 m4">
								<label>Expedido</label>
								<select class="browser-default" name="exp" id="in_exp2" ng-model="data_editar.exp">
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
							<div class="col s12 m4" ng-if="modal_reg_tutor">
								<label>Parentesco</label>
								<select class="browser-default" name="parentesco" id="in_parentesco2" ng-model="data_editar.parentesco">
									<option value="Padre">Padre</option>
			                        <option value="Madre">Madre</option>
			                        <option value="Tutor">Tutor</option>
								</select>
								<input type="hidden" value="{{data_editar.tutor_id}}" name="tutor_id">
							</div>
							<div class="col s12 m4" ng-if="!modal_reg_tutor">
								<label for="in_asignar_curso2">Curso</label>
								<select id="in_asignar_curso2" name="asignar_curso" class="browser-default" ng-model="data_editar.id_curso">
									<option value="" selected>Seleccione un curso</option>
									<option ng-repeat="op in lista_cursos" value="{{op.id}}">{{op.grado}}</option>
								</select>
								<input type="hidden" name="id_estudiante" value="{{data_editar.id_estudiante}}">
							</div>
						</div>
					</div>
				</div>
				<br><br>
				<center><button class="btn red" type="submit">Modificar</button></center>
			</form>
		</div>
      </div>
    </div>
</div>
<div id="modal_informacion" class="modal material-modal modal-lg">
    <div class="modal-content">
      <div class="card-panel">
      	<nav class="blue">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Informacion general</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<div class="card-panel" style="margin:0;">
			
		</div>
      </div>
    </div>
</div>