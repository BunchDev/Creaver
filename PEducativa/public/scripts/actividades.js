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