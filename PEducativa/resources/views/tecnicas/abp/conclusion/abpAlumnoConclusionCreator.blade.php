
@extends('profesor.perfil')

@section('content')
<!-- @start Estilos sección -->
{!! Html::style('css/normalize.css') !!}

{!! Html::style('css/abp.css') !!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}

{!! Html::style('bower_components/urlive/jquery.urlive.css') !!}
{!! Html::style('bower_components/jQuery-File-Validator/css/file-validator.css') !!}

<!--  @end Estilos sección-->

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}

{!! Html::script('bower_components/urlive/jquery.urlive.js')!!}
{!! Html::script('scripts/masonry.pkgd.min.js')!!}
{!! Html::script('jsext/ckeditor/ckeditor.js')!!}
{!! Html::script('bower_components/jQuery-File-Validator/js/file-validator.js')!!}


@if(isset($id)) 
	<input type="hidden" id="id" value="{{$id}}"> 
@endif
@if(isset($idCurso)) 
	<input type="hidden" id="idCurso" value="{{$idCurso}}"> 
@endif


<div id="contenedor">

	<!-- ANUNCIO-->
	<div class="alert alert-dismissible alert-warning" align="center">
  		<button type="button" class="close" data-dismiss="alert">×</button>
  		<strong>Aviso: </strong>

  		<p>Añade uno o más evidencias seleccionando los archivos y/o añandiedo los links necesarios</p>
	</div>




<div align="center">
<button type="button"  class="btn btn-info"  data-toggle="modal" data-target="#editor"><strong id="display">Redactar conclusión</strong> <i class="fa fa-pencil fa-2x" aria-hidden="true"></i></button>
</div>
<br>
<div id="editor" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Redactar la conclusión</h4>
      </div>
      <div class="modal-body">
         <textarea name="conclusion" id="conclusion" rows="20" cols="100"></textarea>
      </div>
      <div class="modal-footer">
        <button  class="btn btn-success btn-circle btn-xl" onClick="show('conclusion','conclusion')" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>




<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Conclusión</h3>
  </div>
  <div class="panel-body" id="shower">
   
  </div>

</div>


 


<!-- Archivos para anexar-->

<!--input type="file" name="archivos_client" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple/-->


<div></div>
<div class="row">
  <div class="col-md-6">
    <div id="fileRoot" class="alert alert-info" align="center">
      <h4 id="fileDisplay"></h4>
      <input type="file" name="archivos_client" id="file" class="inputfile inputfile btn btn-lg" data-multiple-caption="{count} archivos seleccionados" multiple />
      <label for="file">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
          <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
        </svg> 
        <span>Anexar archivos&hellip;</span>
      </label>

    </div>

  </div>
  <div class="col-md-6">
    <!-- Links para anexar-->
    <div id="linkAdd" class="alert alert-info" align="center">
      <h4 id="linkDisplay"></h4>
      <label>Añadir <i>links</i> de interés</label>
      <input type="text" class="form-control" id="link" placeholder="ingresa la url">
      <button onclick="javascript:appendUrl()" class="btn btn-danger btn-fab" id="addLink">Añadir url<i class="material-icons">add</i> </button>
    </div>
  </div>
</div>

<!--Div para mostrar links -->

<div class="progress"></div>

<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
  
  </div>
</div>




<div align="center">
<button onClick="enviarConclusion()" class="btn btn-raised btn-success btn-lg"> Enviar conclusión <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
</div>

<div id="links" align="center">
<div class="grid-conclution">

</div>
</div>



  <script type="text/javascript">
var $grid = $('.grid-conclution').masonry({



        itemSelector: '.grid-item-conclution',
        isFitWidth: true,
        gutter: 5,
        containerStyle: { position: 'relative' }
});

'use strict';

;( function( $, window, document, undefined )
{
  $( '.inputfile' ).each( function()
  {
    var $input   = $( this ),
      $label   = $input.next( 'label' ),
      labelVal = $label.html();

    $input.on( 'change', function( e )
    {
      var fileName = '';

      if( this.files && this.files.length > 1 )
        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
      else if( e.target.value )
        fileName = e.target.value.split( '\\' ).pop();

      if( fileName )
        $label.find( 'span' ).html( fileName );
      else
        $label.html( labelVal );
    });

    // Firefox bug fix
    $input
    .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
    .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
  });
})( jQuery, window, document );

  CKEDITOR.replace( 'conclusion' );

 

  $( 'input[name=archivos_client]' ).fileValidator({
  onValidation: function(files){ $("#fileDisplay").text('Validando archivos ...');
                  $bitsCounter = 0;
                  $maxSize = 10000;
                  $flag = false;
                  $.each(files,function(key,file){
                    $bitsCounter+= ( file.size / 1024);
                    console.log(( file.size / 1024));
                    if($bitsCounter > $maxSize){
                      $flag = true;
                      return;
                    }

                  });

                  if($flag){
                      $('#fileDisplay').text('Error: Se exedió la cantidad de MB disponibles o se adjuntaron archivos no permitidos');
                      $('#fileRoot').removeClass();
                      $('#fileRoot').addClass('alert alert-danger');
                  }
                  else{
                    $('#fileDisplay').text('Success: Archivos validados');
                    $('#fileRoot').removeClass();
                    $('#fileRoot').addClass('alert alert-success');

                      }
                  },
  onInvalid:    function(validationType, file){ 
                    $('#fileDisplay').text('Error: Se exedió la cantidad de MB disponibles o se adjuntaron archivos no permitidos');
                    $('#fileRoot').removeClass();
                    $('#fileRoot').addClass('alert alert-danger');

                  },
   maxSize:      '10m', //optional
  
});
</script>

  

<!-- Scripts sección -->
{!! Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')!!}
{!! Html::script('scripts/alumno/abp.js')!!}












@endsection