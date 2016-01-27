@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}

{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}


  
@section('content')


<!-- Agrego un mensaje de informacion al entrar a este modulo -->
<div class="jumbotron jumbotron-fluid">
<h1 class="display-3">Cursos</h1>
<br>
<p class="lead"> Tus cursos aprobados y pendientes por aprobar se encuentran aquí
</div>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mostrarFormAgregarCurso()" class="btn btn-danger btn-fab" ><i class="material-icons">add</i></a>
<br>


<!-- Creo un form donde agrego los elementos del modulo como los botones de despliegue -->
{!! Form:: open(['url' => '#','role' => 'form','class' => 'form-horizontal'])   !!}
<div id="tablasCursos">
<div class="aprobados" align= "center">

{!! Form:: button("Ver mis cursos",array('class' => 'btn btn-raised btn-success btn-lg','data-toggle' => 'collapse','data-target' => '#curso','id' => 'ap','aria-label' => 'Left Align')) !!}

<br>
<div id="curso" class="collapse">
    
</div>
</div>
<div class="poraprobar" align= "center">

{!! Form:: button("Ver mis cursos por aprobar",array('class' => 'btn btn-raised btn-danger btn-lg','data-toggle' => 'collapse','data-target' => '#cursono','id' => 'pa')) !!}
<br>
<div id="cursono" class="collapse">
<!-- To do not-->
</div>



</div>

</div>


{!! Form:: close() !!}


</div>

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
      <label class="col-md-2 control-label">Nombre</label>

      <div class="col-md-10">
        <div id="status">
        <input type="text" class="form-control" id="nombreCurso" name="nombre">
        </div>
      </div>

    </div>
    <div class="form-group">
 

      <div class="col-md-11">
  <label class="control-label" for="descripcionCurso">Escriba una descripción del curso (opcional)</label>
  <div id="statusTArea">
   <textarea class="form-control" rows="3" id="descripcionCurso" name="descripcion"></textarea>
   </div>

      </div>
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



<!-- Se mandan los datos que se recibe en la vista al script para su posterior ordenamiento -->
<script type="text/javascript">

mostrarCursos(<?php echo json_encode( $datoscursos) ?>)
</script>

@endsection
