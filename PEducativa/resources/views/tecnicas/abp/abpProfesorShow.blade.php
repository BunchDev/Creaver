@extends('profesor.perfil')

@section('content')
<link href='https://fonts.googleapis.com/css?family=Philosopher' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}

{!! Html::script('bower_components/arctext/js/jquery.arctext.js')!!}

<!--LETRERO PRINCIPAL ABP-->
<div align="center" id="icon_cubes" class=".col-md-8">	
<section class="main">				
	<div id="presentacion" class="arc-wrapper">
		<h3 id="letrero_abp">Aprendizaje Basado en Problemas</h3>
		<i class="fa fa-cubes fa-5x"></i>
	</div>
</section>
<br>
<br>
</div>
<div id="contenedor" align="center">
	<!--CONTEXTO-->
<div class="contexto">
<p class="p_contexto">Bajo el siguiente contexto ... </p>
<p id="p_contexto">{{$abp->Contexto}}</p>

</div>

<!--PROBLEMATICA-->
<div class="problematica" >
<p class="p_problematica">La problemática nos dice que ...</p>

<i class="fa fa-quote-left fa-3x fa-pull-left "></i>
<p id="p_problematica">{{$abp->problematica}}</p>
<i class="fa fa-quote-right fa-3x fa-pull-right"></i>
</div>
<br>
<br>

<!--PERSONAJES-->
<div class="personajes">
<p class="p_personajes"> Los personajes involucrados en la problematica son ...</p>
@foreach($personajes as $personaje)
<p id="p_personaje">{{$personaje->Nombre}}</p>
<br>
@endforeach
</div>

</div>
<script >
$presentacion = $('#presentacion').find('h3');
$presentacion.arctext({radius: 200});

$(document).ready(function(){
$("#icon_cubes").addClass('magictime tinUpIn');
 
});


</script>
@endsection