'use strict';

angular.module('Client')
	.controller('BodyController', function($scope,$window,$timeout,$location,AuthResource,$rootScope,$cookies) {
        console.log($rootScope.usuario);
        $scope.cerrarSesion = function() {
            AuthResource={};
            $cookies.remove('estadoConectado');
            $cookies.remove('usuario');
            $cookies.remove('tipo');
            $timeout(function() {
                $location.path('/login');
            }, 1000);
        };
		$scope.collapsibleElements = [{
        icon: 'mdi-image-filter-drama',
        title: 'First',
        content: 'Lorem ipsum dolor sit amet.'
    },{
        icon: 'mdi-maps-place',
        title: 'Second',
        content: 'Lorem ipsum dolor sit amet.'
    },{
        icon: 'mdi-social-whatshot',
        title: 'Third',
        content: 'Lorem ipsum dolor sit amet.'
    }
    ];
    $scope.urlmenu="views/menu.html";
	
});