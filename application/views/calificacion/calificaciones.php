<div class="card indigo">
    <div class="card-content">
      <h4 class="white-text">Seleccione materia</h4>
    </div>
    <div class="card-content blue lighten-5">
		<div class="collection notas"  ng-repeat="mat in lista">
		    <a href="#!notas/{{mat.id_mat}}" class="collection-item-mat tooltipped suspensivos" data-tooltip="Biologia" style="background-color:{{mat.color_hex}}"><span class="badge">{{mat.curso}} {{mat.nivel}}</span>{{mat.titulo}}</a>
		</div>
    </div>
</div>