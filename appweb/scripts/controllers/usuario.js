'use strict';

angular.module('Client')
	.controller('IndexUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout, $route) {
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
		
	})
	.controller('CrearUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout) {
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
		console.log(UsuarioResource);
		UsuarioResource.get({id:id},function(data){
			$scope.Usuario= data.usuario;
			console.log(data.usuarios);
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
	});