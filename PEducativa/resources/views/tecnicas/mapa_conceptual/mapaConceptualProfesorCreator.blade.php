
@extends('profesor.perfil')

@section('content')
<!-- @start Estilos sección -->
{!! Html::style('css/mapaconceptual-creator.css') !!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}

{!! Html::style('bower_components/urlive/jquery.urlive.css') !!}

<!--  @end Estilos sección-->

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}

{!! Html::script('bower_components/urlive/jquery.urlive.js')!!}
{!! Html::script('scripts/masonry.pkgd.min.js')!!}


@if(isset($id)) 
	<input type="hidden" id="id" value="{{$id}}"> 
@endif
@if(isset($idCurso)) 
	<input type="hidden" id="idCurso" value="{{$idCurso}}"> 
@endif

<div id="contenedor" align="center">

	<!-- ANUNCIO-->
	<div class="alert alert-dismissible alert-warning">
  		<button type="button" class="close" data-dismiss="alert">×</button>
  		<strong>Aviso: </strong>

  		<p>Para esta actividad añade la instrucción de dicha actividad, puedes añadir <i>links</i> y/o archivos
        como fuente de información</p>
	</div>


  <label>Intrucción</label>
  <textarea id="instruccion"></textarea> 


<!-- Archivos para anexar-->

<div class="form-group">
  <input type="file" name="archivos_client" multiple >
  <div class="input-group">
    <input type="text" readonly="" class="form-control" placeholder="Adjunta uno o varios archivos de interés...">
      <span class="input-group-btn input-group-sm">
        <button type="button" class="btn btn-fab btn-fab-mini">
         <i class="fa fa-paperclip "></i>
        </button>
      </span>
  </div>
</div>



<!-- Links para anexar-->
<label>Añadir <i>links</i> de interés</label>
<input type="text" id="link" placeholder="ingresa la url">
 <a href="javascript:appendUrl()" class="btn btn-danger btn-fab"><i class="material-icons">add</i></a>

<!--Div para mostrar links -->

<div class="progress"></div>

<!--AREA DE PRUEBAS-->


<!--FIN AREA DE PRUEBAS-->
<button onClick="enviarMateriales()" class="btn btn-raised btn-success"> Guardar </button>
<div id="links" >
<div class="grid">

</div>
</div>
<script type="text/javascript">
var $grid = $('.grid').masonry({
   itemSelector: '.grid-item',
        isFitWidth: true,
        columnWidth: 60,
        containerStyle: { position: 'relative' }
});


</script>


<!-- Scripts sección -->
{!! Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')!!}
{!! Html::script('scripts/mapaconceptual.js')!!}

@endsection