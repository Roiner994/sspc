'use strict';

angular.module('Client')
	.controller('IndexCarroCtrl', function($scope, CarroResource, $location, $timeout, $route,MenuResource) {
		MenuResource.estado=1;
		$scope.Carros = CarroResource.query();
		console.log($scope.Carros);

		$scope.eliminarCarro = function(id) {
			CarroResource.delete({
				id: id
			});
			Materialize.toast('Carro Eliminada.', 5000, 'green accent-4');
			$timeout(function() {
				$route.reload();
			}, 1000);
		};
		
	})
	.controller('CrearCarroCtrl', function($scope, CarroResource, $location, $timeout,MenuResource) {
		MenuResource.estado=1;
		$scope.title = "Agregar Vehiculo";
		$scope.button = "Guardar";
		$scope.Carro = {};
		$scope.guardarCarro = function() {
			CarroResource.save($scope.Carro);
			Materialize.toast('Vehiculo Creado.', 5000, 'green accent-4');
			$timeout(function() {
				$location.path('/carros');
			}, 1000);
		};
	}).controller('EditarCarroCtrl', function($scope, CarroResource, $location, $timeout, $routeParams) {
		$scope.title = "Editar Vehiculo";
		$scope.button = "Guardar";
		var id = $routeParams.id;
		CarroResource.get({id:id},function(data){
			$scope.Carro= data.carro;
		})

		

		$scope.actualizarCarro = function() {
			CarroResource.update($scope.Carro);
			Materialize.toast('Usuario Actualizada.', 5000, 'green accent-4');
			$timeout(function() {
				$location.path('/carros');
			}, 1000);
		};

	});