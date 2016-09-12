@extends('profesor.perfil')

@section('content')

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('bower_components/jsVideoUrlParser/dist/jsVideoUrlParser.js')!!}
{!! Html::script('scripts/vimeoJquery.js')!!}
{!! Html::script('scripts/masonry.pkgd.min.js')!!}
{!! Html::script('scripts/aulainvertida.js')!!}
{!! Html::script('scripts/vimeo.js')!!}
{!! Html::script('https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.min.js')!!}
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
  <h4></h4>
	<label>Instrucción de la actividad</label>
	<textarea class="form-control" id="instruccion">{{$datos->instruccion}}</textarea>
	<br>

</div>

<div class="alert alert-info">
  <strong>Reto para la clase</strong>
  <br>
  puedes habilitar uno o más retos que el alumno pueda ecoger para realizar en clase 
</div>

<div id="reto">
  <h4  id="display-error"></h4>
  <div class="reto-item" id="examen">
    <div>
    <input type="checkbox">
    <br>
    <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
    <br>
    <strong>Examen</strong>
    </div>
  </div>

  <div class="reto-item" id="experimento">
    <div>
    <input type="checkbox">
    <br>
    <i class="fa fa-flask fa-3x" aria-hidden="true"></i>
    <br>
    <strong>Experimento</strong>
    </div>

  </div>

</div>


<!--OPTIONS SELECTORS -->
<div class="form-inline" id="options-selectors">
  <div class="[ form-group ]">
            <input type="checkbox" name="fancy-checkbox-default" id="video-check" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="video-check" class="[ btn btn-default ]">
                  <i class="fa fa-check-square-o" aria-hidden="true"></i>
                  <i class="fa fa-square-o" aria-hidden="true"></i>  
                </label>
                <label for="video-check" class="[ btn btn-danger active ]">
                    Subir un video
                </label>
            </div>
</div>

<div class="[ form-group ]">
            <input type="checkbox" name="fancy-checkbox-default" id="url-check" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="url-check" class="[ btn btn-default ]">
                  <i class="fa fa-check-square-o" aria-hidden="true"></i>
                  <i class="fa fa-square-o" aria-hidden="true"></i>  
                </label>
                <label for="url-check" class="[ btn btn-info active ]">
                    Subir url de vídeo
                </label>
            </div>
</div>

<div class="[ form-group ]">
            <input type="checkbox" name="fancy-checkbox-default" id="vuploaded-check" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="vuploaded-check" class="[ btn btn-default ]">
                  <i class="fa fa-check-square-o" aria-hidden="true"></i>
                  <i class="fa fa-square-o" aria-hidden="true"></i>  
                </label>
                <label for="vuploaded-check" class="[ btn btn-primary active ]">
                    Escoger un vídeo subido anteriormente
                </label>
            </div>
</div>

</div>
<!--END OPTIONS SELECTORS-->



      <!-- VIDEO FILE SELECTOR-->
    <div id="fileRoot" class="alert alert-danger" align="center">
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Aviso: </strong>
         <br> 
         El vídeo no puede tener una duración superior a los 5 minutos
       </div>
      <h4 id="fileDisplay"></h4>
      
      <input type="file" id="videoUpload"  class="inputfile btn btn-lg" accept="video/*"/>
      <label for="videoUpload">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
          <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
        </svg> 
        <span>Escoger archivo de video&hellip;</span>
      </label>

      <div class="input-group">
        <h4 id="vname-display"></h4>
        <label for="vname">Nombre del video *</label>
        <input type="text" class="form-control" id="vname">
      </div>

      <div>

        <label class="control-label" for="thumbnail">
          Thumbnail (opcional) 
          <button data-toggle="popover" title="<strong>¿Que es un thumbnail?</strong>" data-content="Es una imagen que representa el contenido del video para facilitar su ubicación y organización. Más información: <a href='https://es.wikipedia.org/wiki/Thumbnail' target='_blank'>Aquí</a>" class="btn btn-info btn-xs">
            <i class="fa fa-question" aria-hidden="true"></i>
          </button>
        </label>
        <br>
        <input type="file" id="thumbnail" class="inputfile btn btn-lg" accept="image/*" >
        <label for="thumbnail">
          <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
          <span>Escoger imagen</span>
        </label>

      </div>


    </div>

    <!-- END VIDEO FILE SELECTOR-->
  
 
    <!--URL SOCIAL VIDEO PLATFORM SELECTOR -->
    <div id="irul-container" class="alert alert-info">
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Aviso: </strong>
         <br> 
         Los videos añadidos como url se mostrarán en la parte de abajo del botón cargar
       </div>
    <button id="btn-iurl" class="btn btn-info btn-lg active" onclick="insertUrl()">Insertar link de video <i class="fa fa-video-camera" aria-hidden="true"></i></button>
    
    </div>
    <!-- END URL SOCIAL VIDEO PLATFORM SELECTOR-->

    <!-- VIDEO UPOLOADED SELECTOR  -->
    <div id="url-vselector-container" class="alert alert-success">
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Aviso: </strong>
         <br> 
         En esta sección puedes escoger uno o varios videos que has subido anteriormente en Creatver
       </div>
      <button id="btn-selectvideo" data-toggle="modal" data-target="#videoSelecterModal" class="btn btn-primary btn-lg active">Escoger un vídeo subido previamente <i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
    
      <!--MODAL SELECTER VIDEO-->

        <!-- Modal -->
        <div id="videoSelecterModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

          <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Selecciona uno o varios vídeos</h4>
              </div>
              <div class="modal-body">

                <div class="gridselector">
                  
                 
                 <div class="gridselector-item">
                    <div class="selector">
                      <div class="[ form-group ]">
                        <input type="checkbox" name="iframe" id="v1" autocomplete="off" />
                        <div class="[ btn-group ]">
                          <label for="v1" class="[ btn btn-default ]">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            <i class="fa fa-square-o" aria-hidden="true"></i>  
                          </label>
                          <label for="v1" class="[ btn btn-default active ]">
                            Agregar este vídeo
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="video">
                      <iframe src='http://www.youtube.com/embed/gXqqWbnboJ0?autoplay=0'></iframe>
                    </div>
                  </div>

                    <div class="gridselector-item">
                    <div class="selector">
                      <div class="[ form-group ]">
                        <input type="checkbox" name="iframe" id="v2" autocomplete="off" />
                        <div class="[ btn-group ]">
                          <label for="v2" class="[ btn btn-default ]">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            <i class="fa fa-square-o" aria-hidden="true"></i>  
                          </label>
                          <label for="v2" class="[ btn btn-default active ]">
                            Agregar este vídeo
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="video">
                      <iframe src='http://www.youtube.com/embed/gXqqWbnboJ0?autoplay=0'></iframe>
                    </div>
                  </div>

                    <div class="gridselector-item">
                    <div class="selector">
                      <div class="[ form-group ]">
                        <input type="checkbox" name="iframe" id="v3" autocomplete="off" />
                        <div class="[ btn-group ]">
                          <label for="v3" class="[ btn btn-default ]">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            <i class="fa fa-square-o" aria-hidden="true"></i>  
                          </label>
                          <label for="v3" class="[ btn btn-default active ]">
                            Agregar este vídeo
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="video">
                      <iframe src='http://www.youtube.com/embed/gXqqWbnboJ0?autoplay=0'></iframe>
                    </div>
                  </div>

                  



                  

           
                  
                  

                </div>

              </div>
              <div class="modal-footer">
               
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
</div>
      <!-- END MODAL SELECTER VIDEO-->
    </div>


<!-- END VIDEO UPLOADED SELECTOR -->
<br>
<button id="sendMaterials" class="btn btn-success btn-lg" onclick="sendMaterials()">Subir y enviar todo <i class="fa fa-paper-plane" aria-hidden="true"></i></button>


<!--OLDER BELONG HERE-->

<div id="videos" class="grid">

</div>

</div>

              
<script>

profesorInit();





$(document).ready(function(){

 

  




$(window).on('shown.bs.modal', function() { 
    $('#videoSelecterModal').modal('show');
    gridselector.imagesLoaded( function() {
      gridselector.masonry('layout');

      $(".gridselector-item .selector .video").css({
         'width': '240px',
         'height': '240px'
      });

  
});
     
    
});

  $('[data-toggle="popover"]').popover({html:true});

});



function mas()
{
   gridselector.masonry('layout');
}





</script>


@endsection