'use strict';

angular.module('Client',['ngResource','ngRoute','ngCookies'])
	.run(function($rootScope,$location,$cookies){
		$rootScope.$on('$routeChangeStart',function(event, next, current){
			if($cookies.get('estadoConectado') == false || $cookies.get('estadoConectado') == null){
				if(next.templateUrl == 'home.html' || next.templateUrl == 'views/usuario/index.html' || next.templateUrl == "views/usuario/crear.html" || next.templateUrl == "views/usuario/editar.html" || next.templateUrl == 'views/fecha/usuario.html' || next.templateUrl == 'views/fecha/carro.html' || next.templateUrl == 'views/carro/crear.html' || next.templateUrl == 'views/carro/editar.html' || next.templateUrl == 'views/carro/index.html'){
					Materialize.toast('Debe estar autenticado para poder ingresar.', 5000, 'red accent-4');
					$location.path('/login');
				}
			}
		})
	})
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
		.when('/login',{
			templateUrl: 'views/auth/login.html',
			controller: 'LoginCtrl'
		})
		.when('/fecha_usuario',{
			templateUrl: 'views/fecha/usuario.html',
			controller: 'UsuarioFechaCtrl'
		})
		.when('/fecha_carro',{
			templateUrl: 'views/fecha/carro.html',
			controller: 'CarroFechaCtrl'
		})
		.when('/home',{
			templateUrl: 'home.html',
			controller: 'FechaCtrl'
		})
		.when('/carros',{
			templateUrl: 'views/carro/index.html',
			controller: 'IndexCarroCtrl'
		})
		.when('/carros/nuevo',{
			templateUrl: 'views/carro/crear.html',
			controller: 'CrearCarroCtrl'
		})
		.when('/carros/editar/:id',{
			templateUrl: 'views/carro/editar.html',
			controller: 'EditarCarroCtrl'
		})
		.otherwise({
			redirectTo: '/home'
		});
	});