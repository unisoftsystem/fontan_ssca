<div class="container" ng-app="UserSuperAdmin" ng-controller="UserSuperAdminController">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<b>Usuario:</b> {{ user.nombre_contratante + ' - ' + user.nombre_institucion }}
					</h3>
				</div>
				<div class="panel-body">
		
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation"><a ng-click="setTabActive(0)" role="tab" data-toggle="tab">Perfil</a></li>
						<li role="presentation"><a ng-click="setTabActive(1)" role="tab" data-toggle="tab">Institución</a></li>
						<li role="presentation"  class="active"><a ng-click="setTabActive(2)" role="tab" data-toggle="tab">Parametrización</a></li>
						<li role="presentation"><a ng-click="setTabActive(3)" role="tab" data-toggle="tab">Configuración</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<br>
						<div role="tabpanel" class="tab-pane active">
							<user-perfil ng-show="currentTab == 0"></user-perfil>
							<user-institucion ng-show="currentTab == 1"></user-institucion>
							<user-parametrizacion ng-show="currentTab == 2"></user-parametrizacion>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
