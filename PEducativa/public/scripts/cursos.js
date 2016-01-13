$(document).on('ready',function(){

        $("#ap").append(' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
        $("#pa").append(' <span class="glyphicon glyphicon-time" aria-hidden="true"></span>');

    });



function setValidados(datos){
//Si no existen cursos por cargar muestra mensaje de vacio
if(datos.length == 0)
{
$('#curso').append("<div class='alert alert-warning' role='alert'>No tienes cursos aprobados</div>")

}	
else {

	$('#curso').append("<div class='table-responsive'><table class='table table-inverse'><thead><tr><th>#</th><th>Nombre</th><th>Descripción</th><th>Curso</th></tr></thead><tbody id='tbody_ap' align= 'center'></tbody></table></div>")
	for (var i = 0; i < datos.length; i++) {
		var tr = "<tr id='trow_ap_"+datos[i].numero+"'></tr>"
		$("#tbody_ap").append(tr);
		
		var numero = "<th scope='row'>"+datos[i].numero+"</th>";
		var nombre = "<td>"+datos[i].nombre+"</td>";
		var descripcion = "<td>"+datos[i].descripcion+"</td>";
		var opciones ="<td>"+getButtonsTag()+"</td>"
		var etiqueta ="";
		etiqueta = etiqueta.concat(numero,nombre,descripcion,opciones);
		var trid = "#trow_ap_"+datos[i].numero;
		$(trid).append(etiqueta);
	};

}

}

function getButtonsTag(){
	var ir= "<button type='button' class='btn btn-success-outline btn-sm'>Ir al Curso <span class='glyphicon glyphicon-circle-arrow-right' aria-hidden='true'></span></button>"
	var editar = "<button type='button' class='btn btn-success-outline btn-sm'>Editar Curso <span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>"
	return ir+editar;
}

function mostrarFormAgregarCurso()
{
	limpiarForm()
	$('#nuevoCursoModal').modal('show');

}


/*Limpia el form donde se añaden los datos de un nuevo curso*/
function limpiarForm()
{

$('#nuevoCursoModal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
})

}