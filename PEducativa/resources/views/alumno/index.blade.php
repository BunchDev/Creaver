<!DOCTYPE html>
<html lang="es">
<head class="no-js">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alumno</title>

	{!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
	{!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('bower_components/sweetalert/dist/sweetalert.css') !!}
	{!! Html::style('css/alumno.css') !!}
	{!! Html::style('css/magic.css') !!}
	{!! Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') !!}
	{!! Html::style('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
	{!! Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') !!}

	<!-- Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

</head>
<!--oncontextmenu="return false"-->
<style type="text/css">
.navbar-brand > img{
	width: 100px;
	height: 40px;
}

</style>
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
				<a class="navbar-brand" href="#">
					<img src="http://localhost:8080/Creaver/PEducativa/public/images/creatver.jpg">
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/perfil') }}">Inicio</a></li>
					<li><a href="{{ url('/cursos') }}">Cursos</a></li>
					<li><a href="{{ url('/cursos') }}">Calificaciones</a></li>
				</ul>

				
			</div>
		</div>
	</nav>
	
</body>


	<!-- Scripts -->
	{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
	{!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js')!!}
	{!! Html::script('bower_components/sweetalert/dist/sweetalert.min.js')!!}
	{!! Html::script('bower_components/moment/min/moment.min.js')!!}
	{!! Html::script('bower_components/moment/locale/es.js')!!}
	{!! Html::script('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')!!}
	{!! Html::script('bower_components/urlive/jquery.urlive.js')!!}
	{{Html::script('scripts/validatorJQB2.js')}}
	{!! Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')!!}

@yield('content')

</html>
