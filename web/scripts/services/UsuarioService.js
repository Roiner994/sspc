'use strict';

angular.module('Client')
	.factory('UsuarioResource', function($resource) {
		return $resource("http://192.168.1.101:8000/api/usuarios/:id", {
			id: "@id"
		}, {
			update: {
				method: "PUT"
			}
		});
	});