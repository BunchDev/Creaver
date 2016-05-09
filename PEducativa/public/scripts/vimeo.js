var circle;
var startColor = '#FC5B3F';
var endColor = '#6FD57F';
var circle;
var urls = new Array();
var videoData = {
          name: 'Default Name',
          description: ''
        };
$(document).ready(function(){




//Vimeo modal listener
$('#videoModal').on('hide.bs.modal', function () {
$("#reproductor").vimeo("unload");
})
});



function createCircleProgress()
{
  $("#progress").empty();
 circle =  new ProgressBar.Circle('#progress', {
    color: startColor,
    trailColor: '#eee',
    trailWidth: 1,
    duration: 1500,
    easing: 'bounce',
    strokeWidth: 5,
    text: {
        value: '0',
        
    },
    from: { color: startColor, width: 1 },
    to: { color: endColor, width: 10 },

    // Set default step function for all animate calls
    step: function(state, circle) {
        circle.setText((circle.value() * 100).toFixed(0));
        circle.path.setAttribute('stroke', state.color);
    }
});
}



    /**
        * Called when files are dropped on to the drop target. For each file,
        * uploads the content to Drive & displays the results when complete.
        */
       function handleFileSelect(evt) {

       	evt.stopPropagation();
        evt.preventDefault();
        var files = evt.dataTransfer.files; // FileList object.
       	var file = evt.dataTransfer.files[0];   
  		
       
		objectUrl = window.URL.createObjectURL(file);
		$("#vid").prop("src", objectUrl);
		
		$("#vid").on("loadedmetadata", function() {

			videoFile = $("#vid")[0];
      if ( !validarVideo("archivo",file,$(this))) return;
      if ( !validarVideo("size",videoFile,$(this)) ) return;
			
      $.when(getTokenVimeo()).done(function(respuestaToken){
         	  uploadFile(files,respuestaToken);
            createCircleProgress();
            });
				
	

    	
    	});
	}

     

       /**
        * Dragover handler to set the drop effect.
        */
       function handleDragOver(evt) {
         evt.stopPropagation();
         evt.preventDefault();
         evt.dataTransfer.dropEffect = 'copy';
       }

       /**
        * Wire up drag & drop listeners once page loads
        */
       document.addEventListener('DOMContentLoaded', function () {
           var dropZone = document.getElementById('drop_zone');
           dropZone.addEventListener('dragover', handleDragOver, false);
           dropZone.addEventListener('drop', handleFileSelect, false);
       });
;
       /**
        * Updat progress bar.
        */
       function updateProgress(progress) {

       	
          progress = Math.floor(progress * 100);
         
        
          circle.animate((progress/100));
      

       }


function subirVideo()
{
  videoFile = $("#vid")[0];
  file_data = $('#fl').prop('files')[0]
  if ( !validarVideo("archivo",file_data,null) ) return;
	if ( !validarVideo("size",videoFile,null) ) return;
  $("#checkbutton").prop("disabled",true);
	$("#drop_zone").hide();
  $("#cancelarSubida").show();
  $("#archivos_contenedor").hide();
  $("#progress").show();
  
	$.when(getTokenVimeo()).done(function(respuestaToken){
         	prepareFiletoUpload(respuestaToken);
          createCircleProgress();
         });


	
}
function prepareFiletoUpload(accessToken)
{

	  var file_data = $('#fl').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('archivo', file_data);
    videoData.name = $("#nombreAi").val();
      $("#progress").show();
      var uploader = new MediaUploader({
             file: file_data,
             token: accessToken,
             videoData: videoData,
             onError: function(data) {
                $("#progress").hide();
                 var errorResponse = JSON.parse(data);
                message = errorResponse.error;

                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-danger");
                element.appendChild(document.createTextNode(message));
                document.getElementById('results').appendChild(element);

             },
             onProgress: function(data) {
                updateProgress(data.loaded / data.total);
          
             },
             onComplete: function(videoId) {
                 $("#progress").hide();
                 $("#idVideo").attr('value',videoId);
                  guardar();
               
             }
         });
    uploader.upload();

}
var objectUrl;
$(document).ready(function(){
$('#drop_zone').bind("DOMNodeInserted DOMNodeRemoved",function(){
  

});



	$("#fl").change(function(e){
		
		var file = $('#fl').prop('files')[0];   
		
		objectUrl = window.URL.createObjectURL(file);
		
		$("#vid").prop("src", objectUrl);
	});

});


function validarVideo(tipo,file,metaload)
{

		if(tipo=="size")
		{
			 var seconds = file.duration;
			 var minutes = (seconds / 60);
			 if(minutes > 5){
           swal({  
                  title: '<i class="fa fa-frown-o fa-4x"></i>', 
                  text: "<h2>¡Ups!, el video supera los 5 minutos</h2>", 
                  html: true 
                });
            $("#drop_zone").show();
            if(metaload != null) metaload.off('loadedmetadata');
				    return false;
      }
      else{
        return true;
      }
			

		}
    if(tipo=="archivo")
    {
      console.log(file.duration);
      var validExtensions = ['mp4','mov','avi']; //array of valid extensions
      var fileName = file.name;
      var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
      if ($.inArray(fileNameExt, validExtensions) == -1){
            swal({  
                  title: '<i class="fa fa-frown-o fa-4x"></i>', 
                  text: "<h2>¡Ups!, el archivo que tratas de subir no contiene un formato de video correcto</h2>", 
                  html: true 
                });
          $("#drop_zone").show();    
          if(metaload != null) metaload.off('loadedmetadata');
          return false;
          }
      else 
        return true;
    }

}		
function uploadFile(files,accessToken)
{
    $("#checkbutton").prop('disabled',true);
		$("#drop_zone").hide();
   	
   	$("#archivos_contenedor").hide();
    $("#progress").show();
    $("#cancelarSubida").show();
 
         // Clear the results div
         var node = document.getElementById('results');
         while (node.hasChildNodes()) node.removeChild(node.firstChild);

         // Rest the progress bar
         updateProgress(0);
         videoData.name = $("#nombreAi").val();
         var uploader = new MediaUploader({
             file: files[0],
             token: accessToken,
             videoData: videoData,
             onError: function(data) {
                  $("#progress").hide();

                var errorResponse = JSON.parse(data);
                message = errorResponse.error;

                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-danger");
                element.appendChild(document.createTextNode(message));
                document.getElementById('results').appendChild(element);

             },
             onProgress: function(data) {
                updateProgress(data.loaded / data.total);
             },
             onComplete: function(videoId) {
                $("#progress").hide();

				      
              $("#idVideo").attr('value',videoId);

				        
           

              guardar();

             }
         });
         uploader.upload();



}

function getTokenVimeo()
{

return $.ajax({
   type:'post',
   url :"./getToken",
   
   data: {'_token': $('input[name=_token]').val()},
   
   success: function(data) {
       	 token = data;
       	 console.log("Token: "+ token);
         }
,
   error:function(exception){swal("¡Ups!, ocurrió un error al subir el video", "Intenta de nuevo más tarde", "error")}
});


}

function getIdUrl(url)
{

var regExp = /https:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;

var match = url.match(regExp);

if (match){
    return match[2];
}else{
    alert("not a vimeo url");
}

}

function showVideo(id)
{

$("#videoContent").append('<iframe id="player1" src="https://player.vimeo.com/video/'+id+'?api=1&player_id=player1" width="50%" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')


}
function showSucessMessage()
{

	var element = document.createElement("div");
                element.setAttribute('class', "alert alert-dismissible alert-success");
                element.appendChild(document.createTextNode("Video subido exitosamente"));
                document.getElementById('results').appendChild(element);

}


//test

function vimeoLoadingThumb(id){ 
    console.log("ID: "+id);   
    var url = "http://vimeo.com/api/v2/video/" + id + ".json";
   return $.getJSON( url, function() {
  console.log( "success" );
})
  .done(function(data) {
   showThumb(data);
  })
  .fail(function() {
    console.log( "error" );
  })
  .always(function() {
    console.log( "complete" );
  });
    //var id_img = "#vimeo-" + id;

   // var script = document.createElement( 'script' );
   // script.src = url;

   // $(id_img).before(script);
}


function showThumb(data){
 
    var img = $("<img></img>")
    img.attr('src',data[0].thumbnail_medium);
    $("#div_"+data[0].id).append(img);
 //   $("#div_"+data[0].id).not(".checkbox").css('opacity', '0.8');
  

}

function verVideo(id)
{

//https://player.vimeo.com/video/76979871?api=1&player_id=player1
urlPlayer = "https://player.vimeo.com/video/"+id+"?api=1&player_id=player1";
//This modal review

$("#reproductor").attr('src',urlPlayer);
$('#videoModal').modal('show');


}

//verifica si los datos en las etiquetas hide fueron alteradas
// manualmente por el usuario ¬¬
function verificarAlteracion()
{
  var supuesto = $("#idVideo").val();
  if(urls.length == 0) return true;
  for (var i = urls.length - 1; i >= 0; i--) 
  {
      if(supuesto == urls[i]) return true;
  }
  return false;
}



