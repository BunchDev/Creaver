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
          @if(isset($personajes))
            @if(count($personajes)> 0)

              {!!Form::open(array('action' => 'AbpProfesorController@update')) !!}
               <input type="hidden" name="idAbp" value="{{$personajes[0]->fk_idABP}}">
            @else
              {!!Form::open(array('action' => 'AbpProfesorController@store')) !!}
            @endif
          @endif
          
          <div id="contextodiv" class="form-group">

          {!! Form::label('contexto','Contexto',array('class'=>'control-label','for'=>'contexto')) !!}
          <br>
           <div class="fa  fa-pulse circularIcono">
          <i class="material-icons">public</i>
          </div>
          @if(isset($abp->Contexto))
            {!! Form::text("contexto",$abp->Contexto,["name" => "Contexto",'class'=>'form-control input-lg','placeholder'=>'Añade un contexto'])     !!}
         
          @else
            {!! Form::text("contexto",'',["name" => "Contexto",'class'=>'form-control input-lg','placeholder'=>'Añade un contexto'])     !!}

          @endif

          </div>
          <br>
          <div id="problematicadiv" class="form-group">
      
          {!! Form::label('problematica','Problemática',array('class'=>'problematica control-label')) !!}
          <br>
           <div class="fa  fa-pulse circularIcono">
          <i class="material-icons">info outline</i>
          </div>
           @if(isset($abp->problematica))
            {!! Form::textarea('problematica',$abp->problematica,array('class'=>'form-control input-lg','placeholder'=>'Añade una problemática'))!!}
          @else
            {!! Form::textarea('problematica','',array('class'=>'form-control input-lg','placeholder'=>'Añade una problemática'))!!}

          @endif
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
           @if(isset($personajes))
              @foreach($personajes as $personaje)
                @if(isset($personaje->Nombre))
                  <script type="text/javascript">
                    var hiddenP="<input type='hidden' name='Personajes[]' value='{{$personaje->Nombre}}'>"
                    $(".Personajes-Agregados").append("<span onclick='remove()' value='{{$personaje->Nombre}}' class='tag label label-info'> "+hiddenP+"<span>{{$personaje->Nombre}}</span><a><i  class='remove glyphicon glyphicon-remove-sign glyphicon-white'></i></a></span><br><br>")
                  </script>
                @endif
              @endforeach
           @else

           @endif
          </div>
@if(isset($personajes))
  @if(count($personajes)> 0)
     {!!Form::submit('Actualizar',['class'=>'Actualizar','id'=>'Actualizar'])!!} 
  @else
     {!!Form::submit('guardar',['class'=>'Guardar','id'=>'Guardar'])!!} 
  @endif

@endif

    {!! Form::close() !!}
    </div>
    </div>





@endsection
