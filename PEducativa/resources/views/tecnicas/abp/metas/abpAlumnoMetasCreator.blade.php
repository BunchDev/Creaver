@extends('alumno.index')

@section('content')
{{Html::script('scripts/alumno/abp.js')}}

{{Html::style('css/abp.css')}}

<div id="metas_container" align="center" >
<div class="metas_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">1</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí la meta de aprendizaje" class="meta form-control"></textarea>
		</div>
	</div>
</div>


<div class="metas_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">2</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí la meta de aprendizaje" class="meta form-control"></textarea>
		</div>
	</div>
</div>


<div class="metas_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">3</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí la meta de aprendizaje" class="meta form-control"></textarea>
		</div>
	</div>
</div>

</div>

<button class="btn btn-danger" onclick="addMetaForm()">Agregar Otra Meta</button>
<button class="btn btn-success" onclick="sendMetas()">Enviar metas de aprendizaje</button>
@endsection