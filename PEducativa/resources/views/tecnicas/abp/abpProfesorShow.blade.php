@extends('profesor.perfil')

@section('content')
<link href='https://fonts.googleapis.com/css?family=Philosopher' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
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
@endsection