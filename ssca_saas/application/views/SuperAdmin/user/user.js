document.addEventListener("DOMContentLoaded", function(event) { 
  	
  	'use strict';

  	/*===============================================================
  		MAIN MODULE 
  	===============================================================*/
  	angular
		.module('UserSuperAdmin', ['SuperAdmin'])
		.controller('UserSuperAdminController', UsersSuperAdminController);


	function UsersSuperAdminController($scope, api, $ngBootbox) {
		
		$scope.currentTab =  2;

		/*======================================= 
			Obtener usuario
		=======================================*/
		$scope.setTabActive = function(tab) {
			$scope.currentTab =  tab;
		};

	}


	/*===============================================================
  		Perfil Directive 
  	===============================================================*/
  	angular
		.module('UserSuperAdmin')
		.directive('userPerfil', userPerfil);

	function userPerfil() {
		var dir = {};

		dir.restrict = 'E';
		dir.template = 'hola soy el perfil';
		dir.scope = {};
		dir.controller = function() {

		}
		
		return dir;
	}

	/*===============================================================
  		Institucion Directive 
  	===============================================================*/
  	angular
		.module('UserSuperAdmin')
		.directive('userInstitucion', userInstitucion);

	function userInstitucion() {
		var dir = {};

		dir.restrict = 'E';
		dir.template = 'hola soy la institucion';
		dir.scope = {};
		dir.controller = function() {

		}

		return dir;
	}

	/*===============================================================
  		Parametrizacion Directive 
  	===============================================================*/
  	angular
		.module('UserSuperAdmin')
		.directive('userParametrizacion', userParametrizacion);

	function userParametrizacion() {
		var dir = {};

		dir.restrict = 'E';
		dir.templateUrl = base_url_ssca + 'application/views/SuperAdmin/user/templates/parametrizacion.tpl.html';
		dir.scope = {};
		dir.controller = function() {

		}

		return dir;
	}

});