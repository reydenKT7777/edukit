$(document).ready(function() {
    $('.stepper').activateStepper();
});
$(document).on('click', '.modalopen', function() {
    var namemodal=$(this).data("namemodal");
    $("#"+namemodal).modal('open');
});
function inicia_pickadate(dom) {
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
    format: 'yyyy-mm-dd',
    /*formatSubmit: 'yyyy-mm-dd'*/
  });
}
function inicia_pickadate2(dom) {
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
      format: 'yyyy-mm-dd',
      selectMonths: true, //
      selectYears: 80 // 
  });
}
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
    });
});
app.controller('principal_Controller', function($scope, $http) {
});
app.controller('administracion_Controller', function($scope, $http) {
});
app.controller('profesor_nomina_Controller', function($scope, $http) {
    $('.modal').modal();
    $('select').material_select();
    inicia_pickadate("#in_fecha");
    $scope.lista=[];
    $scope.form=[];
    $http.get(base_url_global+"controlador_profesor/listar_profesor").then(function(response){
       $scope.lista=response.data;
    })
    $scope.agregar_registro=function(puntero){
        swal("Registro agregado", "", "success");
    }
    $scope.form_modificar_registro=function(puntero){
        $scope.form=$scope.lista[puntero];
        $("#editprofesor").modal('open');
    }
    $scope.modificar_registro=function(){
        swal("Registro Modificado", "puntero: "+puntero, "success");
    }
    $scope.eliminar_registro=function(id) {
        swal({
            title: "Este registro sera eliminado",
            text: "Desea Continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            confirmButtonText: 'Eliminar',
            closeOnConfirm: false
        },
        function() {
            swal("Registro eliminado", "", "success");
        });
    }
});
app.controller('profesor_asistencia_Controller', function($scope, $http) {
});
app.controller('profesor_disciplina_Controller', function($scope, $http) {
});
app.controller('estudiante_nomina_Controller', function($scope, $http) {
});
app.controller('estudiante_asistencia_Controller', function($scope, $http) {
});
app.controller('estudiante_disciplina_Controller', function($scope, $http) {
});