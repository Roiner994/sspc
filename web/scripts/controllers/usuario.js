'use strict';

angular.module('Client')
	.controller('IndexUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout, $route,MenuResource) {
		MenuResource.estado=1;
		$scope.Usuarios = UsuarioResource.query();

		$scope.eliminarUsuario = function(id) {
			UsuarioResource.delete({
				id: id
			});
			Materialize.toast('Nota Eliminada.', 5000, 'green accent-4');
			$timeout(function() {
				$route.reload();
			}, 1000);
		};
		
		$scope.verUsuario = function(id) {
			UsuarioResource.get({id:id},function(data){
			$scope.Usuario= data.usuario;
			})
		};
	})
	.controller('CrearUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout,MenuResource) {
		MenuResource.estado=1;
		$scope.title = "Crear Usuario";
		$scope.button = "Guardar";
		$scope.Usuario = {};
		$scope.guardarUsuario = function() {
			UsuarioResource.save($scope.Usuario);
			Materialize.toast('Usuario Creado.', 5000, 'green accent-4');
			$timeout(function() {
				$location.path('/usuarios');
			}, 1000);
		};
	}).controller('EditarUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout, $routeParams) {
		$scope.title = "Editar Usuario";
		$scope.button = "Guardar";
		var id = $routeParams.id;
		UsuarioResource.get({id:id},function(data){
			$scope.Usuario= data.usuario;
		})

		
		/*$scope.Usuario = UsuarioResource.get({
			id: $routeParams.id
		});*/

		$scope.actualizarUsuario = function() {
			UsuarioResource.update($scope.Usuario);
			Materialize.toast('Usuario Actualizada.', 5000, 'green accent-4');
			$timeout(function() {
				$location.path('/usuarios');
			}, 1000);
		};
	})
	.controller('FechaCtrl', function($scope,$http ,$location, $timeout,MenuResource,AuthResource) {


		MenuResource.estado=1;
		$scope.Menu = MenuResource;
		$scope.FechaUsuario={};
		$scope.Usuarios_dias={};
		$scope.Usuarios_meses={};
		$scope.Usuarios_anos={};
		$scope.Vehiculos_dias={};
		$scope.Vehiculos_meses={};
		$scope.Vehiculos_anos={};
		$scope.Usuarios_dentro={};
		$scope.Vehiculos_dentro={};
		$http.get("http://192.168.1.101:8000/api/fecha")
			.success(function(data){
				$scope.FechaUsuario=data;
			});
		$http.get("http://192.168.1.101:8000/api/fecha_carro")
			.success(function(data){
				$scope.FechaCarro=data;
			});

		$scope.usuarioDia = function() {
			$http.get("http://192.168.1.101:8000/api/usuario_dia")
			.success(function(data){
				$scope.Usuarios_dias=data;
				for (var i = 0; i < $scope.Usuarios_dias.length; i++) {
					if ($scope.Usuarios_dias[i]['estado']==1) {
						$scope.Usuarios_dias[i]['estado']='entrada';
					}else{
						$scope.Usuarios_dias[i]['estado']='salida';
					}
				}
			});
		};

		$scope.usuarioMes = function() {
			$http.get("http://192.168.1.101:8000/api/usuario_mes")
			.success(function(data){
				$scope.Usuarios_meses=data;
				for (var i = 0; i < $scope.Usuarios_meses.length; i++) {
					if ($scope.Usuarios_meses[i]['estado']==1) {
						$scope.Usuarios_meses[i]['estado']='entrada';
					}else{
						$scope.Usuarios_meses[i]['estado']='salida';
					}
				}
			});
		};

		$scope.usuarioAno = function() {
			$http.get("http://192.168.1.101:8000/api/usuario_ano")
			.success(function(data){
				$scope.Usuarios_anos=data;
				for (var i = 0; i < $scope.Usuarios_anos.length; i++) {
					console.log(i);
					if ($scope.Usuarios_anos[i]['estado']==1) {
						$scope.Usuarios_anos[i]['estado']='entrada';
					}else{
						$scope.Usuarios_anos[i]['estado']='salida';
					}
				}
			});
		};

		$scope.vehiculoDia = function() {
			$http.get("http://192.168.1.101:8000/api/carro_dia")
			.success(function(data){
				$scope.Vehiculos_dias=data;
				for (var i = 0; i < $scope.Vehiculos_dias.length; i++) {
					if ($scope.Vehiculos_dias[i]['estado']==1) {
						$scope.Vehiculos_dias[i]['estado']='entrada';
					}else{
						$scope.Vehiculos_dias[i]['estado']='salida';
					}
				}
			});
		};

		$scope.vehiculoMes = function() {
			$http.get("http://192.168.1.101:8000/api/carro_mes")
			.success(function(data){
				$scope.Vehiculos_meses=data;
				for (var i = 0; i < $scope.Vehiculos_meses.length; i++) {
					if ($scope.Vehiculos_meses[i]['estado']==1) {
						$scope.Vehiculos_meses[i]['estado']='entrada';
					}else{
						$scope.Vehiculos_meses[i]['estado']='salida';
					}
				}
			});
		};

		$scope.vehiculoAno = function() {
			console.log('hola');
			$http.get("http://192.168.1.101:8000/api/carro_ano")
			.success(function(data){
				$scope.Vehiculos_anos=data;
				for (var i = 0; i < $scope.Vehiculos_anos.length; i++) {
					if ($scope.Vehiculos_anos[i]['estado']==1) {
						$scope.Vehiculos_anos[i]['estado']='entrada';
					}else{
						$scope.Vehiculos_anos[i]['estado']='salida';
					}
				}
			})
		};

		$scope.usuarioDentro = function() {
			$http.get("http://192.168.1.101:8000/api/usuarios_dentro")
			.success(function(data){
				console.log(data);
				$scope.Usuarios_dentro=data;
			});
		};

		$scope.vehiculoDentro = function() {
			$http.get("http://192.168.1.101:8000/api/carros_dentro")
			.success(function(data){
				console.log(data);
				$scope.Vehiculos_dentro=data;
			});
		};

	});