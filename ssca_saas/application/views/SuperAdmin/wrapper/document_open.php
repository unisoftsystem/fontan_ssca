<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	<link rel="stylesheet" type="text/css" href="<?= base_url(1);?>css/popup.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(1);?>css/alertify.core.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(1);?>css/alertify.default.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css">
	
	<script src="<?= base_url(1);?>bower_components/jquery/dist/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="<?= base_url(1);?>bower_components/angular/angular.js"></script>
    <script src="<?= base_url(1);?>bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?= base_url(1);?>bower_components/bootbox/bootbox.js"></script>
    <script src="<?= base_url(1);?>bower_components/angular-file-upload/dist/angular-file-upload.min.js"></script>
    <script src="<?= base_url(1);?>bower_components/ngBootbox/dist/ngBootbox.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript" src="<?= base_url(1);?>js/popup.js"></script>
	<script type="text/javascript" src="<?= base_url(1);?>js/alertify.js"></script>
	
	<script> 
		window.base_url = '<?php echo(base_url()) ?>'
		window.base_url_ssca = '<?php echo(base_url(1)) ?>'
	</script>



	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
	<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
	<!-- <script type="text/javascript" src="<?= base_url(1);?>js/angular_1_6_4.js"></script> -->
	<!-- <script type="text/javascript" src="<?= base_url(1);?>js/ValidacionNumerica.js"></script> -->
	<!-- <script src='<?= base_url(1);?>js/moment.min.js'></script> -->
	<!-- <script src='<?= base_url(1);?>js/fullcalendar.min.js'></script> -->

</head>
<body>



	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">SSCA</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>