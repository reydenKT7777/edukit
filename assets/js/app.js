var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : base_url_global+"welcome/principal",
        controller: 'principal_Controller'
    })
    .when("/administracion", {
        templateUrl : base_url_global+"welcome/administracion",
        controller: 'administracion_Controller'
    })
    .when("/nominapro", {
        templateUrl : base_url_global+"welcome/profesor_nomina",
        controller: 'profesor_nomina_Controller'
    })
    .when("/asistenciapro", {
        templateUrl : base_url_global+"welcome/profesor_asistencia",
        controller: 'profesor_asistencia_Controller'
    })
    .when("/disciplinapro", {
        templateUrl : base_url_global+"welcome/profesor_disciplina"
    })
    .when("/nominaest", {
        templateUrl : base_url_global+"welcome/estudiante_nomina"
    })
    .when("/asistenciaest", {
        templateUrl : base_url_global+"welcome/estudiante_asistencia"
    })
    .when("/disciplinaest", {
        templateUrl : base_url_global+"welcome/estudiante_disciplina"
    });
});
app.controller('principal_Controller', function($scope, $http) {
    $scope.mensaje="";
});
app.controller('administracion_Controller', function($scope, $http) {
});
app.controller('profesor_nomina_Controller', function($scope, $http) {
    $scope.lista=[];
    $http.get(base_url_global+"controlador_profesor/listar_profesor")
    .success(function(datos){
      $scope.lista=datos;
    })
    .error(function(error) {
      console.log(error);
    });
});