
 function eliminar(idPersonaje){
 		$("#"+idPersonaje).remove();
 		$(".Personajes-Agregados").append("<input type='hidden' name='Eliminados[]' value='"+idPersonaje+"'>");
     	console.log(idPersonaje);
         }