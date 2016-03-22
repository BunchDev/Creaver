<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profesor</title>

	{!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
	{!! Html::style('bower_components/bootstrap-material-design/dist/css/ripples.min.css') !!}
	{!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
	{!! Html::style('bower_components/bootstrap-material-design/dist/css/bootstrap-material-design.min.css') !!}
	{!! Html::style('bower_components/sweetalert/dist/sweetalert.css') !!}
	{!! Html::style('css/adaptaciones.css') !!}
	{!! Html::style('css/magic.css') !!}
	{!! Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') !!}
	{!! Html::style('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
	



	<!-- Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

	
</head>
<!--oncontextmenu="return false"-->
<body >
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Education</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/perfil') }}">Inicio</a></li>
					<li><a href="{{ url('/cursos') }}">Cursos
					
					</a></li>
				</ul>

				
			</div>
		</div>
	</nav>
	
</body>


	@yield('content')

	<!-- Scripts -->
	{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
	{!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js')!!}
	{!! Html::script('bower_components/bootstrap-material-design/dist/js/ripples.min.js')!!}
	{!! Html::script('bower_components/bootstrap-material-design/dist/js/material.min.js')!!}
	{!! Html::script('bower_components/sweetalert/dist/sweetalert.min.js')!!}
	{!! Html::script('bower_components/moment/min/moment.min.js')!!}
	{!! Html::script('bower_components/moment/locale/es.js')!!}
	{!! Html::script('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')!!}
	{!! Html::script('bower_components/urlive/jquery.urlive.js')!!}

<script type="text/javascript">
	$(document).on('ready',function(){

		$.material.init();
	});

</script>
</html>
