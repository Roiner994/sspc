'use strict';

angular.module('Client')
	.controller('UsuarioFechaCtrl', function($scope, $location, $timeout, MenuResource,$http,$filter) {
		MenuResource.estado=1;
		$scope.Usuarios={};
		$http.get("http://192.168.1.101:8000/api/todos_los_usuarios")
			.success(function(data){
				$scope.Usuarios=data;
				for (var i = 0; i < $scope.Usuarios.length; i++) {
					if ($scope.Usuarios[i]['estado']==1) {
						$scope.Usuarios[i]['estado']='entrada';
					}else{
						$scope.Usuarios[i]['estado']='salida';
					}
				}
			});
		

			$scope.FiltrarUsuarioFecha = function() {
				var fecha_i = $filter('date')($scope.Fecha.inicio, "yyyy-MM-dd");
				var fecha_f = $filter('date')($scope.Fecha.fin, "yyyy-MM-dd");
				$http.post("http://192.168.1.101:8000/api/filtrar_usuarios",{
					fecha_inicio: fecha_i,
					fecha_fin: fecha_f
				})
				.success(function(data){
					$scope.Usuarios=data;
					for (var i = 0; i < $scope.Usuarios.length; i++) {
						if ($scope.Usuarios[i]['estado']==1) {
							$scope.Usuarios[i]['estado']='entrada';
						}else{
							$scope.Usuarios[i]['estado']='salida';
						}
					}
				});
			};
		})
		.controller('CarroFechaCtrl', function($scope, $location, $timeout, MenuResource,$http,$filter) {
			MenuResource.estado=1;
			$scope.Vehiculos={};
			$http.get("http://192.168.1.101:8000/api/todos_los_carros")
			.success(function(data){
				$scope.Vehiculos=data;
				for (var i = 0; i < $scope.Vehiculos.length; i++) {
					if ($scope.Vehiculos[i]['estado']==1) {
						$scope.Vehiculos[i]['estado']='entrada';
					}else{
						$scope.Vehiculos[i]['estado']='salida';
					}
				}
			});

			$scope.FiltrarVehiculoFecha = function() {
				var fecha_i = $filter('date')($scope.Fecha.inicio, "yyyy-MM-dd");
				var fecha_f = $filter('date')($scope.Fecha.fin, "yyyy-MM-dd");
				$http.post("http://192.168.1.101:8000/api/filtrar_carros",{
					fecha_inicio: fecha_i,
					fecha_fin: fecha_f
				})
				.success(function(data){
					$scope.Vehiculos=data;
					for (var i = 0; i < $scope.Vehiculos.length; i++) {
						if ($scope.Vehiculos[i]['estado']==1) {
							$scope.Vehiculos[i]['estado']='entrada';
						}else{
							$scope.Vehiculos[i]['estado']='salida';
						}
					}
				});
			};
		});