var app = angular.module('3p-php', ['ngRoute']);
var base_url = 'http://192.168.1.16:8080/'; //'http://localhost:8080';

// templateUrl: 'viewStudents.htm', controller: 'ViewStudentsController'
app.config(['$routeProvider', function($routeProvider) {
   $routeProvider.
   when('/', {
      templateUrl: 'home.html'
   }).  
   when('/basic-structure', {
      templateUrl: 'basic-structure.html'
   }).
   when('/controller', {
      templateUrl: 'controller.html'
   }).
   when('/model', {
      templateUrl: 'model.html'
   }).
   when('/view', {
      templateUrl: 'view.html'
   }).
   when('/helper', {
      templateUrl: 'helper.html'
   }).
   when('/library', {
      templateUrl: 'library.html'
   }).
   otherwise({
      templateUrl: 'home.html'
   });
	
}]);

app.controller('UI',function($scope,$http){
    
    $scope.msg = '';
            
    /* User defined functions */
    $scope.hideAlert = function(){
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
        return;
    }
    
    
});