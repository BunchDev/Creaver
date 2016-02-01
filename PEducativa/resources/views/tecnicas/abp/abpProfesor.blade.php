@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">
@section('content')
<script type="text/javascript">
	$(document).ready(function(){

    function remove(){
      alert("hola");
      $($this).remove();
    }

   	 	$("#AgregarPersonaje").click(function(){
     	var nuevoPersonaje=$("#NuevoPersonaje").val();
      ///variable con un hidden input con el valor del personaje agreagado.
      var hiddenP="<input type='hidden' name='Personajes[]' value="+nuevoPersonaje+">"
     	$(".Personajes-Agregados").append('<span onclick="remove()" value='+nuevoPersonaje+' class="tag label label-info"> '+hiddenP+'<span>'+nuevoPersonaje+'</span><a><i  class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a></span><br><br>')
		  $("#NuevoPersonaje").val('');
    	});
    	
    });
</script>
 
<div class="jumbotron jumbotron-fluid">
<h2 class="display-3">{{$datos['nombre']}}</h2>


</div>
  <div class="col-lg-4 col-lg-offset-4">
    <div id="formularioAbpProfesor" align="center" class="form-group" >

          {!!Form::open(array('action' => 'AbpProfesorController@store')) !!}
          <div id="contextodiv" class="form-group">

          {!! Form::label('contexto','Contexto',array('class'=>'control-label','for'=>'contexto')) !!}
          <br>
           <div class="fa  fa-pulse circularIcono">
          <i class="material-icons">public</i>
          </div>
          {!! Form::text("contexto",'',["name" => "Contexto",'class'=>'form-control input-lg','placeholder'=>'Añade un contexto'])     !!}
          </div>
          <br>
          <div id="problematicadiv" class="form-group">
          {!! Form::label('problematica','Problemática',array('class'=>'problematica control-label')) !!}
          <br>
           <div class="fa  fa-pulse circularIcono">
          <i class="material-icons">info outline</i>
          </div>
          {!! Form::textarea('problematica','',array('class'=>'form-control input-lg','placeholder'=>'Añade una problemática'))!!}
          </div>
          <br>
          <div id="personajesdiv" class="form-group">
          {!! Form::label('NuevoPersonaje','Personajes') !!}
          
          <br>
           <div class="fa  fa-pulse circularIcono">
          <i class="material-icons">mood</i>
          </div>
          <br>
           <div id="agregarPersonajediv" class="form-group">
         {!! Form::text('Personaje','',['class'=>'form-control input-lg','id'=>'NuevoPersonaje','placeholder'=>'Agregar un personaje'])!!}

         
         <a class="btn btn-danger btn-fab" id = 'AgregarPersonaje' ><i class="material-icons">add</i></a>
         </div>
         </div>
              </br>
         
          </br>
          <div class="Personajes-Agregados">

          </div>
 {!!Form::submit('guardar',['class'=>'Guardar','id'=>'Guardar'])!!} 
    {!! Form::close() !!}
    </div>
    </div>





@endsection
