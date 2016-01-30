@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}


{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}


@section('content')
<<<<<<< HEAD
	<div class="jumbotron jumbotron-fluid">
		<h1 class="display-3">Curso seleccionado</h1>
		<br>
		<p class="lead"> Detalles del curso seleccionado:
		{{$DatosCurso->Nombre}}<br>
		{{$DatosCurso->Descripcion}}
	</div>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mostrarFormAgregarActividad()" class="btn btn-danger btn-fab" ><i class="material-icons">add</i></a>
	<br>
=======
<div class="se-pre-con-irCurso"></div>
<div class="jumbotron jumbotron-fluid">
<h1 class="display-3">Curso seleccionado</h1>
<br>
<p class="lead"> Detalles del curso seleccionado:
	{{$DatosCurso->Nombre}}
{{$DatosCurso->Descripcion}}

</div>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mostrarFormAgregarActividad()" class="btn  btn-fab" id="addAct" ><i class="material-icons">add</i></a>
<br>
>>>>>>> origin/master

	{!! Form:: open(['url' => '#','role' => 'form','class' => 'form-horizontal'])   !!}
	<div id="tablaActividades">
		<div class="aprobados" align= "center">

		{!! Form:: button("Ver mis actividades",array('class' => 'btn btn-raised btn-success btn-lg','data-toggle' => 'collapse','data-target' => '#curso','id' => 'ap','aria-label' => 'Left Align')) !!}

		<br>
			<div id="curso" class="collapse">
    
			</div>
		</div>
	</div>

<<<<<<< HEAD
	{!! Form:: close() !!}
=======
{!! Form:: close() !!}


<!-- MODAL PARA LA ACTIVIDAD -->
<div class="modal fade" id="nuevaActividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Nueva Actividad</h3>
      </div>
      <div class="modal-body">
       
<!-- Cuerpo del form -->
<form action="./crearCurso" method="post" id='formCrearCurso'>
  <div id="avisos"></div>
<div class="form-group">
      <label class="col-md-2 control-label">Nombre</label>

      <div class="col-md-10">
        <div id="status">
        <input type="text" class="form-control" id="nombreCurso" name="nombre">
        </div>
      </div>

    </div>

<!-- Selector de tecnicas -->
<div class="form-group">
      <label class="col-md-2 control-label">Técnica de enseñanza</label>

      <div class="col-md-10">
        <div id="status">
        <select class="selectpicker" data-width="100%" id="tecnicas">
  <option data-content="<div class='list-group'><div class='list-group-item'><div class='row-action-primary'><img class='circle' src='../images/tecnicas/abp.png' alt='icon'></div><div class='row-content'><h4 class='list-group-item-heading'>ABP</h4><p class='list-group-item-text'>Aprendizaje Basado en Problemas</p></div></div></div>">1</option>
  <option data-content="<div class='list-group'><div class='list-group-item'><div class='row-picture'><img class='circle' src='../images/tecnicas/caso.png' alt='icon'></div><div class='row-content'><h4 class='list-group-item-heading'>DC</h4><p class='list-group-item-text'>Diseño de Caso</p></div></div></div>">2</option>
  <option data-content="<div class='list-group'><div class='list-group-item'><div class='row-picture'><img class='circle' src='../images/tecnicas/ai.png' alt='icon'></div><div class='row-content'><h4 class='list-group-item-heading'>AI</h4><p class='list-group-item-text'>Aula Invertida</p></div></div></div>">3</option>
</select>
        </div>
      </div>

    </div>




    <div class="form-group">
<div class="col-md-11">
  <label class="control-label" for="descripcionCurso">Escriba una descripción de la actividad (opcional)</label>
  <div id="statusTArea">
   <textarea class="form-control" rows="3" id="descripcionCurso" name="descripcion"></textarea>
   </div>

      </div>
    </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i class="material-icons">clear</i></button>
        <button type="button" onclick="guardar({{$DatosCurso->idCurso}})" class="btn btn-raised btn-danger" id="guardarActividad">Guardar Actividad <i class="material-icons">save</i></button>
      </div>
      </form>
    </div>
  </div>
</div>
	{!! Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')!!}




>>>>>>> origin/master
@endsection