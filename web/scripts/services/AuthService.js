'use strict';

angular.module('Client')
	.factory('AuthResource', function() {
		return{
			id:'',
			nombre:'',
			apellido:'',
			cedula:'',
			tipo:'',
			login:0
		};
	});