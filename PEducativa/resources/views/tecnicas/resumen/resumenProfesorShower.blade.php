@extends('profesor.perfil')

@section('content')
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>

{!! Html::style('css/resumen-shower.css') !!}
{!! Html::style('bower_components/urlive/jquery.urlive.css') !!}

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('bower_components/urlive/jquery.urlive.js')!!}
{!! Html::script('scripts/abi.js')!!}
{!! Html::script('scripts/masonry.pkgd.min.js')!!}
{!! Html::script('bower_components/arctext/js/jquery.arctext.js')!!}

<!--LETRERO PRINCIPAL AI-->
<div align="center" id="icon_pencil" class=".col-md-8">	
<section class="main">				
	<div id="presentacion" class="arc-wrapper">
		<h3 id="letrero_resumen">Resumen</h3>
		<i class="fa fa-pencil-square fa-5x"></i>
	</div>
</section>

</div>


@if(isset($datos))
	
		<label>Instrucción de la actividad</label>
		<p id="p_instruccion">{{$datos->instruccion}}</p>

	
@endif
@if(isset($materiales))
	<br>
	<br>

	<label>MATERIALES DE APOYO: </label>
	<br>
	
	<i class="fa fa-cogs fa-4x">Archivos Adjuntos</i>
		<br>
		<br>
	@if(isset($materiales[0]) != true)
			<div class="alert alert-dismissible alert-info">
  				<button type="button" class="close" data-dismiss="alert">×</button>
  				<strong>Sin archivos adjuntos</strong>
			</div>

	@else	
		<div id="files" class="grid">
		
			@foreach($materiales as $material)
			<br>
				@if($material->tipo == 1)
				
				
					<div class="grid-item">
						<strong id="sid_{{$material->idMaterial}}"></strong>
						<i class="{{$material->icon}}"></i>
						<button class='btn btn-raised btn-xs btn-info' onClick='downloadFile("{{$material->url}}")'>Descargar</button>
					
					
					
				
					</div>
					<script>
							namePath('{{$material->url}}','{{$material->idMaterial}}');
			    	</script>
				@endif
		
			@endforeach

		</div>
	@endif
	<div id="urls">
		<i class="fa fa-link fa-4x">Url's</i>
		<br>
		<br>
		<div class="grid" id="urlsgrid"></div>

		<script type="text/javascript">

		var $gridUrl = $('#urlsgrid').masonry({
   		itemSelector: '.grid-item',
        isFitWidth: true,
        columnWidth: 60,
        containerStyle: { position: 'relative' }
		});
		</script>
		@foreach($materiales as $material)
		<br>
			@if($material->tipo == 2)
				
				<script type="text/javascript">
				$urls.push("{{$material->url}}");
				</script>
				
			@endif
		
		@endforeach
	</div>	
	</div>
	
	

@endif






<script type="text/javascript">
var $presentacion	= $('#presentacion').find('h3');
$presentacion.arctext({radius: 200});

var $grid = $('.grid').masonry({
   itemSelector: '.grid-item',
        isFitWidth: true,
        columnWidth: 60,
        containerStyle: { position: 'relative' }
});
$(document).ready(function(){
$("#icon_pencil").addClass('magictime tinUpIn');
 fn();		
});



</script>


@endsection