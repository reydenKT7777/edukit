<h4>Asistencia de profesores</h4>
<div class="row">
	<div class="col s12 l8 m8">
		<div class="row">
			<div class="col s12">
				<ul class="collection with-header">
					<li class="collection-header yellow darken-1 white-text"><h4>Retrasos</h4></li>
				    <li class="collection-item avatar">
				      <img src="<?=base_url()?>assets/images/avatar/default.png" alt="" class="circle">
				      <span class="title">Nombre completo</span>
				      <p>Fecha: <br>
				         15 abril 2018
				      </p>
				      <a href="#!" class="secondary-content"><i class="material-icons">info_outline</i></a>
				    </li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<ul class="collection with-header">
					<li class="collection-header red white-text"><h4>Inasistencia</h4></li>
				    <li class="collection-item avatar">
				      <img src="<?=base_url()?>assets/images/avatar/default.png" alt="" class="circle">
				      <span class="title">Nombre completo</span>
				      <p>Fecha <br>
				         15 abril 2018
				      </p>
				      <a href="#!" class="secondary-content"><i class="material-icons">info_outline</i></a>
				    </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col s12 l4 m4">
		<div id="ecommerce-offer">
            <div class="row">
				<div class="col s6 m12">
                    <div class="card gradient-shadow gradient-45deg-amber-amber border-radius-3">
                      <div class="card-content center">
                        <h5 class="white-text lighten-4">Ultima actualizacion</h5>
                        <p class="white-text lighten-4">15 de abril 2018</p>
                      </div>
                    </div>
				</div>
				<div class="col s6 m12">
                    <div class="card gradient-shadow gradient-45deg-green-teal border-radius-3">
                    	<a href="" ng-click="subir_datos()">
                    		<div class="card-content center">
	                        <img src="<?=base_url()?>assets/images/icon/import-icon.png" class="width-40 border-round z-depth-5">
	                        <h5 class="white-text lighten-4">Importar</h5>
	                        <p class="white-text lighten-4">Asistencia biometrica de profesores</p>
	                      </div>
                    	</a> 
                    </div>
                </div>
			</div>
    	</div>
	</div>
</div>
<div id="modal_subir_datos" class="modal">
    <div class="modal-content">
    	<center>
    		<h5>Subir datos del biometrico</h5>	
    	</center>
        <form id="form_subir_datos">
		    <div class="file-field input-field">
		      <div class="btn blue">
		        <span>subir archivo</span>
		        <input type="file" name="datos_excel">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
	    </form>
    </div>
    <div class="modal-footer">
      <a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
      <button class="btn indigo"><i class="material-icons left">unarchive</i>Subir</button>
    </div>
</div>