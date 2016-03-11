@extends('profesor.perfil')

@section('content')
{!! Html::style('css/aulaInvertida.css') !!}
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>


{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('bower_components/arctext/js/jquery.arctext.js')!!}
{!! Html::script('scripts/aulaInvertida.js')!!}

<div class="row">
<!--BACK-->
<div class=".col-md-3 ">
<button class="btn btn-raised btn-default" onClick="javascript:window.location.assign('../../irCurso/{{$curso}}')">Actividades <i id="back_icon" class="fa fa-arrow-circle-left fa-3x"></i></button>
</div>
<!--LETRERO PRINCIPAL AI-->
<div align="center" id="icon_player" class=".col-md-8">	
<section class="main">				
	<div id="presentacion" class="arc-wrapper">
		<h3 id="letrero_ai">Aula Invertida</h3>
		<i class="fa fa-play-circle fa-5x"></i>
	</div>
</section>

</div>
</div>


<br>
<div align="center" id="video_container">
<h1 id="instruccion">Instrucción de la actividad: </h1>
<p id="p_instruccion">{{$aula->instruccion}}</p>
<iframe id="reproductor" 
      		src="https://player.vimeo.com/video/{{$aula->url}}" 
      		width="50%" height="400" frameborder="0" webkitallowfullscreen 
      		mozallowfullscreen allowfullscreen hidden>

</iframe>
<i class="fa fa-spinner fa-pulse fa-5x" id="waiting_iframe"></i>
</div>
<script type="text/javascript">
var $presentacion	= $('#presentacion').find('h3');
$presentacion.arctext({radius: 200});

$(document).ready(function(){
$("#icon_player").addClass('magictime tinUpIn');

});

</script>
@endsection