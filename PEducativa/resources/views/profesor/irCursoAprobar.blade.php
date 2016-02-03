@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}

{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}


@section('content')
	<div class="jumbotron jumbotron-fluid">
		<h1 class="display-3">Curso seleccionado</h1>
		<br>
		<p class="lead"> Detalles del curso por aprobar:
		{{$DatosCurso->Nombre}}<br>
		{{$DatosCurso->Descripcion}}
	</div>

	<br>
	just changed ths
	@foreach ($comentarios as $data)
    <p> comentario {{ $data->Contenido }}</p>
	@endforeach

	  {!!Form::open(array('action' => 'ComentarioController@store')) !!}
		<div class="form-group">
  			<label for="comment">Comentario:</label>
  			<textarea name="Contenido"class="form-control" rows="5" id="comment"></textarea>
		</div>
		<input type="hidden" name="fk_idPropuesta" value="{{$DatosCurso->idCurso}}">

	{!! Form:: Submit("Mandar Comentario",array('class' => 'btn btn-raised btn-danger btn-lg','data-toggle' => 'collapse','data-target' => '#cursono','id' => 'pa')) !!}




</div>

</div>


{!! Form:: close() !!}
@endsection