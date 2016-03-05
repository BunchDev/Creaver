@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">
@section('content')
<script type="text/javascript">
	$(document).ready(function(){

    function eliminar(){
      
      $($this).remove();
    }

   	 	$("#AgregarPersonaje").click(function(){
     	var nuevoPersonaje=$("#NuevoPersonaje").val();
      //variable con un hidden input con el valor del personaje agreagado.
      var hiddenP="<input type='hidden' name='Personajes[]' value="+nuevoPersonaje+">"
      datos = $('<span onclick="remove()" value='+nuevoPersonaje+' class="tag label label-info"> '+hiddenP+'<span>'+nuevoPersonaje+'</span><a><i  class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a></span><br><br>');
     	$(".Personajes-Agregados").append(datos);
		  $("#NuevoPersonaje").val('');
    	});
    	
    });
</script>
 
<div class="jumbotron jumbotron-fluid">
<h2 class="display-3">{{$datos['nombre']}}</h2>


</div>
  <div class="col-lg-4 col-lg-offset-4">
    <div id="formularioAbpProfesor" align="center" class="form-group" >
          

              {!!Form::open(array('action' => 'AbpProfesorController@update')) !!}
               <input type="hidden" name="idAbp" value="{{$abp->idABP}}">

          
          <div id="contextodiv" class="form-group">

          {!! Form::label('contexto','Contexto',array('class'=>'control-label','for'=>'contexto')) !!}
          <br>
           <div class="fa  fa-pulse circularIcono">
          <i class="material-icons">public</i>
          </div>
          <br>
       <button type="button" id ="ayuda" class="btn btn-raised btn-info btn-xs" 
          data-container="body" data-toggle="popover" 
          data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
          Ayuda
     </button>

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
          <br>
       <button type="button" id ="ayuda" class="btn btn-raised btn-info btn-xs" 
          data-container="body" data-toggle="popover" 
          data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
          Ayuda
     </button>
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
       <button type="button" id ="ayuda" class="btn btn-raised btn-info btn-xs" 
       data-container="body" data-toggle="popover" 
       data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
       Ayuda
     </button>
           <div id="agregarPersonajediv" class="form-group">
         {!! Form::text('Personaje','',['class'=>'form-control input-lg','id'=>'NuevoPersonaje','placeholder'=>'Agregar un personaje'])!!}

         
         <a class="btn btn-danger btn-fab" id = 'AgregarPersonaje' ><i class="material-icons">add</i></a>
         </div>
         </div>
              </br>
         
          </br>
          <div class="Personajes-Agregados">
            
          <script src="../scripts/abpProfesor.js" type="text/javascript"></script>
           @if(isset($personajes))
              @foreach($personajes as $personaje)
                @if(isset($personaje->Nombre))
                  <script type="text/javascript">

              
                    var hiddenP="<input type='hidden' name='Personajes[]' value='{{$personaje->Nombre}}'>"
                    $(".Personajes-Agregados").append("<span id='{{$personaje->idPersonajesABP}}' onclick='eliminar({{$personaje->idPersonajesABP}})' value='{{$personaje->Nombre}}' class='tag label label-info'> "+hiddenP+"<span>{{$personaje->Nombre}}</span><a><i  class='remove glyphicon glyphicon-remove-sign glyphicon-white'></i></a></span><br><br>")
                  </script>
                @endif
              @endforeach
           @else

           @endif
          </div>

     {!!Form::submit('guardar',['class'=>'btn btn-raised btn-success','id'=>'Guardar'])!!} 


    {!! Form::close() !!}
    <br>
    <ul class="pager">
    
  <li class="previous"><a href="{{$url = '../irCurso/'.$cursoid}}"><i class="material-icons">keyboard_return</i> Regresar a las Actividades</a></li>
</ul>
    </div>
    </div>




<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
@endsection
