'use strict';

angular.module('Client')
	.factory('CarroResource', function($resource) {
		return $resource("http://192.168.1.101:8000/api/carros/:id", {
			id: "@id"
		}, {
			update: {
				method: "PUT"
			}
		});
	});