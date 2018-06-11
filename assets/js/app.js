var cod_perfil_grupo='';
///abrir modals
$(document).on('click', '.modalopen', function() {
    var namemodal=$(this).data("namemodal");
    $("#"+namemodal).modal('open');
});
// evento de subida de una nueva imagen
$(document).on('change', '#in_img', function(){
  leeimg(this);
})
$(document).on('change', '#in_img2', function(){
  leeimg2(this);
})
// inicializar select2
function buscador_select(dom, tip) {
    var url_peticion="";
    if (tip == 'tipo_1') {
        url_peticion = base_url_global+"Buscador/buscar_profesor";
    }else if (tip == 'tipo_2') {
        url_peticion = base_url_global+"Buscador/buscar_estudiante";
    }
  $(dom).select2({
    language: "es",
    placeholder: "Escriba Apellido y Nombre",
    allowClear: true,
    ajax: {
      url: url_peticion,
      dataType: 'json',
      delay: 250,
      data: function (parametro) {
        return {
          textob: parametro.term,
        };
      },
        processResults: function (data2) {
          return {
            results: data2
          };
        },
      cache: true
    },
    minimumInputLength: 2,
    escapeMarkup: function (markup2) { return markup2; },
    templateResult: formatRepo2,
    templateSelection: formatRepoSelection2
  });
  function formatRepo2 (repo2) {
    var markup2='<ul class="collection" style="width: 100%; margin: 0;">'+
          '<li class="collection-item avatar">'+
            '<img src="'+ base_url_global + repo2.foto_perfil +'" alt="" class="circle">'+
            '<span style="color:#333;"><b>'+ repo2.nombre +'</b></span>'+
            '<p style="color:#777;"><b>' + repo2.detalle + '</b><br>'+
            '</p>'+
          '</li>'+
        '</ul>';
    return markup2;
  }
  function formatRepoSelection2 (repo2) {
    return repo2.nombre || repo2.nombre;
  }
}
///validacion basica de inputs
function valida_input_vacios(elementos) {
    var vefica=true;
    var campos =0;
    var mensaje_error="";
    for (var i = 0; i < elementos.length; i++) {
        if ($('#'+elementos[i]).val() === '') {
            mensaje_error+=$("label[for="+elementos[i]+"]").text() + ", ";
        }else{
            campos++;
        }  
    }
    if (campos == elementos.length) {
        return true;
    }else{
        swal("Error", "Los campos: "+mensaje_error+" son obligatorios", "error");
        return false;
    }
}
//visualizar imagen de input file
function leeimg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#visualizacion_foto').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function leeimg2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#visualizacion_foto2').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
///inicializacion de datepiker basica
function date_picker(dom){
    $(dom).pickadate({
        monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
        monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
        weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
        weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
        weekdaysLetter:["D","L","M","M","J","V","S"],
        today: 'hoy',
        clear: 'borrar',
        close: 'cerrar',
        firstDay: 1,
        format: 'yyyy-mm-dd'
    });
}
///inicializacion de datepiker con seleccion de años y meses
function date_picker2(dom){
    $(dom).pickadate({
        selectMonths: true,
        selectYears: 30,
        monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
        monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
        weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
        weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
        weekdaysLetter:["D","L","M","M","J","V","S"],
        today: 'hoy',
        clear: 'borrar',
        close: 'cerrar',
        firstDay: 1,
        format: 'yyyy-mm-dd'
    });
}
/* inicializacion de los modulos de angular */
var app = angular.module("myApp", ["ngRoute", "ui.materialize"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : base_url_global+"template/principal",
        controller: 'principal_Controller'
    })
    .when("/administracion", {
        templateUrl : base_url_global+"template/administracion",
        controller: 'administracion_Controller'
    })
    .when("/nominapro", {
        templateUrl : base_url_global+"template/profesor_nomina",
        controller: 'profesor_nomina_Controller'
    })
    .when("/asistenciapro", {
        templateUrl : base_url_global+"template/profesor_asistencia",
        controller: 'profesor_asistencia_Controller'
    })
    .when("/disciplinapro", {
        templateUrl : base_url_global+"template/profesor_disciplina",
        controller: 'profesor_disciplina_Controller'
    })
    .when("/nominaest", {
        templateUrl : base_url_global+"template/estudiante_nomina",
        controller: 'estudiante_nomina_Controller'
    })
    .when("/asistenciaest", {
        templateUrl : base_url_global+"template/estudiante_asistencia",
        controller: 'estudiante_asistencia_Controller'
    })
    .when("/disciplinaest", {
        templateUrl : base_url_global+"template/estudiante_disciplina",
        controller: 'estudiante_disciplina_Controller'
    })
    .when("/cursos", {
        templateUrl : base_url_global+"template/cursos",
        controller: 'cursos_Controller'
    })
    .when("/grupos", {
        templateUrl : base_url_global+"template/mis_grupos",
        controller: 'mis_grupos_Controller'
    })
    .when("/mensajeria", {
        templateUrl : base_url_global+"template/mensajeria",
        controller: 'mensajeria_Controller'
    })
    .when("/perfilgrupo", {
        templateUrl : base_url_global+"template/perfil_grupo",
        controller: 'perfil_grupo_Controller'
    });
});
app.controller('principal_Controller', function($scope, $http, $location) {
    $scope.subir_file=false;
    $('.dropify').dropify();
    $('.modal').modal();
    $scope.lista_post=[];
    $scope.lista_megustas=[];
    $scope.top_grupos=[];
    $scope.lista_top_grupos=function(){
        $http.get(base_url_global+"Controlador_grupos/listar_top_grupos").then(function(response){
            $scope.top_grupos=response.data;
        })
    }
    $scope.dir_perfil_grupo=function(val_ruta){
        cod_perfil_grupo = val_ruta;
        $location.path("/perfilgrupo");
    }
    $scope.activa_subir_file=function(){
        if ($scope.subir_file) {
            $scope.subir_file=false;
        }else{
            $scope.subir_file=true;
        }
    }
    $scope.nuevo_post=function(){
        var formData = new FormData($("#form_noti_post")[0]);
        var aux =$('#in_text_post').val();
        if (aux != '') {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_publicacion/agregar_datos?ref_ver=ng',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Noticia publicada con exito</span>');
                        Materialize.toast($toastContent, 2000);
                        $scope.lista_post.unshift(respuesta[1]);
                        $scope.$apply();
                        $("#form_noti_post").trigger('reset');
                        $scope.subir_file=false;
                        $('.dropify-clear').click();
                    }else{
                        swal("Error", respuesta[0], "error");
                    }  
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });   
        }else{
            var $toastContent = $('<span><i class="material-icons red-text">error</i>&nbsp;&nbsp; El contenido de la noticia es obligatorio</span>');
            Materialize.toast($toastContent, 2000);
        }
    }
    $scope.listar_posts=function(){
        $http.get(base_url_global+"Controlador_publicacion/listar_publicacion?pag=0").then(function(response){
            $scope.lista_post=response.data;
        })
    }
    $scope.mas_posts=function(){
        var pagpost=$scope.lista_post.length;
        $http.get(base_url_global+"Controlador_publicacion/listar_publicacion?pag="+pagpost).then(function(response){
            for(var i in response.data){
                $scope.lista_post.push(response.data[i]);
            }
        })
    }
    $scope.modifica_like=function(index, puid){
        $http.get(base_url_global+"Controlador_publicacion/modificaMeGusta?nid="+puid).then(function(response){
            if (response.data[0]) {
                $scope.lista_post[index].meGusta=($scope.lista_post[index].meGusta)*1+1;
                $scope.lista_post[index].meGustaPersonal=true;
            }else{
                $scope.lista_post[index].meGusta=($scope.lista_post[index].meGusta)*1-1;
                $scope.lista_post[index].meGustaPersonal=false;
            }
        })
    }
    $scope.mostrar_likes_noticia=function(puntero, puid){
        $http.get(base_url_global+"Controlador_publicacion/me_gusta_noticia?nid="+puid).then(function(response){
            $scope.lista_megustas=response.data[0];
            if ($scope.lista_megustas.length > 0) {
               $("#modal_lista_megustas").modal('open');
               $scope.lista_post[puntero].meGusta=response.data[1];
            }
        })
    }
    $scope.listar_posts();
    $scope.lista_top_grupos();
    $('.materialboxed').materialbox();
});
app.controller('mis_grupos_Controller', function($scope, $http) {
    
});
app.controller('perfil_grupo_Controller', function($scope, $http) {
    $scope.subir_file=false;
    $('.dropify').dropify();
    $('.modal').modal();
    $scope.lista_post=[];
    $scope.lista_megustas=[];
    $scope.info_grupo=[];
    $scope.lista_miembros=[];
    $scope.activa_subir_file=function(){
        if ($scope.subir_file) {
            $scope.subir_file=false;
        }else{
            $scope.subir_file=true;
        }
    }
    $scope.nuevo_post=function(){
        var formData = new FormData($("#form_noti_post")[0]);
        var aux =$('#in_text_post').val();
        if (aux != '') {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_publicacion/agregar_datos?ref_ver='+cod_perfil_grupo,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $("#form_noti_post").trigger('reset');
                        var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Noticia publicada con exito</span>');
                        Materialize.toast($toastContent, 2000);
                        $scope.lista_post.unshift(respuesta[1]);
                        $scope.$apply();
                        $scope.subir_file=false;
                        $('.dropify-clear').click();
                    }else{
                        swal("Error", respuesta[0], "error");
                    }  
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });   
        }else{
            var $toastContent = $('<span><i class="material-icons red-text">error</i>&nbsp;&nbsp; El contenido de la noticia es obligatorio</span>');
            Materialize.toast($toastContent, 2000);
        }
    }
    /*$scope.listar_posts_g=function(){
        $http.get(base_url_global+"Controlador_publicacion/listar_publicacion?pag=0&ref_ver="+cod_perfil_grupo).then(function(response){
            $scope.lista_post=response.data;
        })    
    }*/
    $scope.mas_posts=function(){
        var pagpost=$scope.lista_post.length;
        $http.get(base_url_global+"Controlador_publicacion/listar_publicacion?pag="+pagpost+"&ref_ver="+cod_perfil_grupo).then(function(response){
            for(var i in response.data){
                $scope.lista_post.push(response.data[i]);
            }
        })
    }
    $scope.modifica_like=function(index, puid){
        $http.get(base_url_global+"Controlador_publicacion/modificaMeGusta?nid="+puid).then(function(response){
            if (response.data[0]) {
                $scope.lista_post[index].meGusta=($scope.lista_post[index].meGusta)*1+1;
                $scope.lista_post[index].meGustaPersonal=true;
            }else{
                $scope.lista_post[index].meGusta=($scope.lista_post[index].meGusta)*1-1;
                $scope.lista_post[index].meGustaPersonal=false;
            }
        })
    }
    $scope.mostrar_likes_noticia=function(puntero, puid){
        $http.get(base_url_global+"Controlador_publicacion/me_gusta_noticia?nid="+puid).then(function(response){
            $scope.lista_megustas=response.data[0];
            if ($scope.lista_megustas.length > 0) {
               $("#modal_lista_megustas").modal('open');
               $scope.lista_post[puntero].meGusta=response.data[1];
            }
        })
    }
    $scope.ver_info_grupo=function(){
        $http.get(base_url_global+"Controlador_publicacion/listar_publicacion?ref_ver="+cod_perfil_grupo).then(function(response){
            $scope.lista_post=response.data[1];
            $scope.info_grupo=response.data[0];
        })
    }
    $scope.mostrar_miembros=function(){
        $http.get(base_url_global+"Controlador_publicacion/listar_publicacion?ref_ver="+cod_perfil_grupo).then(function(response){
            $scope.lista_miembros=response.data;
            $("#modal_lista_miembros").modal('open');
        })
    }
    //$scope.ver_info_grupo();
    $('.materialboxed').materialbox();
});
app.controller('mensajeria_Controller', function($scope, $http) {
    
});
app.controller('administracion_Controller', function($scope, $http) {
    $('.stepper').activateStepper();
    $('.modal').modal();
    $('select').material_select();
    date_picker2("#in_fecha");
    $scope.lista_activos=[];
    $scope.lista_inactivos=[];
    $scope.form=[];
    $scope.tab_inactivo=false;
    $scope.info_pro=[];
    $scope.puntero_aux="";
    $scope.listar_admin=function(){
        $http.get(base_url_global+"controlador_administracion/listar_administracion").then(function(response){
            $scope.lista_activos=response.data;
        }) 
    }
    $scope.listar_admin_inactivos=function(){
        if ($scope.tab_inactivo==false) {
            $http.get(base_url_global+"controlador_administracion/listar_administracion_baja").then(function(response){
                $scope.lista_inactivos=response.data;
            }) 
        }
    }
    $scope.agregar_registro_admin=function(e){
        e.preventDefault();
        var formData = new FormData($("#form_add_admin")[0]);
        var valid =valida_input_vacios(["in_nombres","in_a_paterno","in_a_materno","in_ci","in_usuario","in_password"]);
        if (valid) {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_administracion/agregar_datos',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_admin();
                        $("#addadmin").modal('close');
                        $("#form_add_admin").trigger('reset');
                        swal("Registro agregado", "", "success");
                    }else{
                        swal("Error", respuesta[1], "error");
                    }
                    
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });     
        }  
    }
    $scope.form_modificar_registro_admin=function(puntero){
        $scope.form=$scope.lista_activos[puntero];
        $("#editadmin").modal('open');        
    }
    $scope.form_modificar_registro_admin2=function(){
        $scope.form=$scope.lista_activos[$scope.puntero_aux];
        $("#veradmin").modal('close');
        $("#editadmin").modal('open');        
    }
    $scope.modificar_registro_admin=function(e){
        e.preventDefault();
        var formData = new FormData($("#form_edit_admin")[0]);
        var valid =valida_input_vacios(["in_nombres2","in_a_paterno2","in_a_materno2","in_ci2","in_usuario2"]);
        if (valid) {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_administracion/modificar_administracion',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_admin();
                        $("#editadmin").modal('close');
                        swal("Registro Modificado", "", "success");
                    }else{
                        swal("Error", respuesta[1], "error");
                    }   
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });   
        }
    }
    $scope.desactivar_registro_admin=function(id) {
        swal({
            title: "Este registro sera dado de baja",
            text: "Desea Continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_administracion/eliminar_datos',
                data: {id_persona:id},
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_admin();
                        swal("Registro dado de baja", "", "success");   
                    }
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });
        });
    }
    $scope.activar_registro_admin=function(id) {
        swal({
            title: "Este registro sera dado de alta",
            text: "Desea Continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_administracion/activar_datos',
                data: {id_persona:id},
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_admin();
                        $scope.listar_admin_inactivos();
                        swal("El registro fue dado de alta", "", "success");   
                    }
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });
        });
    }
    $scope.ver_registro_admin=function(puntero){
        $scope.info_pro=$scope.lista_activos[puntero];
        $scope.puntero_aux=puntero;
        $("#veradmin").modal('open'); 
    }
    $scope.listar_admin();
});
app.controller('profesor_nomina_Controller', function($scope, $http) {
    $('.stepper').activateStepper();
    $('.modal').modal();
    $('select').material_select();
    date_picker2("#in_fecha");
    $scope.lista=[];
    $scope.lista2=[];
    $scope.form=[];
    $scope.tab_inactivo=false;
    $scope.info_pro=[];
    $scope.puntero_aux="";
    $scope.listar_profesores=function(){
        $http.get(base_url_global+"controlador_profesor/listar_profesor").then(function(response){
            $scope.lista=response.data;
        }) 
    }
    $scope.listar_profesores_inactivos=function(){
        if ($scope.tab_inactivo==false) {
            $http.get(base_url_global+"controlador_profesor/listar_profesor_baja").then(function(response){
                $scope.lista2=response.data;
            }) 
        }
    }
    $scope.agregar_registro=function(e){
        e.preventDefault();
        var formData = new FormData($("#form_add_profesor")[0]);
        var valid =valida_input_vacios(["in_nombres","in_a_paterno","in_a_materno","in_ci","in_usuario","in_password"]);
        if (valid) {
            $.ajax({
                type: 'POST',
                url: base_url_global+'Controlador_profesor/agregar_datos',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_profesores();
                        $("#addprofesor").modal('close');
                        $("#form_add_profesor").trigger('reset');
                        swal("Registro agregado", "", "success");
                    }else{
                        swal("Error", respuesta[1], "error");
                    }
                    
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });     
        }  
    }
    $scope.form_modificar_registro=function(puntero){
        $scope.form=$scope.lista[puntero];
        $("#editprofesor").modal('open');        
    }
    $scope.form_modificar_registro2=function(){
        $scope.form=$scope.lista[$scope.puntero_aux];
        $("#verprofesor").modal('close');
        $("#editprofesor").modal('open');        
    }
    $scope.modificar_registro=function(e){
        e.preventDefault();
        var formData = new FormData($("#form_edit_profesor")[0]);
        var valid =valida_input_vacios(["in_nombres2","in_a_paterno2","in_a_materno2","in_ci2","in_usuario2"]);
        if (valid) {
            $.ajax({
                type: 'POST',
                url: base_url_global+'Controlador_profesor/modificar_profesor',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_profesores();
                        $("#editprofesor").modal('close');
                        swal("Registro Modificado", "", "success");
                    }else{
                        swal("Error", respuesta[1], "error");
                    }   
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });   
        }
    }
    $scope.eliminar_registro=function(id) {
        swal({
            title: "Este registro sera dado de baja",
            text: "Desea Continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: 'POST',
                url: base_url_global+'Controlador_profesor/eliminar_datos',
                data: {id_persona:id},
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_profesores();
                        swal("Registro dado de baja", "", "success");   
                    }
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });
        });
    }
    $scope.activar_registro=function(id) {
        swal({
            title: "Este registro sera dado de alta",
            text: "Desea Continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: 'POST',
                url: base_url_global+'Controlador_profesor/activar_datos',
                data: {id_persona:id},
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_profesores();
                        $scope.listar_profesores_inactivos();
                        swal("El registro fue dado de alta", "", "success");   
                    }
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });
        });
    }
    $scope.ver_registro=function(puntero){
        $scope.info_pro=$scope.lista[puntero];
        $scope.puntero_aux=puntero;
        $("#verprofesor").modal('open'); 
    }
    $scope.listar_profesores();
});
app.controller('profesor_asistencia_Controller', function($scope, $http) {
    $scope.subir_datos=function(){
        $('.modal').modal();
        $("#modal_subir_datos").modal('open');
    }
});
app.controller('profesor_disciplina_Controller', function($scope, $http) {
    $scope.lista=[];
    buscador_select("#in_profe", 'tipo_1');
    $scope.lista_disciplinas=[];
    $scope.listar_disciplinas=function(){
        $http.get(base_url_global+"Controlador_disciplina_docente/listar_disciplina_docente").then(function(response){
            $scope.lista_disciplinas=response.data;
        })
    }
    $scope.nueva_disciplina=function(){
        $('.modal').modal();
        $("#modal_nuevo").modal('open');
    }
    $scope.registrar_disciplina=function(e){
        e.preventDefault();
        var valid =valida_input_vacios(["in_profe", "in_descripcion"]);
        if (valid) {
            $.ajax({
                type: 'POST',
                url: base_url_global+'controlador_disciplina_docente/agregar_datos',
                data: $('#form-add-disciplina').serialize(),
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $scope.listar_disciplinas();
                        $("#modal_nuevo").modal('close');
                        $("#form-add-disciplina").trigger('reset');
                        swal("Registro agregado", "", "success");
                    }else{
                        swal("Error", respuesta[1], "error");
                    } 
                }, 
                beforeSend: function() {
                  
                },
                complete: function() {
                  
                }
            });     
        }
    }
    $scope.listar_disciplinas();
});
app.controller('estudiante_nomina_Controller', function($scope, $http) {
    $scope.data_ins=[];
    $scope.data_estudiantes=[];
    $scope.data_padre=[];
    $scope.ci_padre="";
    $scope.lista_cursos=[];
    $scope.modal_reg_tutor=true;
    $scope.modal_reg_head="";
    $scope.data_editar=[];
    $scope.item_curso="";
    $scope.estudiantes_curso=[];
    $('.modal').modal();
    $scope.listar_estudiantes_curso=function(){
        $http.get(base_url_global+"Controlador_estudiante/buscar_estudiantes_curso?curso="+$scope.item_curso).then(function(response){
            $scope.estudiantes_curso=response.data;
        })
    }
    $scope.verifica_padre=function(){
        $http.post(base_url_global+"buscador/buscar_tutor", {'ci': $scope.ci_padre}).then(function(response){
            $scope.data_ins=response.data;
            if ($scope.data_ins[0]) {
                $scope.data_padre=$scope.data_ins[1];
                $scope.data_estudiantes=$scope.data_ins[2];
                $("#modal_registrar").modal('open');
            }else{
                $scope.modal_reg_tutor=true;
                $scope.modal_reg_head="tutor";
                swal({
                    title: "No se encontro el registro",
                    text: "Desea Registrarlo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#f44336',
                    confirmButtonText: 'Aceptar',
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $("#modal_registrar_nuevo").modal('open');
                });
            }
        })
    }
    $scope.listar_cursos=function(){
        $http.get(base_url_global+"controlador_curso/listar_curso").then(function(response){
            $scope.lista_cursos=response.data;
        })
    }
    $scope.modal_registrar_estudiante=function(){
        $scope.modal_reg_head="estudiante";
        $scope.modal_reg_tutor=false;
        $("#modal_registrar_nuevo").modal('open');
        $("#modal_registrar").modal('close');
    }
    $scope.nuevo_registro=function(e){
        e.preventDefault();
        var formData = new FormData($("#form_reg_ins_nuevo")[0]);
        var valid=false;
        var url_post="";
        if ($scope.modal_reg_tutor) {
            valid =valida_input_vacios(["in_nombres","in_a_paterno","in_a_materno","in_ci"]);
            url_post=base_url_global+'controlador_tutor/agregar_datos';
        }else{
            valid =valida_input_vacios(["in_nombres","in_a_paterno","in_a_materno","in_ci","in_asignar_curso"]);
            url_post=base_url_global+'controlador_estudiante/agregar_datos';
        }
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url_post,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $("#modal_registrar_nuevo").modal('close');
                        $("#form_reg_ins_nuevo").trigger('reset');
                        swal("Registro agregado", "", "success");
                        $scope.verifica_padre();
                    }else{
                        swal("Error", respuesta[1], "error");
                    }  
                }, 
                beforeSend: function() {
                      
                },
                complete: function() {
                      
                }
            });     
        }
    }
    $scope.registrar_inscripcion=function(e){
        e.preventDefault();
        $http.post(base_url_global+"controlador_estudiante/modificar_inscripcion", $scope.data_estudiantes).then(function(response){
            if (response.data[0]) {
                $("#modal_registrar").modal('close');
                var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Inscripcion modificada</span>');
                Materialize.toast($toastContent, 2000);
            }
        })
    }
    $scope.form_edit_tutor=function(){
        $scope.data_editar=$scope.data_padre;
        $scope.modal_reg_tutor=true;
        $scope.modal_reg_head="tutor";
        $("#modal_editar_registro").modal('open');
    }
    $scope.form_edit_estudiante=function(puntero){
        $scope.data_editar=$scope.data_estudiantes[puntero];
        $scope.modal_reg_tutor=false;
        $scope.modal_reg_head="estudiante";
        $("#modal_editar_registro").modal('open');
    }
    $scope.editar_registro=function(e){
        e.preventDefault();
        var formData = new FormData($("#form_reg_ins_edit")[0]);
        var valid=false;
        var url_post="";
        if ($scope.modal_reg_tutor) {
            valid =valida_input_vacios(["in_nombres2","in_a_paterno2","in_a_materno2","in_ci2"]);
            url_post=base_url_global+'controlador_tutor/modificar_tutor';
        }else{
            valid =valida_input_vacios(["in_nombres2","in_a_paterno2","in_a_materno2","in_ci2","in_asignar_curso2"]);
            url_post=base_url_global+'controlador_estudiante/modificar_estudiante';
        }
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url_post,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){
                    if (respuesta[0]) {
                        $("#modal_editar_registro").modal('close');
                        var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Registro modificado</span>');
                        Materialize.toast($toastContent, 2000);
                    }else{
                        swal("Error", respuesta[1], "error");
                    }  
                }, 
                beforeSend: function() {
                      
                },
                complete: function() {
                      
                }
            });     
        }
    }
    $scope.modal_info=function(){
        $("#modal_informacion").modal('open');
    }
    $scope.listar_cursos();
});
app.controller('estudiante_asistencia_Controller', function($scope, $http) {
    $('.modal').modal();
    buscador_select("#in_est_b", 'tipo_2');
    $scope.lista_cursos_col=[];
    $scope.lista_estudiantes=[];
    $scope.asistencia_valid=false;
    $scope.datos_est_ind=[];
    $scope.bus_estudiante=function(){
        var aux_id=$('#in_est_b').val();
        $http.get(base_url_global+"Controlador_asistencia/asistencia_individual?id_estudiante="+aux_id).then(function(response){
            $scope.datos_est_ind=response.data[0];
        })
        $("#modal_asistencia_in").modal('open');
    }
    $scope.guardar_asistencia_est=function(){
        $http.post(base_url_global+"Controlador_asistencia/guardar_asistencia_individual", $scope.datos_est_ind).then(function(response){
            if (response.data[0]) {
                $("#modal_asistencia_in").modal('close');
                var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Asistencia guardado con exito</span>');
                Materialize.toast($toastContent, 2000);
            }
        })
    }
    $scope.listar_cursos_col=function(){
        $http.get(base_url_global+"Controlador_asistencia/listar_cursos").then(function(response){
            $scope.lista_cursos_col=response.data;
        })
    }
    $scope.seleccion_curso=function(var_id_curso){
        $http.get(base_url_global+"Controlador_asistencia/listar_asistencia_estudiantes_curso?id="+var_id_curso).then(function(response){
            $scope.lista_estudiantes=response.data;
        })
        $("#modal_lista_curso").modal('open');  
    }
    $scope.fun_habilitar_asistencia=function(){
        if (!$scope.asistencia_valid) {
            $http.get(base_url_global+"Controlador_asistencia/asistencias_retrasos").then(function(response){
                if(response.data[0]){
                    $scope.asistencia_valid=true;
                    $scope.listar_cursos_col();
                }
            })
        }
    }
    $scope.guardar_asistencia_curso=function(){
        $http.post(base_url_global+"Controlador_asistencia/guardar_asistencia", $scope.lista_estudiantes).then(function(response){
            if (response.data[0]) {
                $("#modal_lista_curso").modal('close');
                var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Lista de asistencia guardado con exito</span>');
                Materialize.toast($toastContent, 2000);
                $scope.listar_cursos_col();
            }
        })
    }
    $http.get(base_url_global+"Controlador_asistencia/mis_registros_asistencia").then(function(response){
        if (response.data[0]) {
            $scope.asistencia_valid=true;
            $scope.listar_cursos_col();
        }else{
            $scope.asistencia_valid=false;
        }
    })
});
app.controller('estudiante_disciplina_Controller', function($scope, $http) {
});
app.controller('cursos_Controller', function($scope, $http) {
    $('.modal').modal();
    $scope.cursos=[];
    $scope.datos_curso=[];
    $scope.cursos_libres=[];
    $scope.listar_cursos=function(){
        $http.get(base_url_global+"controlador_curso/listar_curso_completo").then(function(response){
            $scope.cursos=response.data;
        })
    }
    $scope.form_editar_curso=function(puntero){
        $scope.datos_curso=$scope.cursos[puntero];
        $("#modal_editar_curso").modal('open');
    }
    $scope.listar_cursos_libres=function(){
        $http.get(base_url_global+"controlador_curso/cursos_disponibles").then(function(response){
            $scope.cursos_libres=response.data;
        })
    }
    $scope.habilitar_curso=function(){
        $http.post(base_url_global+"controlador_curso/agregar_datos", $scope.cursos_libres[$scope.select_curso]).then(function(response){
            if (response.data[0]) {
                $scope.listar_cursos();
                $scope.listar_cursos_libres();
                $("#modal_nuevo_curso").modal('close');
                var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Nuevo curso habilitado</span>');
                Materialize.toast($toastContent, 2000);
            }
        })
    }
    $scope.deshabilitar_curso=function(){
        $http.post(base_url_global+"controlador_curso/modificar_curso", $scope.datos_curso).then(function(response){
            if (response.data[0]) {
                $("#modal_editar_curso").modal('close');
                var $toastContent = $('<span><i class="material-icons green-text">done</i>&nbsp;&nbsp; Curso modificado</span>');
                Materialize.toast($toastContent, 2000);
            }
        })
    }
    $scope.listar_cursos();
    $scope.listar_cursos_libres();
});
app.controller('sidebar_control', function($scope, $http) {
    $scope.contador_nom_profesor="";
    $http.get(base_url_global+"contador/contar_profesor").then(function(response){
        $scope.contador_nom_profesor=response.data[0];
    })
});
