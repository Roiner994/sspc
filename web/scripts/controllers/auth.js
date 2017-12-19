'use strict';

angular.module('Client')
	.controller('LoginCtrl', function($scope,$cookies, $location, $timeout, $route, MenuResource,$http,$window,AuthResource,$rootScope) {
		$rootScope.usuario=1;
		console.log($rootScope.usuario);
		MenuResource.estado=0,
		$scope.Menu = MenuResource;
		$scope.loguear = function() {
			console.log($scope.Usuario.email);
			$http.post("http://192.168.1.101:8000/api/login",{
				email: $scope.Usuario.email,
				password: $scope.Usuario.password
			})
			.success(function(data){
				console.log(data.length);
				if(data.length==0){
					Materialize.toast('Datos incorrectos.', 5000, 'red accent-4');
					$timeout(function() {
						$location.path('/login');
					}, 1000);
				}else{
					console.log(data.nombre);
					console.log(data.tipo);
					$cookies.put('estadoConectado',true);
					$cookies.put('usuario',data.nombre);
					$cookies.put('tipo',data.tipo);
					$location.path('/home');
				}
			});
		};
	});