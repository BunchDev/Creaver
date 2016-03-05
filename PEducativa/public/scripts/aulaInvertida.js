$(document).ready(function(){
   activarCheckedListener();
  activarSlideThumbNail();
   console.log("Its ok");
});

function activarSlideThumbNail()
{
 $('#videos_slide').lightSlider({
        gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
    });  


}



function activarCheckedListener()
{
$('#lista_check').change(function(){
    
 if ($("#checkbutton").is(':checked')) {
      $("#nuevoVideo").hide();
  } else {
      $("#nuevoVideo").show();
  }
});


}

function guardar()
{
  
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