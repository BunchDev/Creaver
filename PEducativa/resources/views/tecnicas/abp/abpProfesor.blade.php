@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
@section('content')

<div class="jumbotron jumbotron-fluid">
<h2 class="display-3">{{$datos['nombre']}}</h2>
<br>
</div>

<div id = 'contexto' name='contexto'></div>



@endsection
