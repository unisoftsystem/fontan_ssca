document.addEventListener("DOMContentLoaded", function(event) { 
  
  	angular
		.module('LoginSuperAdmin', ['SuperAdmin'])
		.controller('LoginSuperAdminController', LoginSuperAdminController);


	function LoginSuperAdminController($scope, $http, api) {
		
		$scope.user = {};	
		$scope.msg = {
			error: 'Datos incorrectos',
			ok: 'Login'
		};

		$scope.onSubmit = function(user) {
			if( $scope.validateUser(user) ) {
				api.post('SuperAdmin/do_login', user).then(function(response) {
					if(response.data == true) {
						window.location.href = base_url + "index.php/SuperAdmin/adminintrar_usuarios";
					}else {
						alertify.error($scope.msg.error)
					}
				}).catch(function(error) {
					console.log(error);
				});
			}else {
				alertify.error($scope.msg.error);
			}
		}

		$scope.validateUser = function(user) {
			return (user.email && user.contrasena)
		}

	}

});
