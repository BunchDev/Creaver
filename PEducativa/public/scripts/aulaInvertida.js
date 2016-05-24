var gridselector = null;

function selecterVideoUploaded(){

  $checks = $('.gridselector-item').find("input[type=checkbox]");
  $itemscontainer = $('.gridselector-item');
  $.each($checks,function(key,value){

    $( value ).on( "click", function(){
    if($( value ).is(':checked')){
      $($itemscontainer[key]).removeClass('alert-default');
      $($itemscontainer[key]).addClass('alert-success');

      $($(value).next().find('label')[1]).removeClass('btn-default');
      $($(value).next().find('label')[1]).addClass('btn-success');
      $($(value).next().find('label')[1]).text('Vídeo agregado');
    }
    else{
     $($itemscontainer[key]).removeClass('alert-success');
      $($itemscontainer[key]).addClass('alert-default');

      $($(value).next().find('label')[1]).removeClass('btn-success');
      $($(value).next().find('label')[1]).addClass('btn-default');
      $($(value).next().find('label')[1]).text('Agregar vídeo');
    }
});
  });
}



function profesorInit(){

selecterVideoUploaded();



  gridselector = $('.gridselector').masonry({



        itemSelector: '.gridselector-item',
        isFitWidth: true,
        containerStyle: { position: 'relative' }
});

$( "#video-check" ).on( "click", function(){
    if($( "#video-check" ).is(':checked')){
      $("#fileRoot").css('display','block');
    }
    else{
      $("#fileRoot").css('display','none');
    }
});
$( "#url-check" ).on( "click", function(){
    if($( "#url-check" ).is(':checked')){
      $("#irul-container").css('display','block');
    }
    else{
      $("#irul-container").css('display','none');

    }
});
$( "#vuploaded-check" ).on( "click", function(){
    if($( "#vuploaded-check" ).is(':checked')){
       $("#url-vselector-container").css('display','block');

    }
    else{
             $("#url-vselector-container").css('display','none');

    }
});


var $grid = $('.grid').masonry({



        itemSelector: '.grid-item',
        isFitWidth: true,
        gutter: 5,
        containerStyle: { position: 'relative' }
});





'use strict';

;( function( $, window, document, undefined )
{
  $( '.inputfile' ).each( function()
  {
    
    var $input   = $( this ),
      $label   = $input.next( 'label' ),
      labelVal = $label.html();

    $input.on( 'change', function( e )
    {
      var fileName = '';

      fileName = $(this).val();
      fileName = (fileName.replace(/^.*[\\\/]/, '').split("/")).pop();

      if( fileName)
        $label.find( 'span' ).html( fileName );
      else
        $label.html( labelVal );
    });

    // Firefox bug fix
    $input
    .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
    .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
  });
})( jQuery, window, document );




}



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

function removeEmbed(item,input){
  $(item).parent().remove();
  console.log("HOMERO " + item);
  console.log("antes =  " + urls);
  urls.splice(urls.indexOf(input),1);
  console.log("ELIMINADO = "+ input + " array = " + urls);
  swal({
    title : 'Eliminado',
    text : '<i class="fa fa-trash fa-4x" aria-hidden="true"></i>',
    html : true,
    timer : 1000,
    animation : 'slide-from-bottom',
    showConfirmButton : false

  });
}

function insertUrl()
{
  optionswal = {   title: "URL",  
   text: "Ingresa una ulr de Youtube, Vimeo, Twitch o Dailymotion <br> <i class='fa fa-link fa-3x' aria-hidden='true'></i>",  
   type: "input",  
   html:true,
    showCancelButton: true,  
    closeOnConfirm: false,  
    animation: "slide-from-top",  
     inputPlaceholder: "url",
     showLoaderOnConfirm: true };

  swal(optionswal,
     function(inputValue){

      if (inputValue === false) return false;   
         if (inputValue === "") {  
            swal.showInputError("No hay nada que agregar");    
             return false   
           } 

   

    embedVideo(inputValue);

     });
}



var urls = new Array();
var urlsVU = new Array();
function embedVideo(url){
jsonInfo = urlParser.parse(url);



if(jsonInfo != undefined){
  if(verifyLink(url)) return;
  $item = $("<div></div>").addClass("grid-item");
  $close = $("<span>x</span>").addClass('close');
  $close.on('click',function(e){removeEmbed(e.target,url)});
  $item.append($close);
  console.log(jsonInfo);
  //urls.push(url);
  switch(jsonInfo.provider){

    case 'youtube' :{
        var info = {'id': jsonInfo.id, 'duration':0};
      $.when(getDurationVideoYoutube(info) ).done(function(){
        if(info.duration == -1){
           swal({
          title : "Error", 
          text :"El vídeo que tratas de añadir es inválido",
          type : "error",
          showLoaderOnConfirm:false
          });
           return;
        }
        if(info.duration <= 5){
       $iframe = $('<iframe width="90%" height="90%" style="margin-top:25px;" src="http://www.youtube.com/embed/'+jsonInfo.id+'?autoplay=0"></iframe>')
       $item.append($iframe);
       $(".grid").append($item);
       urls.push(url);
        swal("Bien", "Se ha agregado el video ", "success");
      }
      else{
         optionswal.showLoaderOnConfirm = false;
        swal({
          title : "Error, no se pudo agregar", 
          text :"El vídeo que tratas de añadir supera los 5 minutos de duración",
          type : "error",
          showLoaderOnConfirm:false
          });
      }
      });
      
    }break;

    case 'vimeo':{
        var info = {'id': jsonInfo.id, 'duration':0};
      $.when(getDurationVideoVimeo(info) ).done(function(){
          if(info.duration <= 5.0)
          {
            $iframe = $('<iframe src="https://player.vimeo.com/video/'+jsonInfo.id+'?api=1&player_id=player1" width="80%" height="500px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
            $item.append($iframe);
            $(".grid").append($item);
            urls.push(url);
            swal("Bien", "Se ha agregado el video ", "success");
          }

          else
          {
            optionswal.showLoaderOnConfirm = false;
            swal({
              title : "Error, no se pudo agregar", 
              text :"El vídeo que tratas de añadir supera los 5 minutos de duración",
              type : "error",
              showLoaderOnConfirm:false
            });
          }

      });
    }break;

    case 'twitch': {

      

      if(jsonInfo.id != undefined)
       {

        $param = "video="+jsonInfo.idPrefix+jsonInfo.id;

        var info = {'id': jsonInfo.id, 'duration':0};
        $.when(getDurationVideoTwitch(info) ).done(function(){
            if(info.duration <= 5.0)
            {
              $iframe = $('<iframe src="http://player.twitch.tv/?'+$param+'" width="80%" height="500px" autoplay="false" allowfullscreen></iframe>');
              $item.append($iframe);
              $(".grid").append($item);
              urls.push(url);
              swal("Bien", "Se ha agregado el video ", "success");
            }

            else
            {
              optionswal.showLoaderOnConfirm = false;
              swal({
                title : "Error, no se pudo agregar", 
                text :"El vídeo que tratas de añadir supera los 5 minutos de duración "  + info.duration,
                type : "error",
                showLoaderOnConfirm:false
                });
            }

        
        });

      }
      else 
      {
         swal.showInputError("Twitch Error, no puedes agregar un video stream");

        /*
        $param = "channel="+jsonInfo.channel; 
        alert($param);
        $iframe = $('<iframe src="http://player.twitch.tv/?'+$param+'" width="80%" height="500px" autoplay="false" allowfullscreen></iframe>');
        $item.append($iframe);
        $(".grid").append($item);
        */

      }

    }break;

    case 'dailymotion' :{
      var info = {'id': jsonInfo.id, 'duration':0};
      $.when(getDurationVideoDayliMotion(info) ).done(function(){
          if(info.duration <= 5.0)
          {
            $iframe = $('<iframe frameborder="0" width="80%" height="80%" src="//www.dailymotion.com/embed/video/'+jsonInfo.id+'" allowfullscreen></iframe>');
            $item.append($iframe);
            $(".grid").append($item);
            urls.push(url);
            swal("Bien", "Se ha agregado el video ", "success");
          }

          else
          {
            optionswal.showLoaderOnConfirm = false;
            swal({
              title : "Error, no se pudo agregar", 
              text :"El vídeo que tratas de añadir supera los 5 minutos de duración "  + info.duration,
              type : "error",
              showLoaderOnConfirm:false
            
            });
          }

        });


    }break;
  }

}
else {
 swal.showInputError("Error, la url agregada es incorrecta o no compatible con las plataformas que se listan arriba");
}
}


function getDurationVideoYoutube(information){

  return $.ajax({
    url: './videoDurationYoutube',
    data: {'id':information.id},
    type : 'post',

    success: function(data){
      information.duration = data;
      console.log("Retorne = " + data);
    },
    error: function(data){

      information.duration = data;
    }

  });


}
function getDurationVideoVimeo(information)
{

  return $.ajax({
    url: './videoDurationVimeo',
    data: {'id':information.id},
    type : 'post',

    success: function(data){
      information.duration = data;
    },
    error: function(){
      information.duration = -1;
    }

  });


}

function getDurationVideoDayliMotion(information)
{

  return $.ajax({
    url: './videoDurationDayliMotion',
    data: {'id':information.id},
    type : 'post',

    success: function(data){
      information.duration = data;
    },
    error: function(){
      information.duration = -1;
    }

  });


}

function getDurationVideoTwitch(information)
{

  return $.ajax({
    url: './videoDurationTwitch',
    data: {'id':information.id},
    type : 'post',

    success: function(data){
      information.duration = data;
    },
    error: function(){
      information.duration = -1;
    }

  });


}

function verifyLink(urlNew){
  if($.inArray(urlNew,urls) > -1)
      {
       swal.showInputError("Esta url ya se encuentra agregada");
       return true; 
      }
  return false;
}

function sendMaterials()
{
  if(validateChecked()) return;
 // $(e.target).attr('disabled',true);
  //var file_data = $('input[name=archivos_client]').prop('files');  
  $datos = new FormData();
  $id  = $('#idAi').val();
  $instruccion = $("#instruccion").val();
  $reto = {
    'exam' :        $( "#examen" ).find('input[type=checkbox]').is(':checked'),
    'experiment' :  $( "#experimento" ).find('input[type=checkbox]').is(':checked')
  };
  $media = {
    'uploadVideo' : $( "#video-check" ).is(':checked'),
    'urls'        : $( "#url-check" ).is(':checked'),
    'videoUploaded' : $( "#vuploaded-check" ).is(':checked')
  };
  $datos.append('id',$id);
  $datos.append('instruccion',$instruccion);
  $datos.append('retos',JSON.stringify( $reto ) );
  $datos.append('media',JSON.stringify( $media ));
  if($media.uploadVideo)
  {
    $video = $("#fileRoot").find('input[type=file]').prop('files')[0];
    $nombre = $("#vname").val();
    $thumbnail = $("#thumbnail").prop('files')[0];
    $datos.append('video',$video);
    $datos.append('nombre',$nombre);
    $datos.append('thumbnail',$thumbnail);
  }
  if($media.urls)
  {
    $urlsJSON = JSON.stringify(urls);
    $datos.append('urls',$urlsJSON);
  }
  if($media.videoUploaded)
  {
    $urlsVUJSON = JSON.stringify(urlsVU);
    $datos.append('urlsVU',$urlsVUJSON);
  }



     $.ajax({
        xhr: function () {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function (evt) {
              if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  console.log(percentComplete);
                  /*
                  $('.progress').css({
                      width: percentComplete * 100 + '%'
                  });
                  if (percentComplete === 1) {
                      $('.progress').addClass('hide');
                  }
                  */
              }
          }, false);
          xhr.addEventListener("progress", function (evt) {
              if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  console.log(percentComplete);
                  /*
                  $('.progress').css({
                      width: percentComplete * 100 + '%'
                  });
                  */

              }
            }, false);
            return xhr;
          },
                url: './guardarAi', // point to server-side PHP script 
                data: $datos,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'text',
                success: function(data){
               
                 alert('SUCCESS RESPONSE : ' + data);
            
               

                }
                ,

             error:function(exception){
              alert("ERROR RESPONSE : " + exception);
             }

          
     });
}

function validateChecked(){
  flag = false;
  if($("#instruccion").val() == ""){
    $("#instrucciondiv").find("h4").addClass("alert alert-danger");
    $("#instrucciondiv").find("h4").text("Debes añadir una instruccion");
    flag = true;
  }
  else{
      $("#instruccion-div").find("h4").removeClass("alert alert-danger");
      $("#instruccion-div").find("h4").text("");
  }
  if(  !$("#examen").find("input[type=checkbox]").is(":checked") && !$("#experimento").find("input[type=checkbox]").is(":checked") ){
    $("#display-error").addClass("alert alert-danger");
    $("#display-error").text("Debes escoger un reto para la clase");
    flag = true;

  }
  else {
    $("#display-error").removeClass("alert alert-danger");
    $("#display-error").text("");
  }

  //video-check,url-check,vuploaded-check
  if($("#video-check").is(":checked"))
  {
    if(!document.getElementById("videoUpload").value != "")
    {
      $("#fileDisplay").addClass('alert alert-danger');
      $("#fileDisplay").text("Debes escoger un vídeo");
      $("#videoUpload").focus();
      flag = true;
    }
    else 
    {
      $("#fileDisplay").removeClass('alert alert-danger');
      $("#fileDisplay").text("");
    }

    if($("#vname").val() == "")
    {
      $("#vname-display").addClass('alert alert-danger');
      $("#vname-display").text("Necesitas nombrar el video");
      $("#vname").focus();
      flag = true;
    }
    else 
    {
      $("#vname-display").addClass('alert alert-danger');
      $("#vname-display").text("Necesitas nombrar el video");
   }



  
  }

  return flag;
}

