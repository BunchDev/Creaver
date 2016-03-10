
 function eliminar(idPersonaje,item){
 		eliminarItem(item);
 		$("#"+idPersonaje).remove();
 		$(".Personajes-Agregados").append("<input type='hidden' name='Eliminados[]' value='"+idPersonaje+"'>");
     	
         }
function eliminarItem(item)
{
personajesArray.splice(personajesArray.indexOf(item),1);
}