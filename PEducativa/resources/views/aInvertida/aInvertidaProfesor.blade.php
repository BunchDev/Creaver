@extends('profesor.perfil')

@section('content')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}

<script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('bower_components/lightslide/dist/css/lightslider.min.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
{!! Html::style('css/aulaInvertida.css') !!}


<div>
 
</div>

<div id="all" align="center"  >

<!--Area de pruebas-->
<img id="vimeo-157320165" src="" alt="ALONE" />



<!--Fin de area de prueba-->
<input type="hidden" id="idAi" value="{{$datos->idAi}}">
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
	<button class="btn btn-raised btn-info btn-lg" onClick="subirVideo()"  id="subir_video">Subir Video
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



<button type="button" class="btn btn-raised btn-success btn-lg" id="g_material" onClick="guardar()">
	Guardar Material 
	<i class="material-icons">save</i>
</button>
<!-- Slide para los thumbnails-->

<ul id= "videos_slide">
  <li data-thumb="https://41.media.tumblr.com/d0b99569ff3ef1d06d171c939d044a9c/tumblr_o3g2e7na0l1sllhwxo1_540.jpg" data-src="https://41.media.tumblr.com/d0b99569ff3ef1d06d171c939d044a9c/tumblr_o3g2e7na0l1sllhwxo1_540.jpg">
    <img src="https://41.media.tumblr.com/d0b99569ff3ef1d06d171c939d044a9c/tumblr_o3g2e7na0l1sllhwxo1_540.jpg" />
  </li>
  <li data-thumb="https://41.media.tumblr.com/e2bd33c143b2967d87fc2d188818d6c3/tumblr_o3erj5oYkA1sllhwxo1_540.jpg" data-src="img/largeImage1.jpg">
    <img src="https://41.media.tumblr.com/e2bd33c143b2967d87fc2d188818d6c3/tumblr_o3erj5oYkA1sllhwxo1_540.jpg" />
  </li>
</ul>



</div>

<!-- Script Section, When I wrote this tags I was really happy and tired at the same time
hahahahaha by: Cristian Michel (I dunno why I'm doing this coments ._. I need to sleep -->
{!! Html::script('bower_components/progressbar.js/dist/progressbar.min.js')!!}
{!! Html::script('scripts/upload.js')!!}
{!! Html::script('scripts/vimeo.js')!!}
{!! Html::script('bower_components/lightslide/src/js/lightslider.js')!!}
{!! Html::script('scripts/aulainvertida.js')!!}


@endsection