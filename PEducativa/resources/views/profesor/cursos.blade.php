@extends('profesor.perfil')
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/cursos.js')!!}

@section('content')




<!-- Agrego un mensaje de informacion al entrar a este modulo -->
<div class="jumbotron jumbotron-fluid">
<h1 class="display-3">Cursos</h1>
<br>
<p class="lead"> Tus cursos aprobados y pendientes por aprobar se encuentran aquí
</div>

<!-- Creo un form donde agrego los elementos del modulo como los botones de despliegue -->
{!! Form:: open(['url' => '#','role' => 'form','class' => 'form-horizontal'])   !!}

<div class="aprobados" align= "center">

{!! Form:: button("Ver mis cursos",array('class' => 'btn btn-raised btn-success btn-lg','data-toggle' => 'collapse','data-target' => '#curso','id' => 'ap','aria-label' => 'Left Align')) !!}

<br>
<div id="curso" class="collapse">
    <div class="table-responsive">
<table class="table table-inverse">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Curso</th>
    </tr>
  </thead>
  <tbody id="tbody_ap" align= "center">
    
  </tbody>
</table>
    </div>
</div>
</div>
<div class="poraprobar" align= "center">

{!! Form:: button("Ver mis cursos por aprobar",array('class' => 'btn btn-raised btn-danger btn-lg','data-toggle' => 'collapse','data-target' => '#cursono','id' => 'pa')) !!}
<br>
<div id="cursono" class="collapse">
<button type="button">Boton1</button><br>
<button type="button">Boton2</button><br>
<button type="button">Boton3</button><br>
<button type="button">Boton4</button><br>
<button type="button">Boton5</button><br>
<button type="button">Boton6</button><br>
</div>



</div>




{!! Form:: close() !!}


</div>
<script type="text/javascript">
setValidados(<?php echo json_encode( $datoscursos) ?>)
</script>
@endsection
