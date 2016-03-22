@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}
{!! Html::script('scripts/masonry.pkgd.min.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
{!! Html::style('css/cursos.css') !!}
@section('content')
<div class="se-pre-con-curso"></div>

<!-- Agrego un mensaje de informacion al entrar a este modulo -->

<h1 >Cursos</h1>
<br>
<p > Tus cursos aprobados y pendientes por aprobar se encuentran aquí
<br>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mostrarFormAgregarCurso()" class="btn btn-danger btn-fab" ><i class="material-icons">add</i></a>
<br>
<br>
@if(count($datoscursos) > 0)
    <div class="grid">
    @foreach($datoscursos as $curso)
      @if($curso->Estatus == 0)
      <div class="grid-item" onClick="irCurso({{$curso->idCurso}},{{$curso->Estatus}})" id="pAprobado">
      @else  
      <div class="grid-item" onClick="irCurso({{$curso->idCurso}},{{$curso->Estatus}})" id="Aprobado">
      @endif
        <div class="list-group">
          <div class="list-group-item">
            <div class="row-action-primary">
              <i class="material-icons">{{$curso->avatar}}</i>
            </div>
            <div class="row-content">
              @if($curso->Estatus == 0)
                <div class="action-secondary">
                  <i class="material-icons">hourglass_empty</i>
                </div>
              @else
                <div class="action-secondary">
                  <i class="material-icons">check_circle</i>
                </div>
              @endif

                <h4 class="list-group-item-heading">{{$curso->Nombre}}</h4>

            </div>
          </div>
        </div>
      </div>
     



    @endforeach
    </div>



@else 
  <div class="alert alert-dismissible alert-warning">
    <h4><strong>Sin cursos</strong></h4>
    <p>Aún no has creado cursos</p>
  </div>

@endif



<!--  Formulario para agregar un nuevo curso-->

<!-- Modal -->

<div class="modal fade" id="nuevoCursoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Nuevo Curso</h3>
      </div>
      <div class="modal-body">
       
<!-- Cuerpo del form -->
<form action="./crearCurso" method="post" id='formCrearCurso'>
  <div id="avisos"></div>
<div class="form-group">
      <label class="col-md-2 control-label" for="nombreCurso">Nombre</label>

      <div class="col-md-10">
        <div id="status">
        <input type="text" class="form-control" id="nombreCurso" name="nombre">
        </div>
      </div>

    </div>
    <div class="form-group">
 

      <div class="col-md-11 ">
        <label class="control-label" for="descripcionCurso">Escriba una descripción del curso (opcional)</label>
        <div id="statusTArea">
          <textarea class="form-control" rows="3" id="descripcionCurso" name="descripcion"></textarea>
        </div>
      </div>
    </div>

    <div class="form-group">
      <select class="selectpicker" id="avatar" title="Escoje un avatar">
        <!--Sorry for this dev, but it was the best way to shows icons, maybe in the future
            you will replace this using a script getting the names of icons from a file -->
        <option data-content="<i class='material-icons'>build</i> &nbsp;<strong>Build </strong>">build</option>
        <option data-content="<i class='material-icons'>android</i> &nbsp;<strong>Android </strong>">android</option>
        <option data-content="<i class='material-icons'>book</i> &nbsp;<strong>Book </strong>">book</option>
        <option data-content="<i class='material-icons'>favorite</i> &nbsp;<strong>Favorite </strong>">favorite</option>
        <option data-content="<i class='material-icons'>grade</i> &nbsp;<strong>Star </strong>">grade</option>
        <option data-content="<i class='material-icons'>gavel</i> &nbsp;<strong>Gavel </strong>">gavel</option>
        <option data-content="<i class='material-icons'>language</i> &nbsp;<strong>Language </strong>">language</option>
        <option data-content="<i class='material-icons'>movie</i> &nbsp;<strong>Movie </strong>">movie</option>
        <option data-content="<i class='material-icons'>business</i> &nbsp;<strong>Business </strong>">business</option>
        <option data-content="<i class='material-icons'>developer_mode</i> &nbsp;<strong>Developer </strong>">developer_mode</option>
        <option data-content="<i class='material-icons'>attach_money</i> &nbsp;<strong>Money </strong>">attach_money</option>
        <option data-content="<i class='material-icons'>insert_emoticon</i> &nbsp;<strong>Emoticon </strong>">insert_emoticon</option>
        <option data-content="<i class='material-icons'>computer</i> &nbsp;<strong>Computer </strong>">computer</option>
        <option data-content="<i class='material-icons'>brush</i> &nbsp;<strong>Brush </strong>">brush</option>
        <option data-content="<i class='material-icons'>palette</i> &nbsp;<strong>Palette </strong>">palette</option>
        <option data-content="<i class='material-icons'>local_hospital</i> &nbsp;<strong>Hospital </strong>">local_hospital</option>
        <option data-content="<i class='material-icons'>extension</i> &nbsp;<strong>Extension </strong>">extension</option>
        <option data-content="<i class='material-icons'>group_work</i> &nbsp;<strong>Group Work </strong>">group_work</option>
        <option data-content="<i class='material-icons'>theaters</i> &nbsp;<strong>Theater </strong>">theaters</option>
        <option data-content="<i class='material-icons'>web</i> &nbsp;<strong>Web </strong>">web</option>
        <option data-content="<i class='material-icons'>filter_vintage</i> &nbsp;<strong>Vintage </strong>">filter_vintage</option>
        <option data-content="<i class='material-icons'>local_library</i> &nbsp;<strong>Library </strong>">local_library</option>
        <option data-content="<i class='material-icons'>public</i> &nbsp;<strong>Public </strong>">public</option>
        <option data-content="<i class='material-icons'>school</i> &nbsp;<strong>School </strong>">school</option>




      </select>
 

    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i class="material-icons">clear</i></button>
        <button type="button" onclick="enviarDatosServidor()" class="btn btn-raised btn-danger">Guardar Curso <i class="material-icons">save</i></button>
      </div>
      </form>
    </div>
  </div>
</div>

  {!! Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')!!}
  {!! Html::script('scripts/validatorJQB.js')!!}
<script>
var msnry;
var container = document.querySelector('.grid');
    msnry = new Masonry( container, {
        itemSelector: '.grid-item',
        isFitWidth: true,
        columnWidth: 40
    });

// Se mandan los datos que se recibe en la vista al script para su posterior ordenamiento
//mostrarCursos(<?php echo json_encode( $datoscursos) ?>)
$(window).bind("load", function() {

msnry.layout();
});

</script>

@endsection
