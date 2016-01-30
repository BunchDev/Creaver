$(window).load(function() {
		
		$(".se-pre-con-irCurso").fadeOut("slow");;
	});


function mostrarFormAgregarActividad()
{
	limpiarForm();
	$('#nuevaActividadModal').modal('show');

}


/*Limpia el form donde se añaden los datos de un nuevo curso*/
function limpiarForm()
{

$('#nuevaActividadModal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
})

}


/*
la función envarDatosServidor manda los datos que se añadieron al formulario y se envia
mediante una petición ajax de tipo POST. 
*/
function guardar(id)
{
//if(validarEntradas() == false) return;

$.ajax({
   type:'post',
   url :"../crearActividad",
   
   data: {'nombre':$("#nombreCurso").val(),'descripcion': $("#descripcionCurso").val(),'tecnica': $('select[id=tecnicas]').val(),'idcurso':id,'_token': $('input[name=_token]').val()},
   
   success: function(data) {
       $('#nuevaActividadModal').modal('hide');
       $('#guardarActividad').attr('disabled',true);
       swal({   title: 'Actividad Añadida exitosamente',  
        text: 'Ve al listado de cursos no aprobados para enviar tu propuesta',  
         type: 'success',   
         showCancelButton: false,   
         confirmButtonColor: '#3085d6',   
         cancelButtonColor: '#d33',  
          confirmButtonText: 'Ok',   
          closeOnConfirm: true },
        function() {   

        	location.reload();
         });


       	
   },
   error:function(exception){swal("¡Ups!, ocurrió un error al crear la actividad", "Intenta de nuevo", "error")}
});



}

// en esta funcion obtengo los datos de las entradas y verifico si se cumplen las reglas de tamaño y contenido.
function validarEntradas()
{

nombre = $("#nombreCurso").val();
descripcion = $("#descripcionCurso").val();
$("#avisos").empty();
if(nombre.length > 0 && descripcion.length < 60) return true;
else {
	$("#avisos").append("<div class='alert alert-dismissible alert-danger' id='msjserror'><strong>¡Ups,ocurrió un problema!</strong></div>");
	$("#statusicon").remove();
	if(nombre.length == 0)
	{
		$("#msjserror").append( "<br><a class='alert-link'>El campo nombre está vacío</a>");
		$("#status").addClass('form-group has-error label-floating is-empty');
		$(".col-md-10").append('<span class="glyphicon glyphicon-remove form-control-feedback" id="statusicon"></span>');
		


	}
	else {
		
		$("#nombreCurso").css("border", "1px solid green");
		$(".col-md-10").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
	}

	if(descripcion.length > 60)
	{
		$("#msjserror").append("<br><a class='alert-link'>La descripción es muy larga, máximo 60 caracteres</a>");
		$("#statusTArea").addClass('form-group has-error label-floating is-empty');

		$(".col-md-11").append('<span class="glyphicon glyphicon-remove form-control-feedback" id="statusicon"></span>');

	}
	if (descripcion.length <60 && nombre.length == 0)
	{


	}
	

	return false;
}
}

function mostrar(id)
{


alert($('select[id=tecnicas]').val());

}



