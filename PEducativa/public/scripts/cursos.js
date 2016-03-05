var ncurso,dcurso;

$(window).load(function() {
		
		$(".se-pre-con-curso").fadeOut("slow");;
	});




$(document).on('ready',function(){

        $("#ap").append(' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
        $("#pa").append(' <span class="glyphicon glyphicon-time" aria-hidden="true"></span>');
        configurarValidaciones();
    });

function configurarValidaciones()
{

    ncurso =  $("#nombreCurso").JQBConfig({

     required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "El nombre es requerido",
                messageSuccess: ""
   });

    dcurso = $("#descripcionCurso").JQBConfig({

     required : true,
                maxLen : 255,
                minLen : 1,
                messageError: "Se requiere",
                messageSuccess: ""
   });


}

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

		var tr = $("<tr id='"+trow+datos[i].numero+"'></tr>");
		
		$(tbody).append(tr);
		
		var numero = $("<th scope='ro' class='thwi'>"+datos[i].numero+"</th>");
		var nombre = $("<td class='tdwinombre'></td>");
		//nombre.text(datos[i].nombre);
		var descripcion = $("<td class='tdwidescripcion'></td>");
		var opciones = $("<td class='tdwiopciones'>"+getButtonsTag(datos[i])+"</td>");
		nombre.text(datos[i].nombre);
		descripcion.text(datos[i].descripcion);
		var trid = "#"+trow+datos[i].numero;
		$(trid).append(numero);
		$(trid).append(nombre);
		$(trid).append(descripcion);
		$(trid).append(opciones);
	};

}



}
/*
@param datos, JSON donde los datos estan desordenados
el metodo mostrarCursos llama a la funcion ordCursos y manda a llamar al metodo necesario para crear 
los elementos dependiendo el estatus del curso
*/

var misdatos;
function mostrarCursos(datos){

misdatos = datos;
datos = ordCursos(datos);
aprobados = datos[0];
naprobados = datos[1];
crearElementos(aprobados,1);
crearElementos(naprobados,2);

}
// se crea aca mismo el form para acceder a la pagina y los datos se mandan por post
function getButtonsTag(dato){
	if (dato['estatus'] == 1){
		var formInicio = "<form action='irCurso/"+dato['numero']+"' method='get'>";
		var hidden = "<input type='hidden' value='"+dato['numero']+"' name='numero'/>";
		var ir= "<button type='submit' class='btn btn-success-outline btn-sm'>Ir a detalles del Curso <span class='glyphicon glyphicon-circle-arrow-right' aria-hidden='true'></span></button>"
		//var editar = "<button type='submit' class='btn btn-success-outline btn-sm'>Editar Curso <span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>"
		var formFinal = "</form>";
		return formInicio + hidden + ir + formFinal;
	}else {
		var formInicio = "<form action='irCursoAprobar/"+dato['numero']+"' method='get'>";
		var hidden = "<input type='hidden' value='"+dato['numero']+"' name='numero'/>";
		var ir= "<button type='submit' class='btn btn-success-outline btn-sm'>Enviar propuesta<span class='glyphicon glyphicon-circle-arrow-right' aria-hidden='true'></span></button>"
		//var editar = "<button type='submit' class='btn btn-success-outline btn-sm'>Editar Curso <span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>"
		var formFinal = "</form>";
		return formInicio + hidden + ir + formFinal;


	}
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
una lista con 2 grupos distintos de cursos: aprobados y no aprobados.
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

if ( (ncurso.validateInputText() & dcurso.validateInputText()) == false)return;


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




function enviarArchivo()
{
MAX_MB = 5;
var file_data = $('#a_propuesta').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('archivo', file_data);
    form_data.append('id',$("#idCurso").val());
    
   	var size = ($('#a_propuesta').prop('files')[0].size/1024/1024).toFixed(2);
   	$("#anuncios").empty();
	if(size > MAX_MB) 
	{

		$("#anuncios").append("El archivo rebasa los 5 MB");
		return;
	}
    $.ajax({
    		xhr: function () {
        	var xhr = new window.XMLHttpRequest();
        	xhr.upload.addEventListener("progress", function (evt) {
            	if (evt.lengthComputable) {
                	var percentComplete = evt.loaded / evt.total;
                	console.log(percentComplete);
                	$('.progress').css({
                    	width: percentComplete * 100 + '%'
                	});
                	if (percentComplete === 1) {
                    	$('.progress').addClass('hide');
                	}
            	}
        	}, false);
        	xhr.addEventListener("progress", function (evt) {
            	if (evt.lengthComputable) {
                	var percentComplete = evt.loaded / evt.total;
                	console.log(percentComplete);
                	$('.progress').css({
                    	width: percentComplete * 100 + '%'
                	});
            	}
        		}, false);
        		return xhr;
    			},
                url: '../subirArchivo', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                if(data == "Ok")
                {
                	swal({   title: "¡La propuesta se ha enviado exitosamente!", 
                	  text: "Espere ...",
                	  type: "success" ,  
                	  showConfirmButton: true
                	},
                	function(isConfirm){
                		    location.reload();
                	}
                	  );
            
                }
                else{
                swal("Error", "La propuesta no pudo ser enviada, intenta de nuevo", "error");	
                }
               


                }
                ,
             error:function(exception){swal("Error", "La propuesta no pudo ser enviada, intenta de nuevo", "error");}
     });


}

function actualizarArchivo()
{
var file_data = $('#a_propuesta').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('archivo', file_data);
    form_data.append('id',$("#idCurso").val());
    
   	var size = ($('#a_propuesta').prop('files')[0].size/1024/1024).toFixed(2);
   	$("#anuncios").empty();
	if(size > 5) 
	{

		$("#anuncios").append("El archivo rebasa los 5 MB");
		return;
	}
    $.ajax({
    		xhr: function () {
        	var xhr = new window.XMLHttpRequest();
        	xhr.upload.addEventListener("progress", function (evt) {
            	if (evt.lengthComputable) {
                	var percentComplete = evt.loaded / evt.total;
                	console.log(percentComplete);
                	$('.progress').css({
                    	width: percentComplete * 100 + '%'
                	});
                	if (percentComplete === 1) {
                    	$('.progress').addClass('hide');
                	}
            	}
        	}, false);
        	xhr.addEventListener("progress", function (evt) {
            	if (evt.lengthComputable) {
                	var percentComplete = evt.loaded / evt.total;
                	console.log(percentComplete);
                	$('.progress').css({
                    	width: percentComplete * 100 + '%'
                	});
            	}
        		}, false);
        		return xhr;
    			},
                url: '../actualizarArchivo', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                if(data == "Ok")
                {
                	swal({   title: "¡La propuesta se ha enviado exitosamente!", 
                	  text: "Espere ...",
                	  type: "success" ,  
                	  showConfirmButton: true
                	},
                	function(isConfirm){
                		    location.reload();
                	}
                	  );
            
                }
                else{
                swal("Error", "La propuesta no pudo ser enviada, intenta de nuevo", "error");	
                }
               


                }
                ,
             error:function(exception){swal("Error", "La propuesta no pudo ser enviada, intenta de nuevo", "error");}
     });


}

function descargarPropuesta()
{

$.ajax({
   type:'post',
   url :"../descargarPropuesta",
   
   data: {'id':$("#idCurso").val(),'_token': $('input[name=_token]').val()},
   
   success: function(data) {
       console.log("Descargado");

   },
   error:function(exception){swal("¡Ups!, ocurrió un error al descargar la propuesta", "Intenta de nuevo", "error")}
});

}
   
