<div class="row">
	<div class="col s12 m8">
		<ul class="tabs" tabs reload="allTabContentLoaded">
			<li class="tab col s3"><a class="active" href="#tab_asis"><i class="material-icons left" style="padding-top: 10px;">create</i>Asistencia</a></li>
			<li class="tab col s3"><a href="#tab_his"><i class="material-icons left" style="padding-top: 10px;">history</i>Historial de asistencia</a></li>
		</ul>
			<div id="tab_asis">
				<div ng-if="asistencia_valid">
					<ul class="collection with-header">
						<li class="collection-header indigo accent-4 white-text">
							<h4 class="task-card-title-simple">Asistencias por curso hoy</h4>
							<p class="task-card-date-simple">Fecha: 3 de junio</p>
			            </li>
						<li class="collection-item" ng-repeat="c in lista_cursos_col">
							<div class="row">
								<div class="col s4">
									<b class="blue-text">{{c.grado}}{{c.paralelo}}</b> <b>de {{c.nivel}}</b>
								</div>
								<div class="col s3">
									<b class="green-text">Asistencia 0%</b>
								</div>
								<div class="col s3">
									<b class="red-text">Inasistencia 0%</b>
								</div>
								<div class="col s2">
									<a class="btn btn-floating pulse red" ng-click="seleccion_curso(c.id)"><i class="material-icons">playlist_add</i></a>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div ng-if="!asistencia_valid">
					<br><br>
					<div class="row">
						<div class="col s12 m6 offset-m3">
							<a href="" ng-click="fun_habilitar_asistencia()">
								<div class="card gradient-shadow gradient-45deg-red-pink border-radius-3">
					                <div class="card-content center">
					                    <img src="<?=base_url()?>/assets/images/icon/printer.png" class="width-40 border-round z-depth-5">
					                    <h5 class="white-text lighten-4">24 de junio 2018</h5>
					                    <p class="white-text lighten-4">Habilitar Asistencia de Hoy</p>
					                </div>
					            </div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div id="tab_his">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, cumque eum tempora ratione, placeat soluta! Ab minima asperiores ipsam, quia at eligendi quam, dignissimos quae facilis, tenetur voluptatem, obcaecati cumque!</p>
			</div>
	</div>
	<div class="col s12 m4">
		<div class="card-panel">
			<div class="row">
				<div class="input-field col s12">
					<select id='in_est_b' name="estudiante_id" style='width: 100%;'>
                	</select>
                	<label class="active" for="in_est_b">Buscar estudiante</label>
				</div>
			</div>
			<center>
				<button class="btn red" ng-click="bus_estudiante()">Buscar</button>
			</center>
		</div>
	</div>
</div>
<div id="modal_lista_curso" class="modal material-modal modal-md">
    <div class="modal-content">
      <div class="card-panel">
      	<nav class="indigo accent-4">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Asistencia 1A de secundaria</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<div class="card-panel" style="margin: 0;" ng-if="lista_estudiantes.length == 0">
			<h5>
				No se encontro información...
			</h5>
		</div>
		<form id="form-add-asistencia-curso" class="card-panel" style="margin: 0;" ng-if="lista_estudiantes.length > 0">
			<table class="highlight responsive-table">
				<thead>
					<th colspan="2">Nombres</th>
					<th colspan="2">Asistencias y retrasos</th>
					<th>Observación</th>
				</thead>
				<tbody>
					<tr ng-repeat="es in lista_estudiantes">
						<td>
							<span class="avatar-status">
			                  <img src="<?=base_url()?>{{es.foto_perfil}}" alt="avatar">
			                </span>
						</td>
						<td>{{es.nombre_completo}}</td>
						<td>
							<i ng-if="es.tipo_asistencia == '1' || es.tipo_asistencia == '2' || es.tipo_asistencia == '4'" class="material-icons" ng-class="{averde: es.tipo_asistencia == '1', arojo: es.tipo_asistencia == '2' || es.tipo_asistencia == '4'}">brightness_1</i>
							<i ng-if="es.tipo_asistencia == '3' || es.tipo_asistencia == '5'" class="material-icons" ng-class="{anegro: es.tipo_asistencia == '3', aplomo: es.tipo_asistencia == '5'}">access_alarm</i>
						</td>
						<td>
							<div>
								<select ng-model="es.tipo_asistencia" class="browser-default">
									<option value="1">Asistencia</option>
									<option value="2">Ausencia</option>
									<option value="3">Retraso</option>
									<option value="4">Ausencia justificado</option>
									<option value="5">Retraso justificado</option>
								</select>
							</div>
						</td>
						<td>
							<div class="input-field" style="margin-top: 0;">
					          <input id="in_obs" type="text" ng-model="es.observacion" style="margin: 0;">
					          <label for="in_obs">Observación</label>
					        </div>
						</td>
					</tr>
				</tbody>
			</table>
			<center><button class="btn red" ng-click="guardar_asistencia_curso()"><i class="material-icons left">done</i>guardar asistencia</button></center>
		</form>
      </div>
    </div>
</div>
<div id="modal_asistencia_in" class="modal material-modal modal-md">
	<div class="modal-content">
      <div class="card-panel">
      	<nav class="blue">
		    <div class="nav-wrapper" style="padding-left: 5px;">
		      <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Asistencia</a>
		      <ul class="right hide-on-med-and-down">
		        <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
		      </ul>
		    </div>
		</nav>
		<form id="form-add-asistencia-curso" class="card-panel" style="margin: 0;">
			<div class="row">
				<div class="col s12 m6">
					<div id="profile-card" class="card">
			            <div class="card-image waves-effect waves-block waves-light">
			                <img src="<?=base_url()?>{{datos_est_ind.foto_perfil}}" alt="user bg">
			            </div>
			            <div class="card-content">
							<img src="<?=base_url()?>assets/images/avatar/default.png" alt="" class="circle responsive-img card-profile-image-center cyan lighten-1 padding-2">
			                <span class="card-title grey-text text-darken-4" style="margin-top: 30px; text-align: center;">{{datos_est_ind.nombre_completo}}</span>
			                <p class="center-align"><b>{{datos_est_ind.curso}}</b></p>
			            </div>
			        </div>
				</div>
				<div class="col s12 m6">
					<div class="row">
						<div class="col s2">
							<i ng-if="datos_est_ind.tipo_asistencia == '1' || datos_est_ind.tipo_asistencia == '2' || datos_est_ind.tipo_asistencia == '4'" class="material-icons" ng-class="{averde: datos_est_ind.tipo_asistencia == '1', arojo: datos_est_ind.tipo_asistencia == '2' || datos_est_ind.tipo_asistencia == '4'}" style="margin-top: 30px; margin-left: 20px;">brightness_1</i>
							<i ng-if="datos_est_ind.tipo_asistencia == '3' || datos_est_ind.tipo_asistencia == '5'" class="material-icons" ng-class="{anegro: datos_est_ind.tipo_asistencia == '3', aplomo: datos_est_ind.tipo_asistencia == '5'}" style="margin-top: 30px; margin-left: 20px;">access_alarm</i>
						</div>
						<div class="col s10">
							<div>
								<label>Asistencia:</label>
								<select class="browser-default" ng-model="datos_est_ind.tipo_asistencia">
									<option value="1">Asistencia</option>
									<option value="2">Ausencia</option>
									<option value="3">Retraso</option>
									<option value="4">Ausencia justificado</option>
									<option value="5">Retraso justificado</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="input-field col s12" style="margin-top: 0;">
							<textarea id="in_obs_ind" class="materialize-textarea" ng-model="datos_est_ind.observacion"></textarea>
          					<label for="in_obs_ind">Observación</label>
					    </div>
					</div>
				</div>
			</div>
			<center><button class="btn red" type="submit" ng-click="guardar_asistencia_est()"><i class="material-icons left">done</i>guardar asistencia</button></center>
		</form>
      </div>
    </div>
</div>