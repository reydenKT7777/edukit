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
          profesor: parametro.term,
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
            '<p style="color:#777;"><b>Especialidad: </b>' + repo2.especialidad + '<br>'+
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
    .when("/materias", {
        templateUrl : base_url_global+"template/materias",
        controller: 'materias_Controller'
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
app.controller('materias_Controller', function($scope, $http) {
    
});
////////////////////
app.controller('sidebar_control', function($scope, $http) {
    
});
