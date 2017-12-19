'use strict';

angular.module('Client')
	.factory('NoteResource', function($resource) {
		return $resource("http://192.168.1.101:8000/api/notes/:id", {
			id: "@id"
		}, {
			update: {
				method: "PUT"
			}
		});
	});