@extends('alumno.index')

@section('content')
{!! Html::style('css/abp.css') !!}
{!! Html::script('jsext/jquery.connections.js')!!}
{!! Html::script('scripts/alumno/abp.js')!!}
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<style type="text/css">
body{
	background: #136a8a; /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #136a8a , #267871); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #136a8a , #267871); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
     
}
</style>

<div id="steps-container">

<div id="paso_1" class="pasos" onClick="goStep(1)"><strong><i class="fa fa-rocket fa-3x" aria-hidden="true"></i><br>PASO 1.- DEFINICIÓN DE CONCEPTOS</strong></div>
<div id="paso_2" class="pasos" onclick="goStep(2)"><strong><i class="fa fa-line-chart fa-3x" aria-hidden="true"></i><br>PASO 2.- PLANTEAMIENTO DEL PROBLEMA</strong></div>
<div id="paso_3" class="pasos" onclick="goStep(3)"><strong><i class="fa fa-line-chart fa-3x" aria-hidden="true"></i><br>PASO 3.- LLUVIA DE IDEAS</strong></div>
<div id="paso_4" class="pasos" onclick="goStep(4)"><strong><i class="fa fa-line-chart fa-3x" aria-hidden="true"></i><br>PASO 4.- CATEGORIZACIÓN DE IDEAS</strong></div>
<div id="paso_5" class="pasos" onclick="goStep(5)"><strong><i class="fa fa-line-chart fa-3x" aria-hidden="true"></i><br>PASO 5.- METAS DE APRENDIZAJE</strong></div>
<div id="paso_6" class="pasos" onclick="goStep(6)"><strong><i class="fa fa-line-chart fa-3x" aria-hidden="true"></i><br>PASO 6.- ESTUDIO INDEPENDIENTE</strong></div>
<div id="paso_7" class="pasos" onclick="goStep(7)"><strong><i class="fa fa-fire fa-3x" aria-hidden="true"></i><br>PASO 7.- CONCLUSIONES</strong></div>




</div>


<script>

init();
</script>




@endsection