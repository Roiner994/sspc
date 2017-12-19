'use strict';

angular.module('Client')
	.factory('UsuarioResource', function($resource) {
		return $resource("http://localhost:8000/api/usuarios/:id", {
			id: "@id"
		}, {
			update: {
				method: "PUT"
			}
		});
	});