
$(document).ready(function(){
   activarCheckedListener();
   activarCheckedListenerVideo();
   frameListener();

   console.log("Its ok");
});

function frameListener()
{
  $("#reproductor").load(function(){
    $("#reproductor").show();
    $("#waiting_iframe").hide();

  });
}


function activarCheckedListener()
{
$('#lista_check').change(function(){
    
 if ($("#checkbutton").is(':checked')) {
      $("#nuevoVideo").hide();
      $("#lista_videos").show();
      msnry.layout();
  } else {
      $("#nuevoVideo").show();
      $("#lista_videos").hide();
  }
});


}
function activarCheckedListenerVideo()
{
$(".checkbox").change(function(){
  
 if ($("input[id='check']").is(':checked')) {
    console.log($(this).parent());
    var siblings = $(this).parent().siblings(".grid-item");
    /*IMPORTANTE: 
      Si el input hidden que está antes del checkbox cambia de posición 
      deberá modificarse la siguiente linea de código, ya que idVideo obtiene el valor 
      del hermano previo (el input hidden).
    */

    var idVideo = $(this).prev().val();
    //se asigna el valor url del video seleccionado al div dedicado a almacenar 
    // el id para posteriormente mandarlo al servidor cuando se seleccione la opción de 
    // guardar material
    $("#idVideo").attr('value',idVideo);
    $("#g_material").show();
      $.each(siblings,function(key,value){
        $(value).hide();
        msnry.layout();
     
      });
     
  } else {
    $("#g_material").hide();
     console.log($(this).parent());
    var siblings = $(this).parent().siblings(".grid-item");
      $.each(siblings,function(key,value){
        $(value).show();
        msnry.layout();
        
      });
      
  }
});


}
function guardar()
{

//if($("#idVideo").val() != "")
if(verificarAlteracion() == false)
{
  swal("¡Error!,", "No se pudo procesar la elección", "error")
  return;
}
$("#g_material").attr('disable',true);
$.ajax({
   type:'post',
   url :"./guardarAi",
   
   data: {'id' :$('#idAi').val(),'instruccion': $('#instruccion').val(),'url':$("#idVideo").val(),'_token': $('input[name=_token]').val()},
   
   success: function(data) {
       		
       		$.when(showSucess()).done(function(){

       			window.location.assign("../../irCurso/"+ $("#idCurso").val() );
       		});
         }
,
   error:function(exception){swal("¡Ups!, ocurrió un error al subir el video", "Intenta de nuevo más tarde", "error")}
});

	
}

function showSucess()
{
	return swal(
		{   title: "¡Exitoso!",   
		text: "El material multimedia se guardó correctamente",  
		 timer: 2000,   
		 showConfirmButton: false });
}

function selectVideo()
{

$('.grid').masonry( 'hide', $('#container ul li').eq(2) ).masonry();


}

function cancelarSubidaVideo()
{
  xhr.abort();
  $("#cancelarSubida").hide();
  swal(
    { 
    title: "Subida Cancelada",   
    text: "Puedes subir otro video o escoger alguno de tu lista",   
    type: "warning",  
    showCancelButton: false, 
    confirmButtonColor: "#DD6B55",
    timer: 2000,  
    showConfirmButton: false
    
  }
 );
  $("#checkbutton").prop("disabled",false);
  $("#drop_zone").show();
 
  $("#archivos_contenedor").show();
  $("#progress").hide();
}