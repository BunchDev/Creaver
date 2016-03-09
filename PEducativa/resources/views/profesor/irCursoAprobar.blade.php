@extends('profesor.perfil')

{!! Html::style('bower_components/bootstrap-material-design-icons/css/material-icons.css') !!}
{!! Html::style('css/adaptaciones.css') !!}



@section('content')

	
		<h1 >Curso seleccionado</h1>
		<br>
		<p > Detalles del curso por aprobar:
		{{$DatosCurso->Nombre}}<br>
		{{$DatosCurso->Descripcion}}
		


		<br>




	@if(isset($propuesta->first()->idPropuesta))
		<!--Este div contiene el form para actualizar un archivo propuesta-->
		<div id="archivo" align="center">
			<div class="form-group" id="archivo_estilo">
  <input type="file" id="a_propuesta" required>
  <div class="input-group">
    <input type="text" readonly="" class="form-control" placeholder="Selecciona un archivo">
      <span class="input-group-btn input-group-sm">
        <button type="button" class="btn btn-fab btn-fab-mini">
          <i class="material-icons">attach_file</i>
        </button>
      </span>
  </div>
</div>
	



		<br>
		<button class="btn btn-raised btn-success" onClick ="actualizarArchivo()" id="a_archivo">	
		Actualizar Propuesta
		<i class="material-icons">find_replace</i>
		</button>
		<button class="btn btn-raised btn-warning" onClick ="descargarPropuesta()">	
		Descargar Propuesta
		<i class="material-icons">file_download</i>
		</button>
		<input type="hidden" id="idCurso" value="{{$DatosCurso->idCurso}}">
		<div id="anuncios"></div>
		<div class="progress"></div>
		</div>

		<!-- Div para mostrar los comentarios de la propuesta subida-->
		<div id="comentarios" align="center"> 
			<div class="detailBox">
    		<div class="titleBox">
      			<label>Comentarios de la Propuesta</label>
        
    		</div>
    	<div class="commentBox">
        
        	<p class="taskDescription">Versión Actual de la Propuesta : {{$propuesta->first()->Version}}</p>
    	</div>
    	<div class="actionBox">
    			<ul class="commentList">
			@foreach ($comentarios as $data)
			
            		<li>
                	<div class="commenterImage">
                  		<i class="material-icons">person</i>
                	</div>
                	<div class="commentText">
                    	<p>{{$data->Contenido}}</p> <span class="date sub-text">{{$data->updated_at}}</span>

                	</div>
           		 	</li>
        		
	
  
			@endforeach
			</ul>

	  		{!!Form::open(array('action' => 'ComentarioController@store','class' => 'form-inline','role'=>'form')) !!}

			 	<div class="form-group">
                	<input class="form-control" type="text" name="Contenido" id="comment" placeholder="Escribe un comentario" />
            		<input type="hidden" name="fk_idPropuesta" value="{{$DatosCurso->idCurso}}">
            	</div>
            	<div class="form-group">
                	<button class="btn btn-default">Enviar</button>
            	</div>
       

			{!! Form:: close() !!}

    		</div>
		</div>
	</div>
	@else 



<!--Este div contiene el form para actualizar un archivo propuesta-->
		
			


		<!--Este div contiene el form para subir por primera vez un archivo propuesta-->
		<div id="archivo" align="center">
			<div class="form-group" id="archivo_estilo">
  				<input type="file" id="a_propuesta" required>
  				<div class="input-group">
    				<input type="text" id="fecha" class="form-control" placeholder="Selecciona un archivo">
      				<span class="input-group-btn input-group-sm">
        			<button type="button" class="btn btn-fab btn-fab-mini">
          				<i class="material-icons">attach_file</i>
        			</button>
      				</span>
  				</div>
			</div>
		
		




		<br>
		<button class="btn btn-raised btn-success" onClick ="enviarArchivo()" id="a_archivo">	
		Mandar Propuesta
		<i class="material-icons">send</i>
		</button>
		<input type="hidden" id="idCurso" value="{{$DatosCurso->idCurso}}">
		<div id="anuncios"></div>
		<div class="progress"></div>
		</div>
		
		</div>





	@endif


{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
{!! Html::script('scripts/validatorJQB.js')!!}
{!! Html::script('scripts/cursos.js')!!}
{!! Html::script('scripts/fileUpload.js')!!}


@endsection