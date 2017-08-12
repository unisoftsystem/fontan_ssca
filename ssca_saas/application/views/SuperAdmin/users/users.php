<div class="container" ng-app="UsersSuperAdmin" ng-controller="UsersSuperAdminController">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Usuarios sistema</h3>
					<div class="pull-right">
						<span ng-click="createUser({})" class="clickable filter" data-toggle="tooltip" title="Toggle table filter">
							<i class="glyphicon glyphicon-plus"></i>
						</span>
						<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter">
							<i class="glyphicon glyphicon-filter"></i>
						</span>
					</div>
				</div>
				<div class="panel-body">
					<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
				</div>
				<table class="table table-hover" id="dev-table">
					<thead>
						<tr>
							<th>ID </th>
							<th>Dominio</th>
							<th>Nombre contratante</th>
							<th>Email contratante</th>
							<th>Nombre institución</th>
							<th class="col-xs-1">Estado</th>
							<th class="col-xs-1"></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="cole in colegios" class="table-detail">
							<td>{{ cole.ID }}</td>
							<td>{{ cole.dominio }}</td>
							<td>{{ cole.nombre_contratante }}</td>
							<td>{{ cole.email_contratante }}</td>
							<td>{{ cole.nombre_institucion }}</td>
							<td>
								<span ng-if="cole.estado==0" class="label label-danger">Inactivo</span>
								<span ng-if="cole.estado==1" class="label label-success">Activo</span>
							</td>
							<td class="text-center"> 
								<span ng-click="createUser(cole)" class="action glyphicon glyphicon-pencil"></span>
								<a href="<?php echo base_url(1).'index.php/SuperAdmin/ver_usuario/' ?>{{ cole.ID }}" class="action">
									<span class=" glyphicon glyphicon-cog"></span>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

