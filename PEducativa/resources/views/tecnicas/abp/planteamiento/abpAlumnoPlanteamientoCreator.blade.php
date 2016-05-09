@extends('alumno.index')

@section('content')
{{Html::script('scripts/alumno/abp.js')}}

{{Html::style('css/abp.css')}}

<div id="planteamiento_container" align="center" >
<div class="planteamiento_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">1</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí tu planteamiento" class="planteamiento form-control"></textarea>
		</div>
	</div>
</div>


<div class="planteamiento_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">2</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí tu planteamiento" class="planteamiento form-control"></textarea>
		</div>
	</div>
</div>


<div class="planteamiento_form form-group">
	<div class="row">
		<div class="col-xs-3 col-sm-1">
			<div class="counter magictime tinUpIn">3</div>
		</div>

		<div class="col-md-6">
			<textarea row="6" placeholder="Escribe aquí tu planteamiento" class="planteamiento form-control"></textarea>
		</div>
	</div>
</div>

</div>

<button class="btn btn-danger" onclick="addPlanteamientoForm()">Agregar Otro Planteamiento</button>
<button class="btn btn-success" onclick="sendPlanteamientos()">Enviar Planteamientos</button>
@endsection