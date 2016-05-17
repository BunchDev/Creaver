@extends('alumno.index')

@section('content')
{!! Html::style('css/abp.css') !!}
{!! Html::style('jsext/ckeditor/contents.css') !!}

{!! Html::style('css/ext/font-awesome-animation.css') !!}

{!! Html::script('jsext/ckeditor/ckeditor.js')!!}


<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

<div class="list-group">
  <div class="list-group-item active">
    <h4 class="list-group-item-heading">Metas de aprendizaje</h4>
    <p class="list-group-item-text">Se lista a continuación las metas de aprendizaje guardados en el paso 5</p>
  </div>
  <div class="list-group-item">
  	Meta 1
  </div>

  <div class="list-group-item">
  	Meta 2
  </div>

  <div class="list-group-item">
  	Meta 3
  </div>


</div>

<div align="center">
<button type="button"  class="btn btn-info"  data-toggle="modal" data-target="#editor"><strong id="display">Redactar estudio independiente</strong> <i class="fa fa-pencil fa-2x" aria-hidden="true"></i></button>
</div>
<br>
<div id="editor" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Redacción de estudio independiente</h4>
      </div>
      <div class="modal-body">
         <textarea name="estudio" id="estudio" rows="20" cols="100"></textarea>
      </div>
      <div class="modal-footer">
      	<button  class="btn btn-success btn-circle btn-xl" onClick="show('estudio','estudio independiente')" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>




<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Estudio Independiente</h3>
  </div>
  <div class="panel-body" id="shower">
   
  </div>

   <div class="panel-footer" id="sec_3" align="center">
      <label for="fuente">Fuente</label>
      <br>

   	<button class="btn btn-warning" data-toggle="modal" data-target="#modal_3">Añadir Fuente</button>
   
          <div class="fuente form-control" align="center"></div>
    
          
<!--MODAL PARA FUENTES-->
<div id="modal_3" class="modal fade" role="dialog">
    <input type="hidden" class="type_apa" value="">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FORMATO APA</h4>
          <select class="selectpicker" data-style="btn-primary" onchange="getModalBody(3)" title="¿Que quieres citar?">
            <option data-content='<i class="fa fa-book" aria-hidden="true"></i> Libro Electrónico'>libro</option>
            <option data-content='<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                Revista Científica Electrónica'>revista</option>
            <option data-content='<i class="fa fa-globe" aria-hidden="true"></i> Página Web' >web</option>
          
          </select>
        </div>
     
        <div class="modal-body">
          <!--BODY DEL MODAL-->
        
          <!--FIN BODY-->


        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" onClick="makeFormat('3')">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
  
      </div>

    </div>
  </div>

   </div>
</div>

<div align="center">
<button class="btn btn-success" onclick="sendEstudioIndependiente()">Enviar estudio independiente <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></button>
</div>







  <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'estudio' );
</script>






{!! Html::script('scripts/alumno/abp.js')!!}


@endsection