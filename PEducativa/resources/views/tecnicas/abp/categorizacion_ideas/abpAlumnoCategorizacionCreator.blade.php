@extends('alumno.index')
<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
{!! Html::style('css/abp.css') !!}
{!! Html::style('css/ext/font-awesome-animation.css') !!}
{!! Html::style('jsext/colorpicker/css/colorpicker.css') !!}



@section('content')

<div id="container-tags" >
<ol class="ideas-dragger">

<li> <h3> <span class="label label-info">Rios en mal estado</span> </h3> </li>
<li> <h3> <span class="label label-info">Funciones lógicas</span> </h3> </li>
<li> <h3> <span class="label label-info">Pruebas unitarias</span> </h3> </li>
<li> <h3> <span class="label label-info">Microorganismos sueltos</span> </h3> </li>
<li> <h3> <span class="label label-info">Ganancias</span> </h3> </li>
<li> <h3> <span class="label label-info">Aire limpio</span> </h3> </li>

</ol>




</div>



 <br style="clear: left;" />
 <br>
 <br>
<div align="center">
<button style="margin: 10px;" class="btn btn-warning btn-lg" onclick="requestNewCategory()"><i class="fa fa-plus"></i>  Agregar categoria</button>
<button style="margin: 10px;" class="btn btn-info btn-lg" onclick="sendCategorizaciones()"><i class="fa fa-send"></i> Enviar categorización</button>

</div>
<br>
<br>
<div class="grid">


</div>



{!! Html::script('scripts/masonry.pkgd.min.js')!!}
{!! Html::script('jsext/own_plugins/editable.js')!!}
{!! Html::script('jsext/jquery-sortable.js')!!}
{!! Html::script('jsext/colorpicker/js/colorpicker.js')!!}
{!! Html::script('scripts/alumno/abp.js')!!}


@endsection