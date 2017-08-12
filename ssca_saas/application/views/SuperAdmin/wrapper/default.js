'use strict';

document.addEventListener("DOMContentLoaded", function(event) { 

	angular
		.module('SuperAdmin', ['ngBootbox', 'angularFileUpload'])
		.service('api', api);

	function api($http, $httpParamSerializer, $q) {
		api = {};
		
		api.post = function(endPoint, data) {
			var deferrer = $q.defer();

			$http({
				method: 'POST',
				url: base_url + 'index.php/' + endPoint,
				data: $httpParamSerializer(data),
				headers: {
					 "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8;"
				}
			}).then(
				function(successData) {
					deferrer.resolve(successData);
				},
				function(error) {
					deferrer.reject(error);
				},
			);

			return deferrer.promise;
		}	

		return api;
	}



});