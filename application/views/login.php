<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Sistema academico">
    <meta name="keywords" content="Alumnos, Profesor, Sistema academico">
    <title>Iniciar sesion</title>
    <!-- Favicons-->
    <link rel="icon" href="<?=base_url()?>assets/images/favicon/pestana.svg" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/images/favicon/pestana.svg">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->
    <!-- CORE CSS-->
    <link href="<?=base_url()?>assets/css/themes/fixed-menu/materialize.css" type="text/css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/themes/fixed-menu/style.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->
    <link href="<?=base_url()?>assets/css/custom/custom.css" type="text/css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/layouts/page-center.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?=base_url()?>assets/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/login.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <div id="login-page" class="row">
      <div class="col s12 z-depth-4 card-panel">
        <form class="login-form" id="iniciar-sis">
          <div class="row">
            <div class="input-field col s12 center">
              <img src="<?=base_url()?>assets/images/logo/l1.svg" alt="" class="responsive-img valign profile-image-login">
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix pt-5">person_outline</i>
              <input id="username" name="nombre_usuario" type="text">
              <label for="username">Nombre de usuario</label>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="material-icons prefix pt-5">lock_outline</i>
              <input id="password" name="password" type="password">
              <label for="password">Contraseña</label>
            </div>
          </div>
          <div class="row row-button">
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light col s12" type="submit">Iniciar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- ================================================
    Scripts
    ================================================ -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="<?=base_url()?>assets/vendors/jquery-3.2.1.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?=base_url()?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/plugins.js"></script>
    <!-- <script type="text/javascript" src="<?=base_url()?>assets/vendors/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("<?=base_url()?>assets/images/gallary/100.jpg", {speed: 500});
    </script> -->
    <script>
      function validachar(valor, ids, ms){
        if (valor==null || valor.length==0 || /^\s+$/.test(valor)){
          $(ids).removeClass("valid");
          $(ids).addClass("invalid");
          $(ids).focus();
          var $toastContent = $('<span><i class="material-icons red-text">error</i>&nbsp;&nbsp;'+ms+'</span>');
          Materialize.toast($toastContent, 2000);
          return 0;
        }else{
          $(ids).removeClass("invalid");
          $(ids).addClass("valid");
          return 1;
        }
      }
      $(document).ready(function() {
        $("#iniciar-sis").submit(function(event) {
          var user=$('#username').val();
          var pass=$('#password').val();
          aux1=validachar(user, "#username", "El nombre de usuario es obligatorio");
          aux2=validachar(pass, "#password", "La Contraseña es obligatorio");
          cont=aux1+aux2;
          if (cont===2) {
            $.ajax({
            type: 'POST',
            url: '<?=base_url()?>login/verificar',
            data: $('#iniciar-sis').serialize(),
            dataType:'json',
            success: function(log){
                if (log.valida =="ok"){
                    //window.self.location=log[0];
                    location.href="<?=base_url()?>template/sisa";
                }else{
                    var $toastContent = $('<span><i class="material-icons red-text">error</i>&nbsp;&nbsp; Error Verifique sus datos</span>');
                    Materialize.toast($toastContent, 2000);
                }
               }
            });
          }
          event.preventDefault();
        });
      });
    </script>
  </body>
</html>
