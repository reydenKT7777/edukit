<h5><i class="material-icons left">arrow_forward</i> Mis Grupos</h5>
<div class="row">
	<div class="col s12 m6 offset-m3">
		<div id="flight-card" class="card">
            <div class="card-header deep-orange accent-2">
                <div class="card-title">
                    <h4 class="flight-card-title">Grupos</h4>
                    <p class="flight-card-date">Profesores, Cursos, Materias</p>
                </div>
            </div>
            <div class="card-content white">
            	<div class="input-field">
            		<i class="material-icons prefix">search</i>
            		<input type="text" id="in_buscar_grupo">
            		<label for="in_buscar_grupo">Buscar grupo</label>
            	</div>
            	<span class="mini-titulo">Grupo Profesores</span>
      			<hr>
      			<div id="email-list">
		            <ul id="issues-collection" class="collection">
		              <li class="collection-item avatar email-unread">
		                <span class="circle indigo darken-1">P</span>
		                <span class="email-title">Profesores</span>
		                <p class="truncate grey-text ultra-small">Grupo de profesores del colegio</p>
		                <a href="#!" class="secondary-content email-time">
		                  <span class="blue-text ultra-small">123 Miembros</span>
		                </a>
		              </li>
		            </ul>
		          </div>
            	<span class="mini-titulo">Grupos por Curso</span>
      			<hr>
				<div id="email-list">
		            <ul id="issues-collection" class="collection">
		              <li class="collection-item avatar email-unread" ng-click="dir_perfil_grupo(GP-0)">
		                <span class="circle red">1</span>
		                <span class="email-title"><b>1B</b> - Secundaria</span>
		                <p class="truncate grey-text ultra-small">Grupo de estudiantes del curso</p>
		                <a href="" class="secondary-content email-time">
		                  <span class="blue-text ultra-small">25 Miembros</span>
		                </a>
		              </li>
		            </ul>
		          </div>
				<span class="mini-titulo">Grupos por Materia</span>
      			<hr>
      			<div id="email-list">
	      			<ul class="collection">
					    <li class="collection-item avatar">
					      <span class="circle red lighten-1">M</span>
					      <span class="title"><b>Matematicas</b> (<b class="blue-text">1B</b> <span class="blue-text">Secundaria</span>)</span>
					      <p class="grey-text">
					         <b>36</b> Miembros
					      </p>
					    </li>
					</ul>
      			</div>
            </div>
        </div>
	</div>
</div>