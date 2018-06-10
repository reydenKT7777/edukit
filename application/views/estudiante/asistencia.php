<div class="row">
	<div class="col s12 m8">
		<ul class="tabs" tabs reload="allTabContentLoaded">
			<li class="tab col s3"><a class="active" href="#tab_asis"><i class="material-icons left" style="padding-top: 10px;">create</i>Asistencia</a></li>
			<li class="tab col s3"><a href="#tab_his"><i class="material-icons left" style="padding-top: 10px;">history</i>Historial de asistencia</a></li>
		</ul>
		<div>
			<div id="tab_asis">
				<ul class="collection with-header">
					<li class="collection-header indigo accent-4 white-text">
						<h4 class="task-card-title-simple">Asistencias por curso hoy</h4>
						<p class="task-card-date-simple">Fecha: 3 de junio</p>
		            </li>
					<li class="collection-item">
						<div class="row">
							<div class="col s4">
								<b>1A  de secundaria</b>
							</div>
							<div class="col s3">
								<b class="green-text">Asistencia 0%</b>
							</div>
							<div class="col s3">
								<b class="red-text">Inasistencia 0%</b>
							</div>
							<div class="col s2">
								<a class="btn btn-floating pulse red" ng-click="seleccion_curso()"><i class="material-icons">playlist_add</i></a>
							</div>
						</div>
					</li>
					<li class="collection-item">
						<div class="row">
							<div class="col s4">
								<b>2B  de secundaria</b>
							</div>
							<div class="col s3">
								<b class="green-text">Asistencia 10%</b>
							</div>
							<div class="col s3">
								<b class="red-text">Inasistencia 90%</b>
							</div>
							<div class="col s2">
								<a class="btn btn-floating blue"><i class="material-icons">done</i></a>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab_his">
				aaaaa
			</div>
		</div>
	</div>
	<div class="col s12 m4">
		<div class="card-panel">
			<div class="row">
					<div class="col s12 input-field">
						<input id="in_buscar_e" type="text" name="nombre">
						<label for="in_buscar_e">
							Buscar estudiante
						</label>
					</div>
			</div>
		</div>
	</div>
</div>
<div id="modal_lista_curso" class="modal material-modal modal-xs">
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
		<form id="form-add-asistencia-curso" class="card-panel" style="margin: 0;">
			<table class="highlight responsive-table">
				<thead>
					<th></th>
					<th>Nombres</th>
					<th>Asistencias y retrasos</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<span class="avatar-status">
			                  <img src="<?=base_url()?>assets/images/avatar/default.png" alt="avatar">
			                </span>
						</td>
						<td>1. Jhonny marcelo</td>
						<td>
							<i class="material-icons green-text">brightness_1</i>
						</td>
					</tr>
				</tbody>
			</table>
			<center><button class="btn red" type="submit"><i class="material-icons left">done</i>guardar asistencia</button></center>
		</form>
      </div>
    </div>
</div>