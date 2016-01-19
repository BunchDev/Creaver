@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
@section('content')
<script type="text/javascript">
	$(document).ready(function(){
   	 	$("#AgregarPersonaje").click(function(){
     	var nuevoPersonaje=$("#NuevoPersonaje").val();
     	$(".Personajes-Agregados").append("<input type='text' value="+nuevoPersonaje+" class='personaje-agregado' name='personaje[]' disabled><br>")
		$("#NuevoPersonaje").val('');
    	});
    	$(".personaje-agregado").click(function(){
    		alert("hola");
    		$(".personaje-agregado").remove();
        });
    });
</script>
 
<div class="jumbotron jumbotron-fluid">
<h2 class="display-3">{{$datos['nombre']}}</h2>
<br>
</div>

   {!!Form::open() !!}
      
         {!! Form::text('Personaje','',['class'=>'NuevoPersonaje','id'=>'NuevoPersonaje'])!!}
         {{ Form::button('Agregar Personaje',['class'=>'AgregarPersonaje','id'=>'AgregarPersonaje']) }}  
              </br>
         
          </br>
          {!! Form::close() !!}
<div class="Personajes-Agregados">

</div>


@endsection
