@extends('alumno.index')

@section('content')
{{Html::script('scripts/alumno/abp.js')}}

{{Html::style('css/abp.css')}}

<div id="lluvia_container" align="center" >
<div class="lluvia_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">1</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí la idea" class="idea form-control"></textarea>
		</div>
	</div>
</div>


<div class="lluvia_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">2</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí la idea" class="idea form-control"></textarea>
		</div>
	</div>
</div>


<div class="lluvia_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">3</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí la idea" class="idea form-control"></textarea>
		</div>
	</div>
</div>

</div>

<button class="btn btn-danger" onclick="addIdeaForm()">Agregar Otra Idea</button>
<button class="btn btn-success" onclick="sendIdeas()">Enviar Lluvia de Ideas</button>
@endsection