$('#generadora').on('change', function(){
   opcion =  $('select[id=generadora]').val()
   if(opcion == 1){
   	crearInputPregunta();
   }
   if(opcion == 2)
   {
   	crearInputCaso();
   }
});

// de manera dinamica creo el campo, limpiando los elementos del div primero y luego añandiendo
function crearInputPregunta(){
$("#formGenerador").empty();
label = $("<label>Pregunta Generadora: </label>");
br = $("<br>");
input = $("<input type='text' id='text_generadora'>");
$("#formGenerador").append(label);
$("#formGenerador").append(br);
$("#formGenerador").append(input);


}
function crearInputCaso()
{
$("#formGenerador").empty();
label = $("<label>Caso: </label>");
br = $("<br>");
input = $("<textarea id='text_generadora'>");
$("#formGenerador").append(label);
$("#formGenerador").append(br);
$("#formGenerador").append(input);


}

function enviarMateriales()
{

//MAX_MB = 5;
	var file_data = $('input[name=archivos_client]').prop('files');   
	//console.log(file_data);
    var form_data = new FormData();        
   for (var i = 0; i<file_data.length ; i++) {
   	   console.log("bomre" +file_data[i].name);
      form_data.append('archivos[]',file_data[i],file_data[i].name);
          };          
    /*
'archivos': form_data,'generadora':$("#text_generadora").val(),
            			'urls':$("urls").val(), 'id': $("#id").val(), 
            			'tipo' :  $('select[id=generadora]').val(),
            			'_token': $('input[name=_token]').val()
    */
    
    form_data.append('generadora', $("#text_generadora").val() );
    form_data.append('urls', $("#urls").val() );
    form_data.append('tipo', $('select[id=generadora]').val() );
    form_data.append('id', $('#id').val() );
    form_data.append('_token', $('input[name=_token]').val() );
    
    
  



   	//var size = ($('#a_propuesta').prop('files')[0].size/1024/1024).toFixed(2);
  // 	$("#anuncios").empty();
//	if(size > MAX_MB) 
//	{

//		$("#anuncios").append("El archivo rebasa los 5 MB");
//		return;
//	}
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
                url: './subirMaterial', // point to server-side PHP script 
                data: form_data,
              	processData: false,
              	contentType: false,
              	type: 'POST',
              	dataType:'text',
                success: function(data){
               
                	window.location.assign("../../irCurso/"+$('#idCurso').val());
            
               

                }
                ,
             error:function(exception){swal("Error", exception.responseText, "error");}
     });


}




