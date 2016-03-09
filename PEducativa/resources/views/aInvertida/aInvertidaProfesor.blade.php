@extends('profesor.perfil')

@section('content')

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/vimeoJquery.js')!!}
{!! Html::script('scripts/masonry.pkgd.min.js')!!}

{!! Html::script('bower_components/lightslide/src/js/lightslider.js')!!}



{!! Html::script('scripts/vimeo.js')!!}
{!! Html::script('scripts/aulainvertida.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('bower_components/lightslide/dist/css/lightslider.min.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
{!! Html::style('css/aulaInvertida.css') !!}


<div>
 
</div>

<div id="all" align="center" >

<!--Area de pruebas-->



<!--Fin de area de prueba-->
<input type="hidden" id="idAi" value="{{$datos->idAi}}">
<input type="hidden" id="nombreAi" value="{{$datos->nombreVideo}}">
<input type="hidden" id="idVideo" value="">
<input type="hidden" id="idCurso" value="{{$idCurso}}">
<br>
<!--Contenedor del formulario del video -->
<div class="form-group input-lg" id="instrucciondiv">

	<label>Instrucción de la actividad</label>
	<textarea class="form-control" id="instruccion">{{$datos->instruccion}}</textarea>
	<br>


</div>

<div class="alert alert-dismissible alert-warning" id="aviso">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Aviso: </strong>
		<p>Puedes seleccionar un archivo manualmente,arrastrarlo y soltarlo en el área marcada o activar la selección de "Ver mis videos cargados" para seleccionar un video de tu lista</p>
	</div>

<!--Area de lista de videos-->
	<div class="togglebutton" id="lista_check">
         <label>
           <input type="checkbox" id="checkbutton"> Ver mis videos cargados
         </label>
    </div>

<!--Fin de area de lista de videos-->
<br>
<div id="nuevoVideo">
	
	<!-- Div dedicado para el contenedor de video upload-->
	<div class= "form-group" id="archivos_contenedor">
			<div id="archivo_estilo">
  				<input class = "form-control" type="file" id="fl" required>
  				<div class="input-group">
    				<input type="text" readonly="" class="form-control" placeholder="Selecciona un video">
      					<span class="input-group-btn input-group-sm">
        					<button type="button" class="btn btn-fab btn-fab-mini">
          						<i class="material-icons">attach_file</i>
        					</button>
      					</span>
  				</div>
			</div>


		<br>
		
	
	</div>
	<button class="btn btn-raised btn-info btn-lg" onClick="subirVideo()"  id="subir_video">Subir Material
			&nbsp;&nbsp;<i class="material-icons">cloud_upload</i>
	</button>

	<!--Progreso y drag and dropper-->
	<div class="form-group">
		<div id="progress" hidden></div>

      	<div id="drop_zone">Suelta tu video aquí</div>
      	<br>
     <div id="results"></div>

	</div>


</div>
<!-- 
	Este tag de video se usa solo para cargar los parametros src y 
	obtener la duración en el script vimeo.js por default no se muestra 
-->
<video controls width="500px" id="vid" style="display:none" preload="metadata"></video>

<br>
<br>
<br>


<!-- En este div se coloca el video cargado-->
<div id="videoContent">

</div>

<!-- Slide para los thumbnails-->
<div id="lista_videos" hidden>


	@if(count($urls) > 0)
	
	<div class="grid">
		
		@foreach($urls as $urln)
    		
  			<div id="div_{{$urln->url}}" class="grid-item">
  				
  				<strong>
        			{{$urln->nombreVideo}}
    			 </strong>
    			 <br>
  				<input type="hidden" id="id" value="{{$urln->url}}">
  				<div class="checkbox" id="check_video">
 					<label>
            			<input type="checkbox" id="check"> Seleccionar
          			</label>

    			</div>

    			<button id="ver_video" onClick="verVideo({{$urln->url}})" class="btn btn-raised btn-info btn-xs">Ver video</button>
  			</div>
  		
  			<script type="text/javascript">
				$.when(vimeoLoadingThumb("{{$urln->url}}")).done(function(){
					console.log("He pasado por aquí y el objeto es: "+msnry);
					msnry.layout();


				});
			//agrego la url real en una pila	
			urls.push("{{$urln->url}}");
				
			</script>
  		@endforeach
  	</div>

	@else
		<div class="alert alert-dismissible alert-warning" id="aviso">
			<strong>Sin videos: </strong>
			<p>No tienes videos disponibles para elegir</p>
		</div>


	@endif

</div>
<button type="button" class="btn btn-raised btn-danger btn-lg" id="cancelarSubida" onClick="cancelarSubidaVideo()" style="display:none" >
	Cancelar
	<i class="material-icons">cancel</i>
</button> 
<button type="button" class="btn btn-raised btn-success btn-lg" id="g_material" onClick="guardar()">
	Guardar Material 
	<i class="material-icons">save</i>
</button>



<!--Fin del contenedor super parent-->
</div>

<!-- Modal para mostrar video -->

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Video</h3>
      </div>
      <div class="modal-body">
      	<iframe id="reproductor" 
      		src="" 
      		width="100%" height="354" frameborder="0" webkitallowfullscreen 
      		mozallowfullscreen allowfullscreen>

      	</iframe>
      </div>

</div>



<!-- Script Section, When I wrote this tags I was really happy and tired at the same time
hahahahaha by: Cristian Michel (I dunno why I'm doing this coments ._. I need to sleep -->
{!! Html::script('bower_components/progressbar.js/dist/progressbar.min.js')!!}
{!! Html::script('scripts/upload.js')!!}
{!! Html::script('scripts/freewall.js')!!}

<script type="text/javascript">
var msnry;
$(document).ready(function() {

    var container = document.querySelector('.grid');
    msnry = new Masonry( container, {
        itemSelector: '.grid-item',
        isFitWidth: true,
        columnWidth: 100
    });

//agrega el listener que escucha cuando el elemento frame se ha cargado
$("#reproductor").load(function(){
   $("#reproductor").vimeo("play");
});


});

//aplica un reacomodo de los elementos del Masonry cuando la pagina ha cargado por completo

$(window).bind("load", function() {
msnry.layout();
  
});



</script>

@endsection