var nactividad,dactividad,factividad;
$(window).load(function() {
		
		$(".se-pre-con-irCurso").fadeOut("slow");;
	});

$(document).ready(function(){
configurarValidaciones();
});

function configurarValidaciones()
{

    nactividad =  $("#nombreActividad").JQBConfig({

     required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "El nombre es requerido",
                messageSuccess: ""
   });

    dactividad = $("#descripcionActividad").JQBConfig({

     required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "La descripcion es requerida",
                messageSuccess: ""
   });

   factividad = $("#fechaVencimiento").JQBConfig({

     required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "Se requiere una fecha de entrega",
                messageSuccess: ""
   }); 


}

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
if( (nactividad.validateInputText() & dactividad.validateInputText() & factividad.validateInputText()) == false) return;

$.ajax({
   type:'post',
   url :"../crearActividad",
   
   data: {'nombre':$("#nombreActividad").val(),'descripcion': $("#descripcionActividad").val(),
          'tecnica': $('select[id=tecnicas]').val(),'idcurso':id,'vencimiento':$("#fechaVencimiento").val(),'_token': $('input[name=_token]').val()},
   
   success: function(data) {
      alert($("#fechaVencimiento").val());
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
        
       	var url = '../irActividad';
      var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="idActividad" value="' + data + '" />' +
        '</form>');
  $('#ir').append(form);
  form.submit();
     
         });


       	
   },
   error:function(exception){swal("¡Ups!, ocurrió un error al crear la actividad", "Intenta de nuevo", "error")}
});

}




function mostrar(id)
{


alert($('select[id=tecnicas]').val());

}

function listarActividades(actividades)
{
	console.log(actividades);
	$.each(actividades, function(key,value) {   
     	
        if(value.status == 0){icotext = "update"; idico="waiting"}
     	else {icotext="done"; idico="done"}
     	lgi = $("<div></div>").addClass("list-group-item").attr("id",value.idActividad);
    	rap = $("<div></div>").addClass("row-action-primary");
    	ico = $("<i></i>").addClass("material-icons").text(icotext).attr("id",idico);
    	rc = $("<div></div>").addClass("row-content");
    	lc = $("<div></div>").addClass("least-content");
    	h4 = $("<h4></h4>").addClass("list-group-item-heading").text(value.Nombre);
    	p = $("<p></p>").addClass("list-group-item-text").text(value.Descripcion);
    	sep = $("<div></div>").addClass("list-group-separator");
    //	btnedit = $("<ul class='dropdown-menu'><li><a href='javascript:void(0)'>Editar Actividad</a></li><li><a href='javascript:void(0)''>Another action</a></li><li class='divider'></li><li><a href='javascript:void(0)'>Eliminar Actividad</a></li></ul>")
      if(value.tipo_tecnica == 1 ) urledit = "../editarActividadABP/"+value.idTecnica;
    	lgi.append(rap);
    	rap.append(ico);
    	lgi.append(rc);
    	rc.append(lc);
    	rc.append(h4);
    	rc.append(p);
    	lc.append("<div class='dropdown'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>Opciones <span class='caret'></span></button><ul class='dropdown-menu' role='menu' ><li class='dropdown'><a href='"+urledit+"'><i class='material-icons'>mode_edit</i>Editar</a></li><li class='dropdown'><a href='warga/delete/<?php echo $a->id;?>'><i class='material-icons'>delete</i>Borrar</a></li></ul>");
    	lgi.append("<br><br><br>");
      lgi.append(sep);
    
    	$(".list-group").append(lgi);
  
	});


}
