@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}
{!! Html::style('css/actividades.css') !!}
@section('content')

<div class="se-pre-con-irCurso"></div>

<h1>Actividades del Curso</h1>
<br>
<p > Detalles del curso seleccionado:
	{{$DatosCurso->Nombre}}
{{$DatosCurso->Descripcion}}


<div id="ir"></div>

   
   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mostrarFormAgregarActividad()" class="btn  btn-fab" id="addAct" ><i class="material-icons">add</i></a>
<br>


	<div id="listaActividades" align="center">
	  <div class="list-group" id="actividadesList">
    @foreach($actividades as $actividad)
   
		
        <div class="list-group-item" id="items" onClick="irActividad({{$actividad->tipo_tecnica}},{{$actividad->idActividad}})">
          <div class="row-picture">
            @if($actividad->tipo_tecnica == 1)
              <img class="circle" src="../images/tecnicas/abp.png" alt="icon">
            @endif
            @if($actividad->tipo_tecnica == 2)
              <img class="circle" src="../images/tecnicas/ai.png" alt="icon">
            @endif
            @if($actividad->tipo_tecnica == 3)
              <img class="circle" src="../images/tecnicas/abi.png" alt="icon">
            @endif
            @if($actividad->tipo_tecnica == 4)
              <img class="circle" src="../images/tecnicas/resumen.png" alt="icon">
            @endif


            
          </div>
          <div class="row-content">
            <h4 class="list-group-item-heading">{{$actividad->Nombre}}</h4>
            <p class="list-group-item-text">{{$actividad->Descripcion}}</p>
          </div>
        </div>
      
      <div class="list-group-separator"></div>
		@endforeach
    </div>
  </div>



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

      <div class="col-md-10" id="actividad">
        <div id="status">
        <input type="text" class="form-control" id="nombreActividad" name="nombre">
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
          <option data-content="<div class='list-group'><div class='list-group-item'><div class='row-picture'><img class='circle' src='../images/tecnicas/ai.png' alt='icon'></div><div class='row-content'><h4 class='list-group-item-heading'>AI</h4><p class='list-group-item-text'>Aula Invertida</p></div></div></div>">2</option>
          <option data-content="<div class='list-group'><div class='list-group-item'><div class='row-picture'><img class='circle' src='../images/tecnicas/abi.png' alt='icon'></div><div class='row-content'><h4 class='list-group-item-heading'>ABI</h4><p class='list-group-item-text'>Aprendizaje Basado en Investigación</p></div></div></div>">3</option>
          <option data-content="<div class='list-group'><div class='list-group-item'><div class='row-picture'><img class='circle' src='../images/tecnicas/resumen.png' alt='icon'></div><div class='row-content'><h4 class='list-group-item-heading'>RESUMEN</h4><p class='list-group-item-text'>Resumen</p></div></div></div>">4</option>

        </select>
        </div>
      </div>

    </div>


<!---->
<!-- Descripcion texarea-->
    <div class="form-group">
<div class="col-md-11">
  <label class="control-label" for="descripcionCurso">Escriba una descripción de la actividad (opcional)</label>
  <div id="statusTArea">
   <textarea class="form-control" rows="3" id="descripcionActividad" name="descripcion"></textarea>
   </div>

      </div>
    </div>


      </div>

      <!--Date Picker-->
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
              <label class="col-md-4 control-label">Fecha de Vencimiento</label>
                <div class='input-group date' id='fecha'>
                    <input type='text' class="form-control" id="fechaVencimiento">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
      
    </div>
</div>

    <!-- Boton Guardar-->  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i class="material-icons">clear</i></button>
        <button type="button" onclick="guardar({{$DatosCurso->idCurso}})" class="btn btn-raised btn-danger" id="guardarActividad">Guardar Actividad <i class="material-icons">save</i></button>
      </div>
      </form>
    </div>
  </div>
</div>
	{!! Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')!!}
  {!! Html::script('scripts/validatorJQB.js')!!}
  {!! Html::script('scripts/actividades.js')!!}
  {!! Html::script('scripts/fecha.js')!!}




@endsection





