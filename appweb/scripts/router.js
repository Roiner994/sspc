'use strict';

angular.module('Client',['ngResource','ngRoute'])
	.config(function($routeProvider){
		$routeProvider
		.when('/notes',{
			templateUrl: 'views/note/index.html',
			controller: 'IndexNoteCtrl'
		})
		.when('/notes/new',{
			templateUrl: 'views/note/create.html',
			controller: 'CreateNoteCtrl'
		})
		.when('/notes/edit/:id',{
			templateUrl: 'views/note/create.html',
			controller: 'EditNoteCtrl'
		})
		.when('/usuarios',{
			templateUrl: 'views/usuario/index.html',
			controller: 'IndexUsuarioCtrl'
		})
		.when('/usuarios/nuevo',{
			templateUrl: 'views/usuario/crear.html',
			controller: 'CrearUsuarioCtrl'
		})
		.when('/usuarios/editar/:id',{
			templateUrl: 'views/usuario/editar.html',
			controller: 'EditarUsuarioCtrl'
		})
		.when('/home',{
			templateUrl: 'views/home.html',
		})
		.when('/login',{
			templateUrl: 'views/auth/login.html',
			controller: 'AuthCtrl'
		})
		/*.otherwise({
			redirectTo: '/'
		});*/
	});