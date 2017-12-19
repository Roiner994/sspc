'use strict';

angular.module('Client')
	.controller('menuController', function($scope, UsuarioResource, $location, $timeout, $route) {
		$scope.mostrar = function() {
			console.log('hola');
			$( "#boton" ).dropdown();
		};
	});