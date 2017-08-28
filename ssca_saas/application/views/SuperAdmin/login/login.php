<div ng-app="LoginSuperAdmin" ng-controller="LoginSuperAdminController">
	
	<div class="wrapper">
		<form class="form-signin" ng-submit="onSubmit(user)" method="POST">       
			
			<h2 class="form-signin-heading">Acceso admins</h2>
			
			<input type="text"
				ng-model="user.email" 
				class="form-control" 
				placeholder="Dirección email" 
				required="true" 
				autofocus="true" />

			<input type="password"
				ng-model="user.contrasena" 
				class="form-control" 
				placeholder="Contaseña" 
				required="true"/>      
			
			<label class="checkbox">
				<input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
			</label>
			
			<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
		
		</form>
	</div>

</div>