@extends('alumno.index')
<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
{!! Html::style('css/abp.css') !!}
{!! Html::style('css/ext/font-awesome-animation.css') !!}
{!! Html::style('jsext/colorpicker/css/colorpicker.css') !!}



@section('content')

<div id="container-tags" >
<ol class="ideas-dragger">

<li> <h3> <span class="label label-info">#SELFIE			</span> </h3> </li>
<li> <h3> <span class="label label-info">Motorola			</span> </h3> </li>
<li> <h3> <span class="label label-info">Vaso				</span> </h3> </li>
<li> <h3> <span class="label label-info">Rio del suchiate	</span> </h3> </li>
<li> <h3> <span class="label label-info">Clever				</span> </h3> </li>
<li> <h3> <span class="label label-info">Fantastic			</span> </h3> </li>

</ol>




</div>



 <br style="clear: left;" />
 <br>
 <br>
<div>
<button class="btn btn-default" onclick="requestNewCategory()"><i class="fa fa-plus"></i>  Agregar categoria</button>
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