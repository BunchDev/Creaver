@extends('alumno.index')

@section('content')
{!! Html::style('css/abp.css') !!}
{!! Html::script('scripts/alumno/abp.js')!!}




<div id="paso_1" class="pasos" onClick="goStep(1)">PASO 1.- DEFINICIÓN DE CONCEPTOS</div>
<div id="paso_2" class="pasos" onclick="goStep(2)">PASO 2.- PLANTEAMIENTO DEL PROBLEMA</div>
<div id="paso_3" class="pasos" onclick="goStep(3)">PASO 3.- LLUVIA DE IDEAS </div>
<div id="paso_4" class="pasos" onclick="goStep(4)">PASO 4.- CATEGORIZACIÓN DE IDEAS</div>
<div id="paso_5" class="pasos" onclick="goStep(5)">PASO 5.- METAS DE APRENDIZAJE</div>
<div id="paso_6" class="pasos" onclick="goStep(6)">PASO 6.- ESTUDIO INDEPENDIENTE</div>
<div id="paso_7" class="pasos" onclick="goStep(7)">PASO 7.- CONCLUSIONES</div>



@endsection