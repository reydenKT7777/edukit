<div class="container">
  <div id="profile-page" class="section">
    <div id="profile-page-header" class="card">
      <div class="card-image waves-effect waves-block waves-light">
        <img src="<?=base_url()?>assets/images/gallary/28.png" alt="user background">
      </div>
      <figure class="card-profile-image">
        <img src="<?=base_url()?>assets/images/avatar/avatar-7.png" alt="profile image" class="circle z-depth-2 responsive-img gradient-45deg-light-blue-cyan gradient-shadow">
      </figure>
      <div class="card-content">
        <div class="row pt-2">
          <div class="col s12 m3 offset-m2">
            <h4 class="card-title grey-text text-darken-4">Profesores</h4>
            <p class="medium-small grey-text">Grupo de profesores del colegio</p>
          </div>
          <div class="col s12 m2 center-align">
            <h4 class="card-title grey-text text-darken-4"></h4>
            <p class="medium-small grey-text"></p>
          </div>
          <div class="col s12 m2 center-align">
            <h4 class="card-title grey-text text-darken-4"></h4>
            <p class="medium-small grey-text"></p>
          </div>
          <div class="col s12 m2 center-align">
            <h4 class="card-title grey-text text-darken-4">123</h4>
            <p class="medium-small grey-text">Miembros</p>
          </div>
          <div class="col s12 m1 right-align">
            <a class="btn-floating waves-effect waves-light rec accent-2 right">
              <i class="material-icons">group</i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div id="profile-page-content" class="row">
      <div id="profile-page-sidebar" class="col s12 m4">
        <a href="">
          <div class="card red accent-2">
            <div class="card-content white-text center-align">
              <p class="card-title">
                <i class="material-icons">group_add</i> 3685</p>
              <p>Miembros</p>
            </div>
          </div>  
        </a>
      </div>
      <div id="profile-page-wall" class="col s12 m8">
        <div class="card-panel" style="margin-top:  15px;">
          <form id="form_noti_post">
          <div class="row">
            <div class="col s2">
              <img src="<?=base_url()?><?=$this->session->foto_perfil?>" alt="" class="circle z-depth-2 responsive-img activator gradient-45deg-light-blue-cyan">
            </div>
            <div class="input-field col s10">
              <textarea id="in_text_post" row="2" class="materialize-textarea" name="contenido"></textarea>
              <label for="in_text_post" class="">Publicar noticia en el grupo</label>
            </div>
          </div>
          <div class="row" ng-show="subir_file">
            <div class="col s12 m12">
              <input type="file" name="adjunto" id="input-file-now" class="dropify" data-default-file="" />
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col s12  m6 share-icons">
              <a href="" ng-click="activa_subir_file()" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Adjuntar archivo">
                <i class="material-icons grey-text text-darken-1">attach_file</i>
              </a>
            </div>
            <div class="col s12 m6 right-align">
              <a class="waves-effect waves-light btn blue" ng-click="nuevo_post()">
                <i class="material-icons left">rate_review</i> Publicar</a>
            </div>
          </div>
          </form> 
        </div>
        <div id="profile-page-wall-posts" class="row">
          <div class="col s12">
            <!-- post imagen-->
            <div id="profile-page-wall-post" class="card" ng-repeat="n in lista_post">
              <div class="card-profile-title">
                <div class="row">
                  <div class="col s1">
                    <img src="<?=base_url()?>{{n.foto_perfil}}" alt="" class="circle z-depth-2 responsive-img activator gradient-45deg-light-blue-cyan">
                  </div>
                  <div class="col s10">
                    <p class="grey-text text-darken-4 margin">{{n.nombres}}</p>
                    <span class="grey-text text-darken-1 ultra-small">Publicado en {{n.fecha}}</span>
                  </div>
                  <div class="col s1 right-align">
                    <a class='dropdown-button black-text' href='javascript:void(0);' data-activates='dropdown_options_1' dropdown><i class="material-icons">expand_more</i></a>
                    <ul id='dropdown_options_1' class='dropdown-content'>
                      <li><a href=""><i class="material-icons">edit</i></a></li>
                      <li><a href=""><i class="material-icons">delete</i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12">
                    <p ng-if="n.tipo_adj == 3 || n.tipo_adj == 1">{{n.contenido}}
                    </p>
                    <div class="card horizontal" ng-if="n.tipo_adj == 2">
                      <div class="card-image">
                        <img src="<?=base_url()?>assets/images/icon/icon_{{n.formato_adj}}.jpg">
                      </div>
                      <div class="card-stacked">
                        <div class="card-content">
                          <p>{{n.contenido}}</p>
                        </div>
                        <div class="card-action">
                          <a href="" class="waves-effect waves-light btn gradient-45deg-red-pink"><i class="material-icons left">file_download</i>Descargar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-image profile-medium" ng-if="n.tipo_adj == 1">
                <img src="<?=base_url()?>{{n.src_adj}}" alt="sample" class="responsive-img profile-post-image profile-medium materialboxed">
              </div>
              <div class="card-content">
                <p><span class="card-title like" ng-click="mostrar_likes_noticia($index, n.noticia_id)"><b>{{n.meGusta}}</b> Me gusta</span>
                <a class="btn-floating btn-large halfway-fab2 waves-effect waves-light" ng-class="{blue: n.meGustaPersonal,  grey: !n.meGustaPersonal}" ng-click="modifica_like($index, n.noticia_id)"><i class="material-icons">thumb_up</i></a></p>
              </div>
            </div>
            <center>
              <a href="" class="btn-floating waves-effect waves-light red" ng-click="mas_posts()" ng-show="lista_post.length > 0"><i class="material-icons">replay_10</i></a>
            </center>
            <br><br>
            <!-- fin  post -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modal_lista_megustas" class="modal material-modal modal-xs">
  <div class="modal-content">
    <div class="card-panel">
      <nav class="blue">
        <div class="nav-wrapper" style="padding-left: 5px;">
          <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Personas a los que le gusta esta publicación</a>
          <ul class="right hide-on-med-and-down">
            <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
          </ul>
        </div>
      </nav>
      <div class="card-panel" style="margin:0;">
        <ul class="collection">
          <li class="collection-item avatar" ng-repeat="like in lista_megustas">
              <img src="<?=base_url()?>{{like.foto_perfil}}" alt="" class="circle">
              <span class="title"><b>{{like.nombres}}</b></span>
              <p>
              </p>
              <span class="task-cat blue" style="margin: 0;"><b>{{like.rol}}</b>
              </span>
              <a href="" class="secondary-content"><i class="material-icons">thumb_up</i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div id="modal_lista_miembros" class="modal material-modal modal-xs">
  <div class="modal-content">
    <div class="card-panel">
      <nav class="indigo">
        <div class="nav-wrapper" style="padding-left: 5px;">
          <a href="" class="brand-logo"><i class="material-icons" style="margin-right: 8px;">arrow_forward</i>Miembros del Grupo</a>
          <ul class="right hide-on-med-and-down">
            <li><a class="modal-action modal-close"><i class="material-icons">close</i></a></li>
          </ul>
        </div>
      </nav>
      <div class="card-panel" style="margin:0;">
        <ul class="collection">
          <li class="collection-item avatar" ng-repeat="mi in lista_miembros">
              <img src="<?=base_url()?>{{mi.foto_perfil}}" alt="" class="circle">
              <span class="title"><b>{{mi.nombres}}</b></span>
              <p>
              </p>
              <span class="task-cat blue" style="margin: 0;"><b>{{mi.rol}}</b>
              </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>