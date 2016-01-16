$(document).on('ready',function(){

        $("#ap").append(' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
        $("#pa").append(' <span class="glyphicon glyphicon-time" aria-hidden="true"></span>');

    





    });
/*
@param datos , contiene la informacion que se mostrara en la tabla 
@param tipo, 1 o 0 el cual representa el estatus del curso 1= aprobado y 0 = inactivo o no aprobado
El metodo crearElementos verifica si existen datos en caso que no se manda un mensaje expresando esto
en el caso de que si existan datos se forma de manera dinamica una tabla */

function crearElementos(datos,tipo){
idetiqueta = ""
trow = ""
tbody = "";
if(datos.length == 0)
{


if (tipo == 1)$("#curso").append("<div class='alert alert-warning' role='alert'>No tienes cursos en este apartado para mostrar</div>")
else $("#cursono").append("<div class='alert alert-warning' role='alert'>No tienes cursos en este apartado para mostrar</div>") 
}	
else {

	if (tipo == 1){
		idetiqueta ="#curso"; 
		trow = "trow_ap_";
		tbody= "#tbody_ap";
		$(idetiqueta).append("<div ><table class='tablaestilo'><thead><tr><th class='thwnumero'>#</th><th class='thwnombre'>Nombre</th><th class='thwdescripcion'>Descripción</th><th class='thwcurso'>Curso</th></tr></thead><tbody id='tbody_ap' align= 'center'></tbody></table></div>");
		}
	else {
		idetiqueta ="#cursono";
		trow = "trow_pa_"
		tbody = "#tbody_pa"
		$(idetiqueta).append("<div><table class='tablaestilo'><thead><tr><th class='thwnumero'>#</th><th class='thwnombre'>Nombre</th><th class='thwdescripcion'>Descripción</th><th class='thwcurso'>Curso</th></tr></thead><tbody id='tbody_pa' align= 'center'></tbody></table></div>");
		}
	for (var i = 0; i < datos.length; i++) {

		var tr = "<tr id='"+trow+datos[i].numero+"'></tr>"
		
		$(tbody).append(tr);
		
		var numero = "<th scope='ro' class='thwi'>"+datos[i].numero+"</th>";
		var nombre = "<td class='tdwinombre'>"+datos[i].nombre+"</td>";
		var descripcion = "<td class='tdwidescripcion'>"+datos[i].descripcion+"</td>";
		var opciones ="<td class='tdwiopciones'>"+getButtonsTag()+"</td>"
		var etiqueta ="";
		etiqueta = etiqueta.concat(numero,nombre,descripcion,opciones);
		var trid = "#"+trow+datos[i].numero;
		$(trid).append(etiqueta);
	};

}



}
/*
@param datos, JSON donde los datos estan desordenados
el metodo mostrarCursos llama a la funcion ordCursos y manda a llamar al metodo necesario para crear 
los elementos dependiendo el estatus del curso
*/
function mostrarCursos(datos){


datos = ordCursos(datos);
aprobados = datos[0];
naprobados = datos[1];
crearElementos(aprobados,1);
crearElementos(naprobados,2);

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

/*
@param cursos, contiene los datos de todos los cursos sin ordenar
el metodo ordCursos ordena los cursos dependiendo su estatus, al final retorna 
una lista con 2 grupos distintos de cursos.
*/
function ordCursos(cursos)
{
aprobados = new Array()
naprobados = new Array()

for (var i = 0; i< cursos.length;i++){
	if(cursos[i].estatus == 1){
		
		aprobados.push(cursos[i]);
	}
	else{
		
		naprobados.push(cursos[i]);
	}


};

return [aprobados,naprobados];

}
/*
la función envarDatosServidor manda los datos que se añadieron al formulario y se envia
mediante una petición ajax de tipo POST. 
*/
function enviarDatosServidor()
{
if(validarEntradas() == false) return;

swal({   title: "Mensaje de Confirmación",
	text: "¿Estás seguro que deseas crear este curso?",   
	type: "warning",   showCancelButton: true,  
	 confirmButtonColor: "#449d44",  
	  confirmButtonText: "Si,deseo crearlo",  
	   closeOnConfirm: false,
	   showLoaderOnConfirm: true, }, 
	function(){  


$.ajax({
   type:'post',
   url :"./crearCurso",
   
   data: {'nombre':$("#nombreCurso").val(),'descripcion': $("#descripcionCurso").val(),'_token': $('input[name=_token]').val()},
   
   success: function(data) {
       $('#nuevoCursoModal').modal('hide');
       swal({   title: 'Curso creado exitosamente',  
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
   error:function(exception){swal("¡Ups!, ocurrió un error al crear el proyecto", "Intenta de nuevo", "error")}
});


	 });


}


function validarEntradas()
{

nombre = $("#nombreCurso").val();
descripcion = $("#descripcionCurso").val();
$("#avisos").empty();
if(nombre.length > 0 && descripcion.length < 60) return true;
else {
	$("#avisos").append("<div class='alert alert-dismissible alert-danger' id='msjserror'><strong>¡Ups,ocurrió un problema!</strong></div>");
	
	if(nombre.length == 0)
	{
		$("#msjserror").append( "<br><a class='alert-link'>El campo nombre está vacío</a>");

		$("#nombreCurso").css("border", "1px solid red");
	}
	else {
		
		$("#nombreCurso").css("border", "1px solid green");
	}

	if(descripcion.length > 60)
	{
		$("#msjserror").append("<br><a class='alert-link'>La descripción es muy larga, máximo 60 caracteres</a>");
		$("#descripcionCurso").css("border", "1px solid red");
	}
	if (descripcion.length <60 && nombre.length == 0)
	{
		$("#descripcionCurso").css("border", "1px solid green");

	}
	

	return false;
}
}




 
   
